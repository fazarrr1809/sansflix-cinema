<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relasi ke Film/Jadwal
    public function showtime(): BelongsTo
    {
        return $this->belongsTo(Showtime::class);
    }

    // Relasi ke Detail Kursi (INI YANG SERING LUPA)
    public function details(): HasMany
    {
        return $this->hasMany(BookingDetail::class);
    }
}