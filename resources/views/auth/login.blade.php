@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-950 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-96 h-96 bg-red-600/20 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-red-900/10 rounded-full blur-[120px] translate-x-1/2 translate-y-1/2"></div>

    <div class="w-full max-w-md z-10 px-4">
        <div class="bg-gray-900/50 backdrop-blur-xl border border-white/10 p-10 rounded-3xl shadow-2xl">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-black text-white italic uppercase tracking-tighter">
                    Sansflix <span class="text-red-600">Login</span>
                </h1>
                <p class="text-gray-400 text-sm mt-2 font-medium">Selamat datang kembali di Sansflix Cinema</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Alamat Email</label>
                    <input type="email" name="email" required 
                        class="w-full bg-gray-800/50 border border-gray-700 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition duration-300 mt-2"
                        placeholder="nama@email.com">
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Password</label>
                    <input type="password" name="password" required 
                        class="w-full bg-gray-800/50 border border-gray-700 rounded-2xl px-5 py-4 text-white focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition duration-300 mt-2"
                        placeholder="••••••••">
                </div>

                <button type="submit" 
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-4 rounded-2xl shadow-[0_10px_20px_rgba(220,38,38,0.3)] transition duration-300 transform hover:-translate-y-1 uppercase tracking-tighter">
                    Masuk Sekarang
                </button>
            </form>

            <div class="relative my-8 text-center">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-800"></div></div>
                <span class="relative bg-gray-900 px-4 text-xs font-bold text-gray-500 uppercase tracking-widest">Atau</span>
            </div>

            <a href="{{ route('google.login') }}" 
                class="w-full flex items-center justify-center gap-3 bg-white hover:bg-gray-100 text-gray-900 font-bold py-4 rounded-2xl transition duration-300 shadow-xl group">
                <img src="https://www.gstatic.com/images/branding/product/1x/gsa_512dp.png" class="w-6 h-6" alt="Google">
                <span>Lanjutkan dengan Google</span>
            </a>

            <p class="text-center text-gray-400 text-sm mt-8">
                Belum punya akun? <a href="{{ route('register') }}" class="text-red-500 font-bold hover:underline">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection