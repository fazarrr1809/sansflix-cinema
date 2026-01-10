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
            $table->string('category'); // Popcorn, Snacks, Drinks, Combo
            $table->integer('price');
            $table->text('description')->nullable();
            $table->string('image_url'); // URL gambar external
            $table->boolean('is_ready')->default(true); // Stok tersedia atau tidak
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
