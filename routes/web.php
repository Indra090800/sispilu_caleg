<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\IzinAbsen;
use App\Http\Controllers\Izincuti;
use App\Http\Controllers\IzinSakit;
use App\Http\Controllers\CalegController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PresensiController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::middleware(['guest:caleg'])->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});

Route::middleware(['guest:user'])->group(function(){
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');

    Route::post('/loginadmin', [AuthController::class, 'loginadmin']);
});


Route::middleware(['auth:caleg'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);

    //presensi
    Route::get('/presensi/create', [PresensiController::class, 'index']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    Route::get('/editprofile', [PresensiController::class, 'editprofile']);
    Route::post('/presensi/{nik}/updateprofile', [PresensiController::class, 'updateprofile']);

    Route::get('/presensi/histori', [PresensiController::class, 'histori']);
    Route::post('/gethistori', [PresensiController::class, 'gethistori']);

    //izin
    Route::get('/presensi/izin', [PresensiController::class, 'izin']);
    Route::get('/presensi/buatizin', [PresensiController::class, 'buatizin']);
    Route::post('/presensi/storeizin', [PresensiController::class, 'storeizin']);

    Route::post('/presensi/cekpengajuan', [PresensiController::class, 'cekpengajuan']);

    Route::get('/izinabsen', [IzinAbsen::class, 'index']);
    Route::post('/izinabsen/create', [IzinAbsen::class, 'create']);
    Route::get('/izinabsen/{id_izin}/edit', [IzinAbsen::class, 'vEdit']);
    Route::post('/izinabsen/{id_izin}/fedit', [IzinAbsen::class, 'fEdit']);

    Route::get('/izinsakit', [IzinSakit::class, 'index']);
    Route::post('/izinsakit/create', [IzinSakit::class, 'create']);
    Route::get('/izinsakit/{id_izin}/edit', [IzinSakit::class, 'vEdit']);
    Route::post('/izinsakit/{id_izin}/fedit', [IzinSakit::class, 'fEdit']);

    Route::get('/izincuti', [Izincuti::class, 'index']);
    Route::post('/izincuti/create', [Izincuti::class, 'create']);
    Route::get('/izincuti/{id_izin}/edit', [Izincuti::class, 'vEdit']);
    Route::post('/izincuti/{id_izin}/fedit', [Izincuti::class, 'fEdit']);

    Route::get('/izin/{kode_izin}/showact', [PresensiController::class, 'showact']);
    Route::post('/deleteizin/{id_izin}', [PresensiController::class, 'showact']);
});

Route::middleware(['auth:user'])->group(function(){
    Route::get('panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);

    Route::get('/caleg', [CalegController::class, 'index']);
    Route::post('/addCaleg', [CalegController::class, 'addCaleg']);
    Route::post('/caleg/{nik}/edit', [CalegController::class, 'editCaleg']);
    Route::post('/caleg/{nik}/delete', [CalegController::class, 'delete']);
});

