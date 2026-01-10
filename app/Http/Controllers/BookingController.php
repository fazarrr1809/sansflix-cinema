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
use Illuminate\Support\Facades\Log; // Wajib ada untuk debugging
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
        // A. Validasi Input
        $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seats' => 'required|array|min:1',
            'seats.*' => 'exists:seats,id',
        ]);

        $showtime = Showtime::findOrFail($request->showtime_id);

        try {
            DB::beginTransaction();

            // B. Hitung Harga
            $totalTicket = count($request->seats);
            $totalPrice = $totalTicket * $showtime->ticket_price;

            // C. Buat Booking (Status PENDING)
            $booking = Booking::create([
                'booking_code' => 'BOOK-' . strtoupper(uniqid()),
                'showtime_id' => $showtime->id,
                'customer_name' => Auth::user()->name,
                'customer_email' => Auth::user()->email,
                'total_tickets' => $totalTicket,
                'total_price' => $totalPrice,
                'status' => 'pending', // Belum lunas
            ]);

            // D. Simpan Detail Kursi
            foreach ($request->seats as $seatId) {
                $seat = Seat::find($seatId);
                
                // Cek apakah kursi sudah diambil orang lain (Race Condition)
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

            // CATATAN: Kode Midtrans sudah dihapus di sini agar lebih efisien.
            
            DB::commit(); // Simpan ke database

            // Redirect ke halaman sukses (User akan diminta pilih pembayaran di sana)
            return redirect()->route('booking.success', $booking->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal booking: ' . $e->getMessage()]);
        }
    }

    // --- 3. PROSES BAYAR (SIMULASI DENGAN PILIHAN METODE) ---
    // Fungsi ini dipanggil saat user klik tombol "Bayar Sekarang" di halaman success
    public function payNow(Request $request, $id)
    {
        // Validasi: User harus memilih salah satu metode
        $request->validate([
            'payment_method' => 'required|string'
        ]);

        // Cari data booking
        $booking = Booking::with(['showtime.movie', 'details'])->findOrFail($id);

        // Update status LUNAS & Simpan Metode Pembayarannya
        $booking->update([
            'status' => 'paid',
            'payment_method' => $request->payment_method
        ]);

        // --- KIRIM EMAIL TIKET ---
        try {
            // Beri waktu ekstra (5 menit) agar pembuatan PDF tidak timeout
            set_time_limit(300); 
            
            // Buat PDF
            $pdf = Pdf::loadView('pdf_ticket', compact('booking'));
            
            // Kirim ke Email User
            Mail::to($booking->customer_email)->send(
                new BookingSuccessMail($booking, $pdf->output())
            );

            Log::info("Email tiket berhasil dikirim ke: " . $booking->customer_email);

        } catch (\Exception $e) {
            // Jika email gagal, jangan error kan aplikasinya. Cukup catat di log.
            Log::error('Gagal kirim email: ' . $e->getMessage());
        }

        // Kembali ke halaman yang sama dengan pesan sukses
        return back()->with('success', 'Pembayaran via ' . strtoupper($request->payment_method) . ' Berhasil! Tiket dikirim ke email.');
    }

    // --- 4. HALAMAN TIKET SUKSES ---
    public function success($id)
    {
        $booking = Booking::with(['showtime.movie', 'details'])->findOrFail($id);
        return view('booking_success', compact('booking'));
    }

    // --- 5. RIWAYAT ---
    public function showTicket($id)
    {
        // 1. Cari booking berdasarkan ID dan Email User
        $booking = Booking::with(['showtime.movie', 'showtime.auditorium', 'details'])
                    ->where('customer_email', Auth::user()->email) 
                    ->findOrFail($id);

        // 2. VALIDASI STATUS: Jika belum lunas, lempar kembali ke halaman pembayaran
        if ($booking->status !== 'paid') {
            return redirect()->route('booking.success', $id)
                ->with('error', 'Silakan selesaikan pembayaran terlebih dahulu untuk melihat tiket.');
        }

        // 3. Jika sudah lunas, baru tampilkan halaman tiket
        return view('booking_ticket', compact('booking'));
    }

    public function history()
    {
        // Sesuaikan juga fungsi history agar tidak error
        $bookings = Booking::with(['showtime.movie', 'showtime.auditorium'])
                    ->where('customer_email', Auth::user()->email)
                    ->latest()
                    ->get();

        return view('history', compact('bookings'));
    }

    // --- 6. DOWNLOAD PDF ---
    public function downloadPdf($id)
    {
        $booking = Booking::with(['showtime.movie', 'details'])->findOrFail($id);

        if ($booking->customer_email !== Auth::user()->email) {
            abort(403, 'Akses ditolak');
        }
        
        $booking = Booking::where('customer_email', Auth::user()->email)->findOrFail($id);

        if ($booking->status !== 'paid') {
            abort(403, 'Tiket belum dibayar.');
        }

        $pdf = Pdf::loadView('pdf_ticket', compact('booking'));

        return $pdf->download('Tiket-Sansflix-' . $booking->booking_code . '.pdf');
    }

}