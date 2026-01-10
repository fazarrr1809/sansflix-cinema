

<?php $__env->startSection('title', 'Sansflix - Home'); ?>

<?php $__env->startSection('content'); ?>
    <div class="relative h-screen min-h-[600px] flex items-center justify-center text-center overflow-hidden bg-gray-900">
        <div class="absolute top-0 left-0 w-full h-full z-0">
            <img src="https://i.pinimg.com/1200x/25/2e/9b/252e9be8d3af9ccb54b8abb4c039386f.jpg" 
                class="w-full h-full object-cover opacity-40" 
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
                
        <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
            <span class="w-2 h-8 bg-red-600 rounded-full"></span> Sedang Tayang
        </h2>

        <div class="swiper movieSwiper mb-16">
            <div class="swiper-wrapper">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $nowPlaying; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <div class="group relative bg-gray-800 rounded-xl overflow-hidden shadow-lg border border-gray-700">
                            <div class="aspect-[2/3] w-full overflow-hidden relative">
                                <img src="<?php echo e($movie->poster_url); ?>" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-black/80 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-center items-center p-4 text-center">
                                    <h3 class="text-lg font-bold text-white mb-4"><?php echo e($movie->title); ?></h3>
                                    <a href="<?php echo e(route('movies.show', $movie->id)); ?>" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-full shadow-lg">
                                        Beli Tiket
                                    </a>
                                </div>
                            </div>
                            <div class="p-4 bg-gray-800">
                                <h3 class="text-white font-semibold truncate"><?php echo e($movie->title); ?></h3>
                                <p class="text-gray-400 text-sm mt-1"><?php echo e($movie->genre); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div class="swiper-pagination !-bottom-2"></div>
        </div>

        
        <h2 class="text-2xl font-bold text-white mb-6 flex items-center gap-2">
            <span class="w-2 h-8 bg-yellow-500 rounded-full"></span> Segera Tayang
        </h2>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($comingSoon->isEmpty()): ?>
            <p class="text-gray-500 italic">Belum ada film yang akan datang.</p>
        <?php else: ?>
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $comingSoon; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="relative bg-gray-800 rounded-xl overflow-hidden shadow-lg border border-gray-700 opacity-80 hover:opacity-100 transition">
                        <div class="aspect-[2/3] w-full overflow-hidden relative">
                            <img src="<?php echo e($movie->poster_url); ?>" class="w-full h-full object-cover grayscale-[50%]">
                            <div class="absolute top-2 right-2">
                                <span class="bg-yellow-600 text-black text-[10px] font-extrabold px-2 py-1 rounded shadow-md">COMING SOON</span>
                            </div>
                        </div>
                        <div class="p-4 bg-gray-800">
                            <h3 class="text-white font-semibold truncate"><?php echo e($movie->title); ?></h3>
                            <p class="text-gray-400 text-sm mt-1"><?php echo e($movie->genre); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="mt-20 flex justify-center">
            <div class="w-24 h-1.5 bg-red-600 rounded-full"></div>
        </div>
    </div>

    <section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-black text-white mb-10 flex items-center gap-3 italic uppercase tracking-tighter">
            <span class="w-10 h-1 bg-red-600"></span> Sansflix News
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($latestNews[0])): ?>
            <div class="lg:col-span-7 group cursor-pointer">
                <div class="relative overflow-hidden rounded-3xl aspect-video border border-gray-800">
                    <img src="<?php echo e($latestNews[0]->thumbnail_url); ?>" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/20 to-transparent"></div>
                    <div class="absolute bottom-0 p-8">
                        <span class="bg-red-600 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase mb-4 inline-block">Hot News</span>
                        <h3 class="text-3xl font-black text-white mb-3 group-hover:text-red-500 transition"><?php echo e($latestNews[0]->title); ?></h3>
                        <p class="text-gray-400 text-sm line-clamp-2"><?php echo e(Str::limit(strip_tags($latestNews[0]->content), 150)); ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="lg:col-span-5 space-y-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $latestNews->skip(1)->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex gap-4 group cursor-pointer border-b border-gray-900 pb-6 last:border-0">
                    <div class="w-32 h-24 flex-shrink-0 overflow-hidden rounded-xl border border-gray-800">
                        <img src="<?php echo e($news->thumbnail_url); ?>" class="w-full h-full object-cover group-hover:scale-110 transition">
                    </div>
                    <div class="flex flex-col justify-center">
                        <h4 class="text-white font-bold text-sm line-clamp-2 group-hover:text-red-500 transition"><?php echo e($news->title); ?></h4>
                        <span class="text-gray-500 text-[10px] mt-2 uppercase tracking-widest font-bold"><?php echo e($news->created_at->diffForHumans()); ?></span>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="py-12 bg-gray-900">
    <h2 class="text-2xl font-bold text-white mb-8 border-l-4 border-yellow-500 pl-4">Promo Menarik</h2>
    
    <div class="swiper promoSwiper">
        <div class="swiper-wrapper">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $activePromos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                    <div class="relative group bg-gray-800 rounded-3xl overflow-hidden border border-gray-700 shadow-2xl transition-transform duration-300">
                        <img src="<?php echo e($promo->thumbnail_url); ?>" class="w-full h-56 md:h-72 object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 p-6 w-full">
                            <span class="text-xs font-black bg-yellow-500 text-black px-3 py-1 rounded-full uppercase tracking-tighter">PROMO</span>
                            <h3 class="text-2xl font-black text-white mt-2 italic uppercase tracking-tighter"><?php echo e($promo->title); ?></h3>
                            <p class="text-gray-300 text-sm mt-1">Berlaku hingga: <span class="text-yellow-500 font-bold"><?php echo e($promo->expired_at->format('d M Y')); ?></span></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/home.blade.php ENDPATH**/ ?>