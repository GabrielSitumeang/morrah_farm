<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanPenjualanExport implements FromQuery, WithHeadings
{
    public function query()
    {
        $bulan = request()->input('bulan');

        $query = DB::table('pesanan_details')
            ->join('pesanans', 'pesanan_details.pesanan_id', '=', 'pesanans.id')
            ->join('produks', 'pesanan_details.produk_id', '=', 'produks.id')
            ->select(
                DB::raw('DATE_FORMAT(pesanans.created_at, "%Y-%m-%d") as bulan'),
                'produks.nama_produk',
                'produks.harga',
                DB::raw('SUM(pesanan_details.jumlah) as jumlah_terjual'),
                DB::raw('SUM(pesanan_details.jumlah * produks.harga) as pendapatan')
            )
            ->where('pesanans.status', '>=', 5)
            ->groupBy('bulan', 'produks.nama_produk', 'produks.harga')
            ->orderBy('bulan');

        if ($bulan) {
            $query->where(DB::raw('DATE_FORMAT(pesanans.created_at, "%Y-%m-%d")'), '=', $bulan);
        }

        return $query;
    }
    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Produk',
            'Harga Satuan',
            'Jumlah Terjual',
            'Pendapatan',
        ];
    }
}
