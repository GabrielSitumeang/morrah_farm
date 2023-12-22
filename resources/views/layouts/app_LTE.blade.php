<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Morrah Farm | {{ $title }}</title>
    <base href="/public">
    <!-- Google Font: Source Sans Pro -->
    <link rel="icon" type="image/png" href="assetuser/images/logo2.png" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
    <!-- include summernote css/js-->
    {{-- <link href="assets/sm/summernote.css" rel="stylesheet"> --}}
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="assets/dist/img/logo3.png" alt="AdminLTELogo" height="200"
                width="200">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                @php
                    // $stocks = \DB::select('SELECT * from produks where stok < 5');
                    $stocks = \DB::select('SELECT s.jumlah, p.* FROM stok AS s JOIN produks AS p ON p.stok_id = s.id WHERE s.jumlah <= 5');
                    $orders = \DB::select('SELECT * from pesanans where status = 2');
                    $produkKadaluwarsa = \DB::select('SELECT p.nama_produk, s.id, s.kadaluwarsa, s.jumlah FROM produks AS p JOIN stok s ON p.stok_id = s.id WHERE s.kadaluwarsa < DATE_ADD(CURDATE(), INTERVAL 3 DAY)');
                    $produkpackings = \DB::select('SELECT * from pesanans where status = 4');
                @endphp
                <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                        class="nav-link nav-link-lg message-toggle"><i class="far fa-bell"></i>
                        <span class="badge headerBadge1 bg-danger">{{ count($stocks) + count($orders) + count($produkKadaluwarsa) + count($produkpackings) }}</span> </a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                        <div class="dropdown-header">
                            Messages
                        </div>
                        <div class="dropdown-list-content dropdown-list-message">
                            @foreach ($stocks as $stock)
                                <a href="{{ route('produk.edit.stok', $stock->id) }}"
                                    class="dropdown-item dropdown-item-unread">
                                    <span class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                    <span class="dropdown-item-desc">
                                        {{ 'Stock ' . $stock->nama_produk . ' tersisa ' . $stock->jumlah }} <br>
                                        <span class="time text-dark">-- {{ $stock->updated_at }} --</span>
                                        <i class="text-danger">*silahkan lakukan pengisian stok!</i>
                                    </span>
                                </a>
                            @endforeach
                            @foreach ($orders as $order)
                                <a href="{{ route('result.file', $order->id) }}" {{-- <a href="{{ route('order.detail') }}" --}}
                                    class="dropdown-item dropdown-item-unread">
                                    <span class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="dropdown-item-desc">
                                        {{ 'Pesanan dengan kode ' . $order->kode . ' sudah dibayar' }} <br>
                                        <span class="time text-dark">{{ $order->updated_at }}</span>
                                        <i class="text-danger">*silahkan cek foto disini</i>
                                    </span>
                                </a>
                            @endforeach
                            @foreach ($produkKadaluwarsa as $kadaluwarsa)
                                <a href="{{ route('produk.edit.kadaluwarsa', $kadaluwarsa->id) }}" {{-- <a href="{{ route('order.detail') }}" --}}
                                    class="dropdown-item dropdown-item-unread">
                                    <span class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                    <span class="dropdown-item-desc">
                                        {{ 'Produk dengan nama ' . $kadaluwarsa->nama_produk . ' sudah mau kadaluwarsa' }}
                                        <br>
                                        <span class="time text-dark">tanggal kadaluwarsa : {{ $kadaluwarsa->kadaluwarsa }}</span>
                                        <i class="text-danger">*silahkan update produk</i>
                                    </span>
                                </a>
                            @endforeach
                            @foreach ($produkpackings as $produkpacking)
                                <a href="{{ route('order.tracking') }}" {{-- <a href="{{ route('order.detail') }}" --}}
                                    class="dropdown-item dropdown-item-unread">
                                    <span class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="dropdown-item-desc">
                                        {{ 'Pesanan dengan kode ' . $produkpacking->kode . ' sudah dipacking' }} <br>
                                        <span class="time text-dark">{{ $produkpacking->updated_at }}</span>
                                        <i class="text-danger">*silahkan isi form tracking</i>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </li>

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-gear"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('akun-manager.edit', ['id' => Auth::user()->id]) }}"
                            class="dropdown-item text-center">
                            <i class="fas fa-gear text-center"></i>Account Setting
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item text-center">
                            <i class="fa-solid fa-right-from-bracket"></i>LogOut
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-2">
            <!-- Brand Logo -->
            <a class="brand-link">
                <img src="assets/dist/img/logo.png" alt="Logo Morrah Farm" class="brand-image img-circle elevation-4"
                    style="opacity: .7">
                <span class="brand-text font-weight-light">Morrah Farm</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('profileFoto/' . Auth::user()->foto) }}" class="img-circle elevation-2"
                            alt="">
                    </div>
                    <div class="info">
                        <a class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="{{ route('manager.beranda') }}"
                                class="nav-link {{ \Route::is('manager.beranda') ? 'active' : '' }}">
                                <i class="nav-icon fa-solid fa-house"></i>
                                <p>
                                    Beranda

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}"
                                class="nav-link {{ \Route::is('user.index') ? 'active' : '' }}">
                                <i class="fa-solid fa-users"></i>
                                <p>
                                    Data Karyawan

                                </p>
                            </a>
                        </li>
                        {{-- 
                        <li class="nav-item">
                            <a href="{{ route('tugas.manager') }}"
                                class="nav-link {{ \Route::is('tugas.manager') ? 'active' : '' }}">
                                <i class="fa-solid fa-tasks"></i>
                                <p>
                                    Tugas

                                </p>
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a href="{{ route('manager.customer') }}"
                                class="nav-link {{ \Route::is('manager.customer') ? 'active' : '' }}">
                                <i class="fa-solid fa-user-plus"></i>
                                <p>Daftar Customer</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('produk.index') }}"
                                class="nav-link {{ \Route::is('produk.index') ? 'active' : '' }}">
                                <i class="fa fa-palette"></i>
                                <p>
                                    Produk

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('about.index') }}"
                                class="nav-link {{ \Route::is('about.index') ? 'active' : '' }}">
                                <i class="fa-brands fa-blogger"></i>
                                <p>
                                    Tentang

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('blog.manager') }}"
                                class="nav-link {{ \Route::is('blog.manager') ? 'active' : '' }}">
                                <i class="fa-brands fa-blogger"></i>
                                <p>
                                    Blog

                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('home-sliders.index') }}"
                                class="nav-link {{ \Route::is('home-sliders.index') ? 'active' : '' }}">
                                <i class="fa-sharp fa-solid fa-images"></i>
                                <p>
                                    Home Slider

                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('manager.laporan') }}"
                                class="nav-link {{ \Route::is('cetak-laporan-penjualan') ? 'active' : '' }}">
                                <i class="fa-solid fa-book"></i>
                                <p>
                                    Laporan

                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-shopping-cart"></i>
                                <p>
                                    <span>Ordered</span>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link" href="{{ route('order.detail') }}">New
                                        order</a></li>
                                {{-- <li class="nav-item"><a class="nav-link" href="{{ route('confirm.photo') }}">Confirm
                                        Photo</a></li> --}}
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('order.tracking') }}">Tracking </a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('order.finish') }}">Order
                                        Finished</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-book"></i>
                                <p>
                                    <span>Data Inventory</span>
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('manager.kerbau') }}">Laporan Kerbau Jantan</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('manager.susu') }}">Laporan
                                        Susu</a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('manager.laporan-produksi') }}">Laporan Hasil Produksi</a></li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('ongkir.manager') }}"
                                class="nav-link {{ \Route::is('ongkos-kirim') ? 'active' : '' }}">
                                <i class="fa-solid fa-dollar"></i>
                                <p>
                                    Ongkos Kirim

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link">

                                <i class=" nav-icon fa-solid fa-right-from-bracket"></i>
                                <p>
                                    LogOut

                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#"></a></li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="continer-xxl flex-grow-1 container-p-y">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {!! implode('', $errors->all('<div>:message</div>')) !!}
                            </div>
                        @endif
                        @yield('content')
                        @include('sweetalert::alert')
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    @include('sweetalert::alert')


    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="assets/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="assets/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <!-- date-range-picker -->
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="assets/plugins/moment/moment.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="assets/dist/js/demo.js"></script>
    <script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="assets/dist/js/pages/dashboard.js"></script>
    <link rel="stylesheet" href="assets/dist/jQurery/select2.min.css">
    <script src="assets/plugins/jQurery/select2.min.js"></script>
    <script src="assets/plugins/jquery.mask.min.js"></script>
    <script src="assets/dist/js/demo.js"></script>
    <script>
        $(document).ready(function() {
            $('.rupiah').mask("#.##0", {
                reverse: true
            });
            $('.select2').select2();
        });
    </script>
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <!-- include summernote css/js-->
    {{-- <script src="assets/sm/summernote.js"></script> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('script')
</body>

</html>
