<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   // database/seeders/DatabaseSeeder.php

    public function run(): void
    {
        // 1. Buat User Admin (Agar Anda bisa login kembali)
         \App\Models\User::create([
        'name' => 'Admin Sansflix',
        'email' => 'adminsansflix@gmail.com',
        'password' => bcrypt('admin1234'),
        'username' => 'sansflix',
        'birthdate' => '1990-01-01',
        ]);

        // 2. Buat Studio (Auditorium)
        // PERBAIKAN: Gunakan 'total_seats' sesuai migrasi Anda
        for ($i = 1; $i <= 5; $i++) {
            \App\Models\Auditorium::create([
                'name' => 'Studio ' . $i,
                'total_seats' => 50 // Ganti dari 'capacity' menjadi 'total_seats'
            ]);
        }

        // 3. Buat Film & Jadwal
        \App\Models\Movie::factory(10)->create();
        \App\Models\Showtime::factory(30)->create();
    }
        
}
