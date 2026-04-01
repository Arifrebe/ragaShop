<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ======================
        // ADMIN
        // ======================
        DB::table('users')->insert([
            'name' => 'Admin Petshop',
            'email' => 'admin@petshop.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ======================
        // CUSTOMER
        // ======================
        $customers = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'phone' => '081234111111',
                'address' => 'Jakarta',
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@gmail.com',
                'phone' => '081234222222',
                'address' => 'Bandung',
            ],
            [
                'name' => 'Andi Pratama',
                'email' => 'andi@gmail.com',
                'phone' => '081234333333',
                'address' => 'Surabaya',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi@gmail.com',
                'phone' => '081234444444',
                'address' => 'Medan',
            ],
        ];

        foreach ($customers as $c) {
            DB::table('users')->insert([
                'name' => $c['name'],
                'email' => $c['email'],
                'password' => Hash::make('password'),
                'role' => 'customer',
                'phone' => $c['phone'],
                'address' => $c['address'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}