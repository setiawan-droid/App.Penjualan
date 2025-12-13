<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalAkhir = $request->tanggal_akhir;

        $query = Transaksi::query();

        // Jika ada filter tanggal
        if ($tanggalMulai && $tanggalAkhir) {
            $query->whereBetween('created_at', [
                $tanggalMulai . ' 00:00:00',
                $tanggalAkhir . ' 23:59:59'
            ]);
        }

        $transaksi = $query->orderBy('created_at', 'desc')->get();

        $totalPendapatan = $transaksi->sum('total');

        return view('laporan.index', compact(
            'transaksi',
            'totalPendapatan',
            'tanggalMulai',
            'tanggalAkhir'
        ));
    }
    public function exportPdf(Request $request)
{
    $tanggalMulai = $request->tanggal_mulai;
    $tanggalAkhir = $request->tanggal_akhir;

    $query = Transaksi::query();

    if ($tanggalMulai && $tanggalAkhir) {
        $query->whereBetween('created_at', [
            $tanggalMulai . ' 00:00:00',
            $tanggalAkhir . ' 23:59:59'
        ]);
    }

    $transaksi = $query->orderBy('created_at', 'desc')->get();
    $totalPendapatan = $transaksi->sum('total');

    $user = Auth::user()->name;

    $pdf = Pdf::loadView('laporan.pdf', compact(
        'transaksi',
        'totalPendapatan',
        'tanggalMulai',
        'tanggalAkhir',
        'user'
    ))->setPaper('A4', 'portrait');

    return $pdf->download('Laporan-Penjualan.pdf');
}
}
