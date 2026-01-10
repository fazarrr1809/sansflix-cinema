@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-950 py-12 px-4 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-96 h-96 bg-red-600/10 rounded-full blur-[120px]"></div>

    <div class="w-full max-w-2xl z-10">
        <div class="bg-gray-900/80 backdrop-blur-xl border border-white/10 p-8 md:p-12 rounded-3xl shadow-2xl">
            <div class="text-center mb-10">
                <h1 class="text-4xl font-black text-white italic uppercase tracking-tighter">
                    Join <span class="text-red-600">Sansflix</span>
                </h1>
                <p class="text-gray-400 mt-2">Daftar sekarang untuk pengalaman menonton terbaik</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-500/20 border border-red-500/50 rounded-xl text-red-200 text-sm">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-5" id="regForm">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- Nama Lengkap --}}
                    <div class="md:col-span-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" required 
                            class="w-full bg-gray-800/50 border border-gray-700 rounded-2xl px-5 py-4 text-white focus:border-red-600 outline-none transition mt-2">
                    </div>

                    {{-- Username (Unique) --}}
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" required 
                            class="w-full bg-gray-800/50 border border-gray-700 rounded-2xl px-5 py-4 text-white focus:border-red-600 outline-none transition mt-2"
                            placeholder="Contoh: sans_user123">
                        <p class="text-[10px] text-gray-500 mt-1">*Username harus unik & belum pernah digunakan.</p>
                    </div>

                    {{-- Tanggal Lahir (Min 15 Tahun) --}}
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Tanggal Lahir</label>
                        <input type="date" name="dob" id="dob" value="{{ old('dob') }}" required 
                            class="w-full bg-gray-800/50 border border-gray-700 rounded-2xl px-5 py-4 text-white focus:border-red-600 outline-none transition mt-2">
                        <p class="text-[10px] text-gray-500 mt-1">*Minimal usia 15 tahun.</p>
                    </div>

                    {{-- Email --}}
                    <div class="md:col-span-2">
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required 
                            class="w-full bg-gray-800/50 border border-gray-700 rounded-2xl px-5 py-4 text-white focus:border-red-600 outline-none transition mt-2">
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Password</label>
                        <input type="password" name="password" id="password" required 
                            class="w-full bg-gray-800/50 border border-gray-700 rounded-2xl px-5 py-4 text-white focus:border-red-600 outline-none transition mt-2">
                        <p class="text-[10px] text-gray-500 mt-2">Min. 8 Karakter (Huruf Besar, Kecil, & Angka)</p>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required 
                            class="w-full bg-gray-800/50 border border-gray-700 rounded-2xl px-5 py-4 text-white focus:border-red-600 outline-none transition mt-2">
                        <p id="password-alert" class="text-[10px] text-red-500 mt-2 hidden">⚠️ Password tidak cocok!</p>
                    </div>
                </div>

                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-black py-4 rounded-2xl shadow-xl transition transform hover:-translate-y-1 mt-4 uppercase">
                    Daftar Akun
                </button>
            </form>

            {{-- Google Login Terintegrasi --}}
            <div class="relative my-8 text-center">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-800"></div></div>
                <span class="relative bg-gray-900 px-4 text-xs font-bold text-gray-500 uppercase">Atau Daftar Dengan</span>
            </div>

            <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 bg-white hover:bg-gray-100 text-gray-900 font-bold py-4 rounded-2xl transition shadow-xl">
                <img src="https://www.gstatic.com/images/branding/product/1x/gsa_512dp.png" class="w-6 h-6" alt="Google">
                <span>Google Account</span>
            </a>
        </div>
    </div>
</div>

<script>
    // 1. Logika Kalender (Minimal 15 Tahun)
    const dobInput = document.getElementById('dob');
    const today = new Date();
    // Default kalender 10 tahun ke belakang
    const defaultDate = new Date(today.getFullYear() - 10, today.getMonth(), today.getDate());
    // Maksimal pemilihan tanggal adalah 15 tahun ke belakang dari hari ini
    const maxDate = new Date(today.getFullYear() - 15, today.getMonth(), today.getDate());
    
    dobInput.max = maxDate.toISOString().split("T")[0]; 
    // Mengatur default tampilan saat kalender dibuka agar user tidak kejauhan scroll
    dobInput.value = maxDate.toISOString().split("T")[0];

    // 2. Logika Real-time Password Alert
    const password = document.getElementById('password');
    const confirm = document.getElementById('password_confirmation');
    const alertMsg = document.getElementById('password-alert');

    confirm.addEventListener('input', function() {
        if (confirm.value !== password.value) {
            alertMsg.classList.remove('hidden');
        } else {
            alertMsg.classList.add('hidden');
        }
    });
</script>
@endsection