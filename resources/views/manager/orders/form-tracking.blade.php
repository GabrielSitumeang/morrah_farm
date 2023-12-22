@extends('layouts.app_LTE')

@section('content')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <form class="needs-validation" novalidate="">
                    <div class="card-header">
                        <h4>Data Order</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nama :</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $dataFormTracking->user->name }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kode Pesanan :</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" value="{{ $dataFormTracking->kode }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Harga :</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control"
                                    value="Rp.{{ number_format($dataFormTracking->jumlah_harga, 0, ',', '.') }}" disabled>
                            </div>
                        </div>
                        <div class="form-group mb-0 row">
                            <label class="col-sm-3 col-form-label">Message :</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" style="resize: none" disabled>{{ $dataFormTracking->address }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <form action="{{ route('form.tracking.process', $dataFormTracking->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h4>Form Order</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Pengirim</label>
                            <input type="text" name="nama_pengirim"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required="" placeholder="nama pengirim ...">
                            @error('record')
                                <div class="valid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>No. Telepon</label>
                            <input type="number" name="tlpn" class="form-control @error('tlpn') is-invalid @enderror"
                                value="{{ old('tlpn') }}" required="" placeholder="no. telepon ..." min="0">
                            @error('record')
                                <div class="valid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <p for="">Dikirim lewat: </p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="angkutan" id="flexRadioDefault1"
                                value="Angkutan Umum" checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Angkutan Umum
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="angkutan" id="flexRadioDefault2"
                                value="Kurir">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Kurir
                            </label>
                        </div>
                        <p class="text-danger">*jika menggunakan (Angkutan Umum) isi field dibawah ini! <br>
                            *jika field yang tidak terpakai, isi dengan tanda kurang (-)!
                        </p>
                        <div class="form-group">
                            <label>Jenis Kendaraan</label>
                            <input type="text" name="jenis" class="form-control @error('jenis') is-invalid @enderror"
                                value="{{ old('jenis') }}" required="" placeholder="Mis: KBT, Karya Agung, dll...">
                            @error('jenis')
                                <div class="valid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Plat Kendaraan</label>
                            <input type="text" name="plat" class="form-control @error('plat') is-invalid @enderror"
                                value="{{ old('plat') }}" required="" placeholder="Mis: BK 1234 EE">
                            @error('plat')
                                <div class="valid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <p class="text-danger">*jika menggunakan (Kurir) isi field dibawah ini! <br>
                            *jika field yang tidak terpakai, isi dengan tanda kurang (-)!
                        </p>
                        <div class="form-group">
                            <label>Kurir : </label>
                            <input type="text" name="kurir" class="form-control @error('kurir') is-invalid @enderror"
                                value="{{ old('kurir') }}" required="" placeholder="Mis: JNE/JNT/dll...">
                            @error('kurir')
                                <div class="valid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>No. Resi</label>
                            <input type="text" name="resi" class="form-control @error('resi') is-invalid @enderror"
                                value="{{ old('resi') }}" required="" placeholder="Mis: 12345678">
                            @error('resi')
                                <div class="valid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
