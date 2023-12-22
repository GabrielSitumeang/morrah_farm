<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanInventori;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class LaporanInventoriProduksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    private $viewIndex = 'beranda_laporan';
    private $viewCreate = 'create_laporan';
    private $viewShow = 'laporan_show';
    public $routePrefix = 'laporan-inventori';


    public function index()
    {
        $production_reports = LaporanInventori::paginate(20);
        return view('produksi.laporan.beranda-laporan',[
            'production_reports' => $production_reports,
            'routePrefix    => $this->routePrefix',
            'title'          => 'Laporan Data Hasil Produksi'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' =>new LaporanInventori(),
            'method' => 'POST',
            'route' => $this->routePrefix. '.store',
            'button' => 'SIMPAN',
            'title' => 'Form tambah Data Laporan Produksi',
        ];
        return view('produksi.laporan.create-laporan', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'nama_produk' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        $user = Auth::user();
        $pelapor = $user->name;

        $production_reports = LaporanInventori::create([
            'nama_pelapor' => $pelapor,
            'tanggal' => $request->tanggal,
            'nama_produk' => $request-> nama_produk,
            'jumlah' => $request->jumlah,

        ]);

        return redirect()->route('laporan-inventori.index')->with('success', 'Hasil Produksi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('produksi.laporan.'. $this->viewShow, [
            'model' => LaporanInventori::findOrFail($id),
            'title' => 'Detail Data Produk'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LaporanInventori  $production_reports
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $production_reports = [
            'model'     => LaporanInventori::findOrFail($id),
            'method'    => 'PUT',
            'route'     => [$this->routePrefix .'.update', $id,],
            'button'    => 'UPDATE',
            'title'     => 'Form Update Laporan Produksi ',
        ];

        return view('produksi.laporan.create-laporan', $production_reports);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\LaporanInventori  $production_reports
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaporanInventori $laporanInventori)
    {
        // dd($request->all());
        $request->validate([
            'nama_produk' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required|numeric'
        ]);

        // $production_reports = LaporanInventori::where('id', $id)->first();
        // $production_reports->nama_produk = $request->pelapor;
        // $production_reports->tanggal = $request->tanggal;
        // $production_reports->jumlah = $request->jumlah;

        $laporanInventori->update([
            'nama_produk' => $request->nama_produk,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);
        return redirect()->route('laporan-inventori.index')->with('success','Data Kerbau Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $production_reports = LaporanInventori::findOrFail($id);
        $production_reports->delete();
        return back()->with('success', 'Data Laporan Hasil Produksi Berhasil Dihapus');
       /* $nama_produk = $production_reports->nama_produk;
        $deleted = DB::table('production_reports')->delete();
        return redirect()->route('beranda-laporan')->with('success', 'Laporan Berhasil Dihapus ');*/
    }
}
