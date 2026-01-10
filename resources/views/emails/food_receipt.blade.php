<!DOCTYPE html>
<html>
<head>
    <title>Struk Pesanan F&B Anda</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">
    <h2 style="color: #dc2626;">Halo, {{ $order->user->name }}!</h2>
    <p>Terima kasih telah memesan snacks dan minuman di <strong>Sansflix Cinema</strong>.</p>
    
    <p>Pesanan Anda telah kami terima dan sedang dalam proses. Berikut adalah ringkasan pesanan Anda:</p>
    
    <div style="background-color: #f9f9f9; padding: 15px; border-radius: 8px; border: 1px solid #eee;">
        <p style="margin: 0;">ID Pesanan: <strong>#FNB-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong></p>
        <p style="margin: 0;">Metode Pembayaran: {{ strtoupper($order->payment_method) }}</p>
        <p style="margin: 0;">Total Bayar: <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></p>
    </div>

    <p>Daftar Pesanan:</p>
    <ul>
        @foreach($order->items as $item)
            <li>{{ $item->foodBeverage->name }} ({{ $item->quantity }}x)</li>
        @endforeach
    </ul>

    <p><strong>Silakan unduh lampiran PDF pada email ini sebagai bukti pengambilan di konter F&B kami.</strong></p>
    
    <p>Cukup tunjukkan QR Code yang tertera pada PDF kepada petugas kami untuk ditukarkan dengan pesanan Anda.</p>
    
    <br>
    <p>Selamat menikmati film Anda!<br><strong>Tim Sansflix Cinema</strong></p>
</body>
</html>