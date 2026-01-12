

<?php $__env->startSection('title', 'Sansflix - Home'); ?>

<?php $__env->startSection('content'); ?>
    
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
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $nowPlaying; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <div class="group relative bg-gray-900 rounded-2xl overflow-hidden border border-gray-800 transition-all duration-500 hover:border-red-600/50 hover:shadow-[0_0_30px_rgba(220,38,38,0.15)]">
                            <div class="aspect-[2/3] w-full overflow-hidden relative">
                                <img src="<?php echo e($movie->poster_url); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/20 to-transparent opacity-60"></div>
                                <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-center items-center p-6 text-center">
                                    <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                        <h3 class="text-xl font-black text-white mb-2 leading-tight"><?php echo e($movie->title); ?></h3>
                                        <p class="text-red-500 text-sm font-bold mb-6 uppercase tracking-widest"><?php echo e($movie->genre); ?></p>
                                        <a href="<?php echo e(route('movies.show', $movie->id)); ?>" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-black py-3 px-8 rounded-full transition-all active:scale-95 shadow-lg shadow-red-600/20">
                                            <span>BELI TIKET</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="p-5 bg-gray-900/80 backdrop-blur-sm">
                                <h3 class="text-white font-bold text-lg truncate group-hover:text-red-500 transition-colors"><?php echo e($movie->title); ?></h3>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-gray-400 text-sm italic"><?php echo e($movie->genre); ?></span>
                                    <span class="flex items-center gap-1 text-yellow-500 text-sm font-bold">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                        <?php echo e($movie->rating ?? 'N/A'); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="swiper-pagination !static mt-8"></div>
        </div>

        
        <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
            <span class="w-2 h-8 bg-yellow-500 rounded-full"></span> Segera Tayang
        </h2>
        <div class="swiper comingSoonSwiper mb-16">
            <div class="swiper-wrapper">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $comingSoon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <div class="bg-gray-800 rounded-xl overflow-hidden border border-gray-700 opacity-80 hover:opacity-100 transition duration-300">
                            <div class="aspect-[2/3] w-full overflow-hidden relative">
                                <img src="<?php echo e($movie->poster_url); ?>" class="w-full h-full object-cover">
                                <div class="absolute top-2 right-2">
                                    <span class="bg-yellow-600 text-black text-[10px] font-extrabold px-2 py-1 rounded shadow-md">SOON</span>
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-white font-semibold truncate"><?php echo e($movie->title); ?></h3>
                                <div class="flex items-center gap-2 text-yellow-500 text-xs mt-2 font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <span>Coming Soon</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        
        <section class="py-10">
            <h2 class="text-2xl font-bold text-gray-500 mb-6 flex items-center gap-2 italic">
                <span class="w-2 h-8 bg-gray-600 rounded-full"></span> Selesai Tayang
            </h2>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($finishedMovies->isEmpty()): ?>
                <p class="text-gray-500 italic">Belum ada riwayat film yang selesai tayang.</p>
            <?php else: ?>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $finishedMovies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition duration-500 text-center">
                            <div class="aspect-[2/3] w-full overflow-hidden rounded-xl shadow-sm">
                                <img src="<?php echo e($movie->poster_url); ?>" class="w-full h-full object-cover">
                            </div>
                            <h3 class="text-gray-400 mt-2 text-sm font-medium"><?php echo e($movie->title); ?></h3>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </section>
    </div>

    
    <section class="py-14 bg-gray-900 border-t border-gray-800">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-black text-white mb-10 flex items-center gap-3 italic uppercase tracking-tighter">
                <span class="w-10 h-1 bg-red-600"></span> Sansflix News
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($latestNews[0])): ?>
                <a href="<?php echo e(route('news.show', $latestNews[0]->slug)); ?>" class="lg:col-span-8 group block h-full">
                    <div class="relative overflow-hidden rounded-3xl aspect-video border border-gray-800 h-full">
                        <img src="<?php echo e($latestNews[0]->thumbnail_url); ?>" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/40 to-transparent"></div>
                        <div class="absolute bottom-0 p-8 w-full">
                            <span class="bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase mb-4 inline-block">Hot News</span>
                            <h3 class="text-xl md:text-3xl font-black text-white mb-3 group-hover:text-red-500 transition line-clamp-2 leading-tight">
                                <?php echo e($latestNews[0]->title); ?>

                            </h3>
                            <p class="text-gray-400 text-sm line-clamp-2 hidden md:block"><?php echo e(Str::limit(strip_tags($latestNews[0]->content), 150)); ?></p>
                        </div>
                    </div>
                </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="lg:col-span-4 flex flex-col justify-between gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $latestNews->skip(1)->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('news.show', $news->slug)); ?>" class="flex items-center gap-5 group cursor-pointer border-b border-gray-800/50 pb-6 last:border-0 last:pb-0">
                            <div class="w-32 h-24 flex-shrink-0 overflow-hidden rounded-2xl border border-gray-800">
                                <img src="<?php echo e($news->thumbnail_url); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" alt="<?php echo e($news->title); ?>">
                            </div>
                            <div class="flex flex-col justify-center flex-grow min-w-0">
                                <h4 class="text-white font-bold text-base leading-tight line-clamp-2 group-hover:text-red-500 transition duration-300">
                                    <?php echo e($news->title); ?>

                                </h4>
                                <div class="flex items-center gap-2 mt-3">
                                    <span class="w-1.5 h-1.5 bg-red-600 rounded-full"></span>
                                    <span class="text-gray-500 text-[10px] uppercase tracking-widest font-bold">
                                        <?php echo e($news->created_at->diffForHumans()); ?>

                                    </span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    
    <section id="promos" class="py-14 bg-gray-900 border-t border-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-white border-l-4 border-yellow-500 pl-4 uppercase tracking-wider">
                    Promo Menarik
                </h2>
            </div>

            <div class="swiper promoSwiper">
                <div class="swiper-wrapper">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $activePromos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide">
                            <a href="<?php echo e(route('promo.detail', $promo->slug)); ?>" class="block">
                                <div class="relative group bg-gray-800 rounded-3xl overflow-hidden border border-gray-700 shadow-2xl transition-all duration-500 hover:border-yellow-500/50">
                                    <img src="<?php echo e($promo->thumbnail_url); ?>" class="w-full h-56 md:h-72 object-cover transform transition-transform duration-700 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/20 to-transparent opacity-90"></div>
                                    <div class="absolute bottom-0 left-0 p-6 w-full">
                                        <span class="inline-block text-[10px] font-black bg-yellow-500 text-black px-3 py-1 rounded-md uppercase tracking-tighter mb-3 shadow-lg">Limited Offer</span>
                                        <h3 class="text-2xl font-black text-white italic uppercase tracking-tighter line-clamp-1 group-hover:text-yellow-500 transition-colors">
                                            <?php echo e($promo->title); ?>

                                        </h3>
                                        <div class="flex items-center mt-2 text-gray-300 text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                            Berlaku hingga: 
                                            <span class="ml-1 text-yellow-500 font-bold">
                                                <?php echo e(is_string($promo->expired_at) ? \Carbon\Carbon::parse($promo->expired_at)->format('d M Y') : $promo->expired_at->format('d M Y')); ?>

                                            </span>
                                        </div>
                                    </div>
                                    <div class="absolute top-4 right-4 bg-black/60 backdrop-blur-md border border-white/10 px-3 py-1 rounded-lg">
                                        <p class="text-[10px] text-gray-400 uppercase">Code</p>
                                        <p class="text-xs font-mono text-white font-bold"><?php echo e($promo->promo_code); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="swiper-pagination !relative !bottom-0 mt-8"></div>
            </div>
        </div>
    </section>

    
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
                spaceBetween: 24,
                grabCursor: true,
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                    dynamicBullets: true,
                },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1280: { slidesPerView: 2 },
                },
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/home.blade.php ENDPATH**/ ?>