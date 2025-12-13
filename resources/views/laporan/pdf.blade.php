<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>

    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; font-weight: bold; margin-bottom: 0; }
        .periode { text-align: center; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; font-size: 11px; }
        th { background: #eaeaea; }
        hr { border: 0; border-top: 2px solid #000; margin: 20px 0; }
        .footer { margin-top: 50px; width: 100%; text-align: right; padding-right: 40px; }
    </style>
</head>
<body>

    <h2><strong>Laporan Penjualan</strong></h2>

    <p class="periode">
        <strong>Periode:</strong>
        {{ $tanggalMulai ?? '-' }} s/d {{ $tanggalAkhir ?? '-' }}
    </p>

    <hr>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Bayar</th>
                <th>Kembalian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $t)
            <tr>
                <td>{{ $t->kode_transaksi }}</td>
                <td>{{ $t->created_at->format('d/m/Y H:i') }}</td>
                <td>Rp {{ number_format($t->total) }}</td>
                <td>Rp {{ number_format($t->bayar) }}</td>
                <td>Rp {{ number_format($t->kembalian) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total Pendapatan: Rp {{ number_format($totalPendapatan) }}</strong></p>

    <div class="footer">
        <p>Mengetahui,</p>
        <br><br><br>
        <p><strong>{{ $user }}</strong></p>
    </div>

</body>
</html>
