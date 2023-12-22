<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    <title>Morrah Farm </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="assetuser/images/logo2.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetuser/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="assetuser/css/all.min.css">
    @yield('css')
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetuser/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetuser/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetuser/fonts/linearicons-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetuser/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetuser/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetuser/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetuser/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetuser/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetuser/vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetuser/vendor/MagnificPopup/magnific-popup.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetuser/vendor/perfect-scrollbar/perfect-scrollbar.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="assetuser/css/util.css">
    <link rel="stylesheet" type="text/css" href="assetuser/css/main.css">
    <!--===============================================================================================-->
    <style>
        /* CSS untuk membuat peta responsif */
        #map-container {
            position: relative;
            width: 100%;
            padding-bottom: 40%;
            /* Perbandingan lebar dan tinggi 16:9 untuk mempertahankan aspek rasio peta */
        }

        #map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .account {
            list-style: none;
            margin: 0;
            padding: 0;
            position: absolute;
            z-index: 1101;
        }

        .account li {
            display: inline-block;
            position: relative;
        }

        .account li a {
            display: inline-block;
            padding: 10px;
            color: #333;
            text-decoration: none;
        }

        .account li a:hover {
            background: #f5f5f5;
        }

        .account li a img {
            vertical-align: middle;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .account li a span {
            vertical-align: middle;
        }

        .account li ul {
            position: absolute;
            top: 100%;
            left: 0;
            background: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            display: none;
        }

        .account li:hover ul {
            display: block;
        }

        .account li ul li {
            display: block;
            margin: 5px 0;
        }

        .account li ul li a {
            display: block;
            padding: 5px;
        }

        .xMDeox {
            position: relative;
            flex-grow: 1;
            width: 980px;
            box-sizing: border-box;
            margin-left: 1.6875rem;
            min-width: 0;
            background: #fff;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .13);
            border-radius: 0.125rem;
        }

        .modalCard {
            position: absolute;
            z-index: 1101;
        }
    </style>
</head>

<body class="animsition">

    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <!-- Topbar -->
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <div class="left-top-bar">
                        Free shipping for standard order over $100
                    </div>
                    <div class="right-top-bar flex-w h-full">
                        @if (Auth::user())
                            <div class="flex-c-m trans-04 p-lr-25">
                                <ul class="account">
                                    <li>
                                        <div>
                                            <img src="{{ asset('profileFoto/' . Auth::user()->foto) }}"
                                                class="img-circle elevation-2" width="20" alt="">
                                            <span>{{ Auth::user()->name }}</span>
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                        <ul>
                                            <li><a
                                                    href="{{ route('akun-pembeli.edit', ['id' => Auth::user()->id]) }}">Profile</a>
                                            </li>
                                            <li><a href="#">Settings</a></li>
                                            <li><a href="{{ route('logout') }}" class="flex-c-m trans-04 p-lr-25">
                                                    Log Out
                                                </a></li>
                                            <li><a href="#" class="flex-c-m trans-04 p-lr-25">
                                                    Help & FAQs
                                                </a></li>
                                        </ul>
                                    </li>

                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                                My Account
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="{{ route('pembeli.beranda') }}" class="logo">
                        <img src="assetuser/images/logo.png" alt="IMG-LOGO">
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li><a href="{{ route('pembeli.beranda') }}"
                                    class="{{ \Route::is('pembeli.beranda') ? 'active' : '' }}">Home</a></li>
                            <li>
                                <a href="{{ route('pembeli.produk') }}">Shop</a>
                            </li>
                            <li>
                                <a href="{{ route('pembeli.about') }}">About</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('pembeli.visimisi') }}">Visi & Misi</a></li>
                                    <li><a href="home-02.html">Penilaian</a></li>
                                    <li><a href="">Galeri</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('pembeli.blog') }}">Blog</a>
                            </li>
                            <li>
                                <a href="{{ route('pembeli.contact') }}">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>
                        @if (Auth::user())
                            <?php
                            $pesanan_utama = App\Models\Pesanan::where('user_id', Auth::user()->id)
                                ->where('status', 0)
                                ->first();
                            if (!empty($pesanan_utama)) {
                                $notif = App\Models\PesananDetail::where('pesanan_id', $pesanan_utama->id)->count();
                            }
                            ?>
                            @if (!empty($notif))
                                <a href="{{ route('pembeli.keranjang') }}">
                                    <div class="icon-header-item cl2 hov-cl2 trans-04 p-l-22 p-r-15 icon-header-noti"
                                        data-notify="{{ $notif }}">
                                        <i class="zmdi zmdi-shopping-cart"></i>
                                    </div>
                                </a>
                            @else
                                <a href="{{ route('pembeli.keranjang') }}">
                                    <div class="icon-header-item cl2 hov-cl2 trans-04 p-l-22 p-r-15 icon-header-noti"
                                        data-notify="0">
                                        <i class="zmdi zmdi-shopping-cart"></i>
                                    </div>
                                </a>
                            @endif
                            @php
                                $orders = \DB::table('pesanans')
                                    ->where('status', 3)
                                    ->where('user_id', Auth::user()->id)
                                    ->get();
                                $packing = \DB::table('pesanans')
                                    ->where('status', 4)
                                    ->where('user_id', Auth::user()->id)
                                    ->get();
                                $tracking = \DB::table('pesanans')
                                    ->where('status', 5)
                                    ->where('user_id', Auth::user()->id)
                                ->get(); @endphp
                            <div class="icon-header-item cl2 hov-cl2 trans-04 p-r-11 p-l-20 icon-header-noti js-show-cart"
                                data-notify="{{ count($orders) + count($packing) + count($tracking) }}">
                                <i class="zmdi zmdi-notifications"></i>
                            </div>

                            <li class="dropdown dropdown-list-toggle">
                                <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                                    <div class="dropdown-list-content dropdown-list-message">
                                        @foreach ($orders as $item)
                                            <a class="dropdown-item" href="{{ url('pesanan/' . $item->id) }}"
                                                class="dropdown-item dropdown-item-unread">{{ 'Pesanan anda dengan kode ' . $item->kode . ' sudah di confirm' }}</a>
                                        @endforeach
                                        @foreach ($packing as $item)
                                            <a class="dropdown-item" href="{{ url('pesanan/' . $item->id) }}"
                                                class="dropdown-item dropdown-item-unread">{{ 'Lihat hasil packingan barang anda' }}</a>
                                        @endforeach
                                        @foreach ($tracking as $item)
                                            <a class="dropdown-item" href="{{ url('pesanan/' . $item->id) }}"
                                                class="dropdown-item dropdown-item-unread">{{ 'Barang anda sudah di kirim, berikan penilaian jika sudah sampai' }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        @else
                            <a href="{{ route('login') }}"
                                class="dis-block icon-header-item cl2 hov-cl2 trans-04 p-l-10 p-r-11 icon-header-noti"
                                data-notify="0">
                                <i class="zmdi zmdi-shopping-cart"></i>

                            </a>

                            <a href="{{ route('login') }}">
                                <div class="icon-header-item cl2 hov-cl2 trans-04 p-l-10 p-r-11 icon-header-noti"
                                    data-notify="0">
                                    <i class="zmdi zmdi-notifications"></i>
                                </div>
                            </a>
                            <a href="{{ route('login') }}"
                                class="flex-c-m p-lr-10 trans-04 btn ml-2 mr-2 btn-success btn-sm">
                                <strong>Masuk</strong>
                            </a>
                            <a href="{{ route('register') }}"
                                class="flex-c-m p-lr-10 trans-04 btn mr-1 btn btn-outline-success btn-sm">
                                <strong>Daftar</strong>
                            </a>
                        @endif
                    </div>
                </nav>
            </div>
        </div>
        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="{{ route('pembeli.beranda') }}"><img src="assetuser/images/logo.png" alt="IMG-LOGO"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>
                @if (Auth::user())
                    <a href="{{ route('pembeli.keranjang') }}"
                        class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
                        data-notify="3">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </a>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                        data-notify="2">
                        <i class="zmdi zmdi-notifications"></i>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
                        data-notify="0">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </a>
                    <a href="{{ route('login') }}">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-10 p-r-11 icon-header-noti"
                            data-notify="0">
                            <i class="zmdi zmdi-notifications"></i>
                        </div>
                    </a>
                @endif

            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li>
                    <div class="left-top-bar">
                        Free shipping for standard order over $100
                    </div>
                </li>

                <li>

                    @if (Auth::user())
                        <div class="dropdown flex-c-m p-lr-10 trans-04">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ Auth::user()->foto }}" alt="user foto">
                                <span>{{ Auth::user()->name }}</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                <a class="dropdown-item" href="#">Profile</a>
                                <a class="dropdown-item" href="#">Settings</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                                <a href="#" class="dropdown-item">Help & FAQs</a>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="flex-c-m p-lr-10 mt-2 trans-04 btn mr-1 btn-success btn-sm">
                            Masuk
                        </a>

                        <a href="{{ route('register') }}"
                            class="flex-c-m p-lr-10 trans-04 btn mt-2 mr-1 btn btn-outline-success btn-sm">
                            Daftar
                        </a>
                    @endif

                </li>
            </ul>

            <ul class="main-menu-m">
                <li>
                    <a href="{{ route('pembeli.beranda') }}">Home</a>
                </li>

                <li>
                    <a href="{{ route('pembeli.produk') }}">Shop</a>
                </li>
                <li>
                    <a href="{{ route('pembeli.blog') }}">Blog</a>
                </li>

                <li>
                    <a href="{{ route('pembeli.about') }}">About</a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('pembeli.visimisi') }}">Visi & Misi</a></li>
                        <li><a href="">Galeri</a></li>
                        <li><a href="home-02.html">Penilaian</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('pembeli.contact') }}">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="assetuser/images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>
    <!-- Cart -->
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>
        @if (Auth::user())
            <div class="header-cart flex-col-l p-l-65 p-r-25">
                <div class="header-cart-title flex-w flex-sb-m p-b-8">
                    <span class="mtext-103 cl2">
                        Notifikasi
                    </span>

                    <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                        <i class="zmdi zmdi-close"></i>
                    </div>
                </div>
                <div class="header-cart-content flex-w js-pscroll">
                    <ul class="header-cart-wrapitem w-full">
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-txt p-t-8">
                                <span class="header-cart-item-info">

                                </span>
                            </div>
                        </li>
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="w-full">
                                @foreach ($orders as $item)
                                    <a class="dropdown-item" href="{{ url('pesanan/' . $item->id) }}"
                                        class="dropdown-item dropdown-item-unread">{{ 'Pesanan anda dengan kode ' . $item->kode . ' sudah di confirm' }}</a>
                                @endforeach
                                @foreach ($packing as $item)
                                    <a class="dropdown-item" href="{{ url('pesanan/' . $item->id) }}"
                                        class="dropdown-item dropdown-item-unread">{{ 'Lihat hasil packingan barang anda' }}</a>
                                @endforeach
                                @foreach ($tracking as $item)
                                    <a class="dropdown-item" href="{{ url('pesanan/' . $item->id) }}"
                                        class="dropdown-item dropdown-item-unread">{{ 'Barang anda sudah di kirim, berikan penilaian jika sudah sampai' }}</a>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        @else
        @endif
    </div>
    </div>
    </div>
    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>


    @yield('content')


    <!-- Footer -->
    <footer class="bg3 layout-footer-fixed">
        <div class="container">
            <div class="p-t-40">
                <div class="flex-c-m flex-w p-b-18">

                    <a href="#" class="m-all-1">
                        <img height="40" src="assetuser/images/icons/wa.png" alt="ICON-WA">
                    </a>
                    <a href="#" class="m-all-1">
                        <img height="35" src="assetuser/images/icons/fb.png" alt="ICON-FB">
                    </a>

                    <a href="#" class="m-all-1">
                        <img height="40" src="assetuser/images/icons/ig.png" alt="ICON-IG">
                    </a>

                </div>

                <p class="stext-107 cl6 txt-center">
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | Made with <i class="fa fa-heart-o"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> &amp;
                    distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

                </p>
            </div>
        </div>
    </footer>



    <!--===============================================================================================-->
    <script src="assetuser/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="assetuser/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="assetuser/vendor/bootstrap/js/popper.js"></script>
    <script src="assetuser/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="assetuser/vendor/select2/select2.min.js"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="assetuser/vendor/daterangepicker/moment.min.js"></script>
    <script src="assetuser/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="assetuser/vendor/slick/slick.min.js"></script>
    <script src="assetuser/js/slick-custom.js"></script>
    <!--===============================================================================================-->
    <script src="assetuser/vendor/parallax100/parallax100.js"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <!--===============================================================================================-->
    <script src="assetuser/vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="assetuser/vendor/isotope/isotope.pkgd.min.js"></script>
    <!--===============================================================================================-->
    <script src="assetuser/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script>
        document.getElementById('password').addEventListener('input', function() {
            var password = document.getElementById('password').value;
            var result = zxcvbn(password);
            var strengthMeter = document.getElementById('password-strength');

            var strength = {
                0: 'Very Weak',
                1: 'Weak',
                2: 'Fair',
                3: 'Strong',
                4: 'Very Strong'
            };

            var score = result.score;
            var feedback = result.feedback.warning || '';

            strengthMeter.innerHTML = '<div class="progress">' +
                '<div class="progress-bar bg-' + getProgressBarColor(score) +
                '" role="progressbar" style="width: ' + (score * 20) + '%" aria-valuenow="' + (score * 20) +
                '" aria-valuemin="0" aria-valuemax="100"></div>' +
                '</div>' +
                '<div class="mt-1">' + strength[score] + '</div>' +
                '<div class="mt-1">' + feedback + '</div>';
        });

        function getProgressBarColor(score) {
            if (score <= 1) {
                return 'danger';
            } else if (score <= 2) {
                return 'warning';
            } else if (score <= 3) {
                return 'info';
            } else {
                return 'success';
            }
        }
    </script>
</body>

</html>
