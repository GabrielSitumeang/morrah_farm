<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Http\Request;

class PesanController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function orderDetails()
    {
        $dataOrders = Pesanan::orderBy('updated_at', 'desc')->where('status', 2)->paginate(10);
        return view('manager.orders.orders', [
            "title" => 'Data Pemesanan'
        ], compact('dataOrders'));
    }

    public function confirmPhoto()
    {
        $dataConfirmPhoto = Pesanan::where('status', '3')->paginate(10);
        return view('produksi.confirm-product-packing', [
            'title' => 'Confirm Photo'
        ], compact('dataConfirmPhoto'));
    }

    public function tracking()
    {
        $dataTracking = Pesanan::where('status', '4')->paginate(10);
        return view('manager.orders.tracking', [
            "title" => 'Tracking'
        ], compact('dataTracking'));
    }

    public function orderResult(Request $request)
    {
        if ($request->has('search')) {
            $dataResult = Pesanan::where('kode', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $dataResult = Pesanan::orderBy('created_at', 'desc')->where('status', 5)->paginate(10);
        }
        return view('manager.orders.orders-result', [
            "title" => 'Pemesanan Selesai'
        ], compact('dataResult'));
    }

    public function resultFile($id)
    {
        $dataResultFile = Pesanan::find($id);
        return view('manager.orders.result-file', [
            "title" => 'Hasil File'
        ], compact('dataResultFile'));
    }

    public function detailPembelian($id)
    {
        $pesanan = Pesanan::find($id);
        $detailPesanan = PesananDetail::where('pesanan_id', $pesanan->id)->get();

        // dd($pesanan);
        return view('manager.orders.detail-pembelian', [
            "title" => 'Detail Pembelian'
        ], compact('pesanan', 'detailPesanan'));
    }

    public function produksidetailPembelian($id)
    {
        $pesanan = Pesanan::find($id);
        $detailPesanan = PesananDetail::where('pesanan_id', $pesanan->id)->get();

        // dd($detailPesanan);
        return view('produksi.detail-pembelian', [
            "title" => 'Detail Pembelian'
        ], compact('pesanan', 'detailPesanan'));
    }

    public function orderResultUpload($id)
    {
        $orderResultUpload = Pesanan::find($id);
        return view('manager.orders.order-upload-result', [
            "title" => 'Hasil Upload Gambar'
        ], compact('orderResultUpload'));
    }

    public function confirmOrdersProcess($id)
    {
        $dataConfirmProcess = Pesanan::where('id', $id)->first();
        $dataConfirmProcess->status = 3;
        // $dataConfirmProcess->status = 7;
        $dataConfirmProcess->update();
        return redirect()->route('order.detail')->with('toast_success', 'Data has been confirmed');
    }

    public function confirmPhotoProcess(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $dataConfirmPhotoProcess = Pesanan::where('id', $id)->first();
        if ($request->hasFile('img')) {
            $request->file('img')->move('productimage/', $request->file('img')->getClientOriginalName());
            $dataConfirmPhotoProcess->img = $request->file('img')->getClientOriginalName();
            $dataConfirmPhotoProcess->status = 4;
            $dataConfirmPhotoProcess->read = 0;
            $dataConfirmPhotoProcess->update();
        }

        return redirect()->route('confirm.photo')->with('Bukti foto berhasil di upload')->with('toast_success', 'Bukti berhasil di upload');
    }

    public function formTracking($id)
    {
        $dataFormTracking = Pesanan::find($id);
        return view('manager.orders.form-tracking', [
            "title" => 'Form Tracking'
        ], compact('dataFormTracking'));
    }

    public function formTrackingProcess(Request $request, $id)
    {
        // return $request;
        // dd($request->all());
        $request->validate([
            'nama_pengirim' => 'required',
            'tlpn' => 'required',
            'angkutan' => 'required',
            'jenis' => 'required',
            'plat' => 'required',
            'kurir' => 'required',
            'resi' => 'required',
        ]);

        $formTracking = Pesanan::where('id', $id)->first();
        $formTracking->nama_pengirim = $request->nama_pengirim;
        $formTracking->tlpn = $request->tlpn;
        $formTracking->angkutan = $request->angkutan;
        $formTracking->jenis = $request->jenis;
        $formTracking->plat = $request->plat;
        $formTracking->kurir = $request->kurir;
        $formTracking->resi = $request->resi;
        $formTracking->status = 5;
        $formTracking->read = 0;
        $formTracking->update();

        return redirect()->route('order.tracking')->with('toast_success', 'Data berhasil tersimpan');
    }
}
