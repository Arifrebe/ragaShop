@extends('panel.layout.master')

@section('title', 'Produk')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Harga</td>
                        <td>Jumlah</td>
                        <td>Kategori</td>
                        <td>Opsi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->name }}</td>
                            <td>Rp.{{ number_format($product->price, 2, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td class="d-flex">
                                <a href="{{ route('product.show', $product->slug) }}" class="btn btn-sm btn-primary">
                                    <i class="fa-regular fa-eye"></i>
                                </a>

                                <form action="{{ route('product.destroy', $product->slug) }}" method="POST"
                                    class="mx-1" onsubmit="confirmation(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                                <a href="{{ route('product.edit', $product->slug) }}" class="btn btn-sm btn-warning"
                                    title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
