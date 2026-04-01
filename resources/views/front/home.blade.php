@extends('front.layout.master')
@section('title', 'Beranda - ragaShop Pets')

@section('custom_css')
    <style>
        .product-item {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            transition: 0.3s;
            border: 1px solid #eee;
        }

        .product-item:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-3px);
        }

        .product-img-ratio {
            position: relative;
            width: 100%;
            padding-top: 100%;
            overflow: hidden;
            background: #f8f9fa;
        }

        .product-img-ratio img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-content {
            padding: 15px;
            text-align: center;
        }

        .product-title {
            font-size: 14px;
            font-weight: 600;
            color: #444;
            margin-bottom: 5px;
            height: 38px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .product-price {
            font-size: 17px;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 12px;
        }

        .btn-cart-small {
            padding: 5px 10px !important;
            font-size: 11px !important;
            background: var(--primary-color);
            color: #fff !important;
            border-radius: 4px;
            font-weight: 600;
            display: inline-block;
            transition: 0.3s;
            border: none;
            width: 100%;
            cursor: pointer;
        }

        .btn-cart-small:hover {
            background: #e63000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-decoration: none;
        }

        .feature-box {
            text-align: center;
            padding: 30px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .feature-icon {
            font-size: 40px;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .slider_area .single_slider {
                height: auto !important;
                padding: 100px 0 60px 0;
                background-position: center right !important;
            }

            .slider_text h3 {
                font-size: 32px !important;
                line-height: 1.2;
            }

            .section_title h3 {
                font-size: 24px !important;
            }

            .product-content {
                padding: 10px;
            }

            .product-title {
                font-size: 13px;
                height: 36px;
            }

            .product-price {
                font-size: 15px;
                margin-bottom: 8px;
            }

            .feature-box {
                padding: 20px;
                margin-bottom: 15px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="slider_area">
        <div class="single_slider slider_bg_1 d-flex align-items-center"
            style="background-image: url('{{ asset('assets/img/banner/banner.png') }}'); height: 80vh; background-size: cover;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-8">
                        <div class="slider_text">
                            <h3 class="text-white" style="font-size: 45px; font-weight: 700;">Nutrisi & Cinta<br> Untuk Anabul
                            </h3>
                            <p class="text-white mb-4 d-none d-md-block">Temukan berbagai pilihan makanan berkualitas tinggi
                                dan perlengkapan terlengkap untuk hewan peliharaan Anda hanya di ragaShop Pets.</p>
                            <a href="{{ route('front.products') }}" class="btn-register header-btn"
                                style="padding: 12px 30px !important; font-size: 15px !important;">Mulai Belanja</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dog_thumb d-none d-lg-block"><img src="{{ asset('assets/img/banner/dog.png') }}" alt="Dog">
            </div>
        </div>
    </div>

    <div class="features_area pt-5 pb-5 bg-light">
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12 mb-3">
                    <div class="feature-box">
                        <i class="ti-truck feature-icon"></i>
                        <h4 class="font-weight-bold" style="font-size: 18px;">Pengiriman Cepat</h4>
                        <p class="text-muted m-0" style="font-size: 14px;">Pesanan Anda dikemas dengan aman dan cepat.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12 mb-3">
                    <div class="feature-box">
                        <i class="ti-shield feature-icon"></i>
                        <h4 class="font-weight-bold" style="font-size: 18px;">100% Original</h4>
                        <p class="text-muted m-0" style="font-size: 14px;">Garansi produk asli dari brand resmi.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12 mb-3">
                    <div class="feature-box">
                        <i class="ti-headphone-alt feature-icon"></i>
                        <h4 class="font-weight-bold" style="font-size: 18px;">Layanan 24/7</h4>
                        <p class="text-muted m-0" style="font-size: 14px;">Tim support siap membantu Anda kapan saja.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product_list_area pt-5 pb-5">
        <div class="container pt-4 pb-4">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h3 class="font-weight-bold section_title">Produk Pilihan</h3>
                    <p class="text-muted">Favorit pelanggan kami minggu ini</p>
                </div>
            </div>
            <div class="row">
                @foreach ($selectedProducts as $product)
                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="product-item">

                            <div class="product-img-ratio">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            </div>

                            <div class="product-content">
                                <h5 class="product-title">{{ $product->name }}</h5>

                                <p class="product-price">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                                <button class="btn-cart-small"
                                    onclick="addToCart(
                            {{ $product->id }},
                            '{{ $product->name }}',
                            {{ $product->price }},
                            '{{ asset('storage/' . $product->image) }}',
                            this
                        )">
                                    + Keranjang
                                </button>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <a href="{{ route('front.products') }}" class="header-btn"
                        style="background: var(--primary-color); color: #fff; padding: 10px 25px !important; text-decoration:none;">Lihat
                        Semua Produk</a>
                </div>
            </div>
        </div>
    </div>
@endsection
