

<?php $__env->startSection('content'); ?>
<style>
    .checkmark-container { display: flex; justify-content: center; align-items: center; margin-bottom: 20px; }
    .checkmark { width: 80px; height: 80px; border-radius: 50%; display: block; stroke-width: 2; stroke: #fff; stroke-miterlimit: 10; box-shadow: inset 0px 0px 0px #10B981; animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both; }
    .checkmark__circle { stroke-dasharray: 166; stroke-dashoffset: 166; stroke-width: 2; stroke-miterlimit: 10; stroke: #10B981; fill: none; animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards; }
    .checkmark__check { transform-origin: 50% 50%; stroke-dasharray: 48; stroke-dashoffset: 48; animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards; }
    @keyframes stroke { 100% { stroke-dashoffset: 0; } }
    @keyframes fill { 100% { box-shadow: inset 0px 0px 0px 40px #10B981; } }
    @keyframes scale { 0%, 100% { transform: none; } 50% { transform: scale3d(1.1, 1.1, 1); } }

    .payment-card:hover { border-color: #3B82F6; transform: translateY(-2px); }
    input:checked + .payment-card { border-color: #3B82F6; background-color: #ffffff; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.5); }
    input:checked + .payment-card .check-icon { opacity: 1; }
</style>

<div class="bg-gray-950 min-h-screen py-12 text-white flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-5xl rounded-3xl shadow-2xl overflow-hidden border border-gray-800 flex flex-col md:flex-row">
        
        <div class="w-full md:w-1/3 bg-gray-900 p-8 border-r border-gray-800 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-red-600 opacity-5 blur-3xl"></div>
            
            <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-6">Ringkasan Pesanan</h3>
            
            <div class="space-y-4 mb-6 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center gap-3">
                    <img src="<?php echo e($item->foodBeverage->image_url); ?>" class="w-12 h-12 object-cover rounded-lg border border-gray-700">
                    <div class="flex-grow">
                        <h2 class="text-white font-bold text-sm leading-tight"><?php echo e($item->foodBeverage->name); ?></h2>
                        <p class="text-gray-400 text-[10px] uppercase tracking-tighter"><?php echo e($item->quantity); ?> x Rp <?php echo e(number_format($item->price, 0, ',', '.')); ?></p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <div class="space-y-3 text-sm text-gray-300 border-t border-gray-800 pt-4">
                <div class="flex justify-between">
                    <span>ID Transaksi</span>
                    <span class="font-mono text-white tracking-wide">#FNB-<?php echo e($order->id); ?></span>
                </div>
                <div class="flex justify-between">
                    <span>Waktu Pesan</span>
                    <span class="text-white"><?php echo e($order->created_at->format('d M, H:i')); ?></span>
                </div>
            </div>

            <div class="mt-8 pt-4 border-t border-dashed border-gray-700">
                <p class="text-gray-400 text-sm mb-1">Total Tagihan</p>
                <h1 class="text-3xl font-extrabold text-white">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></h1>
            </div>
        </div>

        <div class="w-full md:w-2/3 p-8 relative bg-gray-50 text-gray-800">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->status == 'pending'): ?>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800 uppercase italic">Pilih Metode <span class="text-red-600">Pembayaran</span></h2>
                    <span class="text-xs bg-red-100 text-red-600 px-3 py-1 rounded-full animate-pulse font-bold border border-red-200">Menunggu Pembayaran</span>
                </div>

                <form action="<?php echo e(route('cart.pay_proses', $order->id)); ?>" method="POST" id="payment-form">
                    <?php echo csrf_field(); ?>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-6">
                        <label class="cursor-pointer relative">
                            <input type="radio" name="payment_method" value="qris" class="peer sr-only" onchange="showDetail('qris')" required>
                            <div class="payment-card h-24 rounded-xl border border-gray-200 bg-white flex flex-col items-center justify-center transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_QRIS.svg/1200px-Logo_QRIS.svg.png" class="h-8 mb-2" alt="QRIS">
                                <span class="text-[9px] text-gray-400 group-hover:text-black uppercase font-bold">Scan QR</span>
                                <div class="check-icon absolute top-2 right-2 text-blue-500 opacity-0 transition-opacity">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </label>

                        <label class="cursor-pointer relative">
                            <input type="radio" name="payment_method" value="gopay" class="peer sr-only" onchange="showDetail('gopay')">
                            <div class="payment-card h-24 rounded-xl border border-gray-200 bg-white flex flex-col items-center justify-center transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" class="h-6 mb-2" alt="GoPay">
                                <span class="text-[9px] text-gray-400 group-hover:text-black uppercase font-bold">Instant Pay</span>
                            </div>
                        </label>

                        <label class="cursor-pointer relative">
                            <input type="radio" name="payment_method" value="ovo" class="peer sr-only" onchange="showDetail('ovo')">
                            <div class="payment-card h-24 rounded-xl border border-gray-200 bg-white flex flex-col items-center justify-center transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/e/eb/Logo_ovo_purple.svg" class="h-6 mb-2" alt="OVO">
                                <span class="text-[9px] text-gray-400 group-hover:text-black uppercase font-bold">E-Wallet</span>
                            </div>
                        </label>

                        <label class="cursor-pointer relative">
                            <input type="radio" name="payment_method" value="bca" class="peer sr-only" onchange="showDetail('bca')">
                            <div class="payment-card h-24 rounded-xl border border-gray-200 bg-white flex flex-col items-center justify-center transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png" class="h-8 mb-2 px-1" alt="BCA">
                                <span class="text-[9px] text-gray-400 group-hover:text-black uppercase font-bold">VA Transfer</span>
                            </div>
                        </label>

                        <label class="cursor-pointer relative">
                            <input type="radio" name="payment_method" value="mandiri" class="peer sr-only" onchange="showDetail('mandiri')">
                            <div class="payment-card h-24 rounded-xl border border-gray-200 bg-white flex flex-col items-center justify-center transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/1200px-Bank_Mandiri_logo_2016.svg.png" class="h-6 mb-2 px-1" alt="Mandiri">
                                <span class="text-[9px] text-gray-400 group-hover:text-black uppercase font-bold">Virtual Account</span>
                            </div>
                        </label>

                        <label class="cursor-pointer relative">
                            <input type="radio" name="payment_method" value="shopeepay" class="peer sr-only" onchange="showDetail('shopeepay')">
                            <div class="payment-card h-24 rounded-xl border border-gray-200 bg-white flex flex-col items-center justify-center transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Shopee.svg/1200px-Shopee.svg.png" class="h-8 mb-2" alt="Shopee">
                                <span class="text-[9px] text-gray-400 group-hover:text-black uppercase font-bold">E-Wallet</span>
                            </div>
                        </label>
                    </div>

                    <div id="payment-details" class="bg-white border border-gray-200 rounded-xl p-6 mb-6 hidden shadow-inner transition-all duration-300">
                        <div id="detail-qris" class="hidden detail-section text-center">
                            <p class="text-sm text-gray-500 mb-3">Scan QR di bawah ini dengan Mobile Banking / E-Wallet Anda:</p>
                            <div class="bg-white p-3 inline-block rounded-lg mb-2 border shadow-sm">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=FNB-<?php echo e($order->id); ?>" class="w-32 h-32">
                            </div>
                            <p class="text-[10px] text-gray-400 mt-2 font-mono uppercase tracking-widest">NMID: ID102030405060</p>
                        </div>

                        <div id="detail-va" class="hidden detail-section">
                            <p class="text-sm text-gray-500 mb-2 font-bold">Nomor Virtual Account:</p>
                            <div class="flex items-center justify-between bg-gray-100 p-4 rounded-lg border border-gray-300 mb-3">
                                <span class="font-mono text-xl text-blue-600 font-bold tracking-wider" id="va-number">88000<?php echo e(mt_rand(100000, 999999)); ?></span>
                                <button type="button" class="text-[10px] bg-white border px-3 py-1 rounded-md text-blue-500 hover:text-blue-700 uppercase font-bold shadow-sm active:scale-95 transition">Salin</button>
                            </div>
                            <p class="text-[10px] text-gray-400 italic text-center">Gunakan menu Transfer Virtual Account pada Mobile Banking Anda.</p>
                        </div>

                        <div id="detail-ewallet" class="hidden detail-section text-center py-4">
                            <p class="text-sm text-gray-600 mb-2 font-bold uppercase">Konfirmasi Melalui HP</p>
                            <p class="text-xs text-gray-400 mb-4 tracking-tight">Mohon buka aplikasi dan selesaikan notifikasi pembayaran di ponsel Anda.</p>
                            <div class="animate-bounce text-4xl mb-2">📲</div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button type="submit" id="btn-confirm" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl text-lg shadow-lg hover:shadow-blue-500/50 transition-all duration-200 transform hover:-translate-y-1 opacity-50 cursor-not-allowed uppercase tracking-widest" disabled>
                            Konfirmasi Pembayaran
                        </button>

                        <a href="<?php echo e(route('cart.index')); ?>" class="w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-600 font-bold py-3 rounded-xl transition duration-200 uppercase text-xs tracking-widest">
                            Batalkan & Kembali ke Keranjang
                        </a>
                    </div>
                </form>

            <?php elseif($order->status == 'paid'): ?>
                <div class="h-full flex flex-col items-center justify-center py-10 text-center">
                    <div class="checkmark-container">
                        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                        </svg>
                    </div>

                    <h2 class="text-3xl font-extrabold text-gray-800 mb-2 uppercase italic">Yeay! <span class="text-red-600">Berhasil</span></h2>
                    <p class="text-gray-500 mb-8 max-w-xs mx-auto text-sm">Camilan Anda sedang kami siapkan di meja *concession*. Silakan ambil pesanan Anda!</p>

                    <div class="w-full bg-white border border-gray-200 rounded-2xl p-4 mb-8 flex justify-between items-center shadow-sm">
                        <span class="text-gray-500 text-xs font-bold uppercase">Metode</span>
                        <span class="font-bold text-blue-600 uppercase tracking-wider text-sm"><?php echo e($order->payment_method ?? 'CASHLESS'); ?></span>
                    </div>

                    <div class="w-full space-y-3">
                        <a href="<?php echo e(route('food.history')); ?>" class="block w-full bg-gray-900 text-white font-bold py-4 rounded-xl hover:bg-black transition shadow-lg flex items-center justify-center gap-2 uppercase text-sm tracking-widest">
                             Lihat Riwayat Pesanan
                        </a>
                        <a href="<?php echo e(route('fnb.index')); ?>" class="block text-blue-600 font-bold text-xs hover:underline uppercase">Beli Snack Lagi</a>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>

<script>
    function showDetail(method) {
        const btn = document.getElementById('btn-confirm');
        btn.disabled = false;
        btn.classList.remove('opacity-50', 'cursor-not-allowed');
        
        const container = document.getElementById('payment-details');
        container.classList.remove('hidden');

        // Sembunyikan semua section detail
        document.querySelectorAll('.detail-section').forEach(el => el.classList.add('hidden'));

        if (method === 'qris') {
            document.getElementById('detail-qris').classList.remove('hidden');
            btn.innerText = "SAYA SUDAH MEMBAYAR";
        } else if (method === 'bca' || method === 'mandiri') {
            document.getElementById('detail-va').classList.remove('hidden');
            const prefix = method === 'bca' ? '8800' : '7000';
            const random = Math.floor(Math.random() * 900000) + 100000;
            document.getElementById('va-number').innerText = prefix + random;
            btn.innerText = "KONFIRMASI TRANSFER";
        } else if (method === 'gopay' || method === 'shopeepay' || method === 'ovo') {
            document.getElementById('detail-ewallet').classList.remove('hidden');
            btn.innerText = "BUKA APLIKASI " + method.toUpperCase();
        }
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/cart/payment.blade.php ENDPATH**/ ?>