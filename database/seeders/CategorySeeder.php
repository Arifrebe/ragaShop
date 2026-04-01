<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Makanan Kucing',
            'Makanan Anjing',
            'Pasir Kucing',
            'Aksesoris',
            'Kesehatan Hewan'
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat)
            ]);
        }
    }
}
