<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')->pluck('id');
        $promos = DB::table('promos')->pluck('id');

        foreach (range(1, 10) as $i) {
            $subtotal = rand(50000, 200000);
            $discount = rand(0, 20000);
            $shipping = 10000;

            DB::table('orders')->insert([
                'user_id' => $users->random(),
                'invoice' => 'INV-' . strtoupper(Str::random(8)),
                'status' => collect(['pending', 'paid', 'shipped'])->random(),
                'promo_id' => rand(0, 1) ? $promos->random() : null,
                'subtotal' => $subtotal,
                'discount_amount' => $discount,
                'shipping_cost' => $shipping,
                'grand_total' => $subtotal - $discount + $shipping,
                'shipping_courier' => 'JNE',
                'tracking_number' => 'RESI' . rand(100000, 999999),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}