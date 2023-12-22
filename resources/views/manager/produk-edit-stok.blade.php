@extends('layouts.app_LTE')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Stok</h3>
                    </div>
                    {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_produk">Nama Barang</label>
                            {!! Form::text('nama_produk', null, ['class' => 'form-control', 'autofocus', 'readonly' => 'readonly']) !!}
                            <span class="text-danger">{{ $errors->first('nama_produk') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            {!! Form::number('harga', null, ['class' => 'form-control rupiah', 'readonly' => 'readonly']) !!}
                            <span class="text-danger">{{ $errors->first('harga') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Deskripsi</label>
                            {!! Form::textarea('keterangan', null, [
                                'class' => 'form-control',
                                'placeholder' => 'Masukkan Keterangan',
                                'rows' => 5,
                                'readonly' => 'readonly',
                            ]) !!}
                            <span class="text-danger">{{ $errors->first('keterangan') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="stok">Stok (stok > 5)</label>
                            {!! Form::number('stok', $model->stok->jumlah ?? null, ['class' => 'form-control', 'min' => 6]) !!}
                            <span class="text-danger">{{ $errors->first('stok') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="kadaluwarsa">Tanggal Kadaluwarsa</label>
                            {!! Form::date('kadaluwarsa', $model->stok->kadaluwarsa ?? null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                            <span class="text-danger">{{ $errors->first('kadaluwarsa') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="gambar">Gambar Produk </label>
                            <div>

                                <img src="{{ url('productimage') }}/{{ $model->gambar }}" alt="Gambar Produk saat ini">
                            </div>
                            <span class="text-danger">{{ $errors->first('gambar') }}</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        {!! Form::submit($button, ['class' => 'btn btn-primary btn-sm']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@endsection
