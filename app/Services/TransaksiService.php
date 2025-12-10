<?php

namespace App\Services;

use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Helpers\StringFormatter;

class TransaksiService
{
    public function prosesTransaksi($cart, $bayar, $userId)
    {
        $total = array_sum(array_map(fn($x) => $x['harga'] * $x['qty'], $cart));

        if ($bayar < $total) {
            return [
                'status' => false,
                'msg' => 'Uang tidak cukup! Total: ' . StringFormatter::uang($total)
            ];
        }

        $kembalian = $bayar - $total;

        // Create transaction
        $transaksi = Transaksi::create([
            'user_id'        => $userId,
            'kode_transaksi' => StringFormatter::kodeTransaksi(),
            'total'          => $total,
            'bayar'          => $bayar,
            'kembalian'      => $kembalian,
        ]);

        foreach ($cart as $id => $item) {
            TransaksiItem::create([
                'transaksi_id' => $transaksi->id,
                'product_id'   => $id,
                'qty'          => $item['qty'],
                'harga'        => $item['harga'],
                'subtotal'     => $item['harga'] * $item['qty'],
            ]);
        }

        return [
            'status' => true,
            'kembalian' => $kembalian,
            'transaksi' => $transaksi
        ];
    }
}
