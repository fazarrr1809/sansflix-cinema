@extends('layouts.app')

@section('title', 'E-Ticket - ' . $booking->showtime->movie->title)

@section('content')
<div class="container mx-auto px-4 py-12 flex flex-col items-center min-h-screen">
    <div class="bg-white rounded-3xl overflow-hidden shadow-2xl max-w-4xl w-full flex flex-col md:flex-row border border-gray-200">
        
        <div class="md:w-1/3 bg-gray-900 p-8 text-white relative">
            <div class="absolute top-0 left-0 w-full h-full opacity-20">
                <img src="{{ str_contains($booking->showtime->movie->poster_url, 'http') ? $booking->showtime->movie->poster_url : Storage::url($booking->showtime->movie->poster_url) }}" class="w-full h-full object-cover">
            </div>
            <div class="relative z-10 flex flex-col h-full justify-between">
                <div>
                    <h2 class="text-2xl font-black leading-tight uppercase tracking-tighter mb-2">{{ $booking->showtime->movie->title }}</h2>
                    <p class="text-sm text-red-500 font-bold tracking-widest uppercase">{{ $booking->showtime->movie->genre }}</p>
                </div>
                <div class="mt-12">
                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-1">Kode Booking</p>
                    <p class="text-xl font-mono font-bold text-yellow-500 tracking-wider">{{ $booking->booking_code }}</p>
                </div>
            </div>
        </div>

        <div class="md:w-2/3 p-10 bg-white text-gray-900 flex flex-col justify-between">
            <div class="grid grid-cols-2 gap-8 mb-8">
                <div>
                    <h4 class="text-[10px] text-gray-400 uppercase font-bold">Studio</h4>
                    <p class="text-lg font-black">{{ $booking->showtime->auditorium->name }}</p>
                </div>
                <div>
                    <h4 class="text-[10px] text-gray-400 uppercase font-bold">Tanggal</h4>
                    <p class="text-lg font-black">{{ $booking->showtime->starts_at->format('d M Y') }}</p>
                </div>
                <div>
                    <h4 class="text-[10px] text-gray-400 uppercase font-bold">Jam Tayang</h4>
                    <p class="text-lg font-black">{{ $booking->showtime->starts_at->format('H:i') }} WIB</p>
                </div>
                <div>
                    <h4 class="text-[10px] text-gray-400 uppercase font-bold">Nomor Kursi</h4>
                    <p class="text-lg font-black text-red-600">
                        @foreach($booking->details as $detail)
                            {{ $detail->seat_number }}{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </p>
                </div>
            </div>

            <div class="flex flex-col items-center border-t border-dashed border-gray-300 pt-8">
                <div class="p-4 border-2 border-gray-100 rounded-2xl mb-4">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $booking->booking_code }}" alt="QR Code" class="w-32 h-32">
                </div>
                <p class="text-[10px] text-gray-400 text-center uppercase leading-relaxed">Tunjukkan QR Code ini kepada petugas studio <br> untuk proses check-in masuk.</p>
            </div>
        </div>
    </div>

    <div class="mt-8 flex gap-4">
        <a href="{{ route('booking.pdf', $booking->id) }}" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-xl font-bold transition flex items-center gap-2 shadow-lg shadow-red-600/30">
            <i class="fas fa-download"></i> Download E-Ticket (PDF)
        </a>
        <a href="{{ route('booking.history') }}" class="bg-gray-800 hover:bg-gray-700 text-white px-8 py-3 rounded-xl font-bold transition flex items-center gap-2">
            Kembali ke Riwayat
        </a>
    </div>
</div>
@endsection