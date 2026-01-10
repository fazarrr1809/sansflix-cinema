@extends('layouts.app')

@section('content')
<div class="bg-gray-950 min-h-screen py-12 text-white">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-8 italic uppercase">Keranjang <span class="text-red-600">Snacks</span></h1>

        @if(session('cart'))
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div class="bg-gray-900 rounded-2xl overflow-hidden border border-gray-800">
                        @php $total = 0 @endphp
                        @foreach(session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <div class="flex items-center gap-4 p-6 border-b border-gray-800 last:border-0">
                                <img src="{{ $details['image'] }}" class="w-20 h-20 object-cover rounded-lg">
                                <div class="flex-grow">
                                    <h3 class="font-bold text-lg">{{ $details['name'] }}</h3>
                                    <p class="text-gray-400 text-sm">Rp {{ number_format($details['price'], 0, ',', '.') }} x {{ $details['quantity'] }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-red-600">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</p>
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="text-xs text-gray-500 hover:text-white mt-2">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-gray-900 p-6 rounded-2xl border border-gray-800 sticky top-24">
                        <h2 class="text-xl font-bold mb-6">Ringkasan Pesanan</h2>
                        <div class="flex justify-between mb-4">
                            <span class="text-gray-400">Total Harga</span>
                            <span class="font-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <form action="{{ route('cart.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-red-600 py-3 rounded-xl font-bold hover:bg-red-700 transition mt-4">
                                Bayar Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20 bg-gray-900 rounded-3xl border border-gray-800">
                <p class="text-gray-500 text-lg">Keranjangmu masih kosong.</p>
                <a href="{{ route('fnb.index') }}" class="inline-block mt-4 text-red-600 font-bold hover:underline">Ayo cari camilan!</a>
            </div>
        @endif
    </div>
</div>
@endsection