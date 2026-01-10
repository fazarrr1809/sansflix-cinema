<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Menampilkan semua berita
    public function index()
    {
        $allNews = News::where('is_active', true)->latest()->paginate(9);
        return view('news.index', compact('allNews'));
    }

    // Menampilkan detail berita berdasarkan slug
    public function show($slug)
    {
        $news = News::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        // Mengambil berita lainnya sebagai rekomendasi di samping/bawah
        $otherNews = News::where('id', '!=', $news->id)
                         ->where('is_active', true)
                         ->latest()
                         ->take(3)
                         ->get();

        return view('news.show', compact('news', 'otherNews'));
    }
}