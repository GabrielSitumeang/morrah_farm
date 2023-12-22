<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pesanans = Pesanan::where('user_id', Auth::user()->id)->where('status', '!=', 0)->get()->sortByDesc('updated_at');

        return view('pembeli.history.index', [
            "title" => 'Pesanan'
        ], compact('pesanans'));
    }

    public function historyDetail($id)
    {
        $historyPesanan = Pesanan::where('id', $id)->first();
        $historyDetailPesanan = PesananDetail::where('pesanan_id', $historyPesanan->id)->get();
        return view('pembeli.history.detail-history', [
            "title" => 'Detail History Pemesanan'
        ], compact('historyPesanan', 'historyDetailPesanan'));
    }

    public function detail($id)
    {
        $pesanan = Pesanan::where('id', $id)->first();
        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();

        $pesanan->read = 1;
        $pesanan->save();

        return view('pembeli.history.detail', [
            "title" => 'Pesanan | Detail Pemesanan'
        ], compact('pesanan', 'pesanan_details'));
    }
}
