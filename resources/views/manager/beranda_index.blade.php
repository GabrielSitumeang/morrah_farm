@extends('layouts.app_LTE')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">Hai, {{ Auth::user()->name }}</h5>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalPesanans }}</h3>
                    <p>Orderan Terbaru</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart" style="color:white"></i>
                </div>
                <a href="{{ route('order.detail') }}" class="small-box-footer">
                    Lihat
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalProducts }}</h3>
                    <p>Total Produk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars" style="color:white"></i>
                </div>
                <a href="{{ route('produk.index') }}" class="small-box-footer">
                    Lihat
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalCustomer }}</h3>
                    <p>Jumlah Customer</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus" style="color:white"></i>
                </div>
                <a href="{{ route('manager.customer') }}" class="small-box-footer">
                    Lihat
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $totalPegawai }}</h3>
                    <p>Jumlah Karyawan</p>
                </div>
                <div class="icon">
                    {{-- <i class="fas fa-chart-pie"></i> --}}
                    <i class="fa-sharp fa-solid fa-users" style="color:white"></i>
                </div>
                <a href="{{ route('user.index') }}" class="small-box-footer">
                    Lihat
                    <i class="fas fa-arrow-circle-right"></i>

                </a>
            </div>
        </div>
    </div>
    <div class="row" id="grafikPendapatan">
    </div>
    <div class="row" id="grafikOrderan">
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var pendapatan = <?php echo json_encode($total_harga); ?>;
        var bulan = <?php echo json_encode($bulan); ?>;
        Highcharts.chart('grafikPendapatan', {
            title: {
                text: 'Grafik Pendapatan Bulanan'
            },
            xAxis: {
                categories: bulan
            },
            yAxis: {
                title: {
                    text: 'Nominal Pendapatan Bulanan'
                }
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Nominal Pendapatan',
                data: pendapatan
            }]
        });
    </script>
    <script>
        var bulan = <?php echo json_encode($bulan); ?>;
        var total_orderan = <?php echo json_encode($total_orderan); ?>;
        Highcharts.chart('grafikOrderan', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Orderan Bulanan'
            },
            subtitle: {
                text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: bulan,
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nominal Orderan Bulanan'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Total Orderan',
                data: total_orderan

            }]
        });
    </script>
@endsection
