@extends('adminlte::page')
@section('title', 'Form Edit Setoran')
@section('content_header')
    <h1>Data Setoran</h1>
@stop
@section('content')
 <!-- Ini Konten Form Edit Setoran  -->
 @php
$rs1 = App\Models\Mahasantri::all();
@endphp
@foreach($data as $rs)
    <form method="POST" action="{{ route('setoran.update',$rs->id) }}">
@csrf 
<!-- security untuk menghindari dari serangan pada saat input form -->
@method('put') 
<!--  method put digunakan untuk meletakkan data yang akan diubah disetiap element form edit setoran  -->
    <div class="form-group">
        <label>Nama</label>
        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"" name="mahasantri_id">
            <option value="">-- Pilih Nama --</option>
            @foreach($rs1 as $nama)
                @php
                    $sel1 = ($nama->id == $rs->mahasantri_id) ? 'selected' : '';
                @endphp
                <option value="{{ $nama->id }}" {{ $sel1 }}>{{ $nama->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
        <input type="date" name="tanggal" value="{{ old('tanggal', $rs->tanggal) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
    </div>
    <div class="form-group">
        <label for="waktu">Waktu</label>
        <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="waktu" id="waktu">
            <option value="Pagi" {{ (old('waktu') ?? $rs->waktu) == 'Pagi' ? 'selected' : '' }}>Pagi</option>
            <option value="Siang" {{ (old('waktu') ?? $rs->waktu) == 'Siang' ? 'selected' : '' }}>Siang</option>
            <option value="Sore" {{ (old('waktu') ?? $rs->waktu) == 'Sore' ? 'selected' : '' }}>Sore</option>
            <option value="Petang" {{ (old('waktu') ?? $rs->waktu) == 'Petang' ? 'selected' : '' }}>Petang</option>
            <option value="Malam" {{ (old('waktu') ?? $rs->waktu) == 'Malam' ? 'selected' : '' }}>Malam</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="juz" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Juz</label>
        <input type="text" name="juz" value="{{ old('juz', $rs->juz) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
    </div>
    <div class="mb-3">
        <label for="halaman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Halaman</label>
        <input type="text" name="halaman" value="{{ old('halaman', $rs->halaman) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
    </div>
    <button type="submit" class="btn btn-primary bg-blue-500" name="proses">Ubah</button>
    <button type="reset" class="btn btn-primary bg-blue-500" name="unproses">Batal</button>
    <a class="bg-blue-500 text-white font-bold py-2 px-3 rounded float-right" href="/setoran" role="button">Back&nbsp;&nbsp;<i class="fa fa-arrow-left"></i></a>
</form>
@endforeach
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
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)'); 
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
<!-- Page specific script -->
@stop