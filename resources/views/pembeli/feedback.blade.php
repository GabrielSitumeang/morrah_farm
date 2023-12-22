@extends('layouts.app_Coza')

@section('content')
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">
            <div class="flex-w flex-l-m filter-tope-group m-tb-10"></div>

            <div class="flex-w flex-c-m m-tb-10"></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <img src="productimage/{{ $feedback->produk->gambar }}" width="300px"
                            alt="productimage/{{ $feedback->produk->gambar }}">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mohon berikan ulasan terkait produk kami!</h5>
                        <form action="{{ route('berikan.ulasan.process', $feedback->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Email input -->
                            <div class="row">
                                <div class="col-6" style="position:relative">
                                    <label for="firstimg"><i class="fa-solid fa-camera text-center text-primary"
                                            style="font-size: 24px; border:1px solid rgb(30, 27, 238); padding:10px 65px 40px 65px; cursor: pointer; ">
                                            <p
                                                style="color: blue; position:absolute; bottom:-10px; left:20%; font-size:12px; font-family:'Times New Roman', Times, serif">
                                                Tambah Foto</p>
                                        </i></label>
                                    <input type="file" id="firstimg" name="img2"
                                        style="display:none;visibility:none;" onchange="getImage(this.value)"
                                        class="form-control" /><br>
                                    <div id="display-image"></div>
                                </div>
                                <div class="col-6" style="position:relative">
                                    <label for="firstvideo"><i class="fas fa-video text-center text-primary"
                                            style="font-size: 24px; border:1px solid rgb(30, 27, 238); padding:10px 65px 40px 65px; cursor: pointer; ">
                                            <p
                                                style="color: blue; position:absolute; bottom:-10px; left:20%; font-size:12px; font-family:'Times New Roman', Times, serif">
                                                Tambah Video</p>
                                        </i></label>
                                    <input type="file" id="firstvideo" name="video"
                                        style="display:none;visibility:none;" onchange="getImage(this.value)"
                                        class="form-control" /><br>
                                    <div id="display-image" style="display: none;"></div>
                                </div>
                            </div>
                            <!-- Password input -->
                            <label class="form-label" for="form2Example2">Ulasan</label>
                            <div class="form-outline mb-4">
                                <textarea name="review" id="" cols="50" rows="7" style="resize: none;"></textarea>
                                @error('review')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
        integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
        function getImage(imagename) {
            var newimg = imagename.replace(/^.*\\/, "")
            $('#display-image').html(newimg);
        }
    </script>
@endsection
