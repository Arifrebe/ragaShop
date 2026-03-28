@extends('panel.layout.master')

@section('title', 'Tambah kategori')

@section('content')
    <div class="card" style="max-width: 500px;">
        <div class="card-body">
            <form action="{{ route('category.store') }}" method="post">
                @csrf

                @include('panel.categories.form')

                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
@endsection
