{{-- @extends('layouts.app_Coza')

@section('content')
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10"></div>

            <div class="flex-w flex-c-m m-tb-10"></div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('pembeli.produk') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="col-md-12 mt-3">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/list-menu') }}">Menu</a></li>
                            <li class="breadcrumb-item">Pesanan</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fa fa-hostory">Pesanan Anda</i></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Jumlah Harga</th>
                                    <th>Aksi</th>
                                </tr>
                                <?php $no = 1; ?>
                                @foreach ($pesanans as $pesanan)
                                    @if (
                                        $pesanan->status == 1 ||
                                            $pesanan->status == 2 ||
                                            $pesanan->status == 3 ||
                                            $pesanan->status == 4 ||
                                            $pesanan->status == 5)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $pesanan->tanggal }}</td>
                                            <td>
                                                @if ($pesanan->status == 1)
                                                    Sudah pesan & Belum dibayar
                                                @elseif($pesanan->status == 2)
                                                    Pembayaran berhasil, tunggu confirm dari admin
                                                @elseif($pesanan->status == 3)
                                                    Barang sudah di confirm oleh admin
                                                @elseif($pesanan->status == 4)
                                                    Lihat hasil gambar produk anda
                                                @elseif($pesanan->status == 5)
                                                    Barang anda sudah dikirim, lihat detail pengiriman
                                                @endif
                                            </td>
                                            <td>Rp. {{ number_format($pesanan->jumlah_harga) }}</td>
                                            <td>
                                                <a href="{{ url('pesanan') }}\{{ $pesanan->id }}"
                                                    class="btn btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@extends('layouts.app_Coza')
@section('content')
<div class="bg0 m-t-15 p-b-50"></div>
@endsection
