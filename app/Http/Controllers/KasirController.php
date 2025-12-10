<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Services\CartService;
use App\Services\TransaksiService;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    protected $cart;
    protected $trx;

    public function __construct(CartService $cart, TransaksiService $trx)
    {
        $this->cart = $cart;
        $this->trx = $trx;
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $barang = Barang::when($search, fn($q) =>
            $q->where('nama', 'like', "%$search%")
        )->get();

        return view('kasir.index', [
            'barang' => $barang,
            'cart' => $this->cart->get(),
            'search' => $search
        ]);
    }

    public function add(Request $request)
    {
        $this->cart->add($request->product_id);
        return back()->with('success', 'Barang ditambahkan');
    }

    public function plus($id)
    {
        $this->cart->plus($id);
        return back();
    }

    public function minus($id)
    {
        $this->cart->minus($id);
        return back();
    }

    public function delete($id)
    {
        $this->cart->delete($id);
        return back();
    }

    public function submit(Request $request)
    {
        $cart = $this->cart->get();

        if (empty($cart)) {
            return back()->with('error', 'Keranjang kosong!');
        }

        $result = $this->trx->prosesTransaksi(
            $cart,
            $request->bayar,
            auth()->id()
        );

        if (!$result['status']) {
            return back()->with('error', $result['msg']);
        }

        $this->cart->clear();

        return redirect()->route('kasir.index')
            ->with('success', 'Transaksi Berhasil! Kembalian: Rp ' . $result['kembalian']);
    }
}
