@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-950 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-gray-900 p-10 rounded-3xl border border-white/10 shadow-2xl">
        <div>
            <h2 class="text-center text-3xl font-black text-white uppercase italic tracking-tighter">
                Lupa <span class="text-red-600">Password?</span>
            </h2>
            <p class="mt-2 text-center text-sm text-gray-400">
                Masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang password.
            </p>
        </div>

        @if (session('status'))
            <div class="bg-green-600/20 border border-green-600 text-green-500 px-4 py-3 rounded-xl text-sm font-bold">
                {{ session('status') }}
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div>
                    <label for="email" class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Alamat Email</label>
                    <input id="email" name="email" type="email" required 
                        class="appearance-none relative block w-full px-4 py-3 mt-1 border border-gray-700 bg-gray-800 text-white rounded-xl focus:outline-none focus:ring-red-600 focus:border-red-600 focus:z-10 sm:text-sm transition" 
                        placeholder="email@contoh.com" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-[10px] mt-1 italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-black rounded-2xl text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition transform hover:-translate-y-1 uppercase tracking-tighter">
                    Kirim Link Reset Password
                </button>
            </div>
        </form>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-500 hover:text-white transition uppercase tracking-tighter">
                Kembali ke Login
            </a>
        </div>
    </div>
</div>
@endsection