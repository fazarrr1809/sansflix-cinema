

<?php $__env->startSection('title', 'Berita & Promo - Sansflix Cinema'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-900 min-h-screen py-16">
    <div class="container mx-auto px-4">
        
        <div class="mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4">
                SANSFLIX <span class="text-red-600">NEWS</span>
            </h1>
            <p class="text-gray-400 text-lg max-w-2xl">
                Dapatkan informasi terbaru mengenai film, jadwal tayang, dan promo eksklusif hanya di Sansflix Cinema.
            </p>
            <div class="w-20 h-1.5 bg-red-600 mt-6 rounded-full"></div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($allNews->isEmpty()): ?>
            <div class="bg-gray-800 rounded-2xl p-12 text-center border border-gray-700">
                <p class="text-gray-500 text-xl italic">Belum ada berita yang diterbitkan.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $allNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group bg-gray-800 rounded-2xl overflow-hidden shadow-lg border border-gray-700 transition duration-300 hover:border-red-600/50">
                        <div class="relative h-56 overflow-hidden">
                            <img src="<?php echo e($news->thumbnail_url); ?>" 
                                 class="w-full h-full object-cover transition duration-500 group-hover:scale-110" 
                                 alt="<?php echo e($news->title); ?>">
                            <div class="absolute top-4 left-4">
                                <span class="bg-red-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest">
                                    Latest Update
                                </span>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="text-red-500 text-xs font-bold mb-2 uppercase tracking-tighter">
                                <?php echo e($news->created_at->format('d M Y')); ?>

                            </div>
                            <h3 class="text-xl font-bold text-white mb-3 group-hover:text-red-500 transition">
                                <?php echo e($news->title); ?>

                            </h3>
                            <p class="text-gray-400 text-sm leading-relaxed mb-6">
                                <?php echo e(Str::limit(strip_tags($news->content), 120)); ?>

                            </p>
                            <a href="<?php echo e(route('news.show', $news->slug)); ?>" 
                               class="inline-flex items-center gap-2 text-white font-bold text-sm hover:gap-4 transition-all">
                                Baca Selengkapnya <span class="text-red-600">&rarr;</span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="mt-12">
                <?php echo e($allNews->links()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/news/index.blade.php ENDPATH**/ ?>