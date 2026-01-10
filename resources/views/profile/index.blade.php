@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-950 py-20 px-4">
    <div class="max-w-3xl mx-auto">
        <h2 class="text-3xl font-black text-white mb-8 italic uppercase tracking-tighter">
            Pengaturan <span class="text-red-600">Profil</span>
        </h2>

        <div class="bg-gray-900 border border-white/10 rounded-3xl p-8 shadow-2xl">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="flex flex-col md:flex-row items-center gap-8 mb-10">
                    {{-- Foto Profil --}}
                    <div class="relative group">
                        <img src="{{ auth()->user()->avatar ? (Str::startsWith(auth()->user()->avatar, 'http') ? auth()->user()->avatar : asset('uploads/avatars/'.auth()->user()->avatar)) : 'https://ui-avatars.com/api/?name='.auth()->user()->name }}" 
                             class="w-32 h-32 rounded-full object-cover border-4 border-red-600 shadow-lg">
                        <label class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <input type="file" name="avatar" class="hidden">
                        </label>
                    </div>
                    
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-white">{{ auth()->user()->name }}</h3>
                        <p class="text-gray-400 text-sm">Member sejak {{ auth()->user()->created_at->format('M Y') }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $user->name }}" 
                            class="w-full bg-gray-800 border border-gray-700 rounded-2xl px-5 py-4 text-white focus:border-red-600 outline-none mt-2">
                    </div>
                    <div>
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Username</label>
                        <input type="text" name="username" value="{{ $user->username }}" 
                            class="w-full bg-gray-800 border border-gray-700 rounded-2xl px-5 py-4 text-white focus:border-red-600 outline-none mt-2">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Email (Tidak bisa diubah)</label>
                        <input type="email" value="{{ $user->email }}" disabled 
                            class="w-full bg-gray-800/30 border border-gray-700 rounded-2xl px-5 py-4 text-gray-500 mt-2 cursor-not-allowed">
                    </div>
                </div>

                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-4 rounded-2xl shadow-xl transition transform hover:-translate-y-1 mt-10 uppercase tracking-tighter">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection