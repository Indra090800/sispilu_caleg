<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CalegController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KordinatorController;
use App\Http\Controllers\SaksiController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ParpolController;
use App\Http\Controllers\VotersController;
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
        return view('auth.loginadmin');
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
    //update profile saksi
    Route::get('/editprofile', [SaksiController::class, 'editprofile']);
    Route::post('/sispilu/{id_saksi}/updateprofile', [SaksiController::class, 'updateprofile']);
    //vote
    Route::get('/vote/create', [SaksiController::class, 'create']);
    Route::post('/vote/addvote', [SaksiController::class, 'addvote']);
    Route::post('/vote/{id}/{id_tps}/deleteVote', [SaksiController::class, 'deleteVote']);

    Route::get('/sispilu/voters/add', [votersController::class, 'create']);
    Route::post('/sispilu/addVoters', [VotersController::class, 'addVoters']);
    Route::post('/sispilu/voters/{id_voters}/edit', [VotersController::class, 'editVoters']);
    Route::post('/sispilu/voters/{id_voters}/delete', [VotersController::class, 'delete']);
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
    Route::post('/saksi/{id_saksi}/edit', [SaksiController::class, 'editSaksi']);
    //kordinator add saksi
    Route::post('/addSaksi1', [SaksiController::class, 'addSaksi1']);
    Route::post('/saksi/{id_saksi}/edit1', [SaksiController::class, 'editSaksi1']);
    Route::post('/saksi/{id_saksi}/delete', [SaksiController::class, 'delete']);

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

    //voters
    Route::get('/voters', [VotersController::class, 'index']);
    Route::post('/addVoters', [VotersController::class, 'addVoters']);
    Route::post('/voters/{id_voters}/edit', [VotersController::class, 'editVoters']);
    //admin voters
    Route::post('/addVoters1', [VotersController::class, 'addVoters1']);
    Route::post('/voters/{id_voters}/edit1', [VotersController::class, 'editVoters1']);
    Route::post('/voters/{id_voters}/delete', [VotersController::class, 'delete']);
    //report
    Route::post('/voters/cetakVoters', [VotersController::class, 'cetakVoters']);

    //sispilu monitoring
    Route::get('/sispilu/monitoring', [VotersController::class, 'monitoring']);
    //kordinator
    Route::get('/kordinator/kecamatan', [KordinatorController::class, 'index']);
    Route::get('/kordinator/kelurahan', [KordinatorController::class, 'create']);
    Route::post('/addKordinator1', [KordinatorController::class, 'addKordinator1']);
    Route::post('/kordinator/{nik}/edit1', [KordinatorController::class, 'editKordinator1']);
    Route::post('/kordinator/{nik}/delete', [KordinatorController::class, 'delete']);
    //monitor kordinator camat saksi tps voters
    Route::get('/monitor/kordinator/saksi', [KaryawanController::class, 'saksi']);
    Route::get('/monitor/kordinator/tps', [KaryawanController::class, 'tps']);
    Route::get('/monitor/kordinator/voters', [KaryawanController::class, 'voters']);
    //monitor kordinator kelurahan
    Route::get('/monitor/kordinator/kelurahan/saksi', [KaryawanController::class, 'saksi1']);
    Route::get('/monitor/kordinator/kelurahan/tps', [KaryawanController::class, 'tps1']);
    //addsuara
    Route::post('/addsuara', [SaksiController::class, 'addsuara']);
    //monitor kordinator kelurahan
    Route::get('/monitor/kordinator/kelurahan/voters', [KaryawanController::class, 'voters1']);
    //carimonitor
    Route::get('/cari/monitor/{kecamatan}', [DashboardController::class, 'cari']);

    //monitoring caleg saksi,tps,voters
    Route::get('/kordinator/saksi', [KordinatorController::class, 'saksi']);
    Route::get('/kordinator/tps', [KordinatorController::class, 'tps']);
    Route::get('/kordinator/voters', [KordinatorController::class, 'voters']);
});


