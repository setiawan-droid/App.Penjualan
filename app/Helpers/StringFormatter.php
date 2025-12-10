<?php

namespace App\Helpers;

class StringFormatter
{
    public static function uang($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }

    public static function kodeTransaksi()
    {
        return 'TRX-' . now()->format('YmdHis');
    }
}
