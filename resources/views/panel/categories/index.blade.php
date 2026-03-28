@extends('panel.layout.master')

@section('title', 'Kategori')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Jumlah produk</td>
                        <td style="width: 20%">Opsi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td> {{ $category->products_count }}</td>
                        <td class="d-flex">
                            <a href="{{ route('category.show', $category->slug) }}" class="btn btn-sm btn-primary">
                                <i class="fa-regular fa-eye"></i>
                            </a>

                            <form action="{{ route('category.destroy', $category->slug) }}" method="POST" class="mx-1"
                                onsubmit="confirmation(event)">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                            <a href="{{ route('category.edit', $category->slug) }}" class="btn btn-sm btn-warning" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
