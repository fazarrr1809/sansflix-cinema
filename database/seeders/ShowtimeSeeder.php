<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Auditorium;
use App\Models\Showtime;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ShowtimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua film dan auditorium yang ada
        $movies = Movie::all();
        $auditoriums = Auditorium::all();

        if ($movies->isEmpty() || $auditoriums->isEmpty()) {
            $this->command->info('Data Movie atau Auditorium kosong. Silakan isi terlebih dahulu.');
            return;
        }

        // Loop untuk 7 hari ke depan
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::now()->addDays($i);
            $isWeekend = $date->isWeekend();

            foreach ($auditoriums as $auditorium) {
                // Tentukan harga dasar berdasarkan nama studio (case insensitive)
                $isPremier = str_contains(strtolower($auditorium->name), 'premier');
                
                // Logika Harga:
                // Reguler: Weekday 35k, Weekend 50k
                // Premier: Weekday 75k, Weekend 100k
                if ($isPremier) {
                    $basePrice = $isWeekend ? 100000 : 75000;
                } else {
                    $basePrice = $isWeekend ? 50000 : 35000;
                }

                // Pilih 2-3 film secara acak untuk diputar di studio ini dalam sehari
                $dailyMovies = $movies->random(min(2, $movies->count()));

                // Tentukan jam tayang (Misal: 13:00, 16:00, 19:00, 21:00)
                $slots = ['13:00', '16:00', '19:00', '21:30'];

                foreach ($slots as $index => $time) {
                    $movie = ($index % 2 == 0) ? $dailyMovies->first() : $dailyMovies->last();
                    
                    $startAt = Carbon::parse($date->format('Y-m-d') . ' ' . $time);
                    $endAt = (clone $startAt)->addHours(2); // Durasi default 2 jam

                    Showtime::create([
                        'movie_id' => $movie->id,
                        'auditorium_id' => $auditorium->id,
                        'starts_at' => $startAt,
                        'ends_at' => $endAt,
                        'ticket_price' => $basePrice,
                    ]);
                }
            }
        }

        $this->command->info('Berhasil menambahkan data Showtime untuk 7 hari ke depan.');
    }
}