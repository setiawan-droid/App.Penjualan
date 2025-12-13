<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\JsonResponse;

class BarangApiController extends Controller
{
    /**
     * Menampilkan semua barang
     */
    public function index(): JsonResponse
    {
        $barang = Barang::select('id', 'nama', 'harga', 'stok')->get();

        return response()->json([
            'success' => true,
            'jumlah' => $barang->count(),
            'data' => $barang
        ], 200);
    }

    /**
     * Menampilkan detail barang
     */
    public function show($id): JsonResponse
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $barang
        ], 200);
    }
}
