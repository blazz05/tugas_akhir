@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
@stop

@section('content')
<div class="container">
    <br>
    <section class="content">
        <div class="container-fluid">
            <!-- Info Boxes -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalMahasantri }}</h3>
                            <p>Mahasantri</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalSetoran }}</h3>
                            <p>Setoran</p>
                        </div>
                        <div class="icon">
                            <svg class="w-14 h-14 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.143 0H2.857A2.857 2.857 0 0 0 0 2.857v6.286C0 10.831 0.831 12 2.857 12h4.286A2.857 2.857 0 0 0 10 9.143V2.857A2.857 2.857 0 0 0 7.143 0Zm14 0h-4.286A2.857 2.857 0 0 0 12 2.857v6.286C12 10.831 12.831 12 14.857 12h4.286A2.857 2.857 0 0 0 22 9.143V2.857A2.857 2.857 0 0 0 21.143 0Zm-14 14H2.857A2.857 2.857 0 0 0 0 16.857v6.286C0 23.169 0.831 24 2.857 24h4.286A2.857 2.857 0 0 0 10 21.143v-6.286A2.857 2.857 0 0 0 7.143 14Zm14 0h-4.286A2.857 2.857 0 0 0 12 16.857v6.286c0 1.026.831 1.857 1.857 1.857h4.286A2.857 2.857 0 0 0 24 21.143v-6.286A2.857 2.857 0 0 0 21.143 14Z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totalTasmi }}</h3>
                            <p>Ujian Tahfizh</p>
                        </div>
                        <div class="icon">
                            <svg class="w-14 h-14 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.143 0H2.857A2.857 2.857 0 0 0 0 2.857v6.286C0 10.831 0.831 12 2.857 12h4.286A2.857 2.857 0 0 0 10 9.143V2.857A2.857 2.857 0 0 0 7.143 0Zm14 0h-4.286A2.857 2.857 0 0 0 12 2.857v6.286C12 10.831 12.831 12 14.857 12h4.286A2.857 2.857 0 0 0 22 9.143V2.857A2.857 2.857 0 0 0 21.143 0Zm-14 14H2.857A2.857 2.857 0 0 0 0 16.857v6.286C0 23.169 0.831 24 2.857 24h4.286A2.857 2.857 0 0 0 10 21.143v-6.286A2.857 2.857 0 0 0 7.143 14Zm14 0h-4.286A2.857 2.857 0 0 0 12 16.857v6.286c0 1.026.831 1.857 1.857 1.857h4.286A2.857 2.857 0 0 0 24 21.143v-6.286A2.857 2.857 0 0 0 21.143 14Z"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totalUsers }}</h3>
                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Charts -->
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Recap Setoran
                            </h3>
                            <div class="card-tools">
                                <button type="button" class=" btn-tool btn-sm " data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <div class="chart tab-pane active" id="revenue-chart">
                                    <canvas id="revenue-chart-canvas" height="300"></canvas>
                                </div>
                                <div class="chart tab-pane" id="sales-chart">
                                    <canvas id="sales-chart-canvas" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.row -->

            <!-- Tables -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Setoran Harian
                        </div>
                        <div class="card-body">
                            @if ($daily_setoran->isEmpty())
                            <p class="text-muted">Tidak ada setoran untuk hari ini.</p>
                            @else
                            <div class="table-responsive">
                                <table id="daily_table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Juz</th>
                                            <th>Halaman</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($daily_setoran as $setoran)
                                        <tr>
                                            <td>{{ $setoran->nim }}</td>
                                            <td>{{ $setoran->nama }}</td>
                                            <td>{{ $setoran->tanggal }}</td>
                                            <td>{{ $setoran->waktu }}</td>
                                            <td>{{ $setoran->juz }}</td>
                                            <td>{{ $setoran->halaman }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Setoran Bulanan
                        </div>
                        <div class="card-body">
                            @if ($monthly_setoran->isEmpty())
                            <p class="text-muted">Tidak ada setoran untuk bulan ini.</p>
                            @else
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Juz</th>
                                            <th>Halaman</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($monthly_setoran as $setoran)
                                        <tr>
                                            <td>{{ $setoran->nim }}</td>
                                            <td>{{ $setoran->nama }}</td>
                                            <td>{{ $setoran->tanggal }}</td>
                                            <td>{{ $setoran->waktu }}</td>
                                            <td>{{ $setoran->juz }}</td>
                                            <td>{{ $setoran->halaman }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Tempusdominus Bootstrap 4 -->
<link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- JQVMap -->
<link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<!-- Daterange picker -->
<link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
<!-- summernote -->
<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
@stop
@section('js')
<script>
    $(function() {
        // Inisialisasi DataTable untuk tabel harian
        $("#daily_table").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "pageLength": 5,
            "lengthMenu": [5, 10],
        }).buttons().container().appendTo('#daily_table_wrapper .card-body');

    });
    $(function() {
        // Inisialisasi DataTable untuk tabel bulanan (example1)
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "pageLength": 5,
            "lengthMenu": [5, 10],
        }).buttons().container().appendTo('#example1_wrapper .card-body');
    });
</script>

<script>
    $(function() {
        // Data for Area chart
        var areaData = {
            labels: @json($dailyChartData['labels']),
            datasets: [{
                label: 'setoran',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: @json($dailyChartData['data'])
            }]
        };

        // Area chart options
        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        };

        // Draw Area chart using Chart.js
        var areaChartCanvas = $('#revenue-chart-canvas').get(0).getContext('2d');
        var areaChart = new Chart(areaChartCanvas, {
            type: 'line',
            data: areaData,
            options: areaChartOptions
        });
    });


    $(function() {
        // Data for Donut chart
        var donutData = {
            labels: @json($monthlyChartData['labels']),
            datasets: [{
                data: @json($monthlyChartData['data']),
                backgroundColor: ['rgba(210, 214, 222, 1)', ' rgba(60,141,188,0.9)'],
            }]
        };

        // Donut chart options
        var donutOptions = {
            maintainAspectRatio: false,
            responsive: true,
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = Math.floor(((currentValue / total) * 100) + 0.5);
                        return percentage + "%";
                    }
                }
            }
        };

        // Draw Donut chart using Chart.js
        var donutChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d');
        var donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions
        });
    });
</script>
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js')}}"></script>
<script src="dist/js/pages/dashboard2.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
@stop