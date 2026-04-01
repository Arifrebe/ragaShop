<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run(): void
    {
        $products = [
            // MAKANAN KUCING
            [
                'name' => 'Whiskas Adult Tuna 1.2kg',
                'price' => 65000,
                'stock' => 50,
                'weight' => 1.2,
                'category' => 'Makanan Kucing'
            ],
            [
                'name' => 'Royal Canin Kitten 2kg',
                'price' => 285000,
                'stock' => 20,
                'weight' => 2,
                'category' => 'Makanan Kucing'
            ],
            [
                'name' => 'Me-O Adult Salmon 1.1kg',
                'price' => 55000,
                'stock' => 40,
                'weight' => 1.1,
                'category' => 'Makanan Kucing'
            ],

            // MAKANAN ANJING
            [
                'name' => 'Pedigree Adult Beef 1.5kg',
                'price' => 75000,
                'stock' => 30,
                'weight' => 1.5,
                'category' => 'Makanan Anjing'
            ],
            [
                'name' => 'Bolt Dog Food 1kg',
                'price' => 25000,
                'stock' => 60,
                'weight' => 1,
                'category' => 'Makanan Anjing'
            ],

            // PASIR KUCING
            [
                'name' => 'Pasir Kucing Zeolit 10kg',
                'price' => 45000,
                'stock' => 100,
                'weight' => 10,
                'category' => 'Pasir Kucing'
            ],
            [
                'name' => 'Pasir Gumpal Scented 5L',
                'price' => 60000,
                'stock' => 70,
                'weight' => 5,
                'category' => 'Pasir Kucing'
            ],

            // AKSESORIS
            [
                'name' => 'Kalung Kucing Anti Bell',
                'price' => 15000,
                'stock' => 80,
                'weight' => 0.1,
                'category' => 'Aksesoris'
            ],
            [
                'name' => 'Mainan Bola Kucing',
                'price' => 10000,
                'stock' => 100,
                'weight' => 0.05,
                'category' => 'Aksesoris'
            ],

            // KESEHATAN
            [
                'name' => 'Vitamin Kucing Fish Oil',
                'price' => 35000,
                'stock' => 40,
                'weight' => 0.2,
                'category' => 'Kesehatan Hewan'
            ],
            [
                'name' => 'Obat Kutu Anjing & Kucing',
                'price' => 50000,
                'stock' => 25,
                'weight' => 0.2,
                'category' => 'Kesehatan Hewan'
            ],
        ];

        foreach ($products as $p) {
            $category = \App\Models\Category::where('name', $p['category'])->first();

            \App\Models\Product::create([
                'name' => $p['name'],
                'slug' => Str::slug($p['name']),
                'description' => 'Produk ' . $p['name'] . ' berkualitas untuk hewan peliharaan Anda.',
                'image' => 'products/default.png',
                'price' => $p['price'],
                'stock' => $p['stock'],
                'weight' => $p['weight'],
                'category_id' => $category->id,
            ]);
        }
    }
}
