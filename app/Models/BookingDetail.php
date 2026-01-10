<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    // --- WAJIB ADA: Relasi ke Booking ---
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    // Opsional: Relasi ke Seat (Kursi)
    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }
}