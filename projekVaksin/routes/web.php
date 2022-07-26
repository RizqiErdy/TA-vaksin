<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\VaksinController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [AdminController::class, 'index'])->name('home');

//Kecamatan
Route::get('/admin/kecamatan', [KecamatanController::class, 'index'])->name('Kecamatan');
Route::get('/admin/kecamatan/tambah', [KecamatanController::class, 'create']);
Route::post('/admin/kecamatan/simpan', [KecamatanController::class, 'store']);
Route::get('/admin/kecamatan/edit/{id_kecamatan}', [KecamatanController::class, 'edit']);
Route::post('/admin/kecamatan/update/{id_kecamatan}', [KecamatanController::class, 'update']);
Route::get('/admin/kecamatan/delete/{id_kecamatan}', [KecamatanController::class, 'delete']);

//tempat Vaksin
Route::get('/admin/tempatvaksin', [vaksinController::class, 'index'])->name('TempatVaksin');
Route::get('/admin/tempatvaksin/tambah', [vaksinController::class, 'create']);
Route::post('/admin/tempatvaksin/simpan', [vaksinController::class, 'store']);
Route::get('/admin/tempatvaksin/edit/{id_tempatvaksin}', [vaksinController::class, 'edit']);
Route::post('/admin/tempatvaksin/update/{id_tempatvaksin}', [vaksinController::class, 'update']);
Route::get('/admin/tempatvaksin/delete/{id_tempatvaksin}', [vaksinController::class, 'delete']);
