<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promos = [
            [
                'title' => 'Midnight Movie Madness',
                'slug' => Str::slug('Midnight Movie Madness'),
                'promo_code' => 'SANSNIGHT',
                'description' => 'Nonton film horor pilihan di atas jam 21:00 dan dapatkan potongan harga langsung Rp15.000. Berani coba?',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1505686994434-e3cc5abf1330?q=80&w=800',
                'expired_at' => now()->addMonths(1),
                'is_active' => true,
            ],
            [
                'title' => 'Date Night Package: Premier Only',
                'slug' => Str::slug('Date Night Package Premier'),
                'promo_code' => 'LOVESANS',
                'description' => 'Manjakan pasangan Anda di Studio Premier. Gunakan kode ini untuk mendapatkan voucher FnB senilai Rp50.000 secara gratis.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1524712245354-2c4e5e7121c0?q=80&w=800',
                'expired_at' => now()->addWeeks(2),
                'is_active' => true,
            ],
            [
                'title' => 'Family Fun Day: Buy 3 Get 1',
                'slug' => Str::slug('Family Fun Day Buy 3 Get 1'),
                'promo_code' => 'SANSFAMILY',
                'description' => 'Bawa seluruh keluarga nonton film animasi favorit! Beli 3 tiket Reguler, otomatis dapat 1 tiket tambahan gratis.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1478720568477-152d9b164e26?q=80&w=800',
                'expired_at' => now()->addMonths(2),
                'is_active' => true,
            ],
            [
                'title' => 'Monday Movie Buff',
                'slug' => Str::slug('Monday Movie Buff'),
                'promo_code' => 'SANSIMONDAY',
                'description' => 'Benci hari Senin? Obati dengan nonton film apa saja dengan harga flat Rp25.000 untuk semua studio Reguler!',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1485846234645-a62644f84728?q=80&w=800',
                'expired_at' => now()->addMonths(3),
                'is_active' => true,
            ],
            [
                'title' => 'Early Bird: Nonton Hemat Siang Hari',
                'slug' => Str::slug('Early Bird Nonton Hemat'),
                'promo_code' => 'SANSBIRD',
                'description' => 'Lebih awal lebih hemat! Diskon 20% untuk semua jadwal tayang sebelum jam 13:00 setiap harinya.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?q=80&w=800',
                'expired_at' => now()->addMonths(1),
                'is_active' => true,
            ],
        ];

        foreach ($promos as $promo) {
            // Menggunakan create untuk menambahkan data baru
            Promo::create($promo);
        }

        $this->command->info('Berhasil menambahkan 5 promo baru yang menarik ke database.');
    }
}