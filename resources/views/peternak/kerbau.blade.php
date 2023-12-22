@extends('layouts.peternak')


@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h4 class="card-header text-center"><strong>Laporan Data Kerbau Jantan</strong></h4>
                <!-- <div class="col-md-3">
                    <label>Start Date:</label>
                    <input type="date" name="start_date" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>End Date:</label>
                    <input type="date" name="end_date" class="form-control">
                </div> -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <a href="{{ route('user.create') }}"><button type="button"
                                                class="btn btn-primary btn-block btn-sm">
                                                <i class="fa-solid fa-user-plus"></i>Laporkan kerbau jantan</button></a>
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
                                                <th class="text-center">Jumlah Kerbau</th>
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
