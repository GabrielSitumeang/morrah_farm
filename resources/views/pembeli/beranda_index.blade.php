@extends('layouts.app_Coza')

@section('content')
    <!-- Slider -->
    {{-- <section class="section-slide">
        <div class="wrap-slick1 rs2-slick1">
            <div class="slick1">
                @foreach ($sliders as $slider)
                    <div class="item-slick1 bg-overlay1"
                        style="background-image: url({{ asset('images/' . $slider->gambar) }}"
                        alt="{{ $slider->nama_slider }} );" data-thumb="{{ asset('images/' . $slider->gambar) }}"
                        alt="{{ $slider->nama_slider }}">
                        <div class="container h-full">
                            <div class="flex-col-c-m h-full p-t-100 p-b-60 respon5">
                                <div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
                                    <span class="ltext-202 txt-center cl0 respon2">
                                        {{ $slider->nama_slider }}
                                    </span>
                                </div>
                                <div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn"
                                    data-delay="800">
                                    <h2 class="ltext-104 txt-center cl0 p-t-22 p-b-40 respon1">
                                        {{ $slider->deskripsi }}
                                    </h2>
                                </div>
                                <div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
                                    @if (Auth::user())
                                        <a href="{{ route('pembeli.produk') }}"
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                                            Shop Now
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                                            Shop Now
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="wrap-slick1-dots p-lr-10"></div>
        </div>
    </section>
    <!-- Banner -->
    <div class="sec-banner bg0 p-t-95 p-b-55">
        <div class="container">
            <div class="row">
                <div class="col-md-6 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="assetuser/images/bg.jpg" alt="IMG-BANNER">
                        <a href="{{ route('pembeli.produk') }}"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Susu
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    Terbaru
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Beli
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-6 p-b-30 m-lr-auto">
                    <!-- Block1 -->
                    <div class="block1 wrap-pic-w">
                        <img src="assetuser/images/dadih.jpg" alt="IMG-BANNER">

                        <a href="product.html"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Yogurt
                                </span>

                                <span class="block1-info stext-102 trans-04">
                                    Terbaru
                                </span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Beli
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10 mb-5">
                <h3 class="ltext-103 cl5">
                    Testimoni
                </h3>
            </div>
            <!-- Review -->
            @foreach ($reviews as $review)
                <div class="flex-w flex-t p-b-68">
                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-3">
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
                        <div class="flex-w">
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
                        <p class="stext-102 cl5 mt-1">
                            {{ $review->komentar }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </section> --}}
    <!-- Hero Section Begin -->
    <div class="bg0 m-t-15 p-b-60"></div>
    <section class="hero">
        <div class="hero__slider owl-carousel">
            <div class="hero__item">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 p-0">
                            <div class="hero__inside__item hero__inside__item--wide set-bg"
                                data-setbg="assetuser/images/dadih.jpg">
                                <div class="hero__inside__item__text">

                                    <div class="hero__inside__item--text">

                                        <h4>Vegan White Peach Mug Cobbler With CardamomVegan
                                            <br>
                                            White Peach Mug
                                            Cobbler With Cardamom
                                        </h4>
                                        <ul class="widget">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6  p-0">
                            <div class="hero__inside__item hero__inside__item--small set-bg"
                                data-setbg="assetuser/images/login.jpg">
                                <div class="hero__inside__item__text">

                                    <div class="hero__inside__item--text">

                                        <h5>How to Make a Milkshake With Any
                                            <br>Ice Cream, Any Toppings...
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="hero__inside__item hero__inside__item--small set-bg"
                                data-setbg="assetuser/images/susu-02.jpg">
                                <div class="hero__inside__item__text">

                                    <div class="hero__inside__item--text">

                                        <h5>Vintage Copper Preserve Pan with
                                            <br>Brass Handles, Mid 19th Century
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6  p-0">
                            <div class="hero__inside__item set-bg" data-setbg="assetuser/images/cokelat.jpg">
                                <div class="hero__inside__item__text">

                                    <div class="hero__inside__item--text">

                                        <h5>Marinated Lentil Salad with Zucch
                                            <br>ini and Tomatoes
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero__item">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 p-0">
                            <div class="hero__inside__item hero__inside__item--wide set-bg"
                                data-setbg="assetuser/images/dadih-2.jpg">
                                <div class="hero__inside__item__text">

                                    <div class="hero__inside__item--text">

                                        <h4>Vegan White Peach Mug Cobbler With CardamomVegan
                                            <br>
                                            White Peach Mug
                                            Cobbler With Cardamom
                                        </h4>
                                        <ul class="widget">

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 p-0">
                            <div class="hero__inside__item hero__inside__item--small set-bg"
                                data-setbg="assetuser/images/morrahdadi.jpg">
                                <div class="hero__inside__item__text">

                                    <div class="hero__inside__item--text">

                                        <h5>How to Make a Milkshake With Any
                                            <br>Ice Cream, Any Toppings...
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="hero__inside__item hero__inside__item--small set-bg"
                                data-setbg="assetuser/images/login.jpg">
                                <div class="hero__inside__item__text">

                                    <div class="hero__inside__item--text">

                                        <h5>Vintage Copper Preserve Pan with
                                            <br>Brass Handles, Mid 19th Century
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 p-0">
                            <div class="hero__inside__item set-bg" data-setbg="assetuser/images/original.jpg">
                                <div class="hero__inside__item__text">

                                    <div class="hero__inside__item--text">

                                        <h5>Marinated Lentil Salad with Zucch
                                            <br>ini and Tomatoes
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10 mb-5">
                <h3 class="ltext-103 cl5">
                    Testimoni
                </h3>
            </div>
            <!-- Review -->
            @foreach ($reviews as $review)
                <div class="flex-w flex-t p-b-68">
                    <div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-3">
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
                        <div class="flex-w">
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
                        <p class="stext-102 cl5 mt-1">
                            {{ $review->komentar }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
@section('js')
    <script src="assetuser/javascript/jquery-3.3.1.min.js"></script>
    <script src="assetuser/javascript/bootstrap.min.js"></script>
    <script src="assetuser/javascript/jquery.slicknav.js"></script>
    <script src="assetuser/javascript/owl.carousel.min.js"></script>
    <script src="assetuser/javascript/main.js"></script>
@endsection
@section('css')
    <link rel="stylesheet" href="assetuser/style/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assetuser/style/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assetuser/style/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="assetuser/style/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="assetuser/style/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="assetuser/style/style.css" type="text/css">
@endsection
