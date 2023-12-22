@extends('layouts.produksi')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Laporan Data Hasil Produksi</h3>
                    </div>
                    {!! Form::model($model, ['route' => $route, 'method' => $method, 'files' => true], ) !!}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Melapor</label>
                            {!! Form::date('tanggal', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('tanggal') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            {!! Form::text('nama_produk', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('nama_produk') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="jumlah">Jumlah Hasil Produksi</label>
                            {!! Form::number('jumlah', null, ['class' => 'form-control']) !!}
                            <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                        </div>

                    <div class="card-footer">
                        {!! Form::submit($button, ['class' => 'btn btn-primary btn-sm']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
@endsection
