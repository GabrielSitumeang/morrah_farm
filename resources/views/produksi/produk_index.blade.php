@extends('layouts.produksi')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1 class="text-center">{{ $title }}</h1>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body pb-0">
                <a href="{{ route($routePrefix . '.create') }}">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-user-plus"></i>Tambah
                        Produk</button></a>
                <div class="mt-3"></div>
                <div class="row">
                    @foreach ($produks as $produk)
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <div class="card bg-light d-flex flex-fill">
                                <div class="card-header text-muted border-bottom-0">
                                </div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>{{ $produk->nama_produk }}</b></h2>
                                            <p class="text-muted text-sm"><b>Deskripsi: </b>{{ $produk->keterangan }}</p>
                                            <p class="text-muted text-sm"><b>Stok: </b>{{ $produk->stok }}</p>
                                            <p class="text-muted text-sm"><b>Harga: </b>{{ $produk->harga }}</p>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="{{ url('productimage') }}/{{ $produk->gambar }}" alt="Produk-img"
                                                class="img img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">


                                        {!! Form::open([
                                            'route' => ['produk.destroy', $produk->id],
                                            'method' => 'DELETE',
                                        ]) !!}
                                        <a href="{{ route('produk.edit', $produk->id) }}"
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
