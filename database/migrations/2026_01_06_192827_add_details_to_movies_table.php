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
    Schema::table('movies', function (Blueprint $table) {
        // Menambah kolom baru
        $table->decimal('rating', 3, 1)->nullable(); // Contoh: 8.5
        $table->string('age_rating')->nullable();    // Contoh: 13+, 17+, SU
        $table->string('genre')->nullable();         // Contoh: Action, Horror
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            //
        });
    }
};
