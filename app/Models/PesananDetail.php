<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RealRashid\SweetAlert\Facades\Alert;

class PesananDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'produk_id',
        'pesanan_id',
        'ongkir_id',
        'jumlah',
        'jumlah_harga',
    ];

    public function produk()
    {
        return $this->belongsTo('App\Models\Produk', 'produk_id', 'id');
    }

    public function ongkir()
    {
        return $this->belongsTo('App\Models\Ongkir', 'ongkir_id', 'id');
    }

    public function pesanan()
    {
        return $this->belongsTo('App\Models\Pesanan', 'pesanan_id', 'id');
    }
}
