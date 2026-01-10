<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Auditorium;
use App\Models\Showtime;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ShowtimeSeeder extends Seeder
{
        public function run(): void
    {
        $movies = Movie::all(); 
        $studios = Auditorium::all();

        if ($movies->isEmpty() || $studios->isEmpty()) {
            $this->command->error("Gagal: Data Movie atau Auditorium tidak ditemukan!");
            return;
        }

        $timeSlots = ['10:00', '13:00', '16:00', '19:00', '21:30'];

        foreach (range(0, 6) as $day) {
            $date = Carbon::today()->addDays($day);

            foreach ($studios as $studio) {
                $selectedMovie = $movies->random();

                foreach ($timeSlots as $time) {
                    $startTime = Carbon::parse($date->format('Y-m-d') . ' ' . $time);
                    
                    // --- LOGIKA DURASI OTOMATIS ---
                    // Mengambil kolom 'duration' (dalam menit) dari tabel movies
                    // Jika data duration kosong, default ke 120 menit
                    $duration = $selectedMovie->duration ?? 120; 
                    
                    // ends_at = starts_at + durasi film + 30 menit (jeda bersih-bersih studio)
                    $endTime = (clone $startTime)->addMinutes($duration + 30);

                    Showtime::create([
                        'movie_id'      => $selectedMovie->id,
                        'auditorium_id' => $studio->id,
                        'starts_at'     => $startTime,
                        'ends_at'       => $endTime,
                        'ticket_price'  => $date->isWeekend() ? 60000 : 50000,
                    ]);
                }
            }
        }
        $this->command->info("Showtime berhasil dibuat berdasarkan durasi film masing-masing!");
    }
}