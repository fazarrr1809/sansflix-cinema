<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auditorium extends Model
{
    use HasFactory;

    // INI SOLUSINYA: Kita paksa nama tabelnya
    protected $table = 'auditoriums';

    protected $guarded = [];

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }
}