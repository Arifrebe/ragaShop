@extends('front.layout.master')
@section('title', 'Keranjang Belanja - ragaShop Pets')

@section('custom_css')
<style>
    .cart-item { background: #fff; border-radius: 10px; padding: 15px; margin-bottom: 15px; border: 1px solid #eee; display: flex; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
    .cart-img { width: 80px; height: 80px; object-fit: cover; border-radius: 8px; margin-right: 15px; background: #fdfdfd; border: 1px solid #f0f0f0; }
    .cart-title { font-weight: 600; font-size: 15px; margin: 0 0 5px 0; color: #333; }
    .cart-price { color: var(--primary-color); font-weight: 700; font-size: 16px; margin: 0; }
    .qty-input { width: 60px; text-align: center; border: 1px solid #ddd; border-radius: 5px; padding: 5px; }
    .btn-remove { color: #dc3545; background: none; border: none; font-size: 18px; cursor: pointer; transition: 0.2s; }
    .btn-remove:hover { color: #a71d2a; transform: scale(1.1); }
    
    .summary-card { background: #fff; border-radius: 10px; padding: 25px; border: 1px solid #eee; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
    .btn-checkout { background: var(--primary-color); color: #fff; border: none; width: 100%; padding: 12px; border-radius: 5px; font-weight: 600; transition: 0.3s; display:block;}
    .btn-checkout:hover { background: #e63000; box-shadow: 0 4px 8px rgba(0,0,0,0.1); cursor: pointer; color:#fff; text-decoration:none;}

    @media (max-width: 768px) {
        .cart-item { flex-direction: column; align-items: flex-start; position: relative; }
        .cart-img { margin-bottom: 10px; }
        .cart-details { width: 100%; }
        .cart-controls { width: 100%; display: flex; justify-content: space-between; align-items: center; margin-top: 15px; }
        .btn-remove { position: absolute; top: 15px; right: 15px; }
    }
</style>
@endsection

@section('content')
<div class="container pt-4 pt-md-5 pb-5 mt-2">
    <h3 class="font-weight-bold mb-4">Keranjang Belanja</h3>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div id="cart-items-container"></div>
            
            <div class="mt-3">
                <a href="{{ route('front.products') }}" class="text-muted" style="font-size: 14px;"><i class="ti-arrow-left"></i> Lanjut Belanja</a>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="summary-card">
                <h4 class="font-weight-bold mb-4 border-bottom pb-3">Ringkasan</h4>
                <div class="d-flex justify-content-between mb-3 text-muted">
                    <span id="cart-count">Subtotal (0 Barang)</span>
                    <span id="cart-subtotal">Rp 0</span>
                </div>
                <div class="d-flex justify-content-between mb-3 text-muted border-bottom pb-3">
                    <span>Estimasi Ongkir</span>
                    <span>Dihitung di Checkout</span>
                </div>
                <div class="d-flex justify-content-between mb-4">
                    <span class="font-weight-bold" style="font-size: 18px;">Total</span>
                    <span class="font-weight-bold" style="color: var(--primary-color); font-size: 18px;" id="cart-total">Rp 0</span>
                </div>
                <a href="{{ route('front.checkout') }}" class="btn-checkout text-center text-white">Lanjut ke Checkout</a>
            </div>
        </div>
    </div>
</div>
@endsection