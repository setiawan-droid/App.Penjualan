<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KasirController extends Controller
{
   public function index(Request $request)
{
    $search = $request->search;

    $barang = Barang::when($search, function ($query) use ($search) {
        $query->where('nama', 'like', '%' . $search . '%');
    })->get();

    $cart = Session::get('cart', []);

    return view('kasir.index', compact('barang', 'cart', 'search'));
}


    public function add(Request $request)
    {
        $barang = Barang::find($request->product_id);

        $cart = Session::get('cart', []);

        // Jika barang sudah ada, tambah qty
        if (isset($cart[$barang->id])) {
            $cart[$barang->id]['qty']++;
        } else {
            $cart[$barang->id] = [
                'nama' => $barang->nama,
                'harga' => $barang->harga,
                'qty' => 1,
            ];
        }

        Session::put('cart', $cart);
        return back();
    }

    public function submit(Request $request)
{
    $cart = Session::get('cart', []);

    if (empty($cart)) {
        return back()->with('error', 'Keranjang kosong!');
    }

    // Hitung total
    $total = array_sum(array_map(fn($x) => $x['harga'] * $x['qty'], $cart));

    $bayar = (int)$request->bayar;

    //  Validasi uang bayar kurang
    if ($bayar < $total) {
        return back()->with('error', 'Uang yang dibayarkan kurang! Total: Rp ' . number_format($total));
    }

    // Hitung kembalian
    $kembalian = $bayar - $total;

    // Generate kode transaksi
    $kode = 'TRX-' . time();

    // Simpan transaksi
    $transaksi = Transaksi::create([
        'user_id'        => auth()->id(),
        'kode_transaksi' => $kode,
        'total'          => $total,
        'bayar'          => $bayar,
        'kembalian'      => $kembalian,
    ]);

    // Simpan item transaksi
    foreach ($cart as $id => $item) {
        TransaksiItem::create([
            'transaksi_id' => $transaksi->id,
            'product_id' => $id,          //  Sesuaikan nama kolom
            'qty' => $item['qty'],
            'harga' => $item['harga'],
            'subtotal' => $item['harga'] * $item['qty'],
        ]);
    }

    // Kosongkan keranjang
    Session::forget('cart');

    return redirect()->route('kasir.index')->with('success',
        'Transaksi Berhasil! Kembalian: Rp ' . number_format($kembalian)
    );
}

    public function plus($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['qty'] += 1;
    }

    session()->put('cart', $cart);
    return back();
}

public function minus($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id]) && $cart[$id]['qty'] > 1) {
        $cart[$id]['qty'] -= 1;
    }

    session()->put('cart', $cart);
    return back();
}

public function delete($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
    }

    session()->put('cart', $cart);
    return back();
}


}
