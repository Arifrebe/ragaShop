<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(8);

        return view('front.products', compact('products'));
    }

    public function cart()
    {
        return view('front.cart');
    }

    public function checkout()
    {
        return view('front.checkout');
    }

    public function processCheckout()
    {
        // ⚠️ sementara dummy dulu (biar jalan tanpa ubah sistem teman kamu)
        $cart = [
            [
                'product_id' => 1,
                'price' => 100000,
                'qty' => 1
            ]
        ];

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }

        // simpan order
        $order = Order::create([
            'user_id' => auth()->id(),
            'invoice' => 'INV-' . time(),
            'status' => 'pending',
            'subtotal' => $subtotal,
            'discount_amount' => 0,
            'shipping_cost' => 0,
            'grand_total' => $subtotal,
        ]);

        // simpan item
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['qty'],
            ]);
        }

        // MIDTRANS
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = false;

        $params = [
            'transaction_details' => [
                'order_id' => $order->invoice,
                'gross_amount' => (int) $order->grand_total,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('front.checkout', compact('snapToken'));
    }

    public function callback()
    {
        $notif = new Notification();

        $order = Order::where('invoice', $notif->order_id)->first();

        if (!$order) return;

        if ($notif->transaction_status == 'settlement') {
            $order->status = 'paid';
        } elseif ($notif->transaction_status == 'pending') {
            $order->status = 'pending';
        } elseif ($notif->transaction_status == 'expire') {
            $order->status = 'expired';
        }

        $order->save();

        return response()->json(['status' => 'ok']);
    }
}
