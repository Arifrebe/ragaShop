@extends('panel.layout.master')

@section('title', 'Promo')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('promo.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus"></i>
            </a>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Mulai</th>
                        <th>Akhir</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promos as $promo)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $promo->code }}</td>
                            <td>{{ $promo->start_date ? $promo->start_date->format('d M Y') : '-' }}</td>
                            <td>{{ $promo->end_date ? $promo->end_date->format('d M Y') : '-' }}</td>
                            <td>
                                @if ($promo->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="d-flex">
                                 <form action="{{ route('promo.destroy', $promo->code) }}" method="POST"
                                    class="mx-1" onsubmit="confirmation(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                                <a href="{{ route('promo.edit', $promo->code) }}" class="btn btn-sm btn-warning"
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
