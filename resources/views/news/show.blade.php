@extends('layouts.app')

@section('title', $news->title . ' - Sansflix News')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <nav class="text-sm text-gray-400 mb-6">
            <a href="/" class="hover:text-white">Home</a> / 
            <a href="{{ route('news.index') }}" class="hover:text-white">News</a> / 
            <span class="text-gray-200">{{ Str::limit($news->title, 30) }}</span>
        </nav>

        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 leading-tight">
            {{ $news->title }}
        </h1>
        
        <div class="flex items-center text-gray-400 text-sm mb-8 gap-4">
            <span class="flex items-center gap-1">
                📅 {{ $news->created_at->format('d M Y') }}
            </span>
            <span class="text-red-600 font-bold uppercase">Sansflix Editorial</span>
        </div>

        <div class="rounded-2xl overflow-hidden shadow-2xl mb-10 border border-gray-800">
            <img src="{{ $news->thumbnail_url }}" alt="{{ $news->title }}" class="w-full h-auto">
        </div>

        <div class="prose prose-invert prose-red max-w-none text-gray-300 leading-relaxed text-lg">
            {!! $news->content !!}
        </div>

        <div class="mt-16 pt-8 border-t border-gray-800">
            <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 text-red-600 font-bold hover:text-red-500 transition">
                &larr; Kembali ke Daftar Berita
            </a>
        </div>
    </div>
</div>
@endsection