@extends('front.layout.master')
@section('title', 'Keranjang Belanja - ragaShop')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Keranjang Belanja</h2>
        </div>
        <div class="col-lg-8">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="bg-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th width="150px">Kuantitas</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="cart-container">
                        </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">Ringkasan Belanja</h4>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Total:</span>
                        <strong id="cart-total" style="color: #ff3500">Rp 0</strong>
                    </div>
                    <a href="{{ url('/checkout') }}" class="btn w-100" style="background-color: #ff3500; color: #fff">Lanjut ke Checkout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script>
    // Load keranjang dari localStorage
    function loadCart() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        let container = document.getElementById('cart-container');
        let totalEl = document.getElementById('cart-total');
        
        container.innerHTML = '';
        let total = 0;

        if (cart.length === 0) {
            container.innerHTML = '<tr><td colspan="5" class="text-center py-4">Keranjang Anda masih kosong.</td></tr>';
        } else {
            cart.forEach((item, index) => {
                let subtotal = item.price * item.quantity;
                total += subtotal;
                
                // Menyesuaikan .cart-item dengan class tambahan agar tabel rapi
                container.innerHTML += `
                    <tr class="cart-item align-middle">
                        <td class="text-left">${item.name}</td>
                        <td>Rp ${parseInt(item.price).toLocaleString('id-ID')}</td>
                        <td>
                            <input type="number" class="form-control text-center" value="${item.quantity}" min="1" onchange="updateQty(${index}, this.value)">
                        </td>
                        <td class="font-weight-bold">Rp ${subtotal.toLocaleString('id-ID')}</td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="removeItem(${index})">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                `;
            });
        }
        totalEl.innerHTML = `Rp ${total.toLocaleString('id-ID')}`;
    }

    // Update jumlah item
    function updateQty(index, qty) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        if (qty > 0) {
            cart[index].quantity = parseInt(qty);
            localStorage.setItem('cart', JSON.stringify(cart));
            loadCart(); // Render ulang
        }
    }

    // Hapus item dari keranjang
    function removeItem(index) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        loadCart(); // Render ulang
    }

    // Eksekusi loadCart saat halaman dimuat
    document.addEventListener("DOMContentLoaded", loadCart);
</script>
@endsection