<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('front.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        // Jika sebelumnya diarahkan dari keranjang karena data belum lengkap
        if ($request->has('redirect_to_checkout')) {
            return redirect('/checkout')->with('success', 'Data pribadi berhasil dilengkapi. Silakan lanjutkan pesanan Anda.');
        }

        return redirect()->back()->with('success', 'Data pribadi berhasil diperbarui!');
    }
}