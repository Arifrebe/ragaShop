@extends('panel.layout.master')

@section('title', 'Edit promo')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('promo.update', $promo->code) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('panel.promos.form')

                <button type="submit" class="btn btn-primary">Ubah</button>
            </form>
        </div>
    </div>
@endsection
