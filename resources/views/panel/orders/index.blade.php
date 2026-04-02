@extends('panel.layout.master')

@section('title', 'Order')

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Pembeli</th>
                        <th>Invoice</th>
                        <th>Harga total</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->invoice }}</td>
                            <td>Rp.{{ number_format($order->grand_total, 2, ',', '.') }}</td>
                            <td>{{ $order->status }}</td>
                            <td class="d-flex">
                                @if ($order->status == 'pending')
                                    <!-- Tombol Bayar -->
                                    <form action="{{ route('order.orders.updateStatus', $order->id) }}" method="POST"
                                        class="mx-1">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="paid">
                                        <button class="btn btn-sm btn-success" title="Bayar">
                                            Dibayar
                                        </button>
                                    </form>

                                    <!-- Tombol Gagal / Batal -->
                                    <form action="{{ route('order.orders.updateStatus', $order->id) }}" method="POST"
                                        class="mx-1">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="fail">
                                        <button class="btn btn-sm btn-danger" title="Gagal">
                                            Gagal
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
