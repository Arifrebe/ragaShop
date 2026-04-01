<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_item;

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

    // Tambahkan di ShopController.php

    public function checkout(Request $request)
    {
        // 1. Cek apakah user sudah login
        if (!auth()->check()) {
            return redirect()->route('auth.login')->with('error', 'Silakan masuk terlebih dahulu untuk melakukan checkout.');
        }

        $user = auth()->user();

        // 2. Cek apakah data pribadi (phone & address) sudah lengkap
        if (empty($user->phone) || empty($user->address)) {
            // Arahkan ke halaman profil dan beri sinyal bahwa dia sedang tertunda proses checkout-nya
            return redirect()->route('profile.index', ['checkout' => 'pending'])
                            ->with('error', 'Silakan lengkapi Nomor HP dan Alamat Anda terlebih dahulu.');
        }

        // Jika sudah lengkap, tampilkan halaman checkout seperti biasa
        // Kita juga bisa mengirimkan data user ke form checkout agar terisi otomatis
        return view('front.checkout', compact('user'));
    }

    public function checkoutProcess(Request $request)
    {
        // 1. Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('auth.login')->with('error', 'Anda harus login untuk melakukan checkout.');
        }

        $user = Auth::user();

        // 2. Validasi kelengkapan data diri (jika alamat/hp belum lengkap, batalkan)
        if (empty($user->phone) || empty($user->address)) {
            return redirect()->route('profile.index', ['checkout' => 'pending'])
                             ->with('error', 'Silakan lengkapi Nomor HP dan Alamat Anda terlebih dahulu.');
        }

        // 3. Validasi kiriman keranjang (dari input hidden JS)
        $request->validate([
            'cart_data' => 'required'
        ]);

        $cartItems = json_decode($request->cart_data, true);

        if (!$cartItems || count($cartItems) == 0) {
            return redirect()->back()->with('error', 'Keranjang pesanan tidak valid atau kosong.');
        }

        // 4. Kalkulasi Total Harga (Subtotal)
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += ($item['price'] * $item['quantity']);
        }

        // Gunakan DB Transaction agar pesanan batal jika terjadi error di tengah jalan
        DB::beginTransaction();
        try {
            // A. Simpan ke tabel `orders`
            $order = new Order();
            $order->user_id = $user->id;
            // Generate nomor invoice (contoh: INV-20260402-XXXX)
            $order->invoice = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5)); 
            $order->status = 'pending'; // Status awal
            
            // Perhitungan harga
            $order->subtotal = $subtotal;
            $order->discount_amount = 0; // Bisa diubah jika ada logika promo (promo_id)
            $order->shipping_cost = 0;   // Bisa diubah jika ada logika ongkir kurir
            $order->grand_total = $subtotal; // Jika ada ongkir: $subtotal + $shipping_cost
            
            // Detail Pengiriman & Pembayaran
            // $order->shipping_address = $user->address; // Mengambil alamat langsung dari profil user
            // $order->shipping_courier = 'JNE'; // Opsional jika tabel ini mewajibkan isi
            // $order->payment_method = 'Transfer Bank'; // Opsional
            // $order->payment_status = 'unpaid'; // Opsional
            
            $order->save();

            // B. Simpan ke tabel `order_items`
            foreach ($cartItems as $item) {
                $orderItem = new Order_item();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $item['id'];
                $orderItem->price = $item['price'];
                $orderItem->quantity = $item['quantity'];
                // Subtotal per produk (harga x kuantitas)
                $orderItem->subtotal = ($item['price'] * $item['quantity']); 
                $orderItem->save();
            }

            DB::commit(); // Selesaikan semua query
            
            // Redirect dengan membawa pesan sukses dan "sinyal hapus keranjang (clear_cart)"
            return redirect('/')->with([
                'success' => 'Checkout Berhasil! Nomor Invoice: ' . $order->invoice,
                'clear_cart' => true
            ]);

        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua insert jika terjadi error

            dd('ERROR DATABASE: ' . $e->getMessage());
            
            // Mengembalikan ke halaman checkout sambil membawa pesan error aslinya (opsional)
            // return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
            // return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan. Silakan coba lagi.');
        }
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
