<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 0; }
        body { 
            font-family: 'Helvetica', Arial, sans-serif; 
            background-color: #f4f4f4; 
            margin: 0; 
            padding: 30px 0;
        }
        
        .receipt-card {
            background: #ffffff;
            width: 300px;
            margin: 0 auto;
            position: relative;
            /* Dompdf support simple borders better than shadows */
            border: 1px solid #dddddd;
        }

        /* Efek Gerigi Atas & Bawah menggunakan SVG (Lebih stabil di PDF) */
        .jagged-edge {
            width: 100%;
            height: 10px;
            display: block;
        }

        .content { padding: 20px; text-align: center; }

        .logo-container {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .logo-container img {
            max-width: 180px; /* Sesuaikan dengan ukuran logo Anda */
            display: block;
            margin: 0 auto;
        }
        .subtitle { font-size: 9px; color: #888; letter-spacing: 1px; margin-top: 5px; text-transform: uppercase; }

        .order-id-box {
            background: #f0f0f0;
            padding: 8px;
            margin: 15px 0;
            font-family: monospace;
            font-weight: bold;
            font-size: 14px;
            border: 1px dashed #ccc;
        }

        .details-table { width: 100%; font-size: 11px; color: #555; text-align: left; margin-bottom: 15px; border-collapse: collapse; }
        .details-table td { padding: 4px 0; vertical-align: top; }
        .label { color: #999; width: 35%; }
        
        .status-paid { 
            color: #28a745; 
            font-weight: bold; 
            text-transform: uppercase;
            font-size: 10px;
        }

        .divider { border-top: 1px dashed #eee; margin: 15px 0; }

        .item-row { text-align: left; margin-bottom: 12px; position: relative; }
        .item-name { font-size: 12px; font-weight: bold; display: block; width: 70%; }
        .item-price-detail { font-size: 10px; color: #888; }
        .item-total { float: right; font-weight: bold; font-size: 12px; }

        .total-akhir { margin-top: 20px; padding-top: 10px; border-top: 2px solid #333; }
        .total-label { font-size: 10px; color: #999; font-weight: bold; }
        .total-price { float: right; font-size: 18px; font-weight: bold; }

        .qr-section {
            background: #fdfdfd;
            margin: 20px -20px -20px -20px;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #f0f0f0;
        }
        .qr-footer { 
            font-size: 8px; 
            color: #999; 
            text-transform: uppercase; 
            line-height: 1.5; 
            margin-top: 10px;
            font-weight: bold;
        }

        /* Clearfix untuk float */
        .cf:after { content: ""; display: table; clear: both; }
    </style>
</head>
<body>
    <div class="receipt-card">
        <div class="jagged-edge">
            <svg width="100%" height="10px" viewBox="0 0 100 10" preserveAspectRatio="none">
                <polygon points="0,10 5,0 10,10 15,0 20,10 25,0 30,10 35,0 40,10 45,0 50,10 55,0 60,10 65,0 70,10 75,0 80,10 85,0 90,10 95,0 100,10" fill="#f4f4f4"/>
            </svg>
        </div>
        
        <div class="content">
            <div class="logo-container">
                <img src="https://fazarrizwanuli.wordpress.com/wp-content/uploads/2026/01/logo-sansflix-hitam.png" style="width: 150px; height: auto;">
            </div>
            <div class="subtitle">SNACKS & BEVERAGES RECEIPT</div>

            <div class="order-id-box">ID: #FNB-<?php echo e(str_pad($order->id, 5, '0', STR_PAD_LEFT)); ?></div>

            <table class="details-table">
                <tr>
                    <td class="label">Tanggal</td>
                    <td>: <?php echo e($order->created_at->format('d M Y, H:i')); ?></td>
                </tr>
                <tr>
                    <td class="label">Pelanggan</td>
                    <td>: <?php echo e($order->user->name); ?></td>
                </tr>
                <tr>
                    <td class="label">Status</td>
                    <td>: <span class="status-paid">PAID</span></td>
                </tr>
            </table>

            <div class="divider"></div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="item-row cf">
                <span class="item-total">Rp <?php echo e(number_format($item->price * $item->quantity, 0, ',', '.')); ?></span>
                <span class="item-name"><?php echo e($item->foodBeverage->name); ?></span>
                <span class="item-price-detail"><?php echo e($item->quantity); ?> x <?php echo e(number_format($item->price, 0, ',', '.')); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="total-akhir cf">
                <span class="total-label">TOTAL AKHIR</span>
                <span class="total-price">Rp <?php echo e(number_format($order->total_price, 0, ',', '.')); ?></span>
            </div>

            <div class="qr-section">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=<?php echo e($order->id); ?>" width="100">
                <div class="qr-footer">
                    TUNJUKKAN STRUK DIGITAL INI KEPADA PETUGAS<br>
                    DI KONTER SNACKS UNTUK PENGAMBILAN PESANAN.
                </div>
            </div>
        </div>

        <div class="jagged-edge" style="margin-top: 10px; transform: rotate(180deg);">
            <svg width="100%" height="10px" viewBox="0 0 100 10" preserveAspectRatio="none">
                <polygon points="0,10 5,0 10,10 15,0 20,10 25,0 30,10 35,0 40,10 45,0 50,10 55,0 60,10 65,0 70,10 75,0 80,10 85,0 90,10 95,0 100,10" fill="#f4f4f4"/>
            </svg>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\LENOVO\Documents\sansflix\sansflix\resources\views/cart/receipt_pdf.blade.php ENDPATH**/ ?>