<?php

namespace App\Services;

use App\Models\Barang;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function get()
    {
        return Session::get('cart', []);
    }

    public function add($productId)
    {
        $barang = Barang::findOrFail($productId);

        $cart = $this->get();

        if (isset($cart[$barang->id])) {
            $cart[$barang->id]['qty']++;
        } else {
            $cart[$barang->id] = [
                'nama'  => $barang->nama,
                'harga' => $barang->harga,
                'qty'   => 1,
            ];
        }

        Session::put('cart', $cart);
        return $cart;
    }

    public function plus($id)
    {
        $cart = $this->get();

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        }

        Session::put('cart', $cart);
    }

    public function minus($id)
    {
        $cart = $this->get();

        if (isset($cart[$id]) && $cart[$id]['qty'] > 1) {
            $cart[$id]['qty']--;
        }

        Session::put('cart', $cart);
    }

    public function delete($id)
    {
        $cart = $this->get();

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        Session::put('cart', $cart);
    }

    public function clear()
    {
        Session::forget('cart');
    }

    public function total()
    {
        $cart = $this->get();
        return array_sum(array_map(fn($x) => $x['harga'] * $x['qty'], $cart));
    }
}
