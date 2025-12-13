<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::orderBy('id', 'desc')->get();
        return ResponseFormatter::view('barang.index', compact('barang'));
    }

    public function create()
    {
        return ResponseFormatter::view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        Barang::create($request->only(['nama', 'harga', 'stok']));

        return ResponseFormatter::successRedirect(
            'barang.index',
            'Barang berhasil ditambahkan!'
        );
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return ResponseFormatter::view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->only(['nama', 'harga', 'stok']));

        return ResponseFormatter::successRedirect(
            'barang.index',
            'Barang berhasil diperbarui!'
        );
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return ResponseFormatter::successRedirect(
            'barang.index',
            'Barang berhasil dihapus!'
        );
    }
}
