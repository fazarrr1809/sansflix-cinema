<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use App\Models\User;

class ProfileController extends Controller
{
    public function index() 
    {
        // Menggunakan Facade Auth agar metode 'user()' terdeteksi dengan jelas
        $user = Auth::user(); 

        return view('profile.index', compact('user'));
    }

    public function update(Request $request) {
        // Gunakan Auth::user() untuk menghindari error deteksi
        $user = Auth::user(); 
        
        // Cek jika user tidak ada (opsional untuk keamanan)
        if (!$user) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;

        if ($request->hasFile('avatar')) {
            $fileName = time().'_'.$user->id.'.'.$request->avatar->extension();
            $request->avatar->move(public_path('uploads/avatars'), $fileName);
            $user->avatar = $fileName;
        }

        $user->save();
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
