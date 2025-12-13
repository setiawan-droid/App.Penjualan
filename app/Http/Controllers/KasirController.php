<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KasirController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $barang = Barang::when($search, function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $search . '%');
        })->get();

        $cart = Session::get('cart', []);

        return view('kasir.index', compact('barang', 'cart', 'search'));
    }

    // =============================
    //   TAMBAH BARANG KE KERANJANG
    // =============================
    public function add(Request $request)
    {
        $barang = Barang::findOrFail($request->product_id);

        // Cek stok
        if ($barang->stok <= 0) {
            return back()->with('error', 'Stok barang habis!');
        }

        $cart = Session::get('cart', []);

        // Jika barang sudah ada → cek stok sebelum tambah qty
        if (isset($cart[$barang->id])) {

            if ($cart[$barang->id]['qty'] + 1 > $barang->stok) {
                return back()->with('error', 'Stok tidak mencukupi!');
            }

            $cart[$barang->id]['qty']++;
        } 
        else {
            $cart[$barang->id] = [
                'nama' => $barang->nama,
                'harga' => $barang->harga,
                'qty' => 1,
            ];
        }

        Session::put('cart', $cart);
        return back()->with('success', 'Barang dimasukkan ke keranjang.');
    }


    // =============================
    //   TAMBAH QTY (+)
    // =============================
    public function plus($id)
    {
        $cart = Session::get('cart', []);
        $barang = Barang::findOrFail($id);

        // Cek stok
        if ($cart[$id]['qty'] + 1 > $barang->stok) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $cart[$id]['qty']++;
        Session::put('cart', $cart);

        return back();
    }

    // =============================
    //   KURANG QTY (-)
    // =============================
    public function minus($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['qty'] > 1) {
                $cart[$id]['qty']--;
            } else {
                unset($cart[$id]);
            }
        }

        Session::put('cart', $cart);
        return back();
    }

    // =============================
    //   HAPUS BARANG
    // =============================
    public function delete($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        Session::put('cart', $cart);
        return back();
    }


    // =============================
    //   SUBMIT TRANSAKSI (CHECKOUT)
    // =============================
    public function submit(Request $request)
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        // Hitung total
        $total = array_sum(array_map(fn($x) => $x['harga'] * $x['qty'], $cart));

        // Cek uang bayar
        if ($request->bayar < $total) {
            return back()->with('error', 'Uang kurang! Total: ' . $total);
        }

        // =============================
        //  CEK STOK SEBELUM TRANSAKSI
        // =============================
        foreach ($cart as $id => $item) {
            $barang = Barang::find($id);

            if ($item['qty'] > $barang->stok) {
                return back()->with('error', 'Stok barang ' . $barang->nama . ' tidak cukup!');
            }
        }

        // Buat transaksi
        $transaksi = Transaksi::create([
            'user_id' => auth()->id(),
            'kode_transaksi' => 'TRX-' . time(),
            'total' => $total,
            'bayar' => $request->bayar,
            'kembalian' => $request->bayar - $total,
        ]);

        // Simpan items dan kurangi stok
        foreach ($cart as $id => $item) {

            $barang = Barang::find($id);

            // Kurangi stok
           // dd($barang->stok .'--'. $item['qty']); //debug stok
            $barang->stok -= $item['qty'];
            $barang->save();

            // Simpan transaksi detail
            TransaksiItem::create([
                'transaksi_id' => $transaksi->id,
                'product_id' => $id,
                'qty' => $item['qty'],
                'harga' => $item['harga'],
                'subtotal' => $item['harga'] * $item['qty'],
            ]);
        }

        // Bersihkan keranjang
        Session::forget('cart');

        return redirect()->route('kasir.index')->with('success', 'Transaksi berhasil disimpan!');
    }
}
