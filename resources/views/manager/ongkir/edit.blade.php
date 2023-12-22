@extends('layouts.app_LTE')

@section('content')
    <div class="container">
        <h1>Edit Ongkos Kirim</h1>
        <form action="{{ route('ongkir.update', $ongkirs->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $ongkirs->lokasi }}">
            </div>
            <div class="form-group">
                <label for="ongkos">Ongkos Kirim</label>
                <input type="number" class="form-control" id="ongkos" name="ongkos" value="{{ $ongkirs->ongkos }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
