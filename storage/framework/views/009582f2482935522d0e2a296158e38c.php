<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Sansflix - Watch & Chill'); ?></title>
    
    <link rel="icon" type="image/png" href="https://fazarrizwanuli.wordpress.com/wp-content/uploads/2026/01/picsart_26-01-07_23-54-57-173.png?w=1400&h=">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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
                <a href="<?php echo e(route('news.index')); ?>" class="text-gray-300 hover:text-white transition">News</a>
                <a href="#" class="text-gray-300 hover:text-white transition">Promo</a>
                
                <a href="<?php echo e(route('fnb.index')); ?>" 
                    class="group relative flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-yellow-500/10 to-orange-500/10 border border-yellow-500/30 hover:border-yellow-500 hover:bg-yellow-500 transition-all duration-300">
                    <span class="text-lg group-hover:animate-bounce">🍿</span>
                    <span class="text-sm font-bold text-yellow-500 group-hover:text-black tracking-wide uppercase">Snacks</span>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('cart')): ?>
                        <span class="absolute -top-1 -right-1 flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-600"></span>
                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>

                <a href="<?php echo e(route('cart.index')); ?>" class="relative text-gray-300 hover:text-white transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('cart')): ?>
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                            <?php echo e(count(session('cart'))); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <div class="flex items-center gap-6">
                        <div class="relative inline-block group">
                            <button class="text-gray-300 group-hover:text-white transition text-sm flex items-center gap-2 outline-none py-2">
                                <div class=" hover:bg-red-600 transition">
                                    <i class="fas fa-history text-white text-xs"></i>
                                </div>
                                <span class="hidden sm:inline font-medium">Riwayat</span>
                                <i class="fas fa-chevron-down text-[10px] ml-1 opacity-50 transition-transform group-hover:rotate-180"></i>
                            </button>
                            
                            <div class="absolute right-0 w-56 pt-2 bg-transparent opacity-0 translate-y-2 invisible group-hover:opacity-100 group-hover:translate-y-0 group-hover:visible transition-all duration-200 z-[999]">
                                <div class="bg-gray-800 border border-gray-700 rounded-xl shadow-2xl overflow-hidden">
                                    <a href="<?php echo e(route('booking.history')); ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-300 hover:bg-red-600 hover:text-white transition border-b border-gray-700/50">
                                        <i class="fas fa-ticket-alt w-5 text-red-500 group-hover:text-white"></i> 
                                        <span>Tiket Saya</span>
                                    </a>
                                    <a href="<?php echo e(route('food.history')); ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-300 hover:bg-yellow-600 hover:text-white transition">
                                        <i class="fas fa-hamburger w-5 text-yellow-500 group-hover:text-white"></i> 
                                        <span>Pesanan Makanan</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <span class="text-gray-600">|</span>
                        
                        <div class="flex items-center gap-3">
                            <span class="text-gray-300 text-sm font-bold truncate max-w-[120px]">Hi, <?php echo e(Auth::user()->name); ?></span>
                            <form action="<?php echo e(route('logout')); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white border border-red-600/50 px-4 py-1.5 rounded-lg transition text-xs font-bold">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="text-gray-300 hover:text-white font-medium mr-2">Masuk</a>
                    <a href="<?php echo e(route('register')); ?>" class="bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-lg transition text-sm font-bold shadow-lg shadow-red-600/30 text-center">
                        Daftar
                    </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        <?php echo $__env->yieldContent('content'); ?>
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
                &copy; <?php echo e(date('Y')); ?> <span class="text-red-600 font-bold">Sansflix Cinema</span>. All rights reserved.
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

            <?php if(session('success')): ?>
                Toast.fire({
                    icon: 'success',
                    title: "<?php echo e(session('success')); ?>",
                    background: '#111827', // Warna gray-900 agar matching dengan tema
                    color: '#fff'
                });
            <?php endif; ?>

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
</html><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/layouts/app.blade.php ENDPATH**/ ?>