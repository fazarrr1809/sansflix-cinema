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
        Schema::create('food_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('total_price');
            $table->string('status')->default('pending'); // pending, paid, picked_up
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });

        // Tabel detail untuk item yang dibeli
        Schema::create('food_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_order_id')->constrained()->onDelete('cascade');
            $table->foreignId('food_beverage_id')->constrained();
            $table->integer('quantity');
            $table->integer('price'); // Harga saat dibeli
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_orders');
    }
};
