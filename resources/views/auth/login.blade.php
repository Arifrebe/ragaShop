@extends('auth.layout')

@section('content')
<h2>Login</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('auth.login.store') }}" method="POST">
    @csrf

    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
    @error('email')
        <div class="error">{{ $message }}</div>
    @enderror

    <input type="password" name="password" placeholder="Password">
    @error('password')
        <div class="error">{{ $message }}</div>
    @enderror

    <button type="submit">Login</button>
</form>

<div class="link">
    Belum punya akun? <a href="{{ route('auth.register') }}">Register</a>
</div>
@endsection