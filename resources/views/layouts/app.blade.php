<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sansflix - Watch & Chill')</title>
    
    <link rel="icon" type="image/png" href="https://fazarrizwanuli.wordpress.com/wp-content/uploads/2026/01/picsart_26-01-07_23-54-57-173.png?w=1400&h=">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    


    <style>
        body { font-family: 'Inter', sans-serif; }
        html { scroll-behavior: smooth; }
        <style>
    /* Kostumisasi warna titik indikator agar sesuai tema Sansflix */
    .swiper-pagination-bullet {
        background: #4b5563 !important; /* Gray-600 */
        opacity: 1;
    }
    .swiper-pagination-bullet-active {
        background: #dc2626 !important; /* Red-600 */
        width: 24px !important;
        border-radius: 4px !important;
    }
    .promoSwiper {
        padding-bottom: 50px !important;
    }
    .movieSwiper {
        padding-bottom: 40px !important;
    }

    </style>
</head>
<body class="bg-gray-900 text-white font-sans antialiased min-h-screen flex flex-col">

    <nav class="bg-gray-800 border-b border-gray-700 p-4 sticky top-0 z-50 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center gap-2 group">
                <img src="https://fazarrizwanuli.wordpress.com/wp-content/uploads/2026/01/sansflix-logo.png.png?w=1024" alt="Logo" class="h-16 w-auto transition transform group-hover:scale-110">
            </a>
        
            <div class="flex items-center space-x-6">
                <a href="/" class="text-gray-300 hover:text-white transition">Home</a>
                <a href="{{ route('news.index') }}" class="text-gray-300 hover:text-white transition">News</a>
                <a href="#" class="text-gray-300 hover:text-white transition">Promo</a>
                
                <a href="{{ route('fnb.index') }}" 
                    class="group relative flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-yellow-500/10 to-orange-500/10 border border-yellow-500/30 hover:border-yellow-500 hover:bg-yellow-500 transition-all duration-300">
                    <span class="text-lg group-hover:animate-bounce">🍿</span>
                    <span class="text-sm font-bold text-yellow-500 group-hover:text-black tracking-wide uppercase">Snacks</span>
                    @if(session('cart'))
                        <span class="absolute -top-1 -right-1 flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-600"></span>
                        </span>
                    @endif
                </a>

                <a href="{{ route('cart.index') }}" class="relative text-gray-300 hover:text-white transition p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    {{-- Badge selalu ada di HTML agar JavaScript bisa menemukannya --}}
                    <span id="cart-badge" class="{{ session('cart') && count(session('cart')) > 0 ? '' : 'hidden' }} absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-lg border border-gray-900">
                        {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
                    </span>
                </a>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center focus:outline-none">
                            <div class="w-10 h-10 overflow-hidden rounded-full border-2 border-gray-700 hover:border-red-600 transition-all shadow-lg">
                               <img 
                                    src="{{ Auth::user()->avatar 
                                        ? (filter_var(Auth::user()->avatar, FILTER_VALIDATE_URL) 
                                            ? Auth::user()->avatar 
                                            : asset('storage/' . (str_starts_with(Auth::user()->avatar, 'uploads/avatars/') ? Auth::user()->avatar : 'uploads/avatars/' . Auth::user()->avatar))) 
                                        : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=E50914&color=fff' }}" 
                                    alt="Profile"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                        </button>

                        <div x-show="open" 
                            x-show="open" 
                            @click.outside="open = false" 
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-3 w-52 bg-gray-900 border border-white/10 rounded-2xl shadow-2xl py-2 z-50"
                            style="display: none;"
                            >
                            
                            
                            <div class="px-4 py-3 border-b border-white/5 mb-2 text-left">
                                <p class="text-[10px] text-gray-500 uppercase font-black tracking-widest">Hallo,</p>
                                <p class="text-sm text-white font-bold truncate">{{ Auth::user()->name }}</p>
                            </div>

                            <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:bg-red-600 hover:text-white transition group text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Edit Profil
                            </a>

                            <a href="{{ route('booking.history') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:bg-red-600 hover:text-white transition group text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.5 6a3 3 0 00-3-3H6.75a3 3 0 00-3 3v12a3 3 0 003 3h6.75a3 3 0 003-3V6zM3.75 9h16.5M3.75 15h16.5" />
                                </svg>
                                Tiket Saya
                            </a>

                            <a href="{{ route('food.history') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-300 hover:bg-red-600 hover:text-white transition group text-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Pesanan Makanan
                            </a>

                            <hr class="border-white/5 my-2">

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-600 hover:text-white transition group text-left font-bold">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('register') }}" class="group flex items-center gap-2 px-4 py-2 text-gray-400 hover:text-white transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:text-red-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
            </svg>
            <span class="text-xs font-black uppercase tracking-widest">Daftar</span>
        </a>

        <a href="{{ route('login') }}" class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-full shadow-[0_4px_15px_rgba(220,38,38,0.3)] transition-all duration-300 transform hover:-translate-y-0.5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="text-xs font-black uppercase tracking-widest">Masuk</span>
        </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-950 border-t border-gray-800 pt-16 pb-8 mt-auto">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
            
            <div class="md:col-span-4">
                <a href="/" class="flex items-center gap-3 mb-6 group">
                    <img src="https://fazarrizwanuli.wordpress.com/wp-content/uploads/2026/01/sansflix-logo.png.png?w=1024" 
                         alt="Logo Sansflix" 
                         class="h-30 w-auto transition transform group-hover:scale-110">
                </a>
                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Sansflix Cinema menghadirkan pengalaman menonton film terbaik dengan teknologi audio visual terkini. Tempat terbaik untuk menikmati film favorit bersama orang tersayang.
                </p>
                <div class="flex items-center gap-5">
                    <a href="#" class="text-gray-500 hover:text-red-600 transition text-xl"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-500 hover:text-red-600 transition text-xl"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-gray-500 hover:text-red-600 transition text-xl"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-500 hover:text-red-600 transition text-xl"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="md:col-span-2">
                <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-xs">Bantuan</h4>
                <ul class="space-y-4 text-gray-400 text-sm">
                    <li><a href="#" class="hover:text-red-600 transition">Pusat Bantuan</a></li>
                    <li><a href="#" class="hover:text-red-600 transition">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-red-600 transition">Kebijakan Privasi</a></li>
                </ul>
            </div>

            <div class="md:col-span-2">
                <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-xs">Experience</h4>
                <ul class="space-y-4 text-gray-400 text-sm">
                    <li><a href="#" class="hover:text-red-600 transition">Dolby Atmos</a></li>
                    <li><a href="#" class="hover:text-red-600 transition">IMAX Tech</a></li>
                    <li><a href="#" class="hover:text-red-600 transition">Food & Bar</a></li>
                </ul>
            </div>

            <div class="md:col-span-4">
                <h4 class="text-white font-bold mb-6 uppercase tracking-wider text-xs">Langganan Info Promo</h4>
                <p class="text-gray-400 text-sm mb-4">Dapatkan info jadwal film dan promo eksklusif langsung di email Anda.</p>
                <form action="#" class="flex flex-col gap-3">
                    <div class="relative">
                        <input type="email" placeholder="Alamat Email Anda" 
                               class="w-full bg-gray-900 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-red-600 transition">
                        <button type="submit" class="mt-3 w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-lg transition shadow-lg shadow-red-600/20">
                            Berlangganan
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <div class="pt-8 border-t border-gray-800 text-center">
            <p class="text-gray-500 text-xs">
                &copy; {{ date('Y') }} <span class="text-red-600 font-bold">Sansflix Cinema</span>. All rights reserved.
            </p>
        </div>
    </div>
</footer>

        <script>
            // Logika untuk menampilkan Toast dari Session Laravel
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            @if(session('success'))
                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}",
                    background: '#111827', // Warna gray-900 agar matching dengan tema
                    color: '#fff'
                });
            @endif

            document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi Slider Film
        new Swiper(".movieSwiper", {
            slidesPerView: 2,
            spaceBetween: 20,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                640: { slidesPerView: 3 },
                768: { slidesPerView: 4 },
                1024: { slidesPerView: 5 },
            },
        });

        // Inisialisasi Slider Promo
        new Swiper(".promoSwiper", {
            slidesPerView: 1.2,
            centeredSlides: true,
            spaceBetween: 30,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                768: { slidesPerView: 2 },
                1024: { slidesPerView: 2.5 },
            },
        });
    });
        </script>
</body>
</html>