<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $orders = DB::table('orders')->pluck('id');
        $products = DB::table('products')->get();

        foreach ($orders as $orderId) {
            // tiap order punya 1–3 item
            foreach (range(1, rand(1, 3)) as $i) {

                $product = $products->random();
                $qty = rand(1, 3);
                $price = $product->price;

                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $price,
                    'subtotal' => $price * $qty,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}