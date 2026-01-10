<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        // Data Dummy Promo
        $promos = [
            [
                'title' => 'Beli 1 Gratis 1 Kartu Kredit Sansbank',
                'slug' => 'beli-1-gratis-1-sansbank',
                'promo_code' => 'SANSBANKBOGO',
                'description' => 'Nikmati promo beli 1 gratis 1 tiket nonton setiap hari Jumat menggunakan Kartu Kredit Sansbank.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1595764438938-f9738a20700b?q=80&w=800',
                'expired_at' => now()->addMonths(2),
                'is_active' => true,
            ],
            [
                'title' => 'Diskon Pelajar 30% Setiap Selasa',
                'slug' => 'diskon-pelajar-selasa',
                'promo_code' => 'STUDENTPOWER',
                'description' => 'Cukup tunjukkan kartu pelajar Anda dan dapatkan diskon langsung 30% untuk semua film.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?q=80&w=800',
                'expired_at' => now()->addMonths(1),
                'is_active' => true,
            ],
            [
                'title' => 'Paket Combo Popcorn Hemat 50%',
                'slug' => 'paket-combo-hemat',
                'promo_code' => 'MANTAPPU',
                'description' => 'Beli tiket nonton sekarang dan dapatkan voucher diskon 50% untuk pembelian paket popcorn jumbo.',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1572177191856-3cde618dee1f?q=80&w=800',
                'expired_at' => now()->addWeeks(2),
                'is_active' => true,
            ],
        ];

        foreach ($promos as $promo) {
            Promo::create($promo);
        }
    }
}