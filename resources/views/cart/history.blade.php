@extends('layouts.app')

@section('title', 'Riwayat Snacks - Sansflix')

@section('content')
<div class="bg-gray-950 min-h-screen py-16 text-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
            <div>
                <h1 class="text-4xl font-black uppercase tracking-tighter italic">Riwayat <span class="text-yellow-500">Pemesanan F&B</span></h1>
                <p class="text-gray-500 text-sm mt-2">Daftar pesanan camilan dan minuman Anda</p>
            </div>
            <a href="{{ route('fnb.index') }}" class="bg-yellow-600/10 hover:bg-yellow-600 text-yellow-500 hover:text-black px-6 py-2 rounded-xl border border-yellow-600/30 transition-all font-bold text-sm">
                + Pesan Lagi
            </a>
        </div>

        @if($orders->isEmpty())
            <div class="bg-gray-900 rounded-3xl p-16 text-center border border-gray-800 shadow-2xl">
                <div class="w-24 h-24 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl">
                    🍿
                </div>
                <h2 class="text-xl font-bold text-gray-300">Belum ada camilan?</h2>
                <p class="text-gray-500 mt-2 mb-8">Nonton film jadi kurang seru tanpa popcorn dan soda favoritmu.</p>
                <a href="{{ route('fnb.index') }}" class="bg-yellow-600 hover:bg-yellow-700 text-black px-8 py-3 rounded-full font-black transition-all shadow-lg shadow-yellow-600/20">
                    PESAN SEKARANG
                </a>
            </div>
        @else
            <div class="space-y-8">
                @foreach($orders as $order)
                    <div class="bg-gray-900 rounded-3xl border border-gray-800 overflow-hidden shadow-2xl transition-all hover:border-yellow-600/30 group">
                        <div class="bg-gray-800/40 p-6 border-b border-gray-800 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-yellow-600/10 rounded-xl flex items-center justify-center text-yellow-500">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <div>
                                    <p class="text-[10px] text-gray-500 uppercase font-black tracking-widest">ID Transaksi</p>
                                    <p class="text-sm font-mono font-bold text-gray-200">#FNB-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-6 w-full sm:w-auto justify-between sm:justify-end border-t sm:border-t-0 border-gray-800 pt-4 sm:pt-0">
                                <div class="text-left sm:text-right">
                                    <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">Tanggal</p>
                                    <p class="text-xs font-bold">{{ $order->created_at->format('d F Y') }} <span class="text-gray-600">•</span> {{ $order->created_at->format('H:i') }}</p>
                                </div>
                                <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-tighter {{ $order->status == 'paid' ? 'bg-green-600/10 text-green-500 border border-green-600/20' : 'bg-yellow-600/10 text-yellow-500 border border-yellow-600/20' }}">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>

                        <div class="p-8 space-y-6">
                            @foreach($order->items as $item)
                                <div class="flex justify-between items-center group/item">
                                    <div class="flex items-center gap-6">
                                        <div class="relative">
                                            <img src="{{ $item->foodBeverage->image_url }}" class="w-16 h-16 object-cover rounded-2xl shadow-lg border border-gray-800">
                                            <span class="absolute -top-2 -right-2 bg-yellow-600 text-black text-[10px] font-black w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-900">
                                                {{ $item->quantity }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="font-black text-lg text-gray-100 group-hover/item:text-yellow-500 transition">{{ $item->foodBeverage->name }}</p>
                                            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest">Unit Price: Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-black text-white italic">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                       <div class="bg-gray-800/20 p-6 border-t border-gray-800 flex justify-between items-center">
                            <div>
                                <span class="text-gray-500 text-xs font-bold uppercase tracking-widest">Total Bayar</span>
                                <p class="text-2xl font-black text-yellow-500 italic">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                            
                            @if($order->status == 'paid')
                                <a href="{{ route('food.receipt', $order->id) }}" class="bg-yellow-600 hover:bg-white hover:text-black text-black font-black px-6 py-2 rounded-xl text-xs transition-all uppercase tracking-tighter">
                                    Lihat Struk
                                </a>
                            @endif
                       </div>
                    </div>
                @endforeach
            </div>
        @endif
        
        <div class="mt-12 text-center">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-white transition text-xs font-bold uppercase tracking-widest flex items-center justify-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection