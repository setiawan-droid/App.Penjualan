<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('user')
                    ->latest()
                    ->paginate(10);

        return view('transaksi.index', compact('transaksi'));
    }
}
