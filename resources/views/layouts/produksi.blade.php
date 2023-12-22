<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Morrah Farm | Produksi </title>
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
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
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
                @php
                    $stocks = \DB::select('SELECT s.jumlah, p.* FROM stok AS s JOIN produks AS p ON p.stok_id = s.id WHERE s.jumlah <= 5');
                    $orders = \DB::select('SELECT * from pesanans where status = 3');
                    $produkKadaluwarsa = \DB::select('SELECT p.nama_produk, p.id, s.kadaluwarsa, s.jumlah FROM produks AS p JOIN stok s ON p.stok_id = s.id WHERE s.kadaluwarsa < DATE_ADD(CURDATE(), INTERVAL 3 DAY)');
                @endphp
                <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                        class="nav-link nav-link-lg message-toggle"><i class="far fa-bell"></i>
                        <span class="badge headerBadge1 bg-danger">{{ count($stocks) + count($orders) + count($produkKadaluwarsa) }}</span> </a>
                    <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                        <div class="dropdown-header">
                            Messages
                        </div>
                        <div class="dropdown-list-content dropdown-list-message">
                            @foreach ($stocks as $stock)
                                <a href="{{ route('produksi.edit.stok', $stock->id) }}"
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
                                        {{ 'Pesanan dengan kode ' . $order->kode . ' sudah dikonfirmasi' }} <br>
                                        <span class="time text-dark">{{ $order->updated_at }}</span>
                                        <i class="text-danger">*Tolong packing pesanan tersebut</i>
                                    </span>
                                </a>
                            @endforeach
                            @foreach ($produkKadaluwarsa as $kadaluwarsa)
                                <a href="{{ route('produksi.edit.kadaluwarsa', $kadaluwarsa->id) }}" {{-- <a href="{{ route('order.detail') }}" --}}
                                    class="dropdown-item dropdown-item-unread">
                                    <span class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </span>
                                    <span class="dropdown-item-desc">
                                        {{ 'Produk dengan nama ' . $kadaluwarsa->nama_produk . ' sudah mau kadaluwarsa' }}
                                        <br>
                                        <span class="time text-dark">tanggal kadaluwarsa :
                                            {{ $kadaluwarsa->kadaluwarsa }}</span>
                                        <i class="text-danger">*silahkan update produk</i>
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
                        <a href="{{ route('akun-produksi.edit', ['id' => Auth::user()->id]) }}"
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
        <aside class="main-sidebar sidebar-light-primary elevation-2">
            <a class="brand-link">
                <img src="assets/dist/img/logo.png" alt="Logo Morrah Farm" class="brand-image img-circle elevation-4"
                    style="opacity: .7">
                <span class="brand-text font-weight-light">Morrah Farm</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('profileFoto/' . Auth::user()->foto) }}" class="img-circle elevation-2"
                            alt="">
                    </div>
                    <div class="info">
                        <a class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('produksi.beranda') }}"
                                class="nav-link {{ \Route::is('produksi.beranda') ? 'active' : '' }}">
                                <i class="nav-icon fa-solid fa-house"></i>
                                <p>
                                    Beranda

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('produksiproduk.index') }}"
                                class="nav-link {{ \Route::is('produksiproduk.index') ? 'active' : '' }}">
                                <i class="fa fa-palette"></i>
                                <p>
                                    Produk

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan-inventori.index') }}"
                                class="nav-link {{ \Route::is('laporan-inventori.index') ? 'active' : '' }}">
                                <i class="fa fa-book"></i>
                                <p>
                                    Laporan Inventori Produksi

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('confirm.photo') }}"
                                class="nav-link {{ \Route::is('confirm.photo') ? 'active' : '' }}">
                                <i class="fa fa-box"></i>
                                <p>
                                    Packing Pesanan

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link">

                                <i class=" nav-icon fa-solid fa-right-from-bracket"></i>
                                <p>LogOut</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
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
        <aside class="control-sidebar control-sidebar-dark">
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
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="assets/dist/js/pages/dashboard.js"></script>
    <link rel="stylesheet" href="jQurery/select2.min.css">
    <script src="jQurery/select2.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.rupiah').mask("#.##0", {
                reverse: true
            });
            $('.select2').select2();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2/dist/sweetalert2.min.css">

    @include('sweetalert::alert')
    @yield('script')
</body>

</html>
