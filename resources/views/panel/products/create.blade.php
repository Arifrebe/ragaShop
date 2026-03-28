@extends('panel.layout.master')

@section('title', 'Tambah produk')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @include('panel.products.form')

                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
@endsection
