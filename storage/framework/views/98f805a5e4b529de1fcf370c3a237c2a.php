

<?php $__env->startSection('content'); ?>
<div class="bg-gray-950 min-h-screen py-12 text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8 italic uppercase">Keranjang <span class="text-red-600">Snacks</span></h1>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('cart') && count(session('cart')) > 0): ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-gray-900 rounded-2xl overflow-hidden border border-gray-800" id="cart-items-container">
                        <?php $total = 0 ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $total += $details['price'] * $details['quantity'] ?>
                            <div class="flex flex-col md:flex-row items-center gap-4 p-6 border-b border-gray-800 last:border-0" id="item-row-<?php echo e($id); ?>">
                                <img src="<?php echo e($details['image']); ?>" class="w-24 h-24 object-cover rounded-lg shadow-lg">
                                
                                <div class="flex-grow text-center md:text-left">
                                    <h3 class="font-bold text-lg"><?php echo e($details['name']); ?></h3>
                                    <p class="text-yellow-500 font-semibold">Rp <?php echo e(number_format($details['price'], 0, ',', '.')); ?></p>
                                </div>

                                
                                <div class="flex items-center gap-3 bg-gray-950 p-2 rounded-xl border border-gray-800">
                                    <button onclick="updateCartQty(<?php echo e($id); ?>, -1)" 
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 hover:bg-red-600 transition duration-300 text-white font-bold">
                                        -
                                    </button>
                                    
                                    <span class="w-8 text-center font-bold text-lg" id="qty-<?php echo e($id); ?>">
                                        <?php echo e($details['quantity']); ?>

                                    </span>

                                    <button onclick="updateCartQty(<?php echo e($id); ?>, 1)" 
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-800 hover:bg-green-600 transition duration-300 text-white font-bold">
                                        +
                                    </button>
                                </div>

                                <div class="text-right min-w-[120px]">
                                    
                                    <p class="font-bold text-red-600 text-lg" id="subtotal-<?php echo e($id); ?>">
                                        Rp <?php echo e(number_format($details['price'] * $details['quantity'], 0, ',', '.')); ?>

                                    </p>
                                    <form action="<?php echo e(route('cart.remove')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?php echo e($id); ?>">
                                        <button type="submit" class="text-xs text-gray-500 hover:text-red-500 transition mt-2 flex items-center gap-1 justify-end ml-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-gray-900 p-6 rounded-2xl border border-gray-800 sticky top-24 shadow-2xl">
                        <h2 class="text-xl font-bold mb-6 border-b border-gray-800 pb-4">Ringkasan Pesanan</h2>
                        <div class="flex justify-between mb-4">
                            <span class="text-gray-400">Subtotal</span>
                            <span class="font-bold text-white text-lg" id="summary-subtotal">Rp <?php echo e(number_format($total, 0, ',', '.')); ?></span>
                        </div>
                        <div class="flex justify-between mb-6">
                            <span class="text-gray-400">Pajak (0%)</span>
                            <span class="font-bold text-white">Rp 0</span>
                        </div>
                        <div class="border-t border-gray-800 pt-4 flex justify-between mb-8">
                            <span class="font-bold">Total Pembayaran</span>
                            <span class="font-black text-2xl text-yellow-500" id="summary-total">Rp <?php echo e(number_format($total, 0, ',', '.')); ?></span>
                        </div>

                        <form action="<?php echo e(route('cart.checkout')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="w-full bg-red-600 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-red-700 hover:scale-[1.02] active:scale-95 transition-all duration-300 shadow-lg shadow-red-600/20">
                                Checkout Sekarang
                            </button>
                        </form>
                        
                        <a href="<?php echo e(route('fnb.index')); ?>" class="block text-center mt-4 text-sm text-gray-500 hover:text-white transition">
                            Tambah menu lainnya
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="text-center py-24 bg-gray-900 rounded-3xl border border-gray-800 shadow-xl">
                <div class="bg-gray-800 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <p class="text-gray-400 text-xl font-medium">Keranjangmu masih kosong.</p>
                <a href="<?php echo e(route('fnb.index')); ?>" class="inline-block mt-6 bg-red-600 text-white px-8 py-3 rounded-full font-bold hover:bg-red-700 transition transform hover:scale-110 shadow-lg shadow-red-600/20">
                    Ayo Cari Snack!
                </a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>

<script>
// Fungsi pembantu untuk memformat angka ke Rupiah
function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(number).replace("IDR", "Rp");
}

function updateCartQty(id, change) {
    fetch("<?php echo e(route('cart.update_quantity')); ?>", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            "X-Requested-With": "XMLHttpRequest"
        },
        body: JSON.stringify({
            id: id,
            change: change
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Jika item dihapus karena qty jadi 0
            if (data.item_removed) {
                const row = document.getElementById('item-row-' + id);
                if(row) row.remove();
                
                // Jika keranjang benar-benar kosong setelah dihapus, refresh halaman untuk tampilkan "Keranjang Kosong"
                if (data.cart_count === 0) {
                    window.location.reload();
                    return;
                }
            } else {
                // Update angka jumlah (Quantity) di halaman
                const qtyElement = document.getElementById('qty-' + id);
                if(qtyElement) qtyElement.innerText = data.new_qty;

                // Update subtotal item tersebut
                const subtotalElement = document.getElementById('subtotal-' + id);
                if(subtotalElement) subtotalElement.innerText = formatRupiah(data.new_subtotal);
            }

            // Update Total di Ringkasan Pesanan (Kanan)
            document.getElementById('summary-subtotal').innerText = formatRupiah(data.new_total);
            document.getElementById('summary-total').innerText = formatRupiah(data.new_total);

            // Update badge angka di Navbar (jika ada)
            const navbarBadge = document.getElementById('cart-badge');
            if(navbarBadge) navbarBadge.innerText = data.cart_count;
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/cart/index.blade.php ENDPATH**/ ?>