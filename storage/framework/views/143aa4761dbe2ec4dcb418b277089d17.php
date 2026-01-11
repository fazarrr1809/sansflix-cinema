

<?php $__env->startSection('title', $movie->title . ' - Sansflix'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gray-950 min-h-screen">
    
    <div class="relative h-[40vh] w-full overflow-hidden hidden md:block">
        <img src="<?php echo e($movie->poster_url); ?>" class="w-full h-full object-cover blur-3xl opacity-20 transform scale-110">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/80 to-transparent"></div>
    </div>

    <div class="container mx-auto px-4 -mt-32 relative z-10 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            
            <div class="lg:col-span-1">
                <div class="sticky top-24">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($movie->poster_url): ?>
                        <img src="<?php echo e($movie->poster_url); ?>" 
                             alt="<?php echo e($movie->title); ?>" 
                             class="w-full rounded-3xl shadow-[0_0_50px_rgba(0,0,0,0.5)] border border-gray-800">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <div class="bg-gray-900/80 backdrop-blur-md p-4 rounded-2xl text-center border border-gray-800">
                            <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest mb-1">Rating Usia</p>
                            <h3 class="text-2xl font-black text-red-600"><?php echo e($movie->age_rating); ?></h3>
                        </div>
                        <div class="bg-gray-900/80 backdrop-blur-md p-4 rounded-2xl text-center border border-gray-800">
                            <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest mb-1">Skor</p>
                            <h3 class="text-2xl font-black text-yellow-500">★ <?php echo e($movie->rating); ?></h3>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="lg:col-span-2">
                <div class="mb-8">
                    <h1 class="text-4xl md:text-6xl font-black mb-4 tracking-tighter text-white"><?php echo e($movie->title); ?></h1>
                    <div class="flex flex-wrap items-center gap-3 text-sm">
                        <span class="bg-red-600 text-white px-4 py-1 rounded-full font-bold uppercase tracking-tighter text-xs"><?php echo e($movie->genre); ?></span>
                        <span class="text-gray-400 flex items-center gap-2 bg-gray-900/50 px-4 py-1 rounded-full border border-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <?php echo e($movie->duration_minutes); ?> Menit
                        </span>
                    </div>
                </div>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($movie->trailer_url): ?>
                    <div class="mb-10 group">
                        <h3 class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-4 flex items-center gap-2">
                            <span class="w-8 h-[2px] bg-red-600"></span> Trailer Resmi
                        </h3>
                        <div class="aspect-video rounded-3xl overflow-hidden shadow-2xl border border-gray-800 bg-black">
                            <iframe class="w-full h-full" 
                                    src="<?php echo e($movie->embed_url); ?>"
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen></iframe>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <div class="mb-12">
                    <h3 class="text-sm font-bold uppercase tracking-widest text-gray-500 mb-4 flex items-center gap-2">
                        <span class="w-8 h-[2px] bg-red-600"></span> Sinopsis
                    </h3>
                    <p class="text-gray-400 leading-relaxed text-lg font-light"><?php echo e($movie->description); ?></p>
                </div>

                
                <div class="bg-gray-900/30 backdrop-blur-md p-2 md:p-8 rounded-[2rem] border border-gray-800 shadow-2xl">
                    <div class="flex items-center justify-between mb-8 px-4 md:px-0">
                        <h2 class="text-2xl font-black text-white flex items-center gap-3">
                            <i class="fas fa-calendar-alt text-red-600 text-xl"></i> Jadwal Tayang
                        </h2>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($movie->showtimes->isEmpty()): ?>
                        <div class="text-center py-20 bg-gray-900/50 rounded-3xl border border-dashed border-gray-700">
                            <p class="text-gray-500 italic">Maaf, belum ada jadwal tayang tersedia.</p>
                        </div>
                    <?php else: ?>
                        
                        <div class="flex gap-3 overflow-x-auto pb-6 mb-10 scrollbar-hide px-4 md:px-0">
                            <?php
                                $groupedShowtimes = $movie->showtimes->groupBy(fn($s) => $s->starts_at->format('Y-m-d'));
                            ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $groupedShowtimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $times): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <button type="button" 
                                    class="date-tab flex-shrink-0 min-w-[90px] p-4 rounded-2xl border-2 transition-all duration-300 <?php echo e($loop->first ? 'border-red-600 bg-red-600 text-white shadow-lg shadow-red-600/20' : 'border-gray-800 bg-gray-900/50 text-gray-500 hover:border-gray-600 hover:text-white'); ?>"
                                    data-date="<?php echo e($date); ?>">
                                    <span class="block text-[10px] uppercase font-black tracking-widest opacity-70"><?php echo e(\Carbon\Carbon::parse($date)->translatedFormat('M')); ?></span>
                                    <span class="block text-3xl font-black my-1"><?php echo e(\Carbon\Carbon::parse($date)->format('d')); ?></span>
                                    <span class="block text-[10px] font-bold uppercase"><?php echo e(\Carbon\Carbon::parse($date)->translatedFormat('D')); ?></span>
                                </button>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <div id="showtime-container">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $groupedShowtimes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date => $times): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="date-content space-y-4 <?php echo e($loop->first ? 'animate-in fade-in slide-in-from-bottom-4 duration-500' : 'hidden'); ?>" id="content-<?php echo e($date); ?>">
                                    <?php
                                        $auditoriums = $times->groupBy('auditorium.name');
                                    ?>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $auditoriums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studioName => $sessions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="bg-gray-800/40 rounded-3xl p-6 border border-gray-700/50 group hover:border-red-600/30 transition-all duration-500">
                                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 bg-red-600/10 rounded-xl flex items-center justify-center text-red-600">
                                                        <i class="fas fa-video"></i>
                                                    </div>
                                                    <div>
                                                        <h3 class="text-xl font-black text-white"><?php echo e($studioName); ?></h3>
                                                        <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Digital 2D • Executive</p>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-xs text-gray-500 uppercase font-black tracking-widest mb-1">Harga Tiket</p>
                                                    <p class="text-xl font-black text-white italic">Rp <?php echo e(number_format($sessions[0]->ticket_price, 0, ',', '.')); ?></p>
                                                </div>
                                            </div>
                                            
                                            <div class="flex flex-wrap gap-3">
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('booking.seats', $session->id)); ?>" 
                                                       class="min-w-[80px] text-center px-6 py-3 bg-gray-950 hover:bg-red-600 text-white font-black rounded-xl border border-gray-800 hover:border-red-600 transition-all active:scale-95 shadow-lg">
                                                        <?php echo e($session->starts_at->format('H:i')); ?>

                                                    </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <div class="mt-12 flex flex-col sm:flex-row items-center gap-4 border-t border-gray-800 pt-8">
                        <a href="<?php echo e(route('home')); ?>" 
                        class="w-full sm:w-auto flex items-center justify-center gap-2 bg-gray-800/50 hover:bg-gray-800 text-white font-bold px-8 py-4 rounded-2xl transition-all border border-gray-700">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="<?php echo e(route('fnb.index')); ?>" 
                        class="w-full sm:w-auto flex items-center justify-center gap-2 bg-yellow-600/10 hover:bg-yellow-600 text-yellow-600 hover:text-black font-bold px-8 py-4 rounded-2xl transition-all border border-yellow-600/30">
                            <span>🍿</span> Snack & Drinks
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.date-tab');
        const contents = document.querySelectorAll('.date-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const targetDate = tab.getAttribute('data-date');

                // Update Style Tab
                tabs.forEach(t => {
                    t.classList.remove('border-red-600', 'bg-red-600', 'text-white', 'shadow-lg', 'shadow-red-600/20');
                    t.classList.add('border-gray-800', 'bg-gray-900/50', 'text-gray-500');
                });
                tab.classList.add('border-red-600', 'bg-red-600', 'text-white', 'shadow-lg', 'shadow-red-600/20');
                tab.classList.remove('border-gray-800', 'bg-gray-900/50', 'text-gray-500');

                // Switch Konten Jadwal
                contents.forEach(content => {
                    content.classList.add('hidden');
                    content.classList.remove('animate-in', 'fade-in', 'slide-in-from-bottom-4');
                });
                
                const activeContent = document.getElementById('content-' + targetDate);
                activeContent.classList.remove('hidden');
                activeContent.classList.add('animate-in', 'fade-in', 'slide-in-from-bottom-4', 'duration-500');
            });
        });
    });
</script>

<style>
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/movie_detail.blade.php ENDPATH**/ ?>