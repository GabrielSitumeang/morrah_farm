@extends('layouts.app_LTE')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <form action="{{ route('tugas.update', $tugas->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tugas</label>
                            <input type="text" class="form-control" name="nama_tugas" value="{{ $tugas->nama_tugas }}" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea rows="5" name="deskripsi" id="deskripsi" class="form-control" required>{{ $tugas->deskripsi }}</textarea>
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
