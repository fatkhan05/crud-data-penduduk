<?php

use App\Http\Controllers\DataKabupatenController;
use App\Http\Controllers\DataPendudukController;
use App\Http\Controllers\DataProvinsiController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('dashboard');
// });

# DATA PENDUDUK
// Route::get('/data-penduduk', [DataPendudukController::class, 'index'])->name('main-data-penduduk');
Route::get('/', [DataPendudukController::class, 'index'])->name('main-data-penduduk');
Route::post('/data-penduduk-form', [DataPendudukController::class, 'form'])->name('form-data-penduduk');

# DATA PROVINSI
Route::get('/data-provinsi', [DataProvinsiController::class, 'index'])->name('main-data-provinsi');
Route::post('/data-provinsi-form', [DataProvinsiController::class, 'form'])->name('form-data-provinsi');
Route::post('/data-provinsi-store', [DataProvinsiController::class, 'store'])->name('store-data-provinsi');
Route::post('/data-provinsi-destroy', [DataProvinsiController::class, 'destroy'])->name('destroy-data-provinsi');

# DATA KABUPATEN
Route::get('/data-kabupaten', [DataKabupatenController::class, 'index'])->name('main-data-kabupaten');
Route::post('/form-data-kabupaten', [DataKabupatenController::class, 'form'])->name('form-data-kabupaten');
