<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksi_id',
        'product_id',
        'qty',
        'harga',
        'subtotal'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

