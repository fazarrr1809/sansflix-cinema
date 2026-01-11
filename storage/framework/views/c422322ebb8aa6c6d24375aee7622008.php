<!DOCTYPE html>
<html>
<head>
    <title>E-Tiket Anda</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2>Terima Kasih, <?php echo e($booking->customer_name); ?>!</h2>
    <p>Pembelian tiket Anda untuk film <strong><?php echo e($booking->showtime->movie->title); ?></strong> berhasil.</p>
    
    <p>Detail Pesanan:</p>
    <ul>
        <li>Kode Booking: <strong><?php echo e($booking->booking_code); ?></strong></li>
        <li>Studio: <?php echo e($booking->showtime->auditorium->name); ?></li>
        <li>Kursi: 
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $booking->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($detail->seat_number); ?>,
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </li>
    </ul>

    <p><strong>Silakan unduh E-Ticket (PDF) yang kami lampirkan di email ini.</strong></p>
    <p>Sampai jumpa di bioskop!</p>
    <br>
    <p>Salam,<br>Tim Sansflix</p>
</body>
</html><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/emails/booking_success.blade.php ENDPATH**/ ?>