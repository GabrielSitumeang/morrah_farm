<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskKaryawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_tugas',
        'deskripsi',
        'gambar',
        'tanggal',
        'status',
        
    ];

    public function approve()
    {
        $this->status = 'Selesai';
        $this->save();
    }

}
