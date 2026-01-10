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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        
        // Kode Unik Booking (Misal: BOOK-65A2B)
        $table->string('booking_code')->unique();
        
        // Relasi ke Jadwal Tayang
        $table->foreignId('showtime_id')->constrained('showtimes')->onDelete('cascade');
        
        // Data Pembeli (Sederhana saja)
        $table->string('customer_name');
        $table->string('customer_email');
        
        // Jumlah Tiket & Total Harga
        $table->integer('total_tickets');
        $table->decimal('total_price', 10, 2);
        
        // Status Pembayaran
        $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
        
        $table->timestamps();
    });

    // Kita butuh tabel tambahan untuk menyimpan detail kursi yang dipilih
    // Karena 1 Booking bisa punya BANYAK kursi (One to Many)
    Schema::create('booking_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
        $table->foreignId('seat_id')->constrained('seats')->onDelete('cascade'); // Relasi ke tabel kursi
        $table->string('seat_number'); // Simpan nama kursi (A1, A2) jaga-jaga
        $table->decimal('price', 10, 2); // Harga per kursi saat itu
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_details');
        Schema::dropIfExists('bookings');
    }
};
