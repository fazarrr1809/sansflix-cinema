<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('movies', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Judul Film
        $table->text('description'); // Sinopsis
        $table->string('poster_url')->nullable(); // Foto Poster
        $table->string('trailer_url')->nullable(); // Link YouTube
        $table->date('release_date'); // Tanggal Rilis
        $table->integer('duration_minutes'); // Durasi (menit)
        $table->enum('status', ['now_playing', 'coming_soon', 'expired'])->default('now_playing'); // Status Tayang
        $table->timestamps(); // Mencatat kapan dibuat/diedit
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
