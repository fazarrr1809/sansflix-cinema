<?php

namespace Database\Seeders;

use App\Models\FoodBeverage;
use Illuminate\Database\Seeder;

class FoodBeverageSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // POPCORN - Harga Lebih Murah
            [
                'name' => 'Popcorn Salt Small',
                'category' => 'popcorn',
                'price' => 12000,
                'description' => 'Popcorn asin gurih ukuran ekonomis.',
                'image_url' => 'https://images.unsplash.com/photo-1572177191856-3cde618dee1f?q=80&w=500',
                'is_ready' => true,
            ],
            [
                'name' => 'Popcorn Sweet Small',
                'category' => 'popcorn',
                'price' => 15000,
                'description' => 'Popcorn manis ukuran kecil.',
                'image_url' => 'https://images.unsplash.com/photo-1505686994434-e3cc5abf1330?q=80&w=500',
                'is_ready' => true,
            ],
            // DRINK - Pilihan Lebih Banyak
            [
                'name' => 'Mineral Water 600ml',
                'category' => 'drink',
                'price' => 5000,
                'description' => 'Air mineral kemasan botol dingin.',
                'image_url' => 'https://images.unsplash.com/photo-1560023907-5f339617ea30?q=80&w=500',
                'is_ready' => true,
            ],
            [
                'name' => 'Iced Sweet Tea',
                'category' => 'drink',
                'price' => 7000,
                'description' => 'Es teh manis segar.',
                'image_url' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?q=80&w=500',
                'is_ready' => true,
            ],
            [
                'name' => 'Hot Coffee',
                'category' => 'drink',
                'price' => 10000,
                'description' => 'Kopi hitam panas.',
                'image_url' => 'https://images.unsplash.com/photo-1541167760496-162955ed8a9f?q=80&w=500',
                'is_ready' => true,
            ],
            // SNACK - Variasi Menu
            [
                'name' => 'French Fries',
                'category' => 'snack',
                'price' => 15000,
                'description' => 'Kentang goreng renyah.',
                'image_url' => 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?q=80&w=500',
                'is_ready' => true,
            ],
            [
                'name' => 'Grilled Sausage',
                'category' => 'snack',
                'price' => 12000,
                'description' => 'Sosis sapi bakar isi 2.',
                'image_url' => 'https://images.unsplash.com/photo-1532117182044-031e7ed98c69?q=80&w=500',
                'is_ready' => true,
            ],
        ];

        foreach ($items as $item) {
            FoodBeverage::create($item);
        }
    }
}