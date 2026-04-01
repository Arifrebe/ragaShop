@extends('front.layout.master')
@section('title', 'Checkout - ragaShop Pets')

@section('custom_css')
<style>
    .checkout-box { background: #fff; border-radius: 10px; padding: 25px; border: 1px solid #eee; box-shadow: 0 5px 15px rgba(0,0,0,0.02); margin-bottom: 20px; }
    .form-control { border-radius: 5px; border: 1px solid #ddd; height: 45px; }
    .form-control:focus { border-color: var(--primary-color); box-shadow: none; }
    
    .checkout-item-list { border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 10px; font-size: 14px; }
    .payment-method { border: 1px solid #ddd; padding: 15px; border-radius: 8px; margin-bottom: 10px; cursor: pointer; transition: 0.2s; }
    .payment-method:hover { border-color: var(--primary-color); background: #fff8f6; }
    .payment-method input[type="radio"] { margin-right: 10px; cursor: pointer; accent-color: var(--primary-color); }
    
    .btn-checkout { background: var(--primary-color); color: #fff; border: none; width: 100%; padding: 14px; border-radius: 5px; font-weight: bold; font-size: 16px; transition: 0.3s; }
    .btn-checkout:hover { background: #e63000; box-shadow: 0 4px 8px rgba(0,0,0,0.1); cursor: pointer;}

    @media (max-width: 768px) {
        .checkout-box { padding: 15px; }
    }
</style>
@endsection

@section('content')
<div class="container pt-4 pt-md-5 pb-5 mt-2">
    <h3 class="font-weight-bold mb-4">Checkout</h3>
    
    <form id="checkout-form">
        <div class="row">
            <div class="col-lg-7 mb-4">
                <div class="checkout-box">
                    <h5 class="font-weight-bold mb-4 border-bottom pb-2">Informasi Pengiriman</h5>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="text-dark font-weight-bold" style="font-size: 14px;">Nama Depan</label>
                            <input type="text" id="first_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="text-dark font-weight-bold" style="font-size: 14px;">Nama Belakang</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="text-dark font-weight-bold" style="font-size: 14px;">Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="text-dark font-weight-bold" style="font-size: 14px;">No. HP / WhatsApp</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-12 form-group mb-3">
                            <label class="text-dark font-weight-bold" style="font-size: 14px;">Alamat Lengkap</label>
                            <textarea class="form-control" rows="3" style="height: auto;" placeholder="Nama jalan, gedung, no. rumah" required></textarea>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="text-dark font-weight-bold" style="font-size: 14px;">Kota / Kabupaten</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="text-dark font-weight-bold" style="font-size: 14px;">Kode Pos</label>
                            <input type="text" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="checkout-box mb-4">
                    <h5 class="font-weight-bold mb-3 border-bottom pb-2">Pesanan Anda</h5>
                    
                    <div id="checkout-items-container"></div>
                    
                    <div class="d-flex justify-content-between mt-3 text-muted">
                        <span>Subtotal</span>
                        <span id="checkout-subtotal">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between text-muted border-bottom pb-3 mb-3 mt-2">
                        <span>Ongkos Kirim</span>
                        <span id="checkout-ongkir">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="font-weight-bold" style="font-size: 18px;">Total Tagihan</span>
                        <span class="font-weight-bold" style="color: var(--primary-color); font-size: 20px;" id="checkout-total">Rp 0</span>
                    </div>
                </div>

                <div class="checkout-box">
                    <h5 class="font-weight-bold mb-3 border-bottom pb-2">Metode Pembayaran</h5>
                    
                    <label class="payment-method d-block w-100">
                        <input type="radio" name="payment" value="transfer" required checked>
                        <span class="font-weight-bold text-dark">Transfer Bank</span>
                    </label>
                    <label class="payment-method d-block w-100">
                        <input type="radio" name="payment" value="ewallet" required>
                        <span class="font-weight-bold text-dark">E-Wallet (OVO/GoPay/Dana)</span>
                    </label>
                    <label class="payment-method d-block w-100 mb-4">
                        <input type="radio" name="payment" value="cod" required>
                        <span class="font-weight-bold text-dark">Bayar di Tempat (COD)</span>
                    </label>
                    
                    <button type="submit" class="btn-checkout text-center">Buat Pesanan Sekarang</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection