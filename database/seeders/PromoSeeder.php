<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promo;
use Carbon\Carbon;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        $promos = [
            [
                'code' => 'DISC10',
                'type' => 'percentage',
                'value' => 10,
                'min_purchase' => 50000,
                'start_date' => Carbon::now()->subDays(5),
                'end_date' => Carbon::now()->addDays(30),
                'is_active' => true,
            ],
            [
                'code' => 'HEMAT20K',
                'type' => 'fixed',
                'value' => 20000,
                'min_purchase' => 100000,
                'start_date' => Carbon::now()->subDays(3),
                'end_date' => Carbon::now()->addDays(15),
                'is_active' => true,
            ],
            [
                'code' => 'ONGKIRGRATIS',
                'type' => 'fixed',
                'value' => 15000,
                'min_purchase' => 75000,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(10),
                'is_active' => true,
            ],
            [
                'code' => 'FLASH50',
                'type' => 'percentage',
                'value' => 50,
                'min_purchase' => 200000,
                'start_date' => Carbon::now()->subDays(10),
                'end_date' => Carbon::now()->subDays(1), // sudah expired
                'is_active' => false,
            ],
        ];

        foreach ($promos as $promo) {
            \App\Models\Promo::create($promo);
        }
    }
}
