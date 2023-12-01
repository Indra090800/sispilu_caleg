<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CalegController;
use App\Http\Controllers\SaksiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ParpolController;
use App\Http\Controllers\PemilihController;
use App\Http\Controllers\TPSController;
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
});

Route::middleware(['auth:user'])->group(function(){
    Route::get('panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);

    //caleg
    Route::get('/caleg', [CalegController::class, 'index']);
    Route::post('/addCaleg', [CalegController::class, 'addCaleg']);
    Route::post('/caleg/{nik}/edit', [CalegController::class, 'editCaleg']);
    Route::post('/caleg/{nik}/delete', [CalegController::class, 'delete']);

    //saksi
    Route::get('/saksi', [SaksiController::class, 'index']);
    Route::post('/addSaksi', [SaksiController::class, 'addSaksi']);
    Route::post('/saksi/{nik}/edit', [SaksiController::class, 'editSaksi']);
    Route::post('/saksi/{nik}/delete', [SaksiController::class, 'delete']);

    //parpol
    Route::get('/parpol', [ParpolController::class, 'index']);
    Route::post('/addParpol', [ParpolController::class, 'addParpol']);
    Route::post('/parpol/{id_parpol}/edit', [ParpolController::class, 'editParpol']);
    Route::post('/parpol/{id_parpol}/delete', [ParpolController::class, 'delete']);

    //role admin
    Route::get('/role', [RoleController::class, 'index']);
    Route::post('/addRole', [RoleController::class, 'addRole']);
    Route::post('/role/{id_role}/edit', [RoleController::class, 'editRole']);
    Route::post('/role/{id_role}/delete', [RoleController::class, 'delete']);

    //TPS
    Route::get('/tps', [TPSController::class, 'index']);
    Route::post('/addTPS', [TPSController::class, 'addTPS']);
    Route::post('/tps/{id_tps}/edit', [TPSController::class, 'editTPS']);
    Route::post('/tps/{id_tps}/delete', [TPSController::class, 'delete']);

    //pemilih
    Route::get('/pemilih', [PemilihController::class, 'index']);
    Route::post('/addTPS', [PemilihController::class, 'addPemilih']);
    Route::post('/pemilih/{id_pemilih}/edit', [PemilihController::class, 'editPemilih']);
    Route::post('/pemilih/{id_pemilih}/delete', [PemilihController::class, 'delete']);
});

