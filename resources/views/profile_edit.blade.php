@extends('adminlte::page')

@section('title', 'Form Profile')

@section('content_header')
    <h1>Form Edit Profile</h1>
@stop

@section('content')
   <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Data Profile</h3>
        </div>
        
        <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                @if(session('flash_notification.message'))
                    <div class="alert alert-{{ session('flash_notification.level') }}">
                        {{ session('flash_notification.message') }}
                    </div>
                @endif
                @include('flash::message')
                <div class="mb-3">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                    <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('name', $user->name) }}" required />
                </div>
                <div class="mb-3">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('email', $user->email) }}" required />
                </div>
                <div class="mb-3">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Leave blank to keep current password" />
                </div>
                <div class="mb-3">
                    <label for="profile_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Profile Image</label>
                    <div class="relative">
                        <input type="file" name="profile_image" id="profile_image" class="hidden" accept="image/*">
                        <label for="profile_image" class="cursor-pointer bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:border-blue-500 block w-full p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white hover:bg-gray-100 hover:border-gray-400">
                            <span class="block text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Choose a file
                            </span>
                        </label>
                        <span id="filename" class="ml-2 text-sm text-gray-500"></span>
                    </div>
                </div>
                @if($user->profile_image)
                    <div class="mt-3">
                        <img src="{{ Storage::url('public/profile_images/'.$user->profile_image) }}" alt="Profile Image" width="100">
                    </div>
                @endif
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
                <a class="bg-blue-500 text-white font-bold py-2 px-4 rounded float-right" href="dashboard" role="button">Back&nbsp;&nbsp;<i class="fa fa-arrow-left"></i></a>
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
