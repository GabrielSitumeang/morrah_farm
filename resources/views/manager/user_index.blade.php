@extends('layouts.app_LTE')


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h4 class="card-header text-center"><strong>Data Pegawai Morrah Farm</strong></h4>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <a href="{{ route('user.create') }}"><button type="button"
                                                class="btn btn-primary btn-block btn-sm">
                                                <i class="fa-solid fa-user-plus"></i>Tambah Pegawai</button></a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap text-center">
                                        <thead class="text-center">
                                            <tr class="text-center">
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">Nomor HandPhone</th>
                                                <th class="text-center">Email</th>
                                                <th class="text-center">Role User</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($models as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->nohp }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->role }}</td>
                                                    <td class="text-center">
                                                        @if ($item->role == 'manager')
                                                        @else
                                                            {!! Form::open([
                                                                'route' => ['user.destroy', $item->id],
                                                                'method' => 'DELETE',
                                                            ]) !!}
                                                            <a href="{{ route('user.edit', $item->id) }}"
                                                                class="btn btn-success btn-sm text-center"><i
                                                                    class="fas fa-edit"></i></a>

                                                            {{ Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm text-center btndelete', 'id' => 'delete']) }}
                                                            {!! Form::close() !!}
                                                        @endif
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">Data User Tidak ada</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {!! $models->links() !!}
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
