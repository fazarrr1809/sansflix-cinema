<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - Sansflix Cinema</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Animasi Centang Sukses */
        .checkmark-container { display: flex; justify-content: center; align-items: center; margin-bottom: 20px; }
        .checkmark { width: 80px; height: 80px; border-radius: 50%; display: block; stroke-width: 2; stroke: #fff; stroke-miterlimit: 10; box-shadow: inset 0px 0px 0px #10B981; animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both; }
        .checkmark__circle { stroke-dasharray: 166; stroke-dashoffset: 166; stroke-width: 2; stroke-miterlimit: 10; stroke: #10B981; fill: none; animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards; }
        .checkmark__check { transform-origin: 50% 50%; stroke-dasharray: 48; stroke-dashoffset: 48; animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards; }
        @keyframes stroke { 100% { stroke-dashoffset: 0; } }
        @keyframes fill { 100% { box-shadow: inset 0px 0px 0px 40px #10B981; } }
        @keyframes scale { 0%, 100% { transform: none; } 50% { transform: scale3d(1.1, 1.1, 1); } }

        /* Custom Radio Button Style */
        .payment-card:hover { border-color: #3B82F6; transform: translateY(-2px); }
        input:checked + .payment-card { border-color: #3B82F6; background-color: #ffffff; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.5); }
        input:checked + .payment-card .check-icon { opacity: 1; }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-4xl rounded-3xl shadow-2xl overflow-hidden border border-gray-700 flex flex-col md:flex-row">
        
        <div class="w-full md:w-1/3 bg-gray-900 p-8 border-r border-gray-700 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-5 blur-3xl"></div>
            
            <h3 class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-6">Ringkasan Order</h3>
            
            <div class="flex items-start gap-4 mb-6">
               <div class="w-20 h-28 bg-gray-700 rounded-lg overflow-hidden shadow-lg relative flex-shrink-0">
                    @if($booking->showtime->movie->poster_url)
                        <img src="{{ $booking->showtime->movie->poster_url }}"
                            alt="{{ $booking->showtime->movie->title }}"
                            class="w-full h-full object-cover rounded-lg">
                    @else
                        <div class="w-full h-full bg-gray-700 rounded-lg flex items-center justify-center">
                            <span class="text-xs text-gray-400">No Image</span>
                        </div>
                    @endif
                </div>

                <div>
                    <h2 class="text-white font-bold text-lg leading-tight mb-1">{{ $booking->showtime->movie->title }}</h2>
                    <p class="text-gray-400 text-xs mt-1">{{ $booking->showtime->auditorium->name }}</p>
                </div>
            </div>

            <div class="space-y-3 text-sm text-gray-300 border-t border-gray-700 pt-4">
                <div class="flex justify-between">
                    <span>Kode Booking</span>
                    <span class="font-mono text-white tracking-wide">{{ substr($booking->booking_code, -8) }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Kursi</span>
                    <span class="text-white font-bold">
                         @foreach($booking->details as $detail)
                            {{ $detail->seat_number }}{{ !$loop->last ? ',' : '' }} 
                        @endforeach
                    </span>
                </div>
                <div class="flex justify-between">
                    <span>Jadwal</span>
                    <span class="text-white">{{ $booking->showtime->starts_at->format('d M, H:i') }}</span>
                </div>
            </div>

            <div class="mt-8 pt-4 border-t border-dashed border-gray-600">
                <p class="text-gray-400 text-sm mb-1">Total Pembayaran</p>
                <h1 class="text-3xl font-extrabold text-white">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</h1>
            </div>
        </div>

        <div class="w-full md:w-2/3 p-8 relative bg-gray-50 text-gray-800">
            
            @if($booking->status == 'pending')
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Pilih Metode Pembayaran</h2>
                    <span class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded border border-red-200 animate-pulse font-semibold">Berakhir dlm 23:59:00</span>
                </div>

                <form action="{{ route('booking.payNow', $booking->id) }}" method="POST" id="payment-form">
                    @csrf
                    
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-6">
                        <label class="cursor-pointer relative">
                            <input type="radio" name="payment_method" value="qris" class="peer sr-only" onchange="showDetail('qris')">
                            <div class="payment-card h-24 rounded-xl border border-gray-200 bg-white flex flex-col items-center justify-center transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_QRIS.svg/1200px-Logo_QRIS.svg.png" class="h-8 mb-2" alt="QRIS">
                                <span class="text-xs text-gray-400 group-hover:text-black">Scan QR</span>
                                <div class="check-icon absolute top-2 right-2 text-blue-500 opacity-0 transition-opacity">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </label>

                        <label class="cursor-pointer relative">
                            <input type="radio" name="payment_method" value="gopay" class="peer sr-only" onchange="showDetail('gopay')">
                            <div class="payment-card h-24 rounded-xl border border-gray-200 bg-white flex flex-col items-center justify-center transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" class="h-6 mb-2" alt="GoPay">
                                <span class="text-xs text-gray-400 group-hover:text-black">Instant</span>
                                <div class="check-icon absolute top-2 right-2 text-blue-500 opacity-0 transition-opacity">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </label>

                        <label class="cursor-pointer relative">
                            <input type="radio" name="payment_method" value="bca" class="peer sr-only" onchange="showDetail('bca')">
                            <div class="payment-card h-24 rounded-xl border border-gray-200 bg-white flex flex-col items-center justify-center transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png" class="h-8 mb-2 px-1" alt="BCA">
                                <span class="text-xs text-gray-400 group-hover:text-black">Virtual Account</span>
                                <div class="check-icon absolute top-2 right-2 text-blue-500 opacity-0 transition-opacity">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </label>

                         <label class="cursor-pointer relative">
                            <input type="radio" name="payment_method" value="mandiri" class="peer sr-only" onchange="showDetail('mandiri')">
                            <div class="payment-card h-24 rounded-xl border border-gray-200 bg-white flex flex-col items-center justify-center transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/1200px-Bank_Mandiri_logo_2016.svg.png" class="h-6 mb-2 px-1" alt="Mandiri">
                                <span class="text-xs text-gray-400 group-hover:text-black">Virtual Account</span>
                                <div class="check-icon absolute top-2 right-2 text-blue-500 opacity-0 transition-opacity">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </label>

                        <label class="cursor-pointer relative">
                            <input type="radio" name="payment_method" value="shopeepay" class="peer sr-only" onchange="showDetail('shopeepay')">
                            <div class="payment-card h-24 rounded-xl border border-gray-200 bg-white flex flex-col items-center justify-center transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Shopee.svg/1200px-Shopee.svg.png" class="h-8 mb-2" alt="Shopee">
                                <span class="text-xs text-gray-400 group-hover:text-black">E-Wallet</span>
                                <div class="check-icon absolute top-2 right-2 text-blue-500 opacity-0 transition-opacity">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </label>

                        <label class="cursor-pointer relative">
                            <input type="radio" name="payment_method" value="indomaret" class="peer sr-only" onchange="showDetail('indomaret')">
                            <div class="payment-card h-24 rounded-xl border border-gray-200 bg-white flex flex-col items-center justify-center transition-all group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Indomaret.svg" class="h-8 mb-2" alt="Indomaret">
                                <span class="text-xs text-gray-400 group-hover:text-black">Gerai</span>
                                <div class="check-icon absolute top-2 right-2 text-blue-500 opacity-0 transition-opacity">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div id="payment-details" class="bg-white border border-gray-200 rounded-xl p-6 mb-6 hidden shadow-inner transition-all duration-300">
                        <div id="detail-qris" class="hidden detail-section text-center">
                            <p class="text-sm text-gray-500 mb-3">Scan QR di bawah ini dengan Mobile Banking / E-Wallet Anda:</p>
                            <div class="bg-white p-3 inline-block rounded-lg mb-2 border">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $booking->booking_code }}" class="w-32 h-32">
                            </div>
                            <p class="text-xs text-gray-400 mt-2">NMID: ID102030405060</p>
                        </div>

                        <div id="detail-va" class="hidden detail-section">
                            <p class="text-sm text-gray-500 mb-2">Nomor Virtual Account:</p>
                            <div class="flex items-center justify-between bg-gray-100 p-3 rounded-lg border border-gray-300 mb-3">
                                <span class="font-mono text-xl text-blue-600 font-bold tracking-wider" id="va-number">88000{{ mt_rand(100000, 999999) }}</span>
                                <button type="button" class="text-xs text-blue-500 hover:text-blue-700 uppercase font-bold">Salin</button>
                            </div>
                            <p class="text-xs text-gray-400">Menerima transfer dari ATM, Mobile Banking, dan Internet Banking.</p>
                        </div>

                        <div id="detail-ewallet" class="hidden detail-section text-center">
                            <p class="text-sm text-gray-500 mb-4">Anda akan diarahkan ke aplikasi untuk menyelesaikan pembayaran.</p>
                            <div class="animate-bounce text-4xl mb-2">📱</div>
                            <p class="text-xs text-gray-400">Pastikan saldo Anda mencukupi.</p>
                        </div>

                        <div id="detail-retail" class="hidden detail-section">
                            <p class="text-sm text-gray-500 mb-2">Kode Pembayaran (Tunjukkan ke Kasir):</p>
                            <div class="bg-gray-100 p-3 rounded-lg border border-gray-300 mb-3 text-center">
                                <span class="font-mono text-2xl text-orange-600 font-bold tracking-widest">SNX-{{ mt_rand(1000, 9999) }}</span>
                            </div>
                            <p class="text-xs text-gray-400">Beritahu kasir ingin membayar tagihan "Merchant Sansflix".</p>
                        </div>
                    </div>

                    <button type="submit" id="btn-confirm" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl text-lg shadow-lg hover:shadow-blue-500/50 transition-all duration-200 transform hover:-translate-y-1 opacity-50 cursor-not-allowed" disabled>
                        Konfirmasi Pembayaran
                    </button>
                </form>

            @elseif($booking->status == 'paid')
                <div class="h-full flex flex-col items-center justify-center py-10 text-center">
                    <div class="checkmark-container">
                        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                            <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                        </svg>
                    </div>

                    <h2 class="text-3xl font-extrabold text-gray-800 mb-2">Transaksi Berhasil!</h2>
                    <p class="text-gray-500 mb-8">Tiket Anda telah terbit dan dikirim ke email.</p>

                    <div class="w-full bg-white border border-gray-200 rounded-xl p-4 mb-8 flex justify-between items-center shadow-sm">
                        <span class="text-gray-500 text-sm">Metode Pembayaran</span>
                        <span class="font-bold text-blue-600 uppercase tracking-wider">{{ $booking->payment_method ?? 'MANUAL' }}</span>
                    </div>

                    <div class="w-full space-y-3">
                        <a href="{{ route('booking.pdf', $booking->id) }}" class="block w-full bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 text-white font-bold py-3 rounded-xl transition shadow-lg flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                            Download E-Ticket
                        </a>
                        
                        <div class="mt-6 p-3 bg-blue-50 text-blue-800 rounded-lg text-sm">
                            <p>Kembali ke beranda dalam <span id="countdown" class="font-bold text-lg">5</span> detik...</p>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            let timeLeft = 5;
                            const countdownElement = document.getElementById('countdown');
                            
                            // Pastikan elemen ada sebelum menjalankan interval
                            if (countdownElement) {
                                const timer = setInterval(function() {
                                    timeLeft--;
                                    countdownElement.textContent = timeLeft;
                                    
                                    if (timeLeft <= 0) {
                                        clearInterval(timer);
                                        window.location.href = "/"; // Redirect ke Home
                                    }
                                }, 1000);
                            }
                        });
                    </script>
                </div>
            @else
                 <div class="bg-red-900/50 border border-red-500 text-red-200 p-6 rounded-xl text-center">
                    <p class="font-bold">Transaksi Dibatalkan</p>
                 </div>
            @endif
        </div>
    </div>

    <script>
        function showDetail(method) {
            const btn = document.getElementById('btn-confirm');
            btn.disabled = false;
            btn.classList.remove('opacity-50', 'cursor-not-allowed');
            
            const container = document.getElementById('payment-details');
            container.classList.remove('hidden');

            document.querySelectorAll('.detail-section').forEach(el => el.classList.add('hidden'));

            if (method === 'qris') {
                document.getElementById('detail-qris').classList.remove('hidden');
                btn.innerText = "Saya Sudah Membayar";
            } else if (method === 'bca' || method === 'mandiri') {
                document.getElementById('detail-va').classList.remove('hidden');
                const prefix = method === 'bca' ? '8800' : '7000';
                const random = Math.floor(Math.random() * 900000) + 100000;
                document.getElementById('va-number').innerText = prefix + random;
                btn.innerText = "Konfirmasi Transfer";
            } else if (method === 'gopay' || method === 'shopeepay') {
                document.getElementById('detail-ewallet').classList.remove('hidden');
                btn.innerText = "Buka Aplikasi " + method.toUpperCase();
            } else if (method === 'indomaret') {
                document.getElementById('detail-retail').classList.remove('hidden');
                btn.innerText = "Saya Sudah Bayar di Kasir";
            }
        }
    </script>
</body>
</html>