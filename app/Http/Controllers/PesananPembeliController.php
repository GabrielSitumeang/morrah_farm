<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Ongkir;
use App\Models\Produk;
use App\Models\Rating;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\PesananDetail;
use RealRashid\SweetAlert\Facades\Alert;

class PesananPembeliController extends Controller
{
    public function index($id)
    {
        $produk = Produk::where('id', $id)->first();
        $ongkirs = Ongkir::all();
        $ratings = Rating::where('produk_id', $produk->id)->get();
        $rating_sum = Rating::where('produk_id', $produk->id)->sum('rating');
        $user_rating = Rating::where('produk_id', $produk->id)->where('user_id', Auth::id())->first();
        $reviews = Rating::where('produk_id', $produk->id)->get();

        if ($ratings->count() > 0) {
            $rating_value = number_format($rating_sum / $ratings->count(), 1);
        } else {
            $rating_value = 0;
        }


        $jumlahTerjual = Pesanan::where('produk_id', $produk->id)->where('status', '>', 5)->sum('jumlah_pesan');

        return view('pembeli.produk_detail', [
            'title' => 'Detail Pemesanan Produk',
            'ratings' => $ratings,
            'rating_value' => $rating_value,
            'user_rating' => $user_rating,
            'reviews' => $reviews,
            'jumlahTerjual' => $jumlahTerjual
        ], compact('produk', 'ongkirs'));
    }

    public function pesan(Request $request, $id)
    {
        $request->input();
        $produk     = Produk::where('id', $id)->first();
        $tanggal    = Carbon::now();

        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();


        if ($request->jumlah_pesan > $produk->stok) {
            return redirect('pembeli/keranjang/' . $id)->with('toast_error', 'Anda sudah melebihi batas stok');
        } elseif (!empty($cek_pesanan)) {
            $cek_pesanan_detail   = PesananDetail::where('produk_id', $produk->id)->where('pesanan_id', $cek_pesanan->id)->first();
            if (!empty($cek_pesanan_detail)) {
                if ($request->jumlah_pesan + $cek_pesanan_detail->jumlah > $produk->stok) {
                    return redirect()->back()->with('toast_info', 'Stok yang ada dipesanan anda, sudah melebihi stok yang tersedia. Silahkan cek kerangjang anda!');
                }
            }
        }

        $cek_order = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        if (empty($cek_order)) {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->ongkir_id = 0;
            $pesanan->jumlah_harga = 0;
            $pesanan->kode = mt_rand(1000, 9999);
            $pesanan->produk_id = $produk->id;
            $pesanan->jumlah_pesan = $request->jumlah_pesan;
            $pesanan->save();
        }


        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $cek_pesanan_detail   = PesananDetail::where('produk_id', $produk->id)->where('pesanan_id', $pesanan_baru->id)->first();

        if (empty($cek_pesanan_detail)) {
            $pesanan_detail = new PesananDetail;
            $pesanan_detail->produk_id = $produk->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->ongkir_id = 0;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga = $produk->harga * $request->jumlah_pesan;
            $pesanan_detail->save();
        } else {
            $pesanan_detail   = PesananDetail::where('produk_id', $produk->id)->where('pesanan_id', $pesanan_baru->id)->first();
            $pesanan_detail->jumlah         = $pesanan_detail->jumlah + $request->jumlah_pesan;

            // Harga sekarang
            $harga_pesanan_detail_baru      = $produk->harga * $request->jumlah_pesan;
            $pesanan_detail->jumlah_harga   = $pesanan_detail->jumlah_harga + $harga_pesanan_detail_baru;
            $pesanan_detail->update();
        }

        // total number
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga + $produk->harga * $request->jumlah_pesan;
        $pesanan->update();
        Alert::success('Success', 'Berhasil Memasukkan Keranjang');

        return redirect('keranjang');
    }

    public function cart()
    {

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $ongkirs = Ongkir::all();
        $pesanan_details = [];
        if (!empty($pesanan)) {
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        }

        return view('pembeli.keranjang_index', [
            "title" => 'Check Out'
        ], compact('pesanan', 'pesanan_details', 'ongkirs'));
    }

    public function delete($id)
    {
        try {
            $pesanan_detail = PesananDetail::find($id);

            if (!$pesanan_detail) {
                throw new \Exception('Data not found');
            }

            $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();

            if (!$pesanan) {
                throw new \Exception('Pesanan not found');
            }

            $pesanan->jumlah_harga = $pesanan->jumlah_harga - $pesanan_detail->jumlah_harga;
            $pesanan->update();

            // Hapus data pesanan_detail
            $pesanan_detail->delete();

            // Cek apakah masih ada pesanan_detail terkait dengan pesanan
            $remainingDetails = PesananDetail::where('pesanan_id', $pesanan->id)->exists();

            if (!$remainingDetails) {
                // Jika tidak ada pesanan_detail lagi terkait dengan pesanan, hapus data pesanan
                $pesanan->delete();
            }

            return response()->json(['message' => 'Berhasil Menghapus dari keranjang']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function konfirmasi(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        // if (empty($user->alamat)) {
        //     return redirect()->route('akun-pembeli.edit', $user)->with('toast_error', 'Lengkapi Alamat Anda');
        // }

        if (empty($user->nohp)) {
            return redirect()->route('akun-pembeli.edit', $user)->with('toast_error', 'Lengkapi No Hp Anda');
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;
        // Mengambil nilai ongkir_id dari form
        $ongkirId = $request->input('ongkir_id');
        $selectedOngkir = Ongkir::findOrFail($ongkirId);
        $pesanan->status = 1;
        $pesanan->ongkir_id = $selectedOngkir->id;
        $pesanan->update();

        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
        foreach ($pesanan_details as $pesanan_detail) {
            $produk = Produk::where('id', $pesanan_detail->produk_id)->first();
            $stok = $produk->stok;
            $stok->jumlah = $stok->jumlah - $pesanan_detail->jumlah;
            $stok->update();

            $pesanan_detail->ongkir_id = $selectedOngkir->id;
            $pesanan_detail->save();
        }

        return redirect('history/' . $pesanan_id)->with('success', 'CheckOut berhasil silahkan lakukan pembayaran');
    }
}
