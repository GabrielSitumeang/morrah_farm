@extends('layouts.produksi')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1 class="text-center">  {{ $title }}</h1>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
                <a href="{{ route('laporan-inventori.create') }}">
                    <button type="button" class="btn btn-primary btn-sm"><i
                            class="fa-sharp fa-solid fa-user-plus"></i>Laporkan Hasil Produksi</button></a>
                <div class="mt-3"></div>
                <div class="row">
                    @foreach ($production_reports as $laporan_produksi)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>{{ $laporan_produksi->nama_pelapor }}</b></h2>
                                            <p class="text-muted text-sm"><b>Nama Pelapor: </b>{{ $laporan_produksi->nama_pelapor }}</p>
                                            <p class="text-muted text-sm"><b>Tanggal Melapor: </b>{{ $laporan_produksi->tanggal }}
                                            <p class="text-muted text-sm"><b>Nama Produk:  </b>{{ $laporan_produksi->nama_produk }}</p>
                                            <p class="text-muted text-sm"><b>Jumlah Hasil Produksi:  </b>{{ $laporan_produksi->jumlah }}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">


                                        {!! Form::open([
                                            'route' => ['laporan-inventori.destroy', $laporan_produksi->id],
                                            'method' => 'DELETE',
                                        ]) !!}
                                        <a href="{{ route('laporan-inventori.edit', $laporan_produksi->id) }}"
                                            class="btn btn-success btn-sm text-center"><i class="fas fa-edit"></i></a>

                                        {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm text-center btndelete', 'id' => 'delete']) }}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection


