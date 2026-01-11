<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Showtime;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\BookingSuccessMail;

class BookingController extends Controller
{
    // --- 1. PILIH KURSI ---
    public function selectSeats($showtimeId)
    {
        $showtime = Showtime::with(['movie', 'auditorium'])->findOrFail($showtimeId);
        
        $bookedSeats = BookingDetail::whereHas('booking', function($q) use ($showtimeId) {
            $q->where('showtime_id', $showtimeId);
        })->pluck('seat_id')->toArray();

        $seats = Seat::where('auditorium_id', $showtime->auditorium_id)
                     ->orderBy('row_letter')
                     ->orderBy('seat_number')
                     ->get();

        return view('booking_seat', compact('showtime', 'seats', 'bookedSeats'));
    }

    // --- 2. PROSES TRANSAKSI (SIMPAN DATA BOOKING) ---
    public function store(Request $request)
    {
        $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seats' => 'required|array|min:1',
            'seats.*' => 'exists:seats,id',
        ]);

        $showtime = Showtime::findOrFail($request->showtime_id);

        try {
            DB::beginTransaction();

            $totalTicket = count($request->seats);
            $totalPrice = $totalTicket * $showtime->ticket_price;

            $booking = Booking::create([
                'booking_code' => 'BOOK-' . strtoupper(uniqid()),
                'showtime_id' => $showtime->id,
                'customer_name' => Auth::user()->name,
                'customer_email' => Auth::user()->email,
                'total_tickets' => $totalTicket,
                'total_price' => $totalPrice,
                'status' => 'pending', 
            ]);

            foreach ($request->seats as $seatId) {
                $seat = Seat::find($seatId);
                
                // Cek Race Condition
                $isTaken = BookingDetail::whereHas('booking', function($q) use ($showtime) {
                    $q->where('showtime_id', $showtime->id);
                })->where('seat_id', $seatId)->exists();

                if ($isTaken) {
                    throw new \Exception("Kursi {$seat->row_letter}{$seat->seat_number} baru saja diambil orang lain!");
                }

                BookingDetail::create([
                    'booking_id' => $booking->id,
                    'seat_id' => $seatId,
                    'seat_number' => $seat->row_letter . $seat->seat_number,
                    'price' => $showtime->ticket_price,
                ]);
            }
            
            DB::commit();
            return redirect()->route('booking.success', $booking->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal booking: ' . $e->getMessage()]);
        }
    }

    // --- 3. PROSES BAYAR ---
    public function payNow(Request $request, $id)
    {
        $request->validate([
            'payment_method' => 'required|string'
        ]);

        $booking = Booking::with(['showtime.movie', 'details'])->findOrFail($id);

        $booking->update([
            'status' => 'paid',
            'payment_method' => $request->payment_method
        ]);

        try {
            set_time_limit(300); 
            $pdf = Pdf::loadView('pdf_ticket', compact('booking'));
            
            Mail::to($booking->customer_email)->send(
                new BookingSuccessMail($booking, $pdf->output())
            );

            Log::info("Email tiket berhasil dikirim ke: " . $booking->customer_email);
        } catch (\Exception $e) {
            Log::error('Gagal kirim email: ' . $e->getMessage());
        }

        return back()->with('success', 'Pembayaran via ' . strtoupper($request->payment_method) . ' Berhasil!');
    }

    // --- 4. HALAMAN TIKET SUKSES ---
    public function success($id)
    {
        $booking = Booking::with(['showtime.movie', 'details'])->findOrFail($id);
        $expiredTime = $booking->created_at->addMinutes(15)->toIso8601String();
        return view('booking_success', compact('booking', 'expiredTime'));
    }

    // --- 5. RIWAYAT & TIKET ---
    public function showTicket($id)
    {
        $booking = Booking::with(['showtime.movie', 'showtime.auditorium', 'details'])
                    ->where('customer_email', Auth::user()->email) 
                    ->findOrFail($id);

        if ($booking->status !== 'paid') {
            return redirect()->route('booking.success', $id)
                ->with('error', 'Silakan selesaikan pembayaran terlebih dahulu.');
        }

        return view('booking_ticket', compact('booking'));
    }

    public function history()
    {
        $bookings = Booking::with(['showtime.movie', 'showtime.auditorium'])
                    ->where('customer_email', Auth::user()->email)
                    ->latest()
                    ->get();

        return view('history', compact('bookings'));
    }

    // --- 6. PEMBATALAN ---
    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        
        if ($booking->status == 'pending') {
            $showtime_id = $booking->showtime_id;
            $booking->details()->delete(); 
            $booking->delete(); 

            return redirect()->route('booking.seats', $showtime_id)
                             ->with('info', 'Transaksi dibatalkan. Silakan pilih kursi kembali.');
        }

        return redirect()->route('home');
    }

    public function expire($id) 
    {
        $booking = Booking::findOrFail($id);
        if ($booking->status == 'pending') {
            $booking->details()->delete();
            $booking->delete();
        }
        return redirect()->route('home')->with('error', 'Waktu pembayaran telah habis.');
    }

    // --- 7. DOWNLOAD PDF ---
    public function downloadPdf($id)
    {
        $booking = Booking::where('customer_email', Auth::user()->email)->findOrFail($id);

        if ($booking->status !== 'paid') {
            abort(403, 'Tiket belum dibayar.');
        }

        $pdf = Pdf::loadView('pdf_ticket', compact('booking'));
        return $pdf->download('Tiket-Sansflix-' . $booking->booking_code . '.pdf');
    }
}