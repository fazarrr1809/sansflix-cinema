<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Promo;

class HomeController extends Controller
{
    public function index()
{
    $nowPlaying = Movie::where('status', 'now_playing')->latest()->get();
    $comingSoon = Movie::where('status', 'coming_soon')->latest()->get();
    $finishedMovies = Movie::where('status', 'expired')->latest()->get();
    $latestNews = News::where('is_active', true)->latest()->take(4)->get();
    
    // Ambil promo yang masih aktif dan belum expired
    $activePromos = Promo::where('is_active', true)
                         ->where('expired_at', '>=', now())
                         ->latest()->get();

    return view('home', compact('nowPlaying', 'comingSoon', 'finishedMovies', 'latestNews', 'activePromos'));
}

    public function show($id)
    {
        // Ambil film berdasarkan ID
        $movie = Movie::with(['showtimes' => function($query) {
            // Ambil jadwal yang belum lewat (waktu sekarang < waktu mulai)
            // Urutkan dari jam paling awal
            $query->where('starts_at', '>', now())
                  ->orderBy('starts_at', 'asc');
        }, 'showtimes.auditorium']) // Kita butuh data nama studio juga
        ->findOrFail($id);

        return view('movie_detail', compact('movie'));
    }
    public function promoDetail($slug)
    {
        $promo = \App\Models\Promo::where('slug', $slug)->firstOrFail();
        
        return view('promo_detail', compact('promo'));
    }
}