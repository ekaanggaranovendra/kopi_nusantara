<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = ['nama_pemesan', 'produk', 'jumlah', 'alamat_pengiriman'];
}
