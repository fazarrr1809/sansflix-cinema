<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'title', 'slug', 'promo_code', 'description', 
        'thumbnail_url', 'expired_at', 'is_active'
    ];

    // Tambahkan ini agar expired_at otomatis menjadi objek Carbon
    protected $casts = [
        'expired_at' => 'date',
        'is_active' => 'boolean',
    ];
}