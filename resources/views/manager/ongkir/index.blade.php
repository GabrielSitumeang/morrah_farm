@extends('layouts.app_LTE')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h4 class="card-header text-center"><strong>Data Ongkos Kirim Morrah Farm</strong></h4>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <a href="{{ route('ongkir.create') }}"><button type="button"
                                                class="btn btn-primary btn-block btn-sm">
                                                <i class="fa-solid fa-plus"></i>Tambah Ongkos</button></a>
                                    </div>
                                    <div class="card-tools">
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap text-center">
                                        <thead class="text-center">
                                            <tr class="text-center">
                                                <th class="text-center">No</th>
                                                <th class="text-center">Lokasi</th>
                                                <th class="text-center">Harga Ongkos</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($ongkirs as $ongkir)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $ongkir->lokasi }}</td>
                                                    <td>{{ $ongkir->formatRupiah('ongkos') }}</td>
                                                    <td class="text-center">
                                                        {!! Form::open([
                                                            'route' => ['ongkir.delete', $ongkir->id],
                                                            'method' => 'DELETE',
                                                        ]) !!}
                                                        <a href="{{ route('ongkir.edit', $ongkir->id) }}"
                                                            class="btn btn-success btn-sm text-center">
                                                            <i class="fas fa-edit"></i>
                                                        </a>

                                                        {{ Form::button('<i class="fa fa-trash"></i>', [
                                                            'type' => 'submit',
                                                            'class' => 'btn btn-danger btn-sm text-center btndelete',
                                                            'id' => 'delete',
                                                            'onclick' => "return confirm('Yakin ingin menghapus data ini?');",
                                                        ]) }}
                                                        {!! Form::close() !!}
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">
                                                        <h3>Data ongkos kirim Tidak ada</h3>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
