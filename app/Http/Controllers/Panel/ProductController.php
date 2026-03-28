<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();

        return view('panel.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();

        return view('panel.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required',
            'weight'      => 'required|numeric',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validatedData['price'] = str_replace(['Rp.', '.'], '', $request->price);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validatedData);

        return redirect()->route('product.index')
            ->with('success', 'Produk berhasil ditambahkan!');
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
    public function edit(string $slug)
    {
        $categories = Category::select('id', 'name')->get();
        $product = Product::where('slug', $slug)->with('category')->firstOrFail();

        return view('panel.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        $validatedData = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required',
            'weight'      => 'required|numeric',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validatedData['price'] = str_replace(['Rp.', '.'], '', $request->price);

        if ($request->file('image')) {
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }

            $validatedData['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validatedData);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}
