<!DOCTYPE html>
<html>
<head>
    <title>E-Tiket Anda</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2>Terima Kasih, {{ $booking->customer_name }}!</h2>
    <p>Pembelian tiket Anda untuk film <strong>{{ $booking->showtime->movie->title }}</strong> berhasil.</p>
    
    <p>Detail Pesanan:</p>
    <ul>
        <li>Kode Booking: <strong>{{ $booking->booking_code }}</strong></li>
        <li>Studio: {{ $booking->showtime->auditorium->name }}</li>
        <li>Kursi: 
            @foreach($booking->details as $detail)
                {{ $detail->seat_number }},
            @endforeach
        </li>
    </ul>

    <p><strong>Silakan unduh E-Ticket (PDF) yang kami lampirkan di email ini.</strong></p>
    <p>Sampai jumpa di bioskop!</p>
    <br>
    <p>Salam,<br>Tim Sansflix</p>
</body>
</html>