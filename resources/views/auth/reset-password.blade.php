@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-950 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-gray-900 p-10 rounded-3xl border border-white/10 shadow-2xl">
        <div>
            <h2 class="text-center text-3xl font-black text-white uppercase italic tracking-tighter">
                Atur Ulang <span class="text-red-600">Password</span>
            </h2>
            <p class="mt-2 text-center text-sm text-gray-400">
                Silakan buat password baru untuk akun Anda.
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="space-y-4">
                {{-- Email Field (Biasanya otomatis terisi dari link) --}}
                <div>
                    <label for="email" class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Konfirmasi Email</label>
                    <input id="email" name="email" type="email" required readonly
                        class="appearance-none relative block w-full px-4 py-3 mt-1 border border-gray-700 bg-gray-800/50 text-gray-400 rounded-xl focus:outline-none sm:text-sm cursor-not-allowed" 
                        value="{{ $email ?? old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-[10px] mt-1 italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- New Password --}}
                <div>
                    <label for="password" class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Password Baru</label>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none relative block w-full px-4 py-3 mt-1 border border-gray-700 bg-gray-800 text-white rounded-xl focus:outline-none focus:ring-red-600 focus:border-red-600 sm:text-sm transition" 
                        placeholder="Minimal 8 karakter">
                    @error('password')
                        <p class="text-red-500 text-[10px] mt-1 italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="text-[10px] font-black text-gray-500 uppercase tracking-widest">Konfirmasi Password Baru</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                        class="appearance-none relative block w-full px-4 py-3 mt-1 border border-gray-700 bg-gray-800 text-white rounded-xl focus:outline-none focus:ring-red-600 focus:border-red-600 sm:text-sm transition" 
                        placeholder="Ulangi password baru">
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-4 px-4 border border-transparent text-sm font-black rounded-2xl text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition transform hover:-translate-y-1 uppercase tracking-tighter">
                    Perbarui Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection