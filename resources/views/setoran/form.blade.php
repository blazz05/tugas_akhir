@extends('adminlte::page')
@section('title', 'Form Setoran')
@section('content_header')
    <h1>Form Setoran</h1>
@stop
@section('content')
@php
$rs1 = App\Models\Mahasantri::all();
@endphp

    <!-- <p>Welcome to this beautiful admin panel.</p> -->

   <!-- general form elements -->
   <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"> Tables Form Setoran</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
               <form action="{{ route('setoran.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="card-body">
              <div class="form-group">
                  <label>Nama</label>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"" name="mahasantri_id">
                    <option value="">-- Pilih Nama --</option>
                    @foreach($rs1 as $nama)
                    <option value="{{ $nama->id }}">{{ $nama->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                  <input type="date" name="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tanggal" required />
                </div>
                <div class="form-group">
                  <label for="waktu">Waktu</label>
                  <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"l" name="waktu" id="waktu">
                    <option value="Pagi">Pagi</option>
                    <option value="Siang">Siang</option>
                    <option value="Sore">Sore</option>
                    <option value="Petang">Petang</option>
                    <option value="Malam">Malam</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="juz" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Juz</label>
                  <input type="text" name="juz" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Juz" required />
                </div>
                 <div class="mb-3">
                  <label for="halaman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Halaman</label>
                  <input type="text" name="halaman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Halaman" required />
                </div>
           
                @if($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif
                </div>
                <div class="card-footer">
                    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Submit</button>
                    <a class="bg-blue-500 text-white font-bold py-2 px-4 rounded float-right" href="../setoran" role="button">Back&nbsp;&nbsp;<i class="fa fa-arrow-left"></i></a>
                </div>
              </form>
            </div>
            
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop