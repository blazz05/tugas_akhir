@extends('adminlte::page')
@section('title', 'Detail Ujian Tahfizh')
@section('content_header')
    <h1>Data Ujian Tahfizh</h1>
@stop
@section('content')
<p>Welcome to this beautiful admin panel.</p>
@php

$no = 1; 
@endphp
 <!-- /.card -->
 <div class="card">
            
            <!-- /.card-header -->
            <div class="card-body">
            
                <table id="example1" class="table table-bordered table-striped">
                 
                  <tbody>
   
    <div class="media">
            <div class="media-body">
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Nim</td>
                    <td>{{ $tasmi->nim }}</td>
                </tr>
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Nama</td>
                    <td>{{ $tasmi->nama }}</td>
                </tr>
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Tanggal</td>
                    <td>{{ $tasmi->tanggal }} </td>
                </tr>
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Waktu</td>
                    <td>{{ $tasmi->waktu }} </td>
                </tr>
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>Juz</td>
                  <td>{{ $tasmi->setoran_id }}</td>
                </tr>
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>Keterangan</td>
                    <td>{{ $tasmi->keterangan }} </td>    
                </tr>
                  </tbody>
                </table>
                <br><a href="{{ url('/tasmi') }}" class="btn btn-primary">Go Back</a><br>
            </div>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@stop
@section('js')
    <!-- <script> console.log('Hi!'); </script> -->
    <script>
        $(function () {
            $("#example1").DataTable({
    "responsive": true,
    "lengthChange": true,
    "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            });
        });
    </script>
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
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
@stop