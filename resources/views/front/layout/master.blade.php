<!doctype html>
<html class="no-js" lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'ragaShop Pets')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        /* Masukkan CSS kustom (warna, navbar tipis, sticky footer, dll) di sini */
        :root {
            --primary-color: #ff3500;
        }

        body {
            font-family: "Poppins", sans-serif;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background: #fdfdfd;
        }

        .main-content {
            flex: 1;
        }

        .header-area .main-header-area {
            background: var(--primary-color) !important;
            padding: 8px 0 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .main-menu ul li a {
            color: #fff !important;
            padding: 15px 0 !important;
        }

        .header-btn {
            padding: 6px 16px !important;
            font-size: 13px !important;
            border-radius: 30px !important;
            font-weight: 600 !important;
        }

        .btn-login {
            background: transparent;
            border: 2px solid #fff;
            color: #fff !important;
        }

        .btn-login:hover {
            background: #fff;
            color: var(--primary-color) !important;
        }

        .btn-register {
            background: #fff;
            color: var(--primary-color) !important;
            border: 2px solid #fff;
        }

        @media (max-width: 768px) {
            .logo h2 {
                font-size: 20px !important;
            }

            .mobile_menu {
                display: block;
                margin-top: 10px;
            }

            .slicknav_menu {
                background: transparent;
                padding: 0;
                margin-top: -35px;
            }

            .slicknav_btn {
                background-color: transparent;
                border: 1px solid #fff;
            }

            .slicknav_nav {
                background: var(--primary-color);
            }

            .search_icon.d-flex {
                display: none !important;
            }
        }

        @yield('custom_css')
    </style>
</head>

<body>
    <header>
        <div class="header-area">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-6 col-md-3">
                            <div class="logo">
                                <a href="{{ route('front.home') }}" style="text-decoration:none;">
                                    <h2 class="text-white m-0" style="font-weight:800; font-size:24px;">ragaShop Pets.
                                    </h2>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-5 d-none d-lg-block">
                            <div class="main-menu">
                                <nav>
                                    <ul id="navigation">
                                        <li><a class="{{ request()->routeIs('front.home') ? 'active' : '' }}"
                                                href="{{ route('front.home') }}">Beranda</a></li>
                                        <li><a class="{{ request()->routeIs('front.products') ? 'active' : '' }}"
                                                href="{{ route('front.products') }}">Produk</a></li>
                                        <li><a class="{{ request()->routeIs('front.about') ? 'active' : '' }}"
                                                href="{{ route('front.about') }}">Tentang Kami</a></li>
                                        <li><a class="{{ request()->routeIs('front.contact') ? 'active' : '' }}"
                                                href="{{ route('front.contact') }}">Hubungi Kami</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-lg-4 d-none d-lg-block">
                            <div class="search_icon d-flex align-items-center justify-content-end">
                                <a href="{{ route('front.cart') }}"
                                    class="text-white mr-4 text-decoration-none cart-icon-link">
                                    <i class="ti-shopping-cart"></i> <span id="nav-cart-count" class="cart-count">(0)</span>
                                </a>
                                @guest
                                    <!-- Belum login -->
                                    <a href="{{ route('auth.login') }}"
                                        class="header-btn btn-login mr-2 text-decoration-none">Masuk</a>
                                    <a href="{{ route('auth.register') }}"
                                        class="header-btn btn-register text-decoration-none">Daftar</a>
                                @endguest

                                @auth
                                    <!-- Sudah login -->
                                    <a href="{{ route('front.profile.index') }}" class="text-white mr-2">{{ auth()->user()->name }}</a>

                                    <form action="{{ route('auth.logout') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="header-btn btn-login">Logout</button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                        <div class="col-6 col-md-9 d-lg-none">
                            <div class="mobile_menu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="main-content">
        @yield('content')
    </div>

    <footer class="footer bg-dark text-white pt-2 pb-2">
        <div class="container text-center">
            <p class="m-0 text-white-50" style="font-size: 13px;">Copyright &copy; {{ date('Y') }} ragaShop Pets.
            </p>
        </div>
    </footer>

    <script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/shop.js') }}"></script> @yield('custom_js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{!! session('success') !!}',
                showConfirmButton: true,
                confirmButtonColor: '#ff3500' // Sesuaikan dengan warna tema Anda
            });
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{!! session('error') !!}',
                confirmButtonColor: '#ff3500'
            });
        });
    </script>
    @endif

    <script>
        function updateCartBadge() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let totalItems = 0;
            cart.forEach(item => {
                let qty = parseInt(item.quantity);
                if (!isNaN(qty)) totalItems += qty;
            });

            let badgeElements = document.querySelectorAll('#cart-badge, .cart-count');
            badgeElements.forEach(el => {
                el.innerText = totalItems;
            });
        }

        function addToCart(id, name, price, quantity = 1) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            
            let parsedQty = parseInt(quantity);
            if (isNaN(parsedQty) || parsedQty <= 0) parsedQty = 1; 

            let parsedPrice = parseInt(price);
            if (isNaN(parsedPrice)) parsedPrice = 0;
            
            let existingItemIndex = cart.findIndex(item => item.id == id);
            
            if (existingItemIndex !== -1) {
                cart[existingItemIndex].quantity += parsedQty;
            } else {
                cart.push({ id: id, name: name, price: parsedPrice, quantity: parsedQty });
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartBadge();
            
            // 👇 PERUBAHAN DI SINI: Menggunakan SweetAlert2 Toast 👇
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: name + ' ditambahkan ke keranjang!',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
        }

        // Eksekusi fungsi saat halaman dimuat
        document.addEventListener("DOMContentLoaded", updateCartBadge);
    </script>

    @if(session('clear_cart'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            localStorage.removeItem('cart');
            if (typeof updateCartBadge === "function") {
                updateCartBadge();
            }
        });
    </script>
    @endif
</body>

</html>
