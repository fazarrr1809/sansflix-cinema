<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * KUNCI PERBAIKANNYA DI SINI:
     * Kita gunakan $guarded = [] agar SEMUA kolom (name, email, password, username, birth_date)
     * diizinkan untuk disimpan.
     */
    protected $guarded = []; 

    // Jika ada baris $fillable di bawah ini, HAPUS saja agar tidak bentrok.
    // protected $fillable = [ ... ]; <--- Hapus ini

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'username', // Pastikan ini juga ada
        'dob',      // Tambahkan ini
        'avatar',   // Pastikan ini juga ada
    ];
}