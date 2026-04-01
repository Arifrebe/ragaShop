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

    @media (max-width: 768px) {
        .product-content { padding: 10px; }
        .product-title { font-size: 12px; height: 34px; }
        .product-price { font-size: 14px; margin-bottom: 8px; }
        .filter-control { font-size: 12px; }
        .filter-row { flex-direction: column; align-items: flex-start !important; }
        .filter-dropdown { width: 100% !important; margin-top: 10px; justify-content: space-between;}
    }
</style>
@endsection

@section('content')
<div class="product_list_area pt-4 pb-5">
    <div class="container">
        <div class="row align-items-center mb-4 pb-3 filter-row" style="border-bottom: 1px solid #eee;">
            <div class="col-12 col-md-6 mb-2 mb-md-0">
                <h4 class="m-0 font-weight-bold text-dark" style="font-size: 20px;">Katalog Produk</h4>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-md-end filter-dropdown">
                <div class="d-flex align-items-center w-100 justify-content-between justify-content-md-end">
                    <label class="mr-2 mb-0 text-muted filter-control" style="white-space: nowrap;">Urutkan:</label>
                    <select class="form-control form-control-sm filter-control" style="width: auto; border-radius: 5px; cursor: pointer; max-width: 150px;">
                        <option>Terbaru</option>
                        <option>Harga: Rendah</option>
                        <option>Harga: Tinggi</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="product-item">
                    <div class="product-img-ratio"><img src="{{ asset('assets/img/elements/g1.jpg') }}" alt="Produk"></div>
                    <div class="product-content">
                        <h5 class="product-title">Whiskas Tuna Adult 1.2kg</h5>
                        <p class="product-price">Rp 65.000</p>
                        <button class="btn-cart-small" onclick="addToCart(1, 'Whiskas Tuna Adult 1.2kg', 65000, '{{ asset('assets/img/elements/g1.jpg') }}', this)">+ Keranjang</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="product-item">
                    <div class="product-img-ratio"><img src="{{ asset('assets/img/elements/g2.jpg') }}" alt="Produk"></div>
                    <div class="product-content">
                        <h5 class="product-title">Pedigree Beef 1.5kg</h5>
                        <p class="product-price">Rp 82.000</p>
                        <button class="btn-cart-small" onclick="addToCart(2, 'Pedigree Beef 1.5kg', 82000, '{{ asset('assets/img/elements/g2.jpg') }}', this)">+ Keranjang</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="product-item">
                    <div class="product-img-ratio"><img src="{{ asset('assets/img/about/pet_care.png') }}" alt="Produk"></div>
                    <div class="product-content">
                        <h5 class="product-title">Sisir Bulu Hewan Otomatis</h5>
                        <p class="product-price">Rp 45.000</p>
                        <button class="btn-cart-small" onclick="addToCart(3, 'Sisir Bulu Hewan Otomatis', 45000, '{{ asset('assets/img/about/pet_care.png') }}', this)">+ Keranjang</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="product-item">
                    <div class="product-img-ratio"><img src="{{ asset('assets/img/elements/g4.jpg') }}" alt="Produk"></div>
                    <div class="product-content">
                        <h5 class="product-title">Pasir Kucing Gumpal Wangi 10L</h5>
                        <p class="product-price">Rp 55.000</p>
                        <button class="btn-cart-small" onclick="addToCart(4, 'Pasir Kucing Gumpal Wangi 10L', 55000, '{{ asset('assets/img/elements/g4.jpg') }}', this)">+ Keranjang</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="product-item">
                    <div class="product-img-ratio"><img src="{{ asset('assets/img/elements/g5.jpg') }}" alt="Produk"></div>
                    <div class="product-content">
                        <h5 class="product-title">Kalung Kucing Lonceng</h5>
                        <p class="product-price">Rp 15.000</p>
                        <button class="btn-cart-small" onclick="addToCart(5, 'Kalung Kucing Lonceng', 15000, '{{ asset('assets/img/elements/g5.jpg') }}', this)">+ Keranjang</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="product-item">
                    <div class="product-img-ratio"><img src="{{ asset('assets/img/elements/g6.jpg') }}" alt="Produk"></div>
                    <div class="product-content">
                        <h5 class="product-title">Mainan Tikus Interaktif</h5>
                        <p class="product-price">Rp 25.000</p>
                        <button class="btn-cart-small" onclick="addToCart(6, 'Mainan Tikus Interaktif', 25000, '{{ asset('assets/img/elements/g6.jpg') }}', this)">+ Keranjang</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="product-item">
                    <div class="product-img-ratio"><img src="{{ asset('assets/img/elements/g7.jpg') }}" alt="Produk"></div>
                    <div class="product-content">
                        <h5 class="product-title">Kandang Hewan Portable</h5>
                        <p class="product-price">Rp 150.000</p>
                        <button class="btn-cart-small" onclick="addToCart(7, 'Kandang Hewan Portable', 150000, '{{ asset('assets/img/elements/g7.jpg') }}', this)">+ Keranjang</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-6 mb-4">
                <div class="product-item">
                    <div class="product-img-ratio"><img src="{{ asset('assets/img/elements/g8.jpg') }}" alt="Produk"></div>
                    <div class="product-content">
                        <h5 class="product-title">Tali Tuntun Anjing (Leash)</h5>
                        <p class="product-price">Rp 40.000</p>
                        <button class="btn-cart-small" onclick="addToCart(8, 'Tali Tuntun Anjing (Leash)', 40000, '{{ asset('assets/img/elements/g8.jpg') }}', this)">+ Keranjang</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection