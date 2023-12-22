@extends('layouts.app_LTE')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <form action="{{ route('blog.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul</label>
                            <input type="text" class="form-control" name="judul" value="{{ $blog->judul }}" required>
                        </div>

                        <div class="form-group">
                            <label for="isi">Isi</label>
                            <textarea rows="5" name="isi" id="isi" class="form-control" required>{{ $blog->isi }}</textarea>
                        </div>
                        @if ($blog->gambar)
                            <div class="form-group">
                                <label>Gambar saat ini:</label>
                                <img src="{{ url('blogFotos') }}/{{ $blog->gambar }}" alt="Gambar"
                                    style="max-width: 100px;">
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="exampleInputFile">Gambar</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="gambar" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Pilih Gambar</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
