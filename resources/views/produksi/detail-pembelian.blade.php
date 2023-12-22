@extends('layouts.produksi')

@section('content')
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Gambar</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
                <?php
                $no = 1;
                ?>
                @foreach ($detailPesanan as $pesananDetails)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ optional($pesananDetails->produk)->nama_produk }}</td>
                        <td><img style="width: 200px" src="productimage/{{ optional($pesananDetails->produk)->gambar }}"
                                alt="Foto Produk"></td>

                        <td>{{ $pesananDetails->jumlah }}</td>
                        <td>{{ $pesananDetails->jumlah_harga }} </td>
                    </tr>
                @endforeach
            </table>
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" onclick="goBack()">Kembali</button>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
