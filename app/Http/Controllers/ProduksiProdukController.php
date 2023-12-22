<?php

namespace App\Http\Controllers;

use Auth;
use Redirect;
use App\Models\Stok;
use App\Models\Produk;
use App\Models\Rating;
use App\Models\ImageDetail;
use Illuminate\Http\Request;
use App\Models\PesananDetail;
use App\Traits\HasFormatRupiah;
use \App\Models\Produk as Model;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProduksiProdukController extends Controller
{

    use HasFormatRupiah;
    use HasFactory;

    private $viewIndex = 'produk_index';
    private $viewCreate = 'produk_form';
    private $viewEdit = 'produk_form';
    private $viewShow = 'produk_show';
    private $routePrefix = 'produksiproduk';
    private $editStok = 'produksi-edit-stok';
    private $editKadaluwarsa = 'produksi-edit-kadaluwarsa';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $produks = Model::all();
        $currentDate = date('Y-m-d'); // Mendapatkan tanggal hari ini

        $selisiTanggal = [];

        foreach ($produks as $produk) {
            $expiryDate = $produk->stok->kadaluwarsa; // Mendapatkan tanggal kadaluwarsa dari tabel produks
            $diffInDays = \Carbon\Carbon::parse($expiryDate)->diffInDays(\Carbon\Carbon::parse($currentDate)); // Menghitung selisih tanggal dalam bentuk hari
            $selisiTanggal[$produk->id] = $diffInDays; // Menyimpan selisih tanggal dalam variabel $selisiTanggal dengan menggunakan id produk sebagai kunci
        }

        // Mengurutkan data berdasarkan sisa hari terkecil
        $produks = $produks->sortBy(function ($produk, $key) use ($selisiTanggal) {
            return $selisiTanggal[$produk->id];
        });
        // $rating = Rating::where('produk_id', $produks->id)->get;
        return view('produksi.produk.' . $this->viewIndex, [
            'produks' => $produks,
            'selisiTanggal' => $selisiTanggal,
            'currentDate' => $currentDate,
            // 'rating' => $rating,
            'routePrefix'   => $this->routePrefix,
            'title'         => 'Produk Morrah Farm',
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
            'model'     => new Model(),
            'method'    => 'POST',
            'route'     => $this->routePrefix . '.store',
            'button'    => 'SIMPAN',
            'title'     => 'Form tambah produk',
        ];

        return view('produksi.produk.' . $this->viewCreate, $data);
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
            'nama_produk' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'keterangan' => 'required',
            'kadaluwarsa' => 'required|date',
        ]);

        // Simpan data ke tabel stok
        $stok = new Stok();
        $stok->jumlah = $request->stok;
        $stok->kadaluwarsa = $request->kadaluwarsa;
        $stok->save();

        $produks = Produk::create([
            'nama_produk' => $request->nama_produk,
            'gambar' => $request->gambar,
            'harga' => $request->harga,
            'stok_id' => $stok->id,
            'keterangan' => $request->keterangan
        ]);

        if ($request->hasFile('gambar')) {
            $request->file('gambar')->move('productimage', $request->file('gambar')->getClientOriginalName());
            $produks->gambar = $request->file('gambar')->getClientOriginalName();
            $produks->save();
        }
        Alert::success('Yeee', 'Berhasil Menambahkan Produk');
        return redirect()->route('produksiproduk.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $produk = Produk::where('id', $id)->first();
        $ratings = Rating::where('produk_id', $produk->id)->get();
        $rating_sum = Rating::where('produk_id', $produk->id)->sum('rating');
        $user_rating = Rating::where('produk_id', $produk->id)->where('user_id', Auth::id())->first();
        $reviews = Rating::where('produk_id', $produk->id)->get();
        if ($ratings->count() > 0) {
            $rating_value =  $rating_sum / $ratings->count();
        } else {
            $rating_value = 0;
        }
        $jumlah = PesananDetail::all();
        return view('manager.' . $this->viewShow, [
            'produk' => $produk,
            'title' => 'Detail Data Produk',
            'ratings' => $ratings,
            'rating_sum' => $rating_sum,
            'rating_value' => $rating_value,
            'reviews' => $reviews
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
        $produks = [
            'model'     => Model::findOrFail($id),
            'method'    => 'PUT',
            'route'     => [$this->routePrefix . '.update', $id,],
            'button'    => 'UPDATE',
            'title'     => 'Form Update data Produk',
        ];

        return view('produksi.produk.' . $this->viewEdit, $produks);
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
        // dd($request->all());
        $request->validate([
            'nama_produk' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'keterangan' => 'required',
            'kadaluwarsa' => 'required|date',
        ]);

        $product = Produk::findOrFail($id);

        $stok = Stok::findOrFail($product->stok_id);
        $stok->jumlah = $request->stok;
        $stok->kadaluwarsa = $request->kadaluwarsa;
        $stok->update();

        $product->nama_produk = $request->nama_produk;
        $product->harga = $request->harga;
        $product->keterangan = $request->keterangan;

        if ($request->hasFile('gambar')) {
            $request->file('gambar')->move('productimage', $request->file('gambar')->getClientOriginalName());
            $product->gambar = $request->file('gambar')->getClientOriginalName();
        }

        $product->save(); // Menggunakan save() untuk menyimpan perubahan pada model

        return redirect()->route('produksiproduk.index')->with('success', 'Data Produk Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $stok = Stok::findOrFail($produk->stok_id);
        $produk->delete();
        $stok->delete();
        Alert::success('Yeee', 'Berhasil Menghapus Produk');
        return redirect()->back();
    }


    public function editStok($id)
    {
        $produks = [
            'model'     => Model::findOrFail($id),
            'method'    => 'PUT',
            'route'     => [$this->routePrefix . '.update', $id,],
            'button'    => 'UPDATE',
            'title'     => 'Form Update data Stok Produk',
        ];

        return view('produksi.produk.' . $this->editStok, $produks);
    }

    public function updateStok(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'stok' => 'required|numeric|min:6',
        ]);

        $product = Produk::findOrFail($id);
        $product->stok = $request->stok;

        $product->save(); // Menggunakan save() untuk menyimpan perubahan pada model

        return redirect()->route('produksiproduk.index')->with('success', 'Data Produk Berhasil di Ubah');
    }

    public function editKadaluwarsa($id)
    {
        $produks = [
            'model'     => Model::findOrFail($id),
            'method'    => 'PUT',
            'route'     => [$this->routePrefix . '.update', $id,],
            'button'    => 'UPDATE',
            'title'     => 'Form Update data Kadaluwarsa Produk',
        ];

        return view('produksi.produk.' . $this->editKadaluwarsa, $produks);
    }

    public function updateKadaluwarsa(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'kadaluwarsa' => 'required',
        ]);

        $product = Produk::findOrFail($id); // Menggunakan findOrFail agar memberikan 404 Not Found jika produk tidak ditemukan

        // Simpan data ke tabel stok
        $stok = Stok::findOrFail($product->stok_id);
        $stok->kadaluwarsa = $request->kadaluwarsa;
        $stok->update();


        return redirect()->route('produk.index')->with('success', 'Data Produk Berhasil di Ubah');
    }
}
