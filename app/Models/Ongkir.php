<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ongkir extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    protected $fillable = [
        'lokasi',
        'ongkos',
    ];

    public function pesanan()
    {
        return $this->belongTo(Pesanan::class);
    }

    public function pesanan_detail()
    {
        return $this->hasMany(PesananDetail::class);
    }
}
