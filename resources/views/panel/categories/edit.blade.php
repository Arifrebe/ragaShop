@extends('panel.layout.master')

@section('title', 'Edit kategori')

@section('content')
    <div class="card" style="max-width: 500px;">
        <div class="card-body">
            <form action="{{ route('category.update', $category->slug) }}" method="post">
                @csrf
                @method('PUT')

                @include('panel.categories.form')

                <button type="submit" class="btn btn-primary">Ubah</button>
            </form>
        </div>
    </div>
@endsection
