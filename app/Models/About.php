<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class About extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'isi', 'gambar'];

    public static function boot()
    {
        parent::boot();

        // Event listener saat model dihapus
        static::deleting(function($post) {
            // Hapus gambar dari folder jika ada
            if (!empty($post->gambar)) {
                Storage::delete($post->gambar);
            }
        });
    }
}
