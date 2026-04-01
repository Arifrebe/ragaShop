<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Tampilkan form
    public function show()
    {
        return view('auth.register');
    }

    // Simpan user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone'    => 'required|string|max:15',
            'address'  => 'required|string',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone'    => $validated['phone'],
            'address'  => $validated['address'],
            'role'     => 'customer',
        ]);

        return redirect()->route('auth.login')
            ->with('success', 'Registrasi berhasil, silakan login');
    }
}