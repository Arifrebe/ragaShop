@extends('front.layout.master')
@section('title', 'Hubungi Kami - ragaShop Pets')

@section('custom_css')
<style>
    .contact-info-box i { font-size: 30px; color: var(--primary-color); margin-bottom: 15px; display: block; }
    @media (max-width: 768px) {
        h2 { font-size: 24px !important; }
        .contact-info-box { padding: 10px; }
        .contact-info-box h5 { font-size: 16px; }
        .contact-info-box p { font-size: 13px; }
    }
</style>
@endsection

@section('content')
<div class="container pt-4 pt-md-5 pb-5 mt-md-5">
    <div class="row text-center mb-4 mb-md-5 mt-4">
        <div class="col-12">
            <h2 class="font-weight-bold">Hubungi Tim Kami</h2>
            <p class="text-muted" style="font-size: 14px;">Ada pertanyaan tentang produk, pesanan, atau kolaborasi?<br class="d-none d-md-block"> Jangan ragu hubungi kami!</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3 text-center contact-info-box">
            <div class="p-4 bg-white shadow-sm rounded border h-100">
                <i class="ti-location-pin"></i>
                <h5 class="font-weight-bold">Alamat</h5>
                <p class="text-muted m-0">Jl. Raga Utama No. 42,<br>Jakarta Pusat, Indonesia</p>
            </div>
        </div>
        <div class="col-md-4 mb-3 text-center contact-info-box">
            <div class="p-4 bg-white shadow-sm rounded border h-100">
                <i class="ti-mobile"></i>
                <h5 class="font-weight-bold">Telepon / WhatsApp</h5>
                <p class="text-muted m-0">+62 811-2345-6789<br>Senin - Minggu (08:00 - 20:00)</p>
            </div>
        </div>
        <div class="col-md-4 mb-3 text-center contact-info-box">
            <div class="p-4 bg-white shadow-sm rounded border h-100">
                <i class="ti-email"></i>
                <h5 class="font-weight-bold">Email</h5>
                <p class="text-muted m-0">support@ragashop.id<br>info@ragashop.id</p>
            </div>
        </div>
    </div>
</div>
@endsection