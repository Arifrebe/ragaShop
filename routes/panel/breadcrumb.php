<?php

use Diglactic\Breadcrumbs\Generator;
use App\Models\Product;
use App\Models\Category;
use App\Models\Promo;

// Dashboard
Breadcrumbs::for('dashboard', function (Generator  $trail) {
    $trail->push('Dashboard', route('dashboard'));
});

// Product
Breadcrumbs::for('product.index', function (Generator  $trail) {
    $trail->push('Produk', route('product.index'));
});

Breadcrumbs::for('product.create', function (Generator  $trail) {
    $trail->parent('product.index');
    $trail->push('Tambah produk', route('product.create'));
});

Breadcrumbs::for('product.edit', function (Generator $trail) {
    $slug = request()->route('product');
    $product = Product::where('slug', $slug)->first();
    $trail->parent('product.index');

    if ($product) {
        $trail->push(ucfirst($product->name), route('product.edit', $product->slug));
    }
});

// Category
Breadcrumbs::for('category.index', function (Generator  $trail) {
    $trail->push('Kategori', route('category.index'));
});

Breadcrumbs::for('category.create', function (Generator  $trail) {
    $trail->parent('category.index');
    $trail->push('Tambah kategori', route('category.create'));
});

Breadcrumbs::for('category.edit', function (Generator $trail) {
    $slug = request()->route('category');
    $category = Category::where('slug', $slug)->first();
    $trail->parent('category.index');

    if ($category) {
        $trail->push(ucfirst($category->name), route('category.edit', $category->slug));
    }
});

Breadcrumbs::for('category.show', function (Generator $trail) {
    $slug = request()->route('category');
    $category = Category::where('slug', $slug)->first();
    $trail->parent('category.index');

    if ($category) {
        $trail->push(ucfirst($category->name), route('category.show', $category->slug));
    }
});

// Promo
Breadcrumbs::for('promo.index', function (Generator  $trail) {
    $trail->push('Promo', route('promo.index'));
});

Breadcrumbs::for('promo.create', function (Generator  $trail) {
    $trail->parent('promo.index');
    $trail->push('Tambah promo', route('promo.create'));
});

Breadcrumbs::for('promo.edit', function (Generator $trail) {
    $code = request()->route('promo');
    $promo = Promo::where('code', $code)->first();
    $trail->parent('promo.index');

    if ($promo) {
        $trail->push($promo->code, route('promo.edit', $promo->code));
    }
});