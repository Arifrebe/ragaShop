<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('user', 'promo')
            ->orderByRaw("
                CASE 
                    WHEN status = 'pending' THEN 1
                    WHEN status = 'paid' THEN 2
                    WHEN status = 'shipped' THEN 3
                    WHEN status = 'completed' THEN 4
                    ELSE 5
                END
            ")
            ->latest('created_at') // urut berdasarkan tanggal terbaru jika status sama
            ->get();

        return view('panel.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function updateStatus(Request $request, Order $order)
    {
        $status = $request->status;

        $allowed = ['paid', 'fail', 'pending', 'shipped', 'completed'];
        if (!in_array($status, $allowed)) {
            return back()->with('error', 'Status tidak valid');
        }

        $order->status = $status;
        $order->save();

        return back()->with('success', 'Status berhasil diubah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
