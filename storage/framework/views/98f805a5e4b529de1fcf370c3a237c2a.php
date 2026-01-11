

<?php $__env->startSection('content'); ?>
<div class="bg-gray-950 min-h-screen py-12 text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8 italic uppercase">Keranjang <span class="text-red-600">Snacks</span></h1>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('cart')): ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-gray-900 rounded-2xl overflow-hidden border border-gray-800">
                        <?php $total = 0 ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $total += $details['price'] * $details['quantity'] ?>
                            <div class="flex items-center gap-4 p-6 border-b border-gray-800 last:border-0">
                                <img src="<?php echo e($details['image']); ?>" class="w-20 h-20 object-cover rounded-lg">
                                <div class="flex-grow">
                                    <h3 class="font-bold text-lg"><?php echo e($details['name']); ?></h3>
                                    <p class="text-gray-400 text-sm">Rp <?php echo e(number_format($details['price'], 0, ',', '.')); ?> x <?php echo e($details['quantity']); ?></p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-red-600">Rp <?php echo e(number_format($details['price'] * $details['quantity'], 0, ',', '.')); ?></p>
                                    <form action="<?php echo e(route('cart.remove')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?php echo e($id); ?>">
                                        <button type="submit" class="text-xs text-gray-500 hover:text-white mt-2">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-gray-900 p-6 rounded-2xl border border-gray-800 sticky top-24">
                        <h2 class="text-xl font-bold mb-6">Ringkasan Pesanan</h2>
                        <div class="flex justify-between mb-4">
                            <span class="text-gray-400">Total Harga</span>
                            <span class="font-bold">Rp <?php echo e(number_format($total, 0, ',', '.')); ?></span>
                        </div>
                        <form action="<?php echo e(route('cart.checkout')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="w-full bg-red-600 py-3 rounded-xl font-bold hover:bg-red-700 transition mt-4">
                                Bayar Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-20 bg-gray-900 rounded-3xl border border-gray-800">
                <p class="text-gray-500 text-lg">Keranjangmu masih kosong.</p>
                <a href="<?php echo e(route('fnb.index')); ?>" class="inline-block mt-4 text-red-600 font-bold hover:underline">Ayo cari camilan!</a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/cart/index.blade.php ENDPATH**/ ?>