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
        Schema::create('food_beverages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // popcorn, drink, snack
            $table->integer('price');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable(); // Tetap gunakan image_url sesuai error SQL Anda
            $table->boolean('is_active')->default(true); // Tambahkan kolom ini
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_beverages');
    }
};
