@extends('layouts.app')

@section('content')
<div class="bg-gray-950 min-h-screen py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-extrabold text-white mb-2 uppercase italic">Sansflix <span class="text-red-600">Snacks</span></h1>
        <p class="text-gray-400 mb-10">Lengkapi pengalaman menontonmu dengan cemilan terbaik.</p>
        <div class="flex flex-wrap items-center gap-4 mb-10">
            <a href="{{ route('fnb.index') }}" 
            class="px-6 py-2 rounded-full font-bold text-sm {{ !request('category') ? 'bg-red-600 text-white' : 'bg-gray-800 text-gray-400' }}">
            Semua
            </a>

            <a href="{{ route('fnb.index', ['category' => 'Popcorn']) }}" 
            class="px-6 py-2 rounded-full font-bold text-sm {{ request('category') == 'Popcorn' ? 'bg-yellow-500 text-black' : 'bg-gray-800 text-gray-400' }}">
            🍿 Popcorn
            </a>

            <a href="{{ route('fnb.index', ['category' => 'Drinks']) }}" 
            class="px-6 py-2 rounded-full font-bold text-sm {{ request('category') == 'Drinks' ? 'bg-yellow-500 text-black' : 'bg-gray-800 text-gray-400' }}">
            🥤 Drinks
            </a>

            <a href="{{ route('fnb.index', ['category' => 'Snacks']) }}" 
            class="px-6 py-2 rounded-full font-bold text-sm {{ request('category') == 'Snacks' ? 'bg-yellow-500 text-black' : 'bg-gray-800 text-gray-400' }}">
            🌭 Snacks
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
    @foreach($menus as $item)
    <div class="bg-gray-900 border border-gray-800 rounded-2xl overflow-hidden hover:border-yellow-500 transition-all duration-300 group shadow-lg">
        <div class="h-48 overflow-hidden relative">
            <img src="{{ $item->image_url }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
            <div class="absolute top-3 left-3">
                <span class="bg-black/60 backdrop-blur-md text-yellow-500 text-[10px] font-bold px-3 py-1 rounded-full uppercase">
                            {{ $item->category }}
                        </span>
                    </div>
                </div>
                
                <div class="p-5">
                    <h3 class="text-white font-bold text-lg leading-tight">{{ $item->name }}</h3>
                    <div class="flex items-center justify-between mt-6">
                        <div>
                            <p class="text-gray-500 text-[10px] uppercase font-bold tracking-widest">Harga</p>
                            <span class="text-yellow-500 font-black text-xl">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                        </div>
                        
                        <button onclick="addToCart(event, {{ $item->id }})" 
                            class="bg-yellow-500 text-black p-3 rounded-xl hover:bg-white transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function addToCart(e, id) {
        e.preventDefault();
        fetch(`/add-to-cart/${id}`, {
            method: 'GET',
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            // Ganti ID 'cart-badge' sesuai dengan ID angka keranjang di Navbar Anda
            const badge = document.getElementById('cart-badge'); 
            if(badge) badge.innerText = data.cart_count;
        });
    }
    function addToCart(e, id) {
        e.preventDefault();
        
        fetch(`/add-to-cart/${id}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update angka di navbar secara instan
            const badge = document.getElementById('cart-badge');
            if(badge) {
                badge.innerText = data.cart_count;
                // Opsional: Tambah efek animasi sedikit
                badge.classList.add('scale-125');
                setTimeout(() => badge.classList.remove('scale-125'), 200);
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>

@endsection