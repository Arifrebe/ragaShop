@extends('auth.layout')

@section('content')
<h2>Register</h2>

<form action="{{ route('auth.register.store') }}" method="POST">
    @csrf

    <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}">
    @error('name')
        <div class="error">{{ $message }}</div>
    @enderror

    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
    @error('email')
        <div class="error">{{ $message }}</div>
    @enderror

    <input type="password" name="password" placeholder="Password">
    @error('password')
        <div class="error">{{ $message }}</div>
    @enderror

    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password">

    <input type="text" name="phone" placeholder="No HP" value="{{ old('phone') }}">
    @error('phone')
        <div class="error">{{ $message }}</div>
    @enderror

    <textarea name="address" placeholder="Alamat">{{ old('address') }}</textarea>
    @error('address')
        <div class="error">{{ $message }}</div>
    @enderror

    <button type="submit">Register</button>
</form>

<div class="link">
    Sudah punya akun? <a href="{{ route('auth.login') }}">Login</a>
</div>
@endsection