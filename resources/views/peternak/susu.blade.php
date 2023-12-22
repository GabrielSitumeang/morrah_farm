@extends('layouts.peternak')


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h4 class="card-header text-center"><strong>Laporan Data Susu Harian</strong></h4>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <a href="{{ route('user.create') }}"><button type="button"
                                                class="btn btn-primary btn-block btn-sm">
                                                <i class="fa-solid fa-user-plus"></i>Laporan Susu</button></a>
                                    </div>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 200px;">
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap text-center">
                                        <thead class="text-center">
                                            <tr class="text-center">
                                                <th class="text-center">Pelapor</th>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Jumlah Susu</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                               
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
