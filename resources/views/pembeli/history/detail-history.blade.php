@extends('layouts.app_Coza')

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
                <a href="{{ url('history') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="col-md-12 mt-3">
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('pembeli.produk') }}">Produk</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('pembeli.keranjang') }}">Pesanan</a></li>
                            <li class="breadcrumb-item">History Detail Pemesanan</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="col-md-12">
                @if ($historyPesanan->status == 1)
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Checkout pesanan anda berhasil</h3>
                            <h5>Selanjutnya silahkan lakukan pembayaran melalui:</h5>
                            <table class="table">
                                <tr>
                                    <th>No Rekening BRI atas nama Morrah Farm</th>
                                    <td><strong><b>12345678910</b></strong></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Pembayaran</th>
                                    <td><strong>Rp. {{ number_format($historyPesanan->jumlah_harga + $historyPesanan->ongkir->ongkos) }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Kode pemesanan anda</th>
                                    <td><strong>{{ $historyPesanan->kode }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endif
                <div class="card mt-2">
                    <div class="card-header">
                        <h4><i class="fa fa-shopping-cart"></i> Detail Pemesanan</h4>
                        @if (!empty($historyPesanan))
                            <p class="text-end">Tanggal Pesan : {{ $historyPesanan->tanggal }}</p>
                            @if ($historyPesanan->status == 1)
                                <p class="text-end text-danger">*setelah melakukan pembayaran, silahkan upload bukti
                                    pembayaran dibawah ini</p>
                            @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th style="width: 120px">Total Harga</th>
                                </tr>
                                <?php
                                $no = 1;
                                ?>
                                @foreach ($historyDetailPesanan as $pesanan_detail)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <img src="{{ url('productimage') }}/{{ $pesanan_detail->produk->gambar }}"
                                                style="width: 100px; height:100px;" class="card-img-top"
                                                alt="product image" />
                                        </td>
                                        <td>{{ $pesanan_detail->produk->nama_produk }}</td>
                                        <td>{{ $pesanan_detail->jumlah }} buah</td>
                                        <td>Rp. {{ number_format($pesanan_detail->produk->harga) }}</td>
                                        <td>Rp. {{ number_format($pesanan_detail->jumlah_harga + $historyPesanan->ongkir->ongkos) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" class="text-end" colspan="5"><strong>Ongkos Kirim :</strong></td>
                                    <td><strong>Rp. {{ number_format($pesanan_detail->ongkir->ongkos) }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-end" colspan="5"><strong>Total Harga Pesanan:</strong></td>
                                    <td><strong>Rp. {{ number_format($historyPesanan->jumlah_harga) }}</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-end" colspan="5"><strong>Total Pembayaran :</strong>
                                    </td>
                                    <td><strong>Rp. {{ number_format($historyPesanan->jumlah_harga + $historyPesanan->ongkir->ongkos) }}</strong></td>
                                    @if ($historyPesanan->status == 1)
                                        <td><strong><a href="{{ url('/upload/' . $historyPesanan->id) }}"><button
                                                        class="btn btn-secondary">Upload</button></a></strong></td>
                                    @else
                                        <td><strong><button class="btn btn-success"
                                                    disabled><b>Finished</b></button></strong></td>
                                    @endif
                                </tr>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
