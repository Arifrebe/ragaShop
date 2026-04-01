<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Relasi
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('promo_id')->nullable()->constrained()->nullOnDelete();

            // Data utama
            $table->string('invoice')->unique();
            $table->string('status');

            // Keuangan
            $table->decimal('subtotal', 15, 2);
            $table->integer('discount_amount')->default(0);
            $table->integer('shipping_cost')->default(0);
            $table->integer('grand_total');

            // Pengiriman
            $table->string('shipping_courier');
            $table->string('tracking_number')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};