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
    Schema::create('showtimes', function (Blueprint $table) {
        $table->id();
        
        // Relasi ke Film
        $table->foreignId('movie_id')->constrained('movies')->onDelete('cascade');
        
        // Relasi ke Studio
        $table->foreignId('auditorium_id')->constrained('auditoriums')->onDelete('cascade');
        
        // Jam Tayang
        $table->dateTime('starts_at'); // Kapan mulai
        $table->dateTime('ends_at');   // Kapan selesai
        
        // Harga Tiket (Bisa beda-beda tiap jam/hari)
        $table->decimal('ticket_price', 10, 2)->default(50000); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('showtimes');
    }
};
