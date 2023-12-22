@extends('layouts.app_LTE')
@section('content')

    <div class="col-md-12">
        <form method="GET" action="" id="searchForm">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cari Tanggal Penjualan</h3>
                </div>
                <div class="card-body">
                    <!-- Date -->
                    <div class="form-group">
                        <label>Tanggal</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="date" id="bulan" name="bulan" class="form-control">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" onclick="validateForm()">Cari</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Laporan Penjualan</h1>
                {{-- <a href="{{ route('manager.cetaklaporan.index') }}" class="btn btn-primary float-right" target="_blank"><i class="fa-solid fa-print"></i>Download Laporan</a> --}}
            </div>
            <div class="card-body p-0 table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Tanggal</th>
                            <th>Nama Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah Terjual</th>
                            <th>Pendapatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporan as $item)
                            <tr class="text-center">
                                <td>{{ $item->bulan }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ formatRupiah($item->harga) }}</td>
                                <td>{{ $item->jumlah_terjual }} Buah</td>
                                <td>{{ formatRupiah($item->pendapatan) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <h2>Tidak Ada Data Penjualan </h2>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
    @section('script')
        <script>
            function validateForm() {
                var dateInput = document.getElementById('bulan').value;
                if (dateInput === '') {
                    alert('Masukkan tanggal terlebih dahulu pada bagian Tanggal');
                } else {
                    document.getElementById('searchForm').submit();
                }
            }
        </script>
    @endsection
