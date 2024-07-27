<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MahasantriController;
use App\Http\Controllers\SetoranController;
use App\Http\Controllers\TasmiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\UserController;

Auth::routes();

Route::get('/', function () {
    return view('home'); // Ganti 'home' dengan nama template atau view yang sesuai
});

Route::get('/welcome', function () {
    return view('welcome'); // Ganti 'welcome' dengan nama template atau view yang sesuai
});

Route::get('/afterregister', function () {
    return view('afterregister'); // Ganti 'welcome' dengan nama template atau view yang sesuai
});



// mahasantri
Route::resource('mahasantri', MahasantriController::class)->middleware('auth', 'admin'); 

// mahasantri
Route::middleware(['auth', 'admin'])->group(function () {     Route::resource('mahasantri', MahasantriController::class)->names('mahasantri');
});

// setoran
Route::resource('setoran', SetoranController::class)->middleware('auth', 'admin'); 

Route::get('setoran/download/pdf', [SetoranController::class, 'download_pdf']);

Route::get('/form_setoran',[SetoranController::class, 'create'])
    ->name('setoran.create')->middleware('auth', 'admin');
Route::get('/form_edit/{id}/edit', [SetoranController::class, 'edit'])
    ->name('setoran.edit')->middleware('auth', 'admin');
  
// tasmi
Route::resource('tasmi', TasmiController::class)->middleware('auth', 'admin'); 
Route::get('/form_tasmi',[TasmiController::class, 'create'])
    ->name('tasmi.create')->middleware('auth', 'admin');
Route::get('/form_edit/{id}/edit', [TasmiController::class, 'edit'])
    ->name('tasmi.edit')->middleware('auth', 'admin');

// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard.index')
    ->middleware('auth');


Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

Route::resource('logactivity', LogActivityController::class)->middleware('auth'); 

Route::resource('users', UserController::class)->middleware('auth', 'admin'); 




