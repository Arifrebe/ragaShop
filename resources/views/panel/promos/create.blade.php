@extends('panel.layout.master')

@section('title', 'Tambah produk')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('promo.store') }}" method="post">
                @csrf

                @include('panel.promos.form')

                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
@endsection
