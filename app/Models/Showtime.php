<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Showtime extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Mengubah kolom tanggal agar dianggap sebagai 'Date' oleh Laravel
    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    // Relasi: Jadwal ini memutar Film apa?
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    // Relasi: Jadwal ini di Studio mana?
    public function auditorium(): BelongsTo
    {
        return $this->belongsTo(Auditorium::class);
    }
}