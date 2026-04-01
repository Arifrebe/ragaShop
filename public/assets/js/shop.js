// js/shop.js

// Format angka ke Rupiah
const formatRupiah = (angka) => {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
};

// Ambil data keranjang dari localStorage (atau gunakan data default jika kosong)
const getCart = () => {
    let cart = localStorage.getItem('ragashop_cart');
    if (!cart) {
        // Data dummy awal agar keranjang tidak kosong saat dites
        cart = [
            { id: 1, name: "Whiskas Tuna Adult 1.2kg", price: 65000, qty: 1, img: "img/elements/g1.jpg" },
            { id: 2, name: "Pedigree Beef 1.5kg", price: 82000, qty: 2, img: "img/elements/g2.jpg" }
        ];
        saveCart(cart);
    } else {
        cart = JSON.parse(cart);
    }
    return cart;
};

// Simpan data ke localStorage
const saveCart = (cart) => {
    localStorage.setItem('ragashop_cart', JSON.stringify(cart));
    updateCartIcon(cart);
};

// Update angka di ikon keranjang navbar
const updateCartIcon = (cart) => {
    const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
    const cartIcons = document.querySelectorAll('.ti-shopping-cart');
    cartIcons.forEach(icon => {
        icon.parentElement.innerHTML = `<i class="ti-shopping-cart"></i> (${totalItems})`;
    });
};

// --- FUNGSI UNTUK HALAMAN CART ---
const renderCartPage = () => {
    const container = document.getElementById('cart-items-container');
    if (!container) return; // Berhenti jika bukan di halaman cart

    const cart = getCart();
    container.innerHTML = '';
    let subtotal = 0;

    if (cart.length === 0) {
        container.innerHTML = '<p class="text-center text-muted p-4">Keranjang Anda kosong.</p>';
    } else {
        cart.forEach((item, index) => {
            const itemTotal = item.price * item.qty;
            subtotal += itemTotal;

            container.innerHTML += `
                <div class="cart-item">
                    <img src="${item.img}" alt="${item.name}" class="cart-img">
                    <div class="cart-details flex-grow-1">
                        <h4 class="cart-title">${item.name}</h4>
                        <p class="cart-price mt-1">${formatRupiah(item.price)}</p>
                    </div>
                    <div class="cart-controls">
                        <div class="d-flex align-items-center">
                            <label class="m-0 mr-2 text-muted" style="font-size: 14px;">Qty:</label>
                            <button class="btn btn-sm btn-light border" onclick="changeQty(${index}, -1)">-</button>
                            <input type="text" class="qty-input mx-1" value="${item.qty}" readonly style="width: 40px; background:#fff;">
                            <button class="btn btn-sm btn-light border" onclick="changeQty(${index}, 1)">+</button>
                        </div>
                        <button class="btn-remove ml-3 ml-md-4" onclick="removeItem(${index})" title="Hapus"><i class="ti-trash"></i></button>
                    </div>
                </div>
            `;
        });
    }

    document.getElementById('cart-subtotal').innerText = formatRupiah(subtotal);
    document.getElementById('cart-total').innerText = formatRupiah(subtotal);
    document.getElementById('cart-count').innerText = `${cart.length} Barang`;
};

// Ubah Kuantitas
window.changeQty = (index, amount) => {
    const cart = getCart();
    if (cart[index].qty + amount > 0) {
        cart[index].qty += amount;
        saveCart(cart);
        renderCartPage();
    }
};

// Hapus Item
window.removeItem = (index) => {
    const cart = getCart();
    cart.splice(index, 1);
    saveCart(cart);
    renderCartPage();
};


// --- FUNGSI UNTUK HALAMAN CHECKOUT ---
const renderCheckoutPage = () => {
    const container = document.getElementById('checkout-items-container');
    if (!container) return; // Berhenti jika bukan di halaman checkout

    const cart = getCart();
    container.innerHTML = '';
    let subtotal = 0;
    const ongkir = 20000; // Contoh ongkir tetap

    cart.forEach(item => {
        const itemTotal = item.price * item.qty;
        subtotal += itemTotal;
        container.innerHTML += `
            <div class="d-flex justify-content-between checkout-item-list">
                <span>${item.name} <strong>(x${item.qty})</strong></span>
                <span>${formatRupiah(itemTotal)}</span>
            </div>
        `;
    });

    const totalTagihan = subtotal + ongkir;

    document.getElementById('checkout-subtotal').innerText = formatRupiah(subtotal);
    document.getElementById('checkout-ongkir').innerText = formatRupiah(ongkir);
    document.getElementById('checkout-total').innerText = formatRupiah(totalTagihan);

    // Tangani saat form disubmit
    const form = document.getElementById('checkout-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Cegah halaman reload
        
        // Ambil metode pembayaran yang dipilih
        const paymentMethod = document.querySelector('input[name="payment"]:checked').nextElementSibling.innerText;
        
        // Ambil nama dari form
        const nama = document.getElementById('first_name').value;

        // Buat daftar barang untuk alert
        const daftarBarang = cart.map(item => `- ${item.name} (x${item.qty})`).join('\n');

        // Munculkan notifikasi sukses
        alert(`Terima Kasih, ${nama}!\n\nPesanan Anda berhasil dibuat.\n\nDetail Pesanan:\n${daftarBarang}\n\nTotal Tagihan: ${formatRupiah(totalTagihan)}\nMetode Pembayaran: ${paymentMethod}`);
        
        // Kosongkan keranjang setelah sukses
        localStorage.removeItem('ragashop_cart');
        window.location.href = '/'; // Kembali ke beranda
    });
};

// Jalankan fungsi saat halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    getCart(); // Inisialisasi cart icon
    renderCartPage();
    renderCheckoutPage();
});

// --- FUNGSI UNTUK MENAMBAH KE KERANJANG ---
window.addToCart = (id, name, price, img, buttonElement) => {
    const cart = getCart();
    
    // Cek apakah item sudah ada di keranjang
    const existingItemIndex = cart.findIndex(item => item.id === id);
    
    if (existingItemIndex !== -1) {
        // Jika ada, tambah quantity-nya
        cart[existingItemIndex].qty += 1;
    } else {
        // Jika belum ada, masukkan sebagai item baru
        cart.push({
            id: id,
            name: name,
            price: price,
            qty: 1,
            img: img
        });
    }
    
    saveCart(cart); // Simpan ke localStorage dan update ikon navbar
    
    // Efek visual pada tombol agar user tahu berhasil ditambahkan
    if (buttonElement) {
        const originalText = buttonElement.innerText;
        buttonElement.innerText = "✓ Ditambahkan";
        buttonElement.style.backgroundColor = "#28a745"; // Warna hijau sukses
        
        setTimeout(() => {
            buttonElement.innerText = originalText;
            buttonElement.style.backgroundColor = ""; // Kembalikan ke warna asli (CSS)
        }, 1500); // Kembali setelah 1.5 detik
    }
};