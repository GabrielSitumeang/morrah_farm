@extends('layouts.app_Coza')
@section('content')
    <div class="bg0 m-t-15 p-b-50"></div>
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="slick3 gallery-lb">
                                <div class="item-slick3" data-thumb="{{ url('productimage') }}/{{ $produk->gambar }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ url('productimage') }}/{{ $produk->gambar }}" alt="IMG-PRODUCT">
                                        {{-- <a class="flex-c-m size-108 how-pos0 bor1 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="assetuser/images/product-detail-01.jpg">
                                            <i class="fa fa-expand"></i>
                                        </a> --}}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $produk->nama_produk }}
                        </h4>
                        <div class="flex-w">
                            <span class="fs-25 cl11">
                                <a href="" class="cl11">{{ $rating_value }}</a>
                                @php $ratenum = number_format($rating_value) @endphp
                                @for ($i = 1; $i <= $ratenum; $i++)
                                    <i class="zmdi zmdi-star"></i>
                                @endfor
                                @for ($j = $ratenum + 1; $j <= 5; $j++)
                                    <i class="zmdi zmdi-star-outline"></i>
                                @endfor
                            </span>
                            <span class="mt-2">
                                @if ($ratings->count() > 0)
                                    <span class="flex-y ml-2">|</span>
                                    {{ $ratings->count() }} Penilaian
                                @else
                                    <span class="flex-y ml-2">|</span>
                                    <span class="flex-y">Tidak ada penilaian</span>
                                @endif
                            </span>
                            <span class="mt-2 ml-2">|</span>
                            <span class="mt-2 ml-2">{{ $jumlahTerjual }} Terjual</span>
                        </div>
                        <span class="mtext-106 cl2">
                            {{ formatRupiah($produk->harga) }}
                        </span> <br>
                        <span class="mtext-102 cl3 p-t-23">
                            Stok : {{ $produk->stok->jumlah }}
                        </span> <br>
                        <span class="mtext-102 cl3 p-t-23">
                            Tanggal Kadaluwarsa : {{ $produk->stok->kadaluwarsa }}
                        </span>
                        <!--  -->
                        <form action="{{ url('/pesan-process/' . $produk->id) }}" method="POST">
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Jumlah
                                    </div>
                                    <div class="size-204 respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>
                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="jumlah_pesan" value="1" required>
                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Alamat
                                    </div>
                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="address" onchange="updateShippingCost(this)">
                                                <option value="">Pilih Alamat Pengiriman</option>
                                                @foreach ($ongkirs as $ongkir)
                                                    <option data-ongkos="{{ $ongkir->ongkos }}">{{ $ongkir->lokasi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Ongkos Kirim
                                    </div>
                                    <div class="size-204 respon6-next">
                                        <p id="shipping-cost"><b>Rp0</b> </p>
                                    </div>
                                </div>
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        @if (Auth::user())
                                            <div class="row mt-5">
                                                <div class="col-6">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-primary mr-2"><i
                                                            class="zmdi zmdi-shopping-cart"></i>Masukkan Keranjang</button>
                                                </div>
                                                <div class="col-6">
                                                    <button class="btn btn-success js-show-modal1 mr-2">
                                                        Beri Penilaian
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row mt-3">
                                                <div class="col-6">
                                                    <a href="{{ route('login') }}" class="btn btn-outline-primary mr-2">
                                                        <i class="zmdi zmdi-shopping-cart"></i>Masukkan Keranjang
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <a href="{{ route('login') }}" class="btn btn-success ml-2">
                                                        Beri Penilaian
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <!-- - -->
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <p class="stext-102 cl6">
                                {{ $produk->keterangan }}
                            </p>
                        </div>
                    </div>
                    <!-- - -->
                </div>
            </div>
        </div>
        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab01 -->
            <div class="tab01">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <h1>Penilaian Produk</h1>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content p-t-43">
                    <div class="tab-pane fade show active" role="tabpanel">
                        <div class="how-pos2 p-lr-15-md">
                            <!-- Review -->
                            @foreach ($reviews as $review)
                                <div class="flex-w flex-t p-b-68">
                                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
                                        <img src="{{ asset('profileFoto/' . ($review->user->foto ?? 'images/noimage.jpeg')) }}"
                                            alt="AVATAR">
                                    </div>
                                    <div class="size-207">
                                        <div class="flex-w flex-sb-m">
                                            <span class="mtext-107 cl2 p-r-20">
                                                {{ $review->user->name }}
                                                @if ($review->user_id == Auth::id())
                                                    | <a href="" class="js-show-modal1">edit</a>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="flex-w flex-sb-m">
                                            <span class="fs-18 cl11">
                                                @if ($review->rating)
                                                    @php
                                                        $user_rated = $review->rating;
                                                    @endphp
                                                    @for ($i = 1; $i <= $user_rated; $i++)
                                                        <i class="zmdi zmdi-star"></i>
                                                    @endfor
                                                    @for ($j = $user_rated + 1; $j <= 5; $j++)
                                                        <i class="zmdi zmdi-star-outline"></i>
                                                    @endfor
                                                @endif
                                            </span>
                                        </div>
                                        <div>
                                            <p>dinilai tanggal : {{ $review->created_at->format('d M Y') }} Jam
                                                {{ $review->created_at->format('H:i:s') }}</p>
                                        </div>
                                        <p class="stext-102 cl6 mt-3">
                                            {{ $review->komentar }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Modal1 -->
    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
        <div class="overlay-modal1 js-hide-modal1"></div>
        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="assetuser/images/icons/icon-close.png" alt="CLOSE">
                </button>
                <div class="tab-pane ">
                    <div class="row">
                        <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                            <div class="p-b-30 m-lr-15-sm">
                                <!-- Add review -->
                                <form class="w-full" action="{{ url('/add-rating') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                    <h5 class="mtext-108 cl2 p-b-7">
                                        Komentar Anda sangat berharga bagi
                                        kami
                                    </h5>
                                    <div class="flex-w flex-m p-t-50 p-b-23">
                                        <span class="stext-102 cl3 m-r-16">
                                            Berikan Rating
                                        </span>
                                        <span class="wrap-rating fs-25 cl11 pointer">
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <i class="item-rating pointer zmdi zmdi-star-outline"></i>
                                            <input class="dis-none" type="number" name="rating" required>
                                        </span>
                                    </div>
                                    <div class="row p-b-25">
                                        <div class="col-12 p-b-5">
                                            <label class="stext-102 cl3" for="review">Komentar
                                                Anda</label>
                                            <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="komentar"
                                                placeholder="Berikan Komentar anda di sini" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        Kirim
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(angka);
        }

        function updateShippingCost(select) {
            var selectedOption = select.options[select.selectedIndex];
            var shippingCost = selectedOption.getAttribute('data-ongkos');
            var formattedShippingCost = formatRupiah(shippingCost);
            document.getElementById('shipping-cost').innerHTML = '<strong>' + formattedShippingCost + '</strong>';
        }
    </script>

    <style>
        #shipping-cost strong {
            font-weight: bold;
        }
    </style>
@endsection
