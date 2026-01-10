<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    use HasFactory;

    // Agar bisa diisi massal oleh Generator Kursi
    protected $guarded = [];

    // Relasi: Kursi ini milik Studio mana?
    public function auditorium(): BelongsTo
    {
        return $this->belongsTo(Auditorium::class);
    }
}