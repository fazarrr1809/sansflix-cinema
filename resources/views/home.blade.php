@extends('layouts.app')

@section('title', 'Sansflix - Home')

@section('content')
    {{-- HERO SECTION --}}
    <div class="relative h-screen min-h-[600px] flex items-center justify-center text-center overflow-hidden bg-gray-900">
        <div class="absolute top-0 left-0 w-full h-full z-0">
            <img src="https://i.pinimg.com/1200x/25/2e/9b/252e9be8d3af9ccb54b8abb4c039386f.jpg" 
                class="w-full h-full object-cover opacity-60" 
                alt="Hero Background">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/40 via-gray-900/70 to-gray-900"></div>
        </div>
        
        <div class="relative z-10 container mx-auto px-4">
            <h1 class="text-7xl md:text-9xl text-white mb-6 tracking-wide drop-shadow-[0_5px_15px_rgba(255,255,255,0.3)]" 
                style="font-family: 'Great Vibes', cursive;">
                Sansflix <span class="text-red-600">Cinema</span>
            </h1>
            
            <p class="text-gray-300 text-xl md:text-2xl max-w-3xl mx-auto font-light tracking-wide leading-relaxed mb-10">
                Nikmati pengalaman menonton terbaik dengan kualitas layar dan suara premium hanya di Sansflix Cinema.
            </p>
            
            <a href="#daftar-film" class="inline-block px-10 py-4 border-2 border-white text-white font-bold rounded-full transition-all duration-300 hover:bg-white hover:text-gray-900 hover:shadow-[0_0_20px_rgba(255,255,255,0.4)] transform hover:scale-105 group relative overflow-hidden">
                <span class="relative z-10">Mulai Jelajahi</span>
                <div class="absolute inset-0 bg-white transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-in-out"></div>
            </a>
        </div>
    </div>

    <div id="daftar-film" class="container mx-auto px-4 py-16 flex-grow">
            
        {{-- BAGIAN 1: SEDANG TAYANG --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-white flex items-center gap-2">
                <span class="w-2 h-8 bg-red-600 rounded-full"></span> Sedang Tayang
            </h2>
            <div class="flex gap-2">
                <div class="swiper-button-prev-custom cursor-pointer bg-gray-800 hover:bg-red-600 text-white p-2 rounded-full transition shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                </div>
                <div class="swiper-button-next-custom cursor-pointer bg-gray-800 hover:bg-red-600 text-white p-2 rounded-full transition shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </div>
            </div>
        </div>

        <div class="swiper movieSwiper mb-20">
            <div class="swiper-wrapper">
                @foreach ($nowPlaying as $movie)
                    <div class="swiper-slide">
                        <div class="group relative bg-gray-900 rounded-2xl overflow-hidden border border-gray-800 transition-all duration-500 hover:border-red-600/50 hover:shadow-[0_0_30px_rgba(220,38,38,0.15)]">
                            <div class="aspect-[2/3] w-full overflow-hidden relative">
                                <img src="{{ $movie->poster_url }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/20 to-transparent opacity-60"></div>
                                <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-center items-center p-6 text-center">
                                    <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                        <h3 class="text-xl font-black text-white mb-2 leading-tight">{{ $movie->title }}</h3>
                                        <p class="text-red-500 text-sm font-bold mb-6 uppercase tracking-widest">{{ $movie->genre }}</p>
                                        <a href="{{ route('movies.show', $movie->id) }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-black py-3 px-8 rounded-full transition-all active:scale-95 shadow-lg shadow-red-600/20">
                                            <span>BELI TIKET</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="p-5 bg-gray-900/80 backdrop-blur-sm">
                                <h3 class="text-white font-bold text-lg truncate group-hover:text-red-500 transition-colors">{{ $movie->title }}</h3>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-gray-400 text-sm italic">{{ $movie->genre }}</span>
                                    <span class="flex items-center gap-1 text-yellow-500 text-sm font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                        4.5
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination !static mt-8"></div>
        </div>

        {{-- BAGIAN 2: SEGERA TAYANG --}}
        <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
            <span class="w-2 h-8 bg-yellow-500 rounded-full"></span> Segera Tayang
        </h2>
        <div class="swiper comingSoonSwiper mb-16">
            <div class="swiper-wrapper">
                @foreach ($comingSoon as $movie)
                    <div class="swiper-slide">
                        <div class="bg-gray-800 rounded-xl overflow-hidden border border-gray-700 opacity-80 hover:opacity-100 transition duration-300">
                            <div class="aspect-[2/3] w-full overflow-hidden relative">
                                <img src="{{ $movie->poster_url }}" class="w-full h-full object-cover">
                                <div class="absolute top-2 right-2">
                                    <span class="bg-yellow-600 text-black text-[10px] font-extrabold px-2 py-1 rounded shadow-md">SOON</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-white font-semibold truncate">{{ $movie->title }}</h3>
                                <div class="flex items-center gap-2 text-yellow-500 text-xs mt-2 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <span>Coming Soon</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- BAGIAN 3: SELESAI TAYANG --}}
        <section class="py-10">
            <h2 class="text-2xl font-bold text-gray-500 mb-6 flex items-center gap-2 italic">
                <span class="w-2 h-8 bg-gray-600 rounded-full"></span> Selesai Tayang
            </h2>
            @if($finishedMovies->isEmpty())
                <p class="text-gray-500 italic">Belum ada riwayat film yang selesai tayang.</p>
            @else
                <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                    @foreach ($finishedMovies as $movie)
                        <div class="grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition duration-500 text-center">
                            <div class="aspect-[2/3] w-full overflow-hidden rounded-xl shadow-sm">
                                <img src="{{ $movie->poster_url }}" class="w-full h-full object-cover">
                            </div>
                            <h3 class="text-gray-400 mt-2 text-sm font-medium">{{ $movie->title }}</h3>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>

    
    {{-- NEWS SECTION --}}
<section class="py-14 bg-gray-900 border-t border-gray-800">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-black text-white mb-10 flex items-center gap-3 italic uppercase tracking-tighter">
            <span class="w-10 h-1 bg-red-600"></span> Sansflix News
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
            {{-- Headline (1 Berita Utama) --}}
            @if(isset($latestNews[0]))
            <a href="{{ route('news.show', $latestNews[0]->slug) }}" class="lg:col-span-8 group block h-full">
                <div class="relative overflow-hidden rounded-3xl aspect-video border border-gray-800 h-full">
                    <img src="{{ $latestNews[0]->thumbnail_url }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/40 to-transparent"></div>
                    <div class="absolute bottom-0 p-8 w-full">
                        <span class="bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase mb-4 inline-block">Hot News</span>
                        <h3 class="text-xl md:text-3xl font-black text-white mb-3 group-hover:text-red-500 transition line-clamp-2 leading-tight">
                            {{ $latestNews[0]->title }}
                        </h3>
                        <p class="text-gray-400 text-sm line-clamp-2 hidden md:block">{{ Str::limit(strip_tags($latestNews[0]->content), 150) }}</p>
                    </div>
                </div>
            </a>
            @endif

            {{-- Sidebar (3 Berita Samping) --}}
            <div class="lg:col-span-4 flex flex-col justify-between gap-4">
                @foreach($latestNews->skip(1)->take(3) as $news)
                    {{-- items-center untuk sejajar vertikal, border-b untuk garis bawah --}}
                    <div class="flex items-center gap-5 group cursor-pointer border-b border-gray-800/50 pb-6 last:border-0 last:pb-0">
                        
                        {{-- Wadah Thumbnail --}}
                        <div class="w-32 h-24 flex-shrink-0 overflow-hidden rounded-2xl border border-gray-800">
                            <img src="{{ $news->thumbnail_url }}" 
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500"
                                alt="{{ $news->title }}">
                        </div>
                        
                        {{-- Wadah Teks Berita (Sejajar Vertikal dengan Thumbnail) --}}
                        <div class="flex flex-col justify-center flex-grow min-w-0">
                            <h4 class="text-white font-bold text-base leading-tight line-clamp-2 group-hover:text-red-500 transition duration-300">
                                {{ $news->title }}
                            </h4>
                            <div class="flex items-center gap-2 mt-3">
                                {{-- Dot Merah kecil sebagai aksen profesional --}}
                                <span class="w-1.5 h-1.5 bg-red-600 rounded-full"></span>
                                <span class="text-gray-500 text-[10px] uppercase tracking-widest font-bold">
                                    {{ $news->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    @endforeach
            </div>
        </div>
    </div>
</section>

    {{-- PROMO SECTION --}}
    <section class="py-14 bg-gray-900">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-white mb-8 border-l-4 border-yellow-500 pl-4">Promo Menarik</h2>
            <div class="swiper promoSwiper">
                <div class="swiper-wrapper">
                    @foreach($activePromos as $promo)
                        <div class="swiper-slide">
                            <div class="relative group bg-gray-800 rounded-3xl overflow-hidden border border-gray-700 shadow-2xl transition-transform duration-300">
                                <img src="{{ $promo->thumbnail_url }}" class="w-full h-56 md:h-72 object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 p-6 w-full">
                                    <span class="text-xs font-black bg-yellow-500 text-black px-3 py-1 rounded-full uppercase tracking-tighter">PROMO</span>
                                    <h3 class="text-2xl font-black text-white mt-2 italic uppercase tracking-tighter">{{ $promo->title }}</h3>
                                    <p class="text-gray-300 text-sm mt-1">Berlaku hingga: <span class="text-yellow-500 font-bold">{{ $promo->expired_at->format('d M Y') }}</span></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    {{-- SCRIPTS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper(".movieSwiper", {
                slidesPerView: 2,
                spaceBetween: 20,
                grabCursor: true,
                navigation: {
                    nextEl: ".swiper-button-next-custom",
                    prevEl: ".swiper-button-prev-custom",
                },
                breakpoints: {
                    640: { slidesPerView: 3 },
                    1024: { slidesPerView: 5 },
                },
            });

            new Swiper(".comingSoonSwiper", {
                slidesPerView: 2,
                spaceBetween: 20,
                grabCursor: true,
                breakpoints: {
                    640: { slidesPerView: 3 },
                    1024: { slidesPerView: 5 },
                },
            });

            new Swiper(".promoSwiper", {
                slidesPerView: 1,
                spaceBetween: 20,
                autoplay: { delay: 3000 },
                breakpoints: {
                    768: { slidesPerView: 2 },
                },
            });
        });
    </script>
@endsection