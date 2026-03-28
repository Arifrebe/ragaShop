@extends('panel.layout.master')

@section('title', 'Edit produk')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('product.update', $product->slug) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('panel.products.form')

                <button type="submit" class="btn btn-primary">Ubah</button>
            </form>
        </div>
    </div>
@endsection
