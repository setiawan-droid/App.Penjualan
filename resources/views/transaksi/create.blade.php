@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Transaksi Baru</h3>

    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $p)
                <tr>
                    <td>
                        <input type="checkbox" name="items[{{ $p->id }}][product_id]" value="{{ $p->id }}">
                        {{ $p->nama }}
                    </td>

                    <td>
                        <input type="number" name="items[{{ $p->id }}][qty]" value="1" min="1" class="form-control">
                    </td>

                    <td>
                        <input type="number" name="items[{{ $p->id }}][harga]" value="{{ $p->harga }}" class="form-control">
                    </td>

                    <td>
                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mb-3">
            <label>Total</label>
            <input type="number" name="total" class="form-control">
        </div>

        <div class="mb-3">
            <label>Bayar</label>
            <input type="number" name="bayar" class="form-control">
        </div>

        <button class="btn btn-success">Simpan Transaksi</button>

    </form>

</div>
@endsection
