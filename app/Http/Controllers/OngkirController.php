<?php

namespace App\Http\Controllers;

use App\Models\Ongkir;
use Illuminate\Http\Request;

class OngkirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ongkirs = Ongkir::all();
        return view('manager.ongkir.index', [
            'title' => 'Halaman Ongkos Kirim'
        ], compact('ongkirs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.ongkir.create', [
            'title' => 'Halaman Create Ongkos Kirim'
        ]);
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
            'lokasi' => 'required',
            'ongkos' => 'required',
        ]);

        // Simpan data blog ke dalam database
        Ongkir::create([
            'lokasi' => $request->lokasi,
            'ongkos' => $request->ongkos,
            // Menyimpan foreign key (user_id) sesuai dengan pengguna yang sedang login
            'ongkir_id' => auth()->user()->id
        ]);

        // Redirect ke halaman blog manager atau halaman lain yang diinginkan
        return redirect()->route('ongkir.manager')->with('success', 'Ongkos Kirim berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ongkirs = Ongkir::findOrFail($id);
        return view('manager.ongkir.edit', [
            'title' => 'Halaman Edit Ongkos Kirim'
        ], compact('ongkirs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'lokasi' => 'required',
            'ongkos' => 'required',
        ]);

        $ongkirs = Ongkir::findOrFail($id);

        $ongkirs->update([
            'lokasi' => $request->lokasi,
            'ongkos' => $request->ongkos,
        ]);

        return redirect()->route('ongkir.manager')->with('success', 'Ongkos Kirim berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $ongkirs = Ongkir::find($id);

            if (!$ongkirs) {
                throw new \Exception('Data not found');
            }

            // Hapus data
            $ongkirs->delete();

            return redirect()->route('ongkir.manager')->with('success', 'Ongkos Kirim berhasil didelete!');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
