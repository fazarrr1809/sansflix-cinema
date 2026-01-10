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
    Schema::table('users', function (Blueprint $table) {
        // Username harus unik (tidak boleh kembar)
        $table->string('username')->unique()->after('name')->nullable();
        
        // Tanggal Lahir
        $table->date('birth_date')->after('email')->nullable();
    });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'birth_date']);
        });
    }
};
