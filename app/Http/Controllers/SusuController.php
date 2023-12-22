<?php

namespace App\Http\Controllers;

use App\Models\Susu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SusuController extends Controller
{
    private $viewIndex = 'susu_index';
    private $viewCreate = 'susu_form';
    private $viewEdit = 'susu_form';
    private $viewShow = 'susu_show';
    private $routePrefix = 'susu';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $susus = Susu::paginate(20);
        return view('peternak.' . $this->viewIndex, [
            'susus' => $susus,
            'routePrefix'   => $this->routePrefix,
            'title'         => 'Laporan Data Susu Harian'
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
            'model'     => new Susu(),
            'method'    => 'POST',
            'route'     => $this->routePrefix . '.store',
            'button'    => 'SIMPAN',
            'title'     => 'Form tambah data laporan susu harian',
        ];

        return view('peternak.' . $this->viewCreate, $data);
    }

    // public function store(Request $request)
    // {

    //     $request->validate([
    //         'tanggal' => 'required',
    //         'jumlah_susu' => 'required',
    //     ]);

    //     // Mendapatkan pengguna yang sedang login
    //     $user = Auth::user();

    //     // Mendapatkan nama pengguna yang sedang login
    //     $pelapor = $user->name;

    //     $susus = Susu::create([
    //         'pelapor' => $pelapor,
    //         'tanggal' => $request->tanggal,
    //         'jumlah_susu' => $request->jumlah_susu,
    //     ]);

    //     $request->validate([
    //         'pelapor' => 'required',
    //         'tanggal' => 'required',
    //         'jumlah_susu' => 'required',
    //     ]);

    //     $susus = Susu::create([
    //         'pelapor' => $request->pelapor,
    //         'tanggal' => $request->tanggal,
    //         'jumlah_susu' => $request->jumlah_susu,
    //     ]);

    //     return redirect()->route('susu.index')->with('success', 'Laporan berhasil ditambahkan');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_susu' => 'required',
            'tanggal' => 'required|date',
        ]);

        $user = Auth::user();
        $pelapor = $user->name;

        Susu::create([
            'pelapor' => $pelapor,
            'jumlah_susu' => $request->jumlah_susu,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('susu.index')->with('success', 'Laporan berhasil ditambahkan');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('peternak.' . $this->viewShow, [
            'model' => Susu::findOrFail($id),
            'title' => 'Detail Laporan Susu'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $susus = [
            'model'     => Susu::findOrFail($id),
            'method'    => 'PUT',
            'route'     => [$this->routePrefix . '.update', $id,],
            'button'    => 'UPDATE',
            'title'     => 'Form Update Laporan Susu',
        ];

        return view('peternak.' . $this->viewEdit, $susus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     // dd($request->all());
    //     $request->validate([
    //         'tanggal' => 'required',
    //         'jumlah_susu' => 'required',
    //     ]);

    //     $susus = Susu::where('id', $id)->first();
    //     $susus->tanggal = $request->tanggal;
    //     $susus->jumlah_susu = $request->jumlah_susu;
    //     return redirect()->route('susu.index')->with('success', 'Laporan Data Susu Berhasil di Ubah');
    // }
    public function update(Request $request, Susu $susu)
    {
        $request->validate([
            'jumlah_susu' => 'required',
            'tanggal' => 'required|date',
        ]);

        $susu->update([
            'jumlah_susu' => $request->jumlah_susu,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('susu.index')->with('success', 'Laporan Data Susu Berhasil di Ubah');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $susus = Susu::findOrFail($id);
        $susus->delete();
        return back()->with('success', 'Laporan Data Susu Berhasil dihapus');
    }
}
