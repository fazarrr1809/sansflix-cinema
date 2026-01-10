@extends('layouts.app')

@section('title', 'Pilih Kursi - ' . $showtime->movie->title)

@section('content')
<style>
    /* Efek Layar Bioskop Melengkung */
    .screen {
        height: 70px;
        width: 100%;
        background: linear-gradient(to bottom, rgba(239, 68, 68, 0.5), transparent);
        transform: perspective(300px) rotateX(-15deg);
        box-shadow: 0 30px 50px rgba(239, 68, 68, 0.2);
        border-radius: 50% 50% 0 0 / 30px 30px 0 0;
        margin-bottom: 50px;
        position: relative;
    }
    
    .screen::after {
        content: "SCREEN";
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 10px;
        letter-spacing: 5px;
        color: rgba(255, 255, 255, 0.3);
    }

    /* Checkbox Tersembunyi */
    .seat-checkbox {
        display: none;
    }

    /* Tampilan Kursi Default */
    .seat-label {
        width: 38px;
        height: 34px;
        background-color: #374151; /* Gray-700 */
        border-radius: 6px 6px 12px 12px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: bold;
        color: #9CA3AF;
        border-bottom: 4px solid #1f2937;
    }

    .seat-label:hover:not(.seat-booked) {
        background-color: #4B5563;
        transform: translateY(-2px);
    }

    /* Saat Kursi Dipilih */
    .seat-checkbox:checked + .seat-label {
        background-color: #ef4444; /* Red-600 */
        color: white;
        box-shadow: 0 0 15px rgba(239, 68, 68, 0.5);
        border-bottom-color: #b91c1c;
        transform: scale(1.1);
    }

    /* Saat Kursi Sudah Terisi */
    .seat-booked {
        background-color: #111827 !important;
        cursor: not-allowed;
        color: #374151 !important;
        border-bottom-color: #000;
        opacity: 0.8;
    }
</style>

<div class="bg-gray-950 min-h-screen pb-20">
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 bg-gray-900 p-6 rounded-2xl border border-gray-800 shadow-xl">
            <div class="flex items-center gap-4 mb-4 md:mb-0">
                <a href="{{ route('movies.show', $showtime->movie_id) }}" class="p-3 bg-gray-800 rounded-xl hover:bg-red-600 transition text-white">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-black tracking-tight">{{ $showtime->movie->title }}</h1>
                    <p class="text-gray-500 text-sm uppercase tracking-widest font-bold">
                        {{ $showtime->auditorium->name }} <span class="mx-2">•</span> {{ $showtime->starts_at->format('H:i') }} WIB
                    </p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="text-right hidden md:block">
                    <p class="text-gray-500 text-xs uppercase font-bold">Harga Tiket</p>
                    <p class="text-xl font-black text-white italic">Rp {{ number_format($showtime->ticket_price, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            <div class="flex-1 bg-gray-900 p-10 rounded-3xl border border-gray-800 shadow-2xl overflow-x-auto">
                <div class="screen max-w-2xl mx-auto"></div>

                <form id="bookingForm" action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
                    
                    <div class="flex flex-col gap-3 items-center min-w-[600px]">
                        @foreach($seats->groupBy('row_letter') as $row => $rowSeats)
                            <div class="flex gap-3 items-center">
                                <div class="w-8 font-black text-gray-700 text-center">{{ $row }}</div>
                                
                                <div class="flex gap-2">
                                    @foreach($rowSeats as $seat)
                                        @php
                                            $isBooked = in_array($seat->id, $bookedSeats ?? []);
                                        @endphp

                                        <label class="relative group">
                                            <input type="checkbox" 
                                                name="seats[]" 
                                                value="{{ $seat->id }}" 
                                                data-price="{{ $showtime->ticket_price }}"
                                                data-number="{{ $seat->row_letter }}{{ $seat->seat_number }}"
                                                class="seat-checkbox"
                                                {{ $isBooked ? 'disabled' : '' }}
                                                onchange="updateTotal()">
                                                
                                            <div class="seat-label {{ $isBooked ? 'seat-booked' : '' }}">
                                                {{ $seat->seat_number }}
                                            </div>

                                            @if(!$isBooked)
                                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-gray-800 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition pointer-events-none">
                                                {{ $row }}{{ $seat->seat_number }}
                                            </div>
                                            @endif
                                        </label>
                                        
                                        {{-- Beri celah di tengah bioskop --}}
                                        @if($loop->iteration == ceil($rowSeats->count() / 2))
                                            <div class="w-10"></div>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="w-8 font-black text-gray-700 text-center">{{ $row }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-center gap-8 mt-16 p-6 bg-gray-950/50 rounded-2xl border border-gray-800">
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 bg-gray-700 rounded-md border-b-4 border-gray-800"></div> 
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Tersedia</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 bg-red-600 rounded-md border-b-4 border-red-800 shadow-[0_0_10px_rgba(239,68,68,0.4)]"></div> 
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Dipilih</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-5 h-5 bg-gray-900 rounded-md border-b-4 border-black"></div> 
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Terisi</span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="w-full lg:w-96">
                <div class="bg-gray-900 p-8 rounded-3xl border border-gray-800 shadow-2xl sticky top-24">
                    <h3 class="text-xl font-black mb-6 flex items-center gap-3">
                        <i class="fas fa-receipt text-red-600"></i> Ringkasan Order
                    </h3>
                    
                    <div class="space-y-4 mb-8">
                        <div class="flex justify-between items-start">
                            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Film</p>
                            <p class="font-bold text-right text-sm">{{ $showtime->movie->title }}</p>
                        </div>

                        <div class="flex justify-between items-center">
                            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Studio</p>
                            <p class="font-bold text-sm">{{ $showtime->auditorium->name }}</p>
                        </div>

                        <div class="flex justify-between items-center">
                            <p class="text-gray-500 text-xs font-bold uppercase tracking-widest">Kursi</p>
                            <p id="selected-seats-display" class="font-black text-red-500 text-sm">-</p>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-800 mb-8 flex justify-between items-end">
                        <div>
                            <p class="text-gray-500 text-[10px] font-bold uppercase tracking-widest mb-1">Total Pembayaran</p>
                            <p class="text-3xl font-black text-white italic">Rp <span id="total-price">0</span></p>
                        </div>
                    </div>

                    <button onclick="document.getElementById('bookingForm').submit()" 
                            id="btn-checkout"
                            class="w-full bg-gray-800 text-gray-500 font-black py-4 rounded-2xl cursor-not-allowed transition-all duration-300 shadow-lg" 
                            disabled>
                        KONFIRMASI PEMESANAN
                    </button>

                    <div class="mt-4 grid grid-cols-2 gap-2">
                        <button type="button" onclick="resetSeats()" 
                        class="flex items-center justify-center gap-2 bg-gray-800/50 hover:bg-orange-600/20 text-gray-400 hover:text-orange-500 font-bold py-3 rounded-xl transition-all border border-gray-800 text-xs">
                            <i class="fas fa-undo text-[10px]"></i>
                            Reset Kursi
                        </button>

                        <a href="{{ route('home') }}" 
                        class="flex items-center justify-center gap-2 bg-gray-800/50 hover:bg-gray-700 text-gray-400 hover:text-white font-bold py-3 rounded-xl transition-all border border-gray-800 text-xs">
                            <i class="fas fa-home text-[10px]"></i>
                            Beranda
                        </a>
                    </div>
                    </div>
                    
                    <p class="text-center text-[10px] text-gray-600 mt-4 uppercase tracking-tighter italic">
                        *Pastikan pilihan kursi sudah benar sebelum membayar
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateTotal() {
        const checkboxes = document.querySelectorAll('.seat-checkbox:checked');
        const selectedSeatsDisplay = document.getElementById('selected-seats-display');
        const totalPriceDisplay = document.getElementById('total-price');
        const btnCheckout = document.getElementById('btn-checkout');

        let total = 0;
        let seats = [];

        checkboxes.forEach(chk => {
            total += parseFloat(chk.getAttribute('data-price'));
            seats.push(chk.getAttribute('data-number'));
        });

        if (seats.length > 0) {
            selectedSeatsDisplay.innerText = seats.join(', ');
            btnCheckout.classList.remove('bg-gray-800', 'text-gray-500', 'cursor-not-allowed');
            btnCheckout.classList.add('bg-red-600', 'text-white', 'hover:bg-white', 'hover:text-black', 'shadow-red-600/20');
            btnCheckout.disabled = false;
        } else {
            selectedSeatsDisplay.innerText = '-';
            btnCheckout.classList.add('bg-gray-800', 'text-gray-500', 'cursor-not-allowed');
            btnCheckout.classList.remove('bg-red-600', 'text-white', 'hover:bg-white', 'hover:text-black');
            btnCheckout.disabled = true;
        }

        totalPriceDisplay.innerText = new Intl.NumberFormat('id-ID').format(total);
    }

    function resetSeats() {
        // Ambil semua checkbox kursi yang sedang dicentang
        const selectedCheckboxes = document.querySelectorAll('.seat-checkbox:checked');
        
        // Matikan semua centang
        selectedCheckboxes.forEach(chk => {
            chk.checked = false;
        });

        // Panggil ulang fungsi updateTotal agar ringkasan harga kembali ke 0
        updateTotal();

        // Opsional: Tambahkan notifikasi kecil
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500
        });
        Toast.fire({
            icon: 'info',
            title: 'Pilihan kursi telah dikosongkan',
            background: '#111827',
            color: '#fff'
        });
    }
</script>
@endsection