@extends('front.layout.master')
@section('title', 'Profil Pengguna - ragaShop')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h3 class="mb-4">Data Pribadi Pengguna</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('front.profile.update') }}" method="POST">
                        @csrf
                        @if(request()->query('checkout') == 'pending')
                            <input type="hidden" name="redirect_to_checkout" value="1">
                            <div class="alert alert-warning">
                                Anda harus melengkapi <b>Nomor HP</b> dan <b>Alamat Lengkap</b> terlebih dahulu sebelum melanjutkan checkout.
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                            <small class="text-muted">Email tidak dapat diubah.</small>
                        </div>
                        <div class="form-group mb-3">
                            <label>Nomor HP/WA <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 08123456789" required>
                        </div>
                        <div class="form-group mb-4">
                            <label>Alamat Lengkap Pengiriman <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control" rows="4" placeholder="Masukkan alamat lengkap rumah Anda" required>{{ old('address', $user->address) }}</textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">Simpan Data Pribadi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection