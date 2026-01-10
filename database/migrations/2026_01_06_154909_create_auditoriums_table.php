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
    Schema::create('auditoriums', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Contoh: "Studio 1", "IMAX", "Gold Class"
        $table->integer('total_seats')->default(0); // Total kapasitas kursi
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditoriums');
    }
};
