@extends('layouts.app')

@section('title', 'Tiket Saya - Sansflix')

@section('content')
<div class="container mx-auto px-4 py-10 min-h-screen">
    <h1 class="text-3xl font-bold mb-8 border-l-4 border-red-600 pl-4 text-white">Riwayat Tiket Saya</h1>

    @if($bookings->isEmpty())
        <div class="text-center py-20 bg-gray-800 rounded-xl border border-gray-700 opacity-75">
            <p class="text-gray-400 text-xl mb-4">Kamu belum pernah beli tiket.</p>
            <a href="{{ route('home') }}" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-full transition font-bold">
                Cari Film Sekarang
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($bookings as $booking)
                <div class="bg-gray-800 rounded-xl overflow-hidden shadow-lg border border-gray-700 hover:border-gray-500 transition relative group">
                    <div class="h-40 w-full relative overflow-hidden">
                        @php
                            // Cek apakah poster_url adalah URL lengkap atau path lokal
                            $posterPath = $booking->showtime->movie->poster_url;
                            $imageUrl = str_contains($posterPath, 'http') ? $posterPath : Storage::url($posterPath);
                        @endphp
                        
                        <img src="{{ $imageUrl }}" 
                             alt="{{ $booking->showtime->movie->title }}"
                             class="w-full h-full object-cover opacity-60 group-hover:scale-110 transition duration-500">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="font-bold text-xl text-white shadow-black drop-shadow-lg truncate">
                                {{ $booking->showtime->movie->title }}
                            </h3>
                            <p class="text-xs text-gray-300">{{ $booking->showtime->movie->genre }}</p>
                        </div>
                    </div>

                    <div class="p-5">
                        <div class="flex justify-between items-center text-sm mb-3 text-gray-400 font-medium">
                            <span><i class="far fa-calendar-alt mr-1"></i> {{ $booking->showtime->starts_at->format('d M Y') }}</span>
                            <span><i class="far fa-clock mr-1"></i> {{ $booking->showtime->starts_at->format('H:i') }}</span>
                        </div>

                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Studio</p>
                                <p class="font-bold text-white">{{ $booking->showtime->auditorium->name }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">Total</p>
                                <p class="font-bold text-red-400">
                                    {{ $booking->details->count() }} Kursi
                                </p>
                            </div>
                        </div>

                        <div class="border-t border-gray-700 pt-4 flex justify-between items-center">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter {{ $booking->status == 'paid' ? 'bg-green-600/20 text-green-500' : 'bg-yellow-600/20 text-yellow-500' }}">
                                {{ $booking->status }}
                            </span>

                            @if($booking->status == 'paid')
                                <a href="{{ route('booking.ticket', $booking->id) }}" class="text-blue-400 hover:text-white text-sm font-bold transition hover:underline">
                                    Lihat Tiket &rarr;
                                </a>
                            @else
                                <a href="{{ route('booking.success', $booking->id) }}" class="text-yellow-500 hover:text-white text-sm font-bold transition hover:underline">
                                    Bayar Sekarang &rarr;
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection