

<?php $__env->startSection('title', $news->title . ' - Sansflix News'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <nav class="text-sm text-gray-400 mb-6">
            <a href="/" class="hover:text-white">Home</a> / 
            <a href="<?php echo e(route('news.index')); ?>" class="hover:text-white">News</a> / 
            <span class="text-gray-200"><?php echo e(Str::limit($news->title, 30)); ?></span>
        </nav>

        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 leading-tight">
            <?php echo e($news->title); ?>

        </h1>
        
        <div class="flex items-center text-gray-400 text-sm mb-8 gap-4">
            <span class="flex items-center gap-1">
                📅 <?php echo e($news->created_at->format('d M Y')); ?>

            </span>
            <span class="text-red-600 font-bold uppercase">Sansflix Editorial</span>
        </div>

        <div class="rounded-2xl overflow-hidden shadow-2xl mb-10 border border-gray-800">
            <img src="<?php echo e($news->thumbnail_url); ?>" alt="<?php echo e($news->title); ?>" class="w-full h-auto">
        </div>

        <div class="prose prose-invert prose-red max-w-none text-gray-300 leading-relaxed text-lg">
            <?php echo $news->content; ?>

        </div>

        <div class="mt-16 pt-8 border-t border-gray-800">
            <a href="<?php echo e(route('news.index')); ?>" class="inline-flex items-center gap-2 text-red-600 font-bold hover:text-red-500 transition">
                &larr; Kembali ke Daftar Berita
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/news/show.blade.php ENDPATH**/ ?>