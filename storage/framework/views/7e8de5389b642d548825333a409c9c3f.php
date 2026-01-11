<!DOCTYPE html>
<html>
<head>
    <title>E-Ticket Poster</title>
    <style>
        @page { margin: 0; }
        body {
            font-family: 'Helvetica', sans-serif;
            background-color: #1a1a1a;
            color: white;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            height: 100%;
            position: relative;
        }
        
        /* BACKGROUND POSTER (Dibuat agak gelap) */
        .poster-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 60%; /* Gambar memenuhi 60% atas */
            z-index: -1;
            /* Trik agar gambar lokal terbaca oleh DOMPDF */
            background-image: url("<?php echo e($booking->showtime->movie->poster_url); ?>");
            background-size: cover;
            background-position: center top;
            opacity: 0.6; /* Supaya teks di atasnya terbaca */
        }
        
        /* GRADASI SUPAYA TEKS JELAS */
        .gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 60%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1), #1a1a1a);
        }

        /* KONTEN UTAMA */
        .content {
            padding: 20px;
            text-align: center;
            padding-top: 250px; /* Dorong konten ke bawah */
        }

        .movie-title {
            font-size: 36px;
            font-weight: bold;
            text-transform: uppercase;
            text-shadow: 2px 2px 4px #000;
            margin-bottom: 5px;
            color: #fff;
        }
        .genre {
            font-size: 14px;
            color: #ccc;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* KOTAK INFORMASI */
        .info-box {
            background-color: #fff;
            color: #333;
            border-radius: 15px;
            padding: 20px;
            margin: 0 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .row {
            width: 100%;
            margin-bottom: 15px;
        }
        .col {
            display: inline-block;
            width: 48%;
            vertical-align: top;
            text-align: left;
        }
        .text-right { text-align: right; }
        
        .label {
            font-size: 10px;
            color: #888;
            text-transform: uppercase;
            display: block;
        }
        .value {
            font-size: 16px;
            font-weight: bold;
            color: #000;
        }
        .big-value {
            font-size: 24px;
            font-weight: bold;
            color: #d32f2f;
        }

        /* QR CODE */
        .qr-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px dashed #ddd;
            text-align: center;
        }
        .qr-img {
            width: 120px;
            height: 120px;
            border: 5px solid #fff; /* Bingkai putih */
        }
        
        .footer {
            margin-top: 30px;
            color: #555;
            font-size: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="poster-bg"></div>
    <div class="gradient-overlay"></div>

    <div class="content">
        <div class="movie-title"><?php echo e($booking->showtime->movie->title); ?></div>
        <div class="genre"><?php echo e($booking->showtime->movie->genre); ?> | <?php echo e($booking->showtime->movie->age_rating); ?></div>

        <div class="info-box">
            <div class="row">
                <div class="col">
                    <span class="label">STUDIO</span>
                    <span class="value"><?php echo e($booking->showtime->auditorium->name); ?></span>
                </div>
                <div class="col text-right">
                    <span class="label">TANGGAL</span>
                    <span class="value"><?php echo e($booking->showtime->starts_at->format('d M Y')); ?></span>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <span class="label">JAM TAYANG</span>
                    <span class="value"><?php echo e($booking->showtime->starts_at->format('H:i')); ?> WIB</span>
                </div>
                <div class="col text-right">
                    <span class="label">KURSI</span>
                    <span class="big-value">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $booking->details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($detail->seat_number); ?><?php echo e(!$loop->last ? ',' : ''); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </span>
                </div>
            </div>

            <div class="qr-section">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo e($booking->booking_code); ?>" class="qr-img">
                <br><br>
                <span class="label">KODE BOOKING</span>
                <span class="value" style="font-family: monospace; font-size: 18px; letter-spacing: 3px;">
                    <?php echo e($booking->booking_code); ?>

                </span>
            </div>
        </div>

        <div class="footer">
            Tunjukkan tiket ini di pintu masuk studio.<br>
            &copy; Sansflix Cinema
        </div>
    </div>

</body>
</html><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/pdf_ticket.blade.php ENDPATH**/ ?>