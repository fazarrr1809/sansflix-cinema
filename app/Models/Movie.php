<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function showtimes(): HasMany
    {
        return $this->hasMany(Showtime::class);
    }

    public function getEmbedUrlAttribute()
    {
        $url = $this->trailer_url;
        if (!$url) return null;

        if (str_contains($url, 'youtu.be/')) {
            $parts = explode('?', $url);
            $path = explode('/', $parts[0]);
            $videoId = end($path);
        } elseif (str_contains($url, 'v=')) {
            parse_str(parse_url($url, PHP_URL_QUERY), $params);
            $videoId = $params['v'] ?? null;
        } else {
            $videoId = null;
        }

        return $videoId ? 'https://www.youtube.com/embed/' . $videoId : $url;
    }

    // Perbaikan Accessor agar tidak error Undefined Property
    public function getPosterUrlAttribute()
    {
        return $this->attributes['poster_url'] ?? asset('images/no-poster.png');
    }
}