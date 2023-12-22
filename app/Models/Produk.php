<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stok;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    use SoftDeletes;

    protected $fillable = [
        'nama_produk',
        'gambar',
        'harga',
        'stok_id',
        'keterangan',
        'updated_at',
        'created_at'

    ];

    public function pesanan_detail()
    {
        return $this->hasMany('App\Models\PesananDetail', 'produk_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function pesanan()
    {
        return $this->belongTo(Pesanan::class);
    }

    public function stok()
    {
        return $this->hasOne(Stok::class, 'id', 'stok_id');
    }
}
