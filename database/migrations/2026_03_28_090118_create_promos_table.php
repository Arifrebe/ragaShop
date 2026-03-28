<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promo;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promos = Promo::all();
        return view('panel.promos.index', compact('promos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.promos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'code'         => 'required|string|unique:promos,code|max:50',
            'type'         => 'required|in:percentage,fixed',
            'value'        => 'required',
            'min_purchase' => 'nullable',
            'start_date'   => 'nullable|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'is_active'    => 'required|boolean',
        ]);

        // Hapus format ribuan dan simbol Rp / %
        $validatedData['value'] = str_replace([',', 'Rp', '%', '.'], '', $validatedData['value']);
        $validatedData['value'] = (float) $validatedData['value'];

        $validatedData['min_purchase'] = isset($validatedData['min_purchase'])
            ? (float) str_replace([',', 'Rp', '.'], '', $validatedData['min_purchase'])
            : 0;

        Promo::create($validatedData);

        return redirect()->route('panel.promos.index')
            ->with('success', 'Promo berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $promo = Promo::findOrFail($id);
        return view('panel.promos.edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $promo = Promo::findOrFail($id);

        $validatedData = $request->validate([
            'code'         => 'required|string|max:50|unique:promos,code,' . $promo->id,
            'type'         => 'required|in:percentage,fixed',
            'value'        => 'required',
            'min_purchase' => 'nullable',
            'start_date'   => 'nullable|date',
            'end_date'     => 'nullable|date|after_or_equal:start_date',
            'is_active'    => 'required|boolean',
        ]);

        // Hapus format ribuan dan simbol Rp / %
        $validatedData['value'] = str_replace([',', 'Rp', '%', '.'], '', $validatedData['value']);
        $validatedData['value'] = (float) $validatedData['value'];

        $validatedData['min_purchase'] = isset($validatedData['min_purchase'])
            ? (float) str_replace([',', 'Rp', '.'], '', $validatedData['min_purchase'])
            : 0;

        $promo->update($validatedData);

        return redirect()->route('panel.promos.index')
            ->with('success', 'Promo berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();

        return redirect()->back()->with('success', 'Promo berhasil dihapus!');
    }
}