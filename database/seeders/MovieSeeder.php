<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $movies = [
            [
                'title' => 'Agak Laen',
                'genre' => 'Comedy, Horror',
                'duration_minutes' => 119, // Tambahkan durasi
                'poster_url' => 'https://image.tmdb.org/t/p/original/m9Yp0v0606L97v6Sj0KjY7R4GvL.jpg',
                'status' => 'expired',
                'description' => 'Empat sekawan pengelola rumah hantu pasar malam mencoba mencari cara baru menakuti pengunjung demi menyelamatkan usaha mereka.',
                'release_date' => '2024-02-01',
            ],
            [
                'title' => 'Siksa Kubur',
                'genre' => 'Horror, Drama',
                'duration_minutes' => 117,
                'poster_url' => 'https://image.tmdb.org/t/p/original/jS9mI8IAtU28k019T7o9WjO9C6f.jpg',
                'status' => 'expired',
                'description' => 'Setelah kedua orang tuanya jadi korban bom bunuh diri, Sita jadi tidak percaya agama. Ia mencari orang paling berdosa untuk ikut masuk ke dalam kuburnya.',
                'release_date' => '2024-04-11',
            ],
            [
                'title' => 'Vina: Sebelum 7 Hari',
                'genre' => 'Horror, Crime',
                'duration_minutes' => 100,
                'poster_url' => 'https://image.tmdb.org/t/p/original/8m1z8S0k8mK9I1Wl1E4Xv7eW8rW.jpg',
                'status' => 'expired',
                'description' => 'Kisah nyata tentang Vina, seorang gadis yang menjadi korban kekejaman geng motor di Cirebon.',
                'release_date' => '2024-05-08',
            ],
            [
                'title' => 'Pemandi Jenazah',
                'genre' => 'Horror, Mystery',
                'duration_minutes' => 107,
                'poster_url' => 'https://image.tmdb.org/t/p/original/6K1Y0p6Z8E9m1F4S5O8w7X9k0m6.jpg',
                'status' => 'expired',
                'description' => 'Lela, seorang pemandi jenazah, menemukan kejanggalan pada jenazah ibunya yang baru saja meninggal.',
                'release_date' => '2024-02-22',
            ],
            [
                'title' => 'Ipar Adalah Maut',
                'genre' => 'Drama, Romance',
                'duration_minutes' => 131,
                'poster_url' => 'https://image.tmdb.org/t/p/original/4k1Z8S0k8mK9I1Wl1E4Xv7eW8rW.jpg',
                'status' => 'expired',
                'description' => 'Kehidupan rumah tangga Nisa dan Aris hancur ketika adik kandung Nisa mulai tinggal bersama mereka.',
                'release_date' => '2024-06-13',
            ],
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}