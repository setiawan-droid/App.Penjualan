@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Detail Transaksi</h3>

    <div class="card">
        <div class="card-body">

            <p><strong>Kode:</strong> {{ $transaksi->kode_transaksi }}</p>
            <p><strong>Kasir:</strong> {{ $transaksi->user->name }}</p>
            <p><strong>Tanggal:</strong> {{ $transaksi->created_at }}</p>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($transaksi->items as $item)
                    <tr>
                        <td>{{ $item->product->nama }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h4>Total: Rp {{ number_format($transaksi->total, 0, ',', '.') }}</h4>
            <h4>Bayar: Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</h4>
            <h4>Kembalian: Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</h4>

        </div>
    </div>

</div>
@endsection
