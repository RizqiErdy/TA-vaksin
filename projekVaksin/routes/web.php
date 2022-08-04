<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\VaksinController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\UserController;
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
Route::get('/tempatvaksin', [WebController::class, 'tempatvaksin']);
Route::get('/about', [WebController::class, 'about'])->name('about');
Route::post('/send', [WebController::class, 'send'])->name('email.send');
Route::get('/kecamatan/{id_kecamatan}', [WebController::class, 'kecamatan']);
Route::get('/tempatVaksin/{id_tempatVaksin}', [WebController::class, 'detail']);

Route::get('/home', [AdminController::class, 'index'])->name('home');

Auth::routes();

//Kecamatan
Route::get('/admin/kecamatan', [KecamatanController::class, 'index'])->name('Kecamatan');
Route::get('/admin/kecamatan/tambah', [KecamatanController::class, 'create']);
Route::post('/admin/kecamatan/simpan', [KecamatanController::class, 'store']);
Route::get('/admin/kecamatan/edit/{id_kecamatan}', [KecamatanController::class, 'edit']);
Route::post('/admin/kecamatan/update/{id_kecamatan}', [KecamatanController::class, 'update']);
Route::get('/admin/kecamatan/delete/{id_kecamatan}', [KecamatanController::class, 'delete']);

//tempat Vaksin
Route::get('/admin/tempatVaksin', [VaksinController::class, 'index'])->name('TempatVaksin');
Route::get('/admin/tempatVaksin/tambah', [VaksinController::class, 'create']);
Route::post('/admin/tempatVaksin/simpan', [VaksinController::class, 'store']);
Route::get('/admin/tempatVaksin/edit/{id_tempatVaksin}', [VaksinController::class, 'edit']);
Route::post('/admin/tempatVaksin/update/{id_tempatVaksin}', [VaksinController::class, 'update']);
Route::get('/admin/tempatVaksin/delete/{id_tempatVaksin}', [VaksinController::class, 'delete']);

//Jadwal Vaksin
Route::get('/admin/jadwalvaksin', [JadwalController::class, 'index'])->name('JadwalVaksin');
Route::post('/admin/jadwalvaksin/simpan', [JadwalController::class, 'store']);
Route::post('/admin/jadwalvaksin/update/{id_jadwalVaksin}', [JadwalController::class, 'update']);
Route::get('/admin/jadwalvaksin/delete/{id_jadwalVaksin}', [JadwalController::class, 'delete']);

//user
Route::get('/admin/user', [UserController::class, 'index'])->name('User');
Route::get('/admin/user/tambah', [UserController::class, 'create']);
Route::post('/admin/user/simpan', [UserController::class, 'store']);
Route::post('/admin/user/update/{id}', [UserController::class, 'update']);
Route::get('/admin/user/delete/{id}', [UserController::class, 'delete']);

Auth::routes();
