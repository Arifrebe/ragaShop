<!doctype html>
<html class="no-js" lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - ragaShop Pets</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        :root { --primary-color: #ff3500; }
        body { background: #f8f9fa; font-family: "Poppins", sans-serif; }
        .btn-primary-rs { background: var(--primary-color); color: #fff; border: none; padding: 10px; border-radius: 5px; font-weight: 600; width: 100%; transition: 0.3s; }
        .btn-primary-rs:hover { background: #e63000; box-shadow: 0 4px 8px rgba(0,0,0,0.1); cursor: pointer; }
        .auth-card { border-radius: 15px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; padding: 40px 0;">
        <div class="card auth-card" style="width: 100%; max-width: 450px;">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <a href="{{ url('/') }}" class="text-decoration-none">
                        <h2 style="font-weight: 800; color: var(--primary-color); font-size: 28px;">ragaShop Pets.</h2>
                    </a>
                    <h5 class="mt-3 text-dark font-weight-bold">Buat Akun Baru</h5>
                    <p class="text-muted">Daftar untuk mulai berbelanja</p>
                </div>
                <form action="{{ route('auth.register') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="text-dark font-weight-bold" style="font-size: 14px;">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Anda" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="text-dark font-weight-bold" style="font-size: 14px;">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@contoh.com" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label class="text-dark font-weight-bold" style="font-size: 14px;">Kata Sandi</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Buat sandi" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-dark font-weight-bold" style="font-size: 14px;">Konfirmasi Sandi</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi sandi" required>
                    </div>
                    <button type="submit" class="btn-primary-rs">Daftar Sekarang</button>
                </form>
                <div class="text-center mt-4">
                    <p class="text-muted m-0" style="font-size: 14px;">Sudah punya akun? <a href="{{ route('auth.login') }}" class="font-weight-bold" style="color: var(--primary-color);">Masuk</a></p>
                    <a href="{{ url('/') }}" class="text-muted d-block mt-3" style="font-size:14px;">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>