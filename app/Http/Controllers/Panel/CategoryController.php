<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('products')->get();

        return view('panel.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestValidated = $request->validate([
            'name'      => 'required|max:255|unique:categories,name',
        ]);

        Category::create($requestValidated);

        return redirect()->route('category.index')->with('success', 'category berhasil ditambahkan!');
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
        $category = Category::where('slug', $slug)->firstOrFail();

        return view('panel.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $requestValidated = $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($requestValidated);

        return redirect()->route('category.index')
            ->with('success', 'category berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $category->delete();

        return redirect()->back()->with('success', 'category berhasil dihapus!');
    }
}
