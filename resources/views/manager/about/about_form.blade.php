@extends('layouts.app_LTE')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create About</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul</label>
                            <input name="judul" type="text" class="form-control" id="exampleInputEmail1"
                                placeholder="Judul About">
                        </div>
                        <div class="form-group">
                            <label for="isi">Isi</label>
                            <textarea name="isi" id="isi" class="form-control" rows="6" required></textarea>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Gambar (*resolusi gambar harus berukuran 1200 x 1200)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
