@extends('layouts.produksi')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Morrah Farm </title>
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
<body>
    <div class="content">
        <div class="card card-info card-outline"
            <div class="card-header">
                <h3>Edit Laporan Inventori Produksi</h3>
            </div>
            <div class="card-body">
                @if($errors->any())
                        <div class="mb-3">
                             @foreach($errors->all() as $error)
                                 <p>{{$error}}</p>
                             @endforeach
                        </div>
                    @endif
                <form action="{{route('update-laporan', $production_reports->nama_produk)}}" method="POST">
                    @csrf  @method('PUT')
                        <div class="form-group"></div>
                            <p class="text-muted text-sm"><b> Nama Produk: </b>
                            <input type="text" id="nama_produk" value="{{$production_reports->nama_produk}}" name="nama_produk"  class="form-control" placeholder="Nama Produk" >
                        </div>
                        <div class="form-group"></div>
                            <p class="text-muted text-sm"><b> Tanggal: </b>
                            <input type="date" id="tanggal" name="tanggal" value="{{$production_reports->tanggal}}" class="form-control" placeholder="Tanggal" >
                        </div>
                        <div class="form-group">
                            <p class="text-muted text-sm"><b>Jumlah: </b>
                            <input type="number" id="jumlah" name="jumlah" value="{{$production_reports->jumlah}}" class="form-control" placeholder="Jumlah ">
                        </div>
                        <div class="form-group">
                            <p class="text-muted text-sm"><b> Nama Pelapor: </b>
                            <input type="text" id="nama_pelapor" name="nama_pelapor" value="{{$production_reports->nama_pelapor}}" class="form-control" placeholder=" Nama Pelapor">
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Update Laporan</button>
                        </div>
                        <div>
                            <button type="button" value="go back" onclick="history.back(-1)" class="btn btn-danger">Kembali</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
@endsection

