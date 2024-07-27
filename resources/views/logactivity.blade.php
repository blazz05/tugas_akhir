@extends('adminlte::page')
@section('title', 'Data Activity Log')
@section('content_header')
    <h1>Data Activity Log</h1> 
@stop
@section('content')
    <p>Pesantren Teknologi Dan Komunikasi II Jombang YBM PLN</p><br>
@php
$ar_judul = ['No','User','Event', 'Before','After', 'Description', 'Waktu'];
$no = 1; 
@endphp

     <!-- /.card -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Table Activity Log</h3>
              
            </div>
            <!-- /.card-header -->
            <div class="card-body">

            <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">No</th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">User</th>
                            <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Event</th>
                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Before</th>
                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">After</th>
                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Tanggal</th>
                            <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Description</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @foreach($ar_logactivity as $logactivity)
                        <tr class="hover:bg-gray-100 dark:hover:bg-neutral-700">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{ $no++ }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ optional($logactivity->causer)->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $logactivity->event }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200"> 
                                @if(isset($logactivity->properties['old']) && is_array($logactivity->properties['old']))
                                @foreach($logactivity->properties['old'] as $key => $value)
                                    @if(isset($logactivity->properties['attributes'][$key]) && $logactivity->properties['attributes'][$key] != $value)
                                        <p>{{ $key }} : {{ $value }}</p>
                                    @endif
                                    @endforeach
                                @else
                                    Data Lama Tidak Tersedia
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                @if(isset($logactivity->properties['attributes']) && is_array($logactivity->properties['attributes']))
                                @foreach($logactivity->properties['attributes'] as $key => $value)
                                    @if(isset($logactivity->properties['old'][$key]) && $logactivity->properties['old'][$key] != $value)
                                        {{-- Check for specific relations --}}
                                        @if(in_array($key, ['user_id', 'other_relation_id'])) {{-- Ganti 'other_relation_id' dengan nama relasi lain yang ada --}}
                                            <p>{{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $logactivity->causer->$key->name }}</p>
                                        @else
                                            <p>{{ $key }} : {{ $value }}</p>
                                        @endif
                                    @else
                                        {{-- Show newly added data --}}
                                        @if(!isset($logactivity->properties['old'][$key]))
                                            @if(in_array($key, ['user_id', 'other_relation_id'])) {{-- Ganti 'other_relation_id' dengan nama relasi lain yang ada --}}
                                                <p>{{ ucfirst(str_replace('_', ' ', $key)) }} Baru: {{ $logactivity->causer->$key->name }}</p>
                                            @else
                                                <p>{{ $key }} : {{ $value }}</p>
                                            @endif
                                        @endif
                                    @endif
                                    @endforeach
                                @else
                                    Data Baru Tidak Tersedia
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $logactivity->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{ $logactivity->description }}</td>
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
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
            "responsive": true, "lengthChange": true, "autoWidth": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "pageLength": 5,
            "lengthMenu": [5, 10, 50],
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