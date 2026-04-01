@extends('front.layout.master')
@section('title', 'Katalog Produk - ragaShop Pets')

@section('custom_css')
<style>
    .product-item { background: #fff; border-radius: 10px; overflow: hidden; transition: 0.3s; border: 1px solid #eee; }
    .product-item:hover { box-shadow: 0 10px 20px rgba(0,0,0,0.1); transform: translateY(-3px); }
    .product-img-ratio { position: relative; width: 100%; padding-top: 100%; overflow: hidden; background: #f8f9fa; }
    .product-img-ratio img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; }
    .product-content { padding: 15px; text-align: center; }
    .product-title { font-size: 14px; font-weight: 600; color: #444; margin-bottom: 5px; height: 38px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
    .product-price { font-size: 17px; font-weight: 700; color: var(--primary-color); margin-bottom: 12px; }
    .btn-cart-small { padding: 5px 10px !important; font-size: 11px !important; background: var(--primary-color); color: #fff !important; border-radius: 4px; font-weight: 600; display: inline-block; transition: 0.3s; border:none; width: 100%; cursor: pointer;}
    .btn-cart-small:hover { background: #e63000; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-decoration: none;}
</style>
@endsection

@section('content')
<div class="product_list_area pt-4 pb-5">
    <div class="container">

        <!-- HEADER -->
        <div class="row align-items-center mb-4 pb-3 filter-row" style="border-bottom: 1px solid #eee;">
            <div class="col-12 col-md-6 mb-2 mb-md-0">
                <h4 class="m-0 font-weight-bold text-dark">Katalog Produk</h4>
            </div>
        </div>

        <!-- PRODUK -->
        <div class="row">
            @forelse($products as $product)
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="product-item">

                        <div class="product-img-ratio">
                            <img src="{{ $product->image 
                                ? asset('storage/' . $product->image) 
                                : asset('assets/img/default.png') }}" 
                                alt="{{ $product->name }}">
                        </div>

                        <div class="product-content">
                            <h5 class="product-title">{{ $product->name }}</h5>

                            <p class="product-price">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>

                            @if($product->stock > 0)
                                <button class="btn-cart-small"
                                    onclick="addToCart(
                                        {{ $product->id }},
                                        '{{ $product->name }}',
                                        {{ $product->price }},
                                        '{{ $product->image ? asset('storage/' . $product->image) : asset('assets/img/default.png') }}',
                                        this
                                    )">
                                    + Keranjang
                                </button>
                            @else
                                <button class="btn-cart-small" disabled>
                                    Stok Habis
                                </button>
                            @endif
                        </div>

                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada produk</p>
                </div>
            @endforelse
        </div>

        <!-- PAGINATION -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $products->links() }}
        </div>

    </div>
</div>
@endsection