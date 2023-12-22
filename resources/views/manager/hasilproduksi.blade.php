@extends('layouts.app_LTE')
@section('content')
    <h1>{{ $title }}</h1>
    <div class="col-md-12">
        <form action="{{ route('laporan-produksi.search') }}" method="GET">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cari Tanggal</h3>
                </div>
                <div class="card-body">
                    <!-- Date -->
                    <div class="form-group">
                        <label>Date:</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="date" id="bulan" name="date" class="form-control">

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Laporan Hasil Produksi</h1>
            </div>
            <div class="card-body p-0">

                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Nama Pelapor</th>
                            <th>Tanggal Melapor</th>
                            <th>Nama Produk</th>
                            <th>Jumlah Hasil Produksi:</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if ($production_report->isEmpty())
                            <tr>
                                <td colspan="3">Tidak ada data yang ditemukan.</td>
                            </tr>
                        @else
                            @foreach ($production_report as $production_report)
                                <tr>
                                    <td>{{ $production_report->nama_pelapor }}</td>
                                    <td>{{ $production_report->tanggal }}</td>
                                    <td>{{ $production_report->nama_produk }}</td>
                                    <td>{{ $production_report->jumlah }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
@endsection