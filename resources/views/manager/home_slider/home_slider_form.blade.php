@extends('layouts.app_LTE')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tambah Slider</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('home-sliders.update', $homSlider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Slider</label>
                            <input name="nama_slider" type="text" value="{{ $homSlider->nama_slider }}" class="form-control" id="exampleInputEmail1"
                                placeholder="Nama Slider">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Deskripsi</label>
                            <input name="deskripsi" type="text" value="{{ $homSlider->deskripsi }}" class="form-control" id="exampleInputPassword1"
                                placeholder="Deksirpis Singkat">
                        </div>

                        <div class="form-group">
                            <label for="gambar">Gambar lama:</label>
                            <img src="{{ asset('images/' . $homSlider->gambar) }}" alt="{{ $homSlider->nama_slider }}"
                                height="100" width="100">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Gambar (*resolusi gambar harus berukuran 1920 x 930)</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="gambar">
                                    <label class="custom-file-label" for="exampleInputFile">Klik Untuk memilih gambar</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
