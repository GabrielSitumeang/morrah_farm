@extends('layouts.app_LTE')

@section('content')
    {{-- <div class="container">
        <h1>Tambah Tugas Karyawan </h1>
        <form action="{{ route('tugas.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama-tugas">Tugas</label>
                <input type="text" name="nama_tugas" id="nama_tugas" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required></textarea>
            </div>
            <!-- <div class="form-group">
                <label for="ga">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control" required>
            </div> -->
            <!-- Tambahkan field-field lain sesuai kebutuhan -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('tugas.manager') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div> --}}

    <div class="row">
        <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Tugas Karyawan</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('tugas.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_tugas">Tugas</label>
                            <input type="text" name="nama_tugas" id="nama_tugas" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4" required></textarea>

                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputFile">Gambar (*resolusi gambar harus berukuran 1200 x 837)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('tugas.manager') }}" class="btn btn-secondary">Kembali</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
