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
    Schema::create('seats', function (Blueprint $table) {
        $table->id();
        
        // Menghubungkan Kursi dengan Studio (Foreign Key)
        // Jika Studio dihapus, kursinya ikut terhapus (cascade)
        $table->foreignId('auditorium_id')->constrained('auditoriums')->onDelete('cascade');
        
        $table->string('row_letter'); // Baris: A, B, C
        $table->integer('seat_number'); // Nomor: 1, 2, 3
        
        // Tipe kursi (biar nanti harganya bisa beda kalau mau)
        $table->enum('type', ['standard', 'vip', 'couple'])->default('standard');
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
