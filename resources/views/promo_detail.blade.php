@extends('layouts.app')

@section('title', 'Detail Promo - ' . $promo->title)

@section('content')
<div class="bg-gray-900 min-h-screen pt-24 pb-12">
    <div class="container mx-auto px-4">
        {{-- Breadcrumb --}}
        <nav class="flex mb-8 text-gray-400 text-sm">
            <a href="{{ route('home') }}" class="hover:text-yellow-500">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('home') }}#promos" class="hover:text-yellow-500">Promo</a>
            <span class="mx-2">/</span>
            <span class="text-white">{{ $promo->title }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Bagian Kiri: Gambar --}}
            <div class="lg:col-span-2">
                <div class="rounded-3xl overflow-hidden border border-gray-800 shadow-2xl">
                    <img src="{{ $promo->thumbnail_url }}" class="w-full h-auto object-cover" alt="{{ $promo->title }}">
                </div>
                
                <div class="mt-8 bg-gray-800/50 p-8 rounded-3xl border border-gray-700">
                    <h1 class="text-3xl font-black text-white italic uppercase tracking-tighter mb-4">
                        {{ $promo->title }}
                    </h1>
                    <div class="prose prose-invert max-w-none text-gray-300">
                        <p class="text-lg leading-relaxed">{{ $promo->description }}</p>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-gray-700">
                        <h4 class="text-white font-bold mb-4">Cara Penggunaan:</h4>
                        <ol class="list-decimal list-inside text-gray-400 space-y-2">
                            <li>Pilih film yang ingin Anda tonton di halaman utama.</li>
                            <li>Lanjutkan ke proses pemilihan kursi dan pembayaran.</li>
                            <li>Masukkan kode promo <span class="text-yellow-500 font-mono font-bold">{{ $promo->promo_code }}</span> pada kolom yang tersedia.</li>
                            <li>Klik apply dan diskon akan otomatis memotong total harga.</li>
                            <li>Selesaikan pembayaran sebelum batas waktu berakhir.</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Bagian Kanan: Info Ringkas --}}
            <div class="lg:col-span-1">
                <div class="bg-yellow-500 p-6 rounded-3xl sticky top-24">
                    <p class="text-black font-black uppercase text-xs tracking-widest mb-2">Salin Kode Promo</p>
                    <div class="flex items-center justify-between bg-black/10 rounded-xl p-4 border border-black/10 mb-6">
                        <span class="text-2xl font-mono font-black text-black tracking-tighter">{{ $promo->promo_code }}</span>
                        <button onclick="copyToClipboard('{{ $promo->promo_code }}')" class="bg-black text-white text-xs px-3 py-2 rounded-lg hover:bg-gray-800 transition-colors">
                            Copy
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-sm border-b border-black/10 pb-2">
                            <span class="text-black/60 font-bold uppercase text-[10px]">Status</span>
                            <span class="bg-green-600 text-white text-[10px] px-2 py-0.5 rounded-full font-bold uppercase">Aktif</span>
                        </div>
                        <div class="flex justify-between items-center text-sm border-b border-black/10 pb-2">
                            <span class="text-black/60 font-bold uppercase text-[10px]">Berakhir Pada</span>
                            <span class="text-black font-bold">{{ $promo->expired_at->format('d M Y') }}</span>
                        </div>
                    </div>

                    <a href="{{ route('home') }}" class="block w-full text-center bg-black text-white font-black uppercase py-4 rounded-xl mt-8 hover:bg-gray-800 transition-transform active:scale-95">
                        Paket Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        const toast = document.getElementById('copyToast');

        // Memunculkan Toast (Animasi Naik & Fade In)
        toast.classList.remove('translate-y-20', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');

        // Menghilangkan kembali setelah 3 detik
        setTimeout(() => {
            toast.classList.add('translate-y-20', 'opacity-0');
            toast.classList.remove('translate-y-0', 'opacity-100');
        }, 3000);
    });
}

    
</script>
<div id="copyToast" class="fixed bottom-10 right-10 transform translate-y-20 opacity-0 transition-all duration-500 ease-in-out z-50">
    <div class="bg-gray-800 border-l-4 border-yellow-500 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <div>
            <p class="font-bold text-sm">Berhasil!</p>
            <p class="text-xs text-gray-400">Kode promo telah disalin ke clipboard.</p>
        </div>
    </div>
</div>
@endsection