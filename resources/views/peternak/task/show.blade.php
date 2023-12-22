@extends('layouts.peternak')
@section('content')
    <div class="container-fluid">
        <h1 class="text-center">Detail Tugas Karyawan</h1>
    </div><!-- /.container-fluid -->

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <!-- <a href="{{ route('tugas.create') }}">
                <button type="button" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-user-plus"></i>Tambah Tugas Karyawan</button></a> -->
            <div class="mt-3"></div>
            <div class="row">
                
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr class="text-center">
                                <th>Tugas</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Gambar</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                                <tr>
                                    <td>{{ $task->nama_tugas}}</td>
                                    <td>{{ $task->deskripsi }}</td>
                                    <td>{{ $task->tanggal }}</td>
                                    <td align="center"><img src="{{ url('blogFotos') }}/{{ $task->gambar }}" alt="Blog-img"
                                            class="img img-fluid" height="115px" width="195px"></td>
                                    
                                </tr>
                        </tbody>

                    </table>
                </div>
                <!-- /.card-body -->

            </div>
        </div>
    </div>
@endsection


