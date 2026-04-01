@extends('front.layout.master')
@section('title', 'Tentang Kami - ragaShop Pets')

@section('custom_css')
<style>
    @media (max-width: 768px) {
        .about-image { margin-bottom: 20px; }
        h2 { font-size: 24px !important; }
        p { font-size: 14px !important; }
    }
</style>
@endsection

@section('content')
<div class="container pt-5 pb-5 mt-md-5 mb-5">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0 text-center text-md-left about-image">
            <img src="{{ asset('assets/img/about/about_lft.png') }}" class="img-fluid rounded shadow-sm" alt="Tentang Kami">
        </div>
        <div class="col-md-6 pl-md-5 text-center text-md-left">
            <h2 class="font-weight-bold" style="color: var(--primary-color);">Tentang ragaShop Pets</h2>
            <p class="mt-3 text-muted" style="line-height: 1.8;">
                ragaShop Pets adalah toko perlengkapan dan makanan hewan peliharaan online terpercaya di Indonesia. Berawal dari kepedulian kami terhadap kesehatan dan kesejahteraan hewan, kami berkomitmen untuk menyediakan produk-produk berkualitas tinggi.
            </p>
            <p class="text-muted" style="line-height: 1.8;">
                Kami percaya bahwa setiap anjing, kucing, dan hewan peliharaan lainnya berhak mendapatkan nutrisi terbaik dan perlengkapan yang aman. Dengan layanan pengiriman cepat dan customer service yang ramah, kami hadir untuk mempermudah Anda memanjakan anabul kesayangan dari rumah.
            </p>
            <a href="{{ route('front.products') }}" class="header-btn mt-3 d-inline-block text-white" style="background: var(--primary-color); padding: 12px 25px !important; text-decoration: none;">Lihat Katalog Kami</a>
        </div>
    </div>
</div>
@endsection