@extends('layouts.template')
@section('csstambahan')
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


<link rel="stylesheet" href="dist/css/adminlte.min.css?v=3.2.0">

<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">

<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.8.6/dist/apexcharts.css">
<style>
        .chart-container {
            width: 100%;
            height: 400px;
        }
    </style>
@endsection

<!-- Section Konten  -->
@section('konten')
<section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totaldataflame }}</h3>
                            <p>Total Flame Data</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-flame"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totaldatadht }}</h3>
                            <p>Total DHT Data</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-thermometer"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totaldatauser }}</h3>
                            <p>Total Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totaldatagas }}</h3>
                            <p>Total Gas Data</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-cloud"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Chart 1: Line Chart -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">DHT 22</h3>
                                </div>
                                <div class="card-body">
                                    {!! $chart->container() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Chart 2: Bar Chart -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Flame</h3>
                                </div>
                                <div class="card-body">
                                    {!! $chart2->container() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Chart 3: Area Chart -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">MQ2</h3>
                                </div>
                                <div class="card-body">
                                    {!! $chart3->container() !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Chart 4: Pie Chart -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Users</h3>
                                </div>
                                <div class="card-body">
                                    {!! $chart4->container() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <!-- Scripts untuk chart -->
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    {{ $chart2->script() }}
    {{ $chart3->script() }}
    {{ $chart4->script() }}

  
    @endsection 

@section('jstambahan')
<script src="plugins/jquery/jquery.min.js"></script>

<script src="plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="plugins/chart.js/Chart.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function fetchData() {
        $.ajax({
            url: '/fetchdata', // Ganti dengan URL endpoint yang sesuai untuk memeriksa data baru
            method: 'GET',
            success: function(response) {
                // Tampilkan alert jika ada data dengan nilai 0
                if (response.alert) {
                    alert(response.alert);
                }
            },
            error: function(xhr) {
                console.log('Error:', xhr.responseText);
            }
        });
    }

    // Pembaruan data setiap 5 detik
    setInterval(fetchData, 5000);
</script>
@endsection
<!-- end of section konten  -->
