@extends('layouts.app_Coza')

@section('content')
    @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Berikan Penilaian</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('ratings.store', ['product' => $produk->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="rating">Rating</label>
                                <select name="rating" id="rating"
                                    class="form-control @error('rating') is-invalid @enderror">
                                    <option value="">Pilih Rating</option>
                                    <option value="1"{{ old('rating') == '1' ? ' selected' : '' }}>1 Bintang</option>
                                    <option value="2"{{ old('rating') == '2' ? ' selected' : '' }}>2 Bintang</option>
                                    <option value="3"{{ old('rating') == '3' ? ' selected' : '' }}>3 Bintang</option>
                                    <option value="4"{{ old('rating') == '4' ? ' selected' : '' }}>4 Bintang</option>
                                    <option value="5"{{ old('rating') == '5' ? ' selected' : '' }}>5 Bintang</option>
                                </select>
                                @error('rating')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="comment">Komentar</label>
                                <textarea name="comment" id="comment" class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="photo">Unggah Foto</label>
                                <input type="file" name="photo" id="photo"
                                    class="form-control-file @error('photo') is-invalid @enderror">
                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@endsection
