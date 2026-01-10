@extends('layouts.app')

@section('title', $movie->title . ' - Sansflix')

@section('content')
<div class="bg-gray-950 min-h-screen">
    <div class="relative h-[40vh] w-full overflow-hidden hidden md:block">
        <img src="{{ $movie->poster_url }}" class="w-full h-full object-cover blur-2xl opacity-30">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/60 to-transparent"></div>
    </div>

    <div class="container mx-auto px-4 -mt-32 relative z-10 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            
            <div class="md:col-span-1">
                <div class="sticky top-24">
                    @if($movie->poster_url)
                        <img src="{{ $movie->poster_url }}" 
                             alt="{{ $movie->title }}" 
                             class="w-full rounded-2xl shadow-2xl border border-gray-800 transform transition hover:scale-[1.02] duration-500">
                    @else
                        <div class="w-full aspect-[2/3] bg-gray-800 rounded-2xl flex items-center justify-center border border-gray-700">
                            <span class="text-xs text-gray-500 italic">Poster tidak tersedia</span>
                        </div>
                    @endif
                    
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="bg-gray-900/80 backdrop-blur-md p-4 rounded-2xl text-center border border-gray-800">
                            <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest mb-1">Rating Usia</p>
                            <h3 class="text-2xl font-black text-red-600">{{ $movie->age_rating }}</h3>
                        </div>
                        <div class="bg-gray-900/80 backdrop-blur-md p-4 rounded-2xl text-center border border-gray-800">
                            <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest mb-1">Skor</p>
                            <h3 class="text-2xl font-black text-yellow-500">★ {{ $movie->rating }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="mb-6">
                    <h1 class="text-4xl md:text-6xl font-black mb-4 tracking-tighter">{{ $movie->title }}</h1>
                    <div class="flex flex-wrap items-center gap-3 text-sm">
                        <span class="bg-red-600/20 text-red-500 px-3 py-1 rounded-full border border-red-600/30 font-bold">{{ $movie->genre }}</span>
                        <span class="text-gray-400 flex items-center gap-1">
                            <i class="far fa-clock"></i> {{ $movie->duration_minutes }} Menit
                        </span>
                    </div>
                </div>

                @if($movie->trailer_url)
                    <div class="mb-10 group">
                        <h3 class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-4 flex items-center gap-2">
                            <span class="w-8 h-[2px] bg-red-600"></span> Trailer Resmi
                        </h3>
                        <div class="aspect-video rounded-3xl overflow-hidden shadow-2xl border border-gray-800 bg-black">
                            <iframe class="w-full h-full" 
                                    src="{{ $movie->embed_url }}"
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                @endif

                <div class="mb-10">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-4 flex items-center gap-2">
                        <span class="w-8 h-[2px] bg-red-600"></span> Sinopsis
                    </h3>
                    <p class="text-gray-400 leading-relaxed text-lg font-light">{{ $movie->description }}</p>
                </div>

                <div class="bg-gray-900/50 backdrop-blur-md p-8 rounded-3xl border border-gray-800 shadow-xl">
                    <h2 class="text-2xl font-black mb-6 flex items-center gap-3">
                        <i class="fas fa-ticket-alt text-red-600"></i> Jadwal Tayang Hari Ini
                    </h2>
                    
                    @if($movie->showtimes->isEmpty())
                        <div class="text-center py-10">
                            <p class="text-gray-600 italic">Maaf, belum ada jadwal tayang tersedia untuk film ini.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-4">
                            @foreach($movie->showtimes as $showtime)
                                <div class="bg-gray-800/40 border border-gray-700 p-5 rounded-2xl hover:border-red-600/50 hover:bg-gray-800 transition-all duration-300 flex flex-col md:flex-row justify-between items-center group">
                                    <div class="flex items-center gap-5 mb-4 md:mb-0">
                                        <div class="w-12 h-12 bg-red-600/10 rounded-xl flex items-center justify-center text-red-600 group-hover:bg-red-600 group-hover:text-white transition">
                                            <i class="fas fa-door-open"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-lg text-white">{{ $showtime->auditorium->name }}</p>
                                            <p class="text-xs text-gray-500 uppercase font-bold tracking-widest">
                                                {{ $showtime->starts_at->format('H:i') }} WIB
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-6 w-full md:w-auto justify-between md:justify-end">
                                        <p class="text-xl font-black text-white italic">
                                            <span class="text-[10px] text-gray-500 not-italic uppercase block">Harga Tiket</span>
                                            Rp {{ number_format($showtime->ticket_price, 0, ',', '.') }}
                                        </p>
                                        <a href="{{ route('booking.seats', $showtime->id) }}" 
                                           class="bg-red-600 hover:bg-white hover:text-black text-white font-bold px-6 py-3 rounded-xl transition-all shadow-lg shadow-red-600/20 active:scale-95">
                                            PILIH KURSI
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="mt-8 flex flex-col sm:flex-row items-center gap-4">
                        <a href="{{ route('home') }}" 
                        class="w-full sm:w-auto flex items-center justify-center gap-2 bg-gray-800 hover:bg-gray-700 text-white font-bold px-8 py-3 rounded-xl transition-all border border-gray-700 shadow-lg">
                            <i class="fas fa-arrow-left text-sm"></i>
                            Kembali ke Beranda
                        </a>
                        
                        <a href="{{ route('fnb.index') }}" 
                        class="w-full sm:w-auto flex items-center justify-center gap-2 bg-yellow-600/10 hover:bg-yellow-600 text-yellow-600 hover:text-black font-bold px-8 py-3 rounded-xl transition-all border border-yellow-600/30">
                            <span>🍿</span>
                            Beli Snack
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection