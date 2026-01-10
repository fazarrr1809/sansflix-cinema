@extends('layouts.app')

@section('title', 'Struk Pesanan #' . $order->id)

@section('content')
<div class="bg-gray-950 min-h-screen py-12 flex flex-col items-center">
    <div class="w-full max-w-md mb-6">
        <a href="{{ route('food.history') }}" class="text-gray-500 hover:text-white transition flex items-center gap-2 text-sm">
            <i class="fas fa-arrow-left"></i> Kembali ke Riwayat
        </a>
    </div>

    <div class="bg-white text-gray-900 w-full max-w-md rounded-3xl overflow-hidden shadow-2xl flex flex-col relative">
        <div class="absolute -top-3 left-0 right-0 flex justify-around px-4">
            @for ($i = 0; $i < 10; $i++)
                <div class="w-6 h-6 bg-gray-950 rounded-full"></div>
            @endfor
        </div>

        <div class="p-8 pt-12">
            <div class="text-center border-b-2 border-dashed border-gray-200 pb-6 mb-6">
                <h1 class="text-2xl font-black tracking-tighter uppercase italic">Sansflix <span class="text-red-600">Cinema</span></h1>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Snacks & Beverages Receipt</p>
                <div class="mt-4 bg-gray-100 py-2 rounded-lg font-mono text-sm font-bold">
                    ID: #FNB-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                </div>
            </div>

            <div class="space-y-2 mb-6 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-400">Tanggal</span>
                    <span class="font-bold">{{ $order->created_at->format('d M Y, H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Nama Pelanggan</span>
                    <span class="font-bold">{{ Auth::user()->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Status</span>
                    <span class="px-2 py-0.5 bg-green-100 text-green-600 rounded text-[10px] font-black uppercase tracking-tighter border border-green-200">
                        {{ $order->status }}
                    </span>
                </div>
            </div>

            <div class="border-t-2 border-dashed border-gray-200 pt-6 mb-6 space-y-4">
                @foreach($order->items as $item)
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="font-bold text-sm leading-tight">{{ $item->foodBeverage->name }}</p>
                            <p class="text-xs text-gray-400">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-bold text-sm">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>

            <div class="border-t-2 border-gray-100 pt-4 mb-8 flex justify-between items-center">
                <span class="font-black text-gray-400 uppercase text-xs">Total Akhir</span>
                <span class="text-2xl font-black italic">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
            </div>

            <div class="flex flex-col items-center justify-center p-6 bg-gray-50 rounded-2xl border-2 border-gray-100">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=FNB-{{ $order->id }}" class="w-32 h-32 mb-4 mix-blend-multiply">
                <p class="text-[9px] text-gray-400 text-center font-bold uppercase leading-relaxed">
                    Tunjukkan struk digital ini kepada petugas <br> di konter snacks untuk pengambilan pesanan.
                </p>
            </div>
        </div>

        <div class="w-full flex">
            @for ($i = 0; $i < 20; $i++)
                <div class="flex-1 h-3 bg-white" style="clip-path: polygon(0 0, 50% 100%, 100% 0);"></div>
            @endfor
        </div>
    </div>

    <div class="mt-8 flex flex-col sm:flex-row gap-4 w-full max-w-md">
        <a href="{{ route('food.download', $order->id) }}" 
        class="group relative flex-1 flex items-center justify-center gap-3 bg-red-600 hover:bg-red-700 text-white font-black uppercase tracking-tighter py-4 px-6 rounded-2xl transition-all duration-300 shadow-[0_10px_20px_rgba(220,38,38,0.3)] hover:shadow-[0_15px_30px_rgba(220,38,38,0.4)] hover:-translate-y-1 active:scale-95">
            <div class="absolute inset-0 w-full h-full bg-white/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
            <i class="fas fa-print"></i>
            <span>Simpan Struk</span>
        </a>
    </div>
</div>

<style>
    @media print {
        /* Memaksa warna dan gambar latar belakang muncul */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
        
        /* Sembunyikan elemen navigasi */
        nav, footer, .bg-gray-950, .flex.gap-4, .w-full.max-w-md.mb-6, button { 
            display: none !important; 
        }

        body { 
            background: white !important; 
            color: black !important;
        }

        /* Pastikan struk berada di tengah kertas */
        .bg-white { 
            box-shadow: none !important; 
            margin: 0 auto !important;
            border: 1px solid #eee; /* Beri border tipis sebagai pengganti shadow */
        }
    }
</style>
@endsection