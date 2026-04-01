@extends('front.layout.master')
@section('title', 'Checkout - ragaShop')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-7">
            <h3 class="mb-4">Detail Pengiriman</h3>

            @if(session('error'))
                <div class="alert alert-danger font-weight-bold">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ url('/checkout/process') }}" method="POST" id="checkout-form">
                @csrf
                <input type="hidden" name="cart_data" id="cart_data">
                
                <div class="form-group mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->email }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label>Nomor HP/WA</label>
                    <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}" readonly>
                </div>
                <div class="form-group mb-4">
                    <label>Alamat Lengkap</label>
                    <textarea name="address" class="form-control" rows="4" readonly>{{ auth()->user()->address }}</textarea>
                </div>
                <button type="submit" class="btn btn-success btn-lg w-100">Buat Pesanan Sekarang</button>
            </form>
        </div>
        
        <div class="col-lg-5">
            <div class="card shadow-sm mt-4 mt-lg-0">
                <div class="card-body">
                    <h4 class="card-title mb-4">Ringkasan Pesanan</h4>
                    <ul id="checkout-summary" class="list-group list-group-flush mb-3">
                        </ul>
                    <div class="d-flex justify-content-between mt-3 px-3">
                        <h5 class="mb-0">Total Tagihan</h5>
                        <h5 class="mb-0 text-success" id="checkout-total">Rp 0</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        
        // Jika keranjang kosong, kembalikan ke halaman keranjang
        if (cart.length === 0) {
            // Sembunyikan form agar tidak bisa diklik saat alert muncul
            document.getElementById('checkout-form').style.display = 'none'; 
            
            Swal.fire({
                icon: 'warning',
                title: 'Keranjang Kosong',
                text: 'Silakan pilih produk terlebih dahulu sebelum melakukan checkout.',
                confirmButtonText: 'Mulai Belanja',
                confirmButtonColor: '#ff3500',
                allowOutsideClick: false, // Tidak bisa ditutup dengan klik luar
                allowEscapeKey: false // Tidak bisa ditutup dengan ESC
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('/') }}"; // Arahkan ke beranda/produk
                }
            });
            return; // Hentikan eksekusi JS selanjutnya
        }

        // Set data keranjang ke dalam hidden input form
        document.getElementById('cart_data').value = JSON.stringify(cart);

        let summary = document.getElementById('checkout-summary');
        let totalEl = document.getElementById('checkout-total');
        let total = 0;

        // Render ringkasan produk
        cart.forEach(item => {
            let subtotal = item.price * item.quantity;
            total += subtotal;
            summary.innerHTML += `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="my-0">${item.name}</h6>
                        <small class="text-muted">x${item.quantity}</small>
                    </div>
                    <span>Rp ${subtotal.toLocaleString('id-ID')}</span>
                </li>
            `;
        });

        totalEl.innerHTML = `Rp ${total.toLocaleString('id-ID')}`;
    });
</script>
@endsection