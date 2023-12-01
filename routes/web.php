<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PerkembanganAnakController;



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

// auth
Route::get('/login', [AuthController::class, 'getLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'doLogin'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'doLogout'])->middleware('auth');

// pages
Route::get('/', [PagesController::class, 'getIndex'])->middleware('auth');

// anak
Route::group(['prefix' => 'anak', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/datatable-json', [AnakController::class, 'datatableJson'])->name('anak.datatable-json');
    Route::get('/{anak}/edit-akun', [AnakController::class, 'editAkun'])->name('anak.edit.akun');
    Route::put('/{anak}/update-akun', [AnakController::class, 'updateAkun'])->name('anak.update.akun');
});
Route::resource('anak', AnakController::class)->middleware(['auth', 'role:admin']);

// perkembangan anak
Route::group(['prefix' => 'perkembangan-anak', 'middleware' => 'auth'], function () {
    Route::get('/datatable-json', [PerkembanganAnakController::class, 'datatableJson'])->name('perkembangan-anak.datatable-json');
});
Route::resource('perkembangan-anak', PerkembanganAnakController::class)->except('show')->middleware(['auth', 'role:admin']);

// laporan
Route::group(['prefix' => 'laporan', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/per-anak', [LaporanController::class, 'perAnak'])->name('laporan.per-anak');
    Route::get('/per-bulan', [LaporanController::class, 'perBulan'])->name('laporan.per-bulan');
});
Route::get('/nokartu', [PagesController::class, 'nokartu']);
Route::get('/suhu', [PagesController::class, 'suhu']);
Route::get('/tinggi', [PagesController::class, 'tinggi']);
Route::get('/berat', [PagesController::class, 'berat']);
Route::get('/postkartu/{id}', [PagesController::class, 'temp_rfid']);
Route::get('/posttinggi/{id}', [PagesController::class, 'temp_tinggi']);
Route::get('/postberat/{id}', [PagesController::class, 'temp_berat']);
Route::get('/postsuhu/{id}', [PagesController::class, 'temp_suhu']);

// routes/web.php
