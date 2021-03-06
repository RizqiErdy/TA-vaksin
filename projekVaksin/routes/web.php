<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\VaksinController;
use App\Http\Controllers\WebController;
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

Route::get('/', [WebController::class, 'index']);
Route::get('/cari', [WebController::class, 'cari']);
Route::get('/kecamatan/{id_kecamatan}', [WebController::class, 'kecamatan']);
// Route::get('/jenis/{id_jenis}', [WebController::class, 'jenis']);
Route::get('/tempatVaksin/{id_tempatVaksin}', [WebController::class, 'detail']);

Route::get('/home', [AdminController::class, 'index'])->name('home');

//Kecamatan
Route::get('/admin/kecamatan', [KecamatanController::class, 'index'])->name('Kecamatan');
Route::get('/admin/kecamatan/tambah', [KecamatanController::class, 'create']);
Route::post('/admin/kecamatan/simpan', [KecamatanController::class, 'store']);
Route::get('/admin/kecamatan/edit/{id_kecamatan}', [KecamatanController::class, 'edit']);
Route::post('/admin/kecamatan/update/{id_kecamatan}', [KecamatanController::class, 'update']);
Route::get('/admin/kecamatan/delete/{id_kecamatan}', [KecamatanController::class, 'delete']);

//tempat Vaksin
Route::get('/admin/tempatVaksin', [vaksinController::class, 'index'])->name('TempatVaksin');
Route::get('/admin/tempatVaksin/tambah', [vaksinController::class, 'create']);
Route::post('/admin/tempatVaksin/simpan', [vaksinController::class, 'store']);
Route::get('/admin/tempatVaksin/edit/{id_tempatvaksin}', [vaksinController::class, 'edit']);
Route::post('/admin/tempatVaksin/update/{id_tempatVaksin}', [vaksinController::class, 'update']);
Route::get('/admin/tempatVaksin/delete/{id_tempatVaksin}', [vaksinController::class, 'delete']);
