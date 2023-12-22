@extends('layouts.app_LTE')

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
                                            <p class="text-muted text-sm"><b>Stok: </b>{{ $produk->stok->jumlah }}</p>
                                            @if ($selisiTanggal[$produk->id] < 3)
                                                <p class="text-danger text-sm">
                                                    <b>Kadaluwarsa: </b>{{ $produk->stok->kadaluwarsa }}
                                                    ({{ $selisiTanggal[$produk->id] }} Hari)
                                                </p>
                                            @else
                                                <p class="text-muted text-sm">
                                                    <b>Kadaluwarsa: </b>{{ $produk->stok->kadaluwarsa }}
                                                    ({{ $selisiTanggal[$produk->id] }} Hari)
                                                </p>
                                            @endif
                                            <p class="text-muted text-sm"><b>Harga: </b>{{ $produk->formatRupiah('harga') }}
                                            </p>
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
                                            'id' => 'deleteproduk',
                                        ]) !!}
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route($routePrefix . '.show', $produk->id) }}">
                                            <i class="fa-solid fa-eye"></i></a>
                                        <a href="{{ route('produk.edit', $produk->id) }}"
                                            class="btn btn-success btn-sm text-center">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        {{ Form::button('<i class="fa fa-trash"></i>', [
                                            'type' => 'submit',
                                            'class' => 'btn btn-danger btn-sm text-center btndelete',
                                            'id' => 'delete',
                                        ]) }}
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
@section('script')
    <script type="text/javascript">
        $(function() {
            $(document).on('submit', '#deleteproduk', function(e) {
                e.preventDefault();
                var form = $(this);
                var link = form.attr("action");

                Swal.fire({
                    title: 'Anda Yakin Menghapus?',
                    text: "Anda tidak bisa mengembalikan file data ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: link,
                            type: 'POST',
                            data: {
                                '_method': 'DELETE',
                                '_token': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred while deleting the file.',
                                    'error'
                                );
                            }
                        });
                    }
                })
            });
        });
    </script>
@endsection
