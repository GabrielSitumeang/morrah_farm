@extends('layouts.app_LTE')

@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none">{{ $produk->nama_produk }}</h3>
                        <div class="col-12">
                            <img src="{{ url('productimage') }}/{{ $produk->gambar }}" height="600px"
                                alt="Product Image">
                        </div>
                        <div class="col-12 product-image-thumbs">
                            {{-- <div class="product-image-thumb active">
                                <img src="{{ url('productimage') }}/{{ $produk->gambar }}" alt="Product Image">
                            </div>
                            <div class="product-image-thumb">
                                <img src="assets/dist/img/prod-2.jpg" alt="Product Image">
                            </div>
                            <div class="product-image-thumb">
                                <img src="assets/dist/img/prod-3.jpg" alt="Product Image">
                            </div>
                            <div class="product-image-thumb">
                                <img src="assets/dist/img/prod-4.jpg" alt="Product Image">
                            </div>
                            <div class="product-image-thumb">
                                <img src="assets/dist/img/prod-5.jpg" alt="Product Image">
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">{{ $produk->nama_produk }}</h3>
                        <div class="rating">
                            <span class="text-warning h1">&#9733;</span>
                            <span class="text-warning h1">&#9733;</span>
                            <span class="text-warning h1">&#9733;</span>
                            <span class="text-warning h1">&#9733;</span>
                            <span class="text-warning h1">&#9733;</span>
                        </div>
                        <hr>
                        <h4 class="mt-3">
                            <small>Total Yang Terjual</small>
                        </h4>


                        <div class="bg-gray py-2 px-3 mt-4">
                            <h2 class="mb-0">
                                {{ $produk->formatRupiah('harga') }}
                            </h2>
                        </div>
                        <div class="mt-4 product-share">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                                Tambah gambar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc"
                                role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                            <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab"
                                href="#product-comments" role="tab" aria-controls="product-comments"
                                aria-selected="false">Penilaian User</a>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="product-desc" role="tabpanel"
                            aria-labelledby="product-desc-tab">
                            {{ $produk->keterangan }}
                        </div>

                        <div class="tab-pane fade" id="product-comments" role="tabpanel"
                            aria-labelledby="product-comments-tab">
                            @foreach ($reviews as $review)
                                <div class="card-body">
                                    <div class="media">
                                        <img src="{{ asset('profileFoto/' . ($review->user->foto ?? 'images/noimage.jpeg')) }}"
                                            class="mr-3 rounded-circle" alt="Foto Profil"
                                            style="width: 64px; height: 64px;">
                                        <div class="media-body">
                                            <h5 class="mt-0"> {{ $review->user->name }}</h5>
                                            <p class="date">Tanggal penilaian: {{ $review->created_at->format('d M Y') }}
                                                Jam
                                                {{ $review->created_at->format('H:i:s') }}</p>
                                            <div class="rating">
                                                @if ($review->rating)
                                                    @php
                                                        $user_rated = $review->rating;
                                                    @endphp
                                                    @for ($i = 1; $i <= $user_rated; $i++)
                                                        <span class="text-warning h4">&#9733;</span>
                                                    @endfor
                                                    @for ($j = $user_rated + 1; $j <= 5; $j++)
                                                        <span class="h4">&#9733;</span>
                                                    @endfor
                                                @endif
                                            </div>
                                            <p class="comment">{{ $review->komentar }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.product-image-thumb').on('click', function() {
                var $image_element = $(this).find('img')
                $('.product-image').prop('src', $image_element.attr('src'))
                $('.product-image-thumb.active').removeClass('active')
                $(this).addClass('active')
            })
        })
    </script>
    <script>
        let img = document.getElementById('imgchose');
        let input = document.getElementById('input');

        input.onchange = (e) => {
            if (input.files[0])
                img.src = URL.createObjectURL(input.files[0]);
        };
    </script>
@endsection
