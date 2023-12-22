@extends('layouts.app_LTE')
@section('content')
    <div class="container">
        <h1>Tambah Ongkos Kirim</h1>
        <form action="{{ route('ongkir.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="ongkos">Harga Ongkos Kirim</label>
                <input type="number" name="ongkos" id="ongkos" class="form-control" required></input>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('ongkir.manager') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection