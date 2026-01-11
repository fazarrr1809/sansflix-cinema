<!DOCTYPE html>
<html>
<head>
    <title>Struk Pesanan F&B Anda</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <h2 style="color: #dc2626;">Halo, <?php echo e($order->user->name); ?>!</h2>
    <p>Terima kasih telah memesan snacks dan minuman di <strong>Sansflix Cinema</strong>.</p>
    
    <p>Pesanan Anda telah kami terima dan sedang dalam proses. Berikut adalah ringkasan pesanan Anda:</p>
    
    <div style="background-color: #f9f9f9; padding: 15px; border-radius: 8px; border: 1px solid #eee;">
        <p style="margin: 0;">ID Pesanan: <strong>#FNB-<?php echo e(str_pad($order->id, 5, '0', STR_PAD_LEFT)); ?></strong></p>
        <p style="margin: 0;">Metode Pembayaran: <?php echo e(strtoupper($order->payment_method)); ?></p>
        <p style="margin: 0;">Total Bayar: <strong>Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></strong></p>
    </div>

    <p>Daftar Pesanan:</p>
    <ul>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($item->foodBeverage->name); ?> (<?php echo e($item->quantity); ?>x)</li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </ul>

    <p><strong>Silakan unduh lampiran PDF pada email ini sebagai bukti pengambilan di konter F&B kami.</strong></p>
    
    <p>Cukup tunjukkan QR Code yang tertera pada PDF kepada petugas kami untuk ditukarkan dengan pesanan Anda.</p>
    
    <br>
    <p>Selamat menikmati film Anda!<br><strong>Tim Sansflix Cinema</strong></p>
</body>
</html><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/emails/food_receipt.blade.php ENDPATH**/ ?>