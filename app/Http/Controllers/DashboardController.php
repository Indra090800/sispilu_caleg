<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $hariini = date("Y-m-d");
        $bulanini = date("m") * 1;
        $tahunini = date("Y");
        $presensihariini = DB::table('tbl_presensi')->where('nik', $nik)->where('tgl_presensi', $hariini)->first();
        $historybulanini = DB::table('tbl_presensi')
        ->leftJoin('jam_kerja', 'tbl_presensi.kode_jamKerja', '=', 'jam_kerja.kode_jamKerja')
        ->where('nik', $nik)
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulanini.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahunini.'"')
        ->orderBy('tgl_presensi')
        ->get();

        $rekappresensi = DB::table('tbl_presensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_in > jam_masuk,1,0)) as jmltelat')
        ->leftJoin('jam_kerja', 'tbl_presensi.kode_jamKerja', '=', 'jam_kerja.kode_jamKerja')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_presensi)="'.$bulanini.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahunini.'"')
        ->first();

        $rekappengajuan = DB::table('tbl_pengajuan')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_izin_dari)="'.$bulanini.'"')
        ->whereRaw('YEAR(tgl_izin_dari)="'.$tahunini.'"')
        ->where('status_approved', 1)
        ->first();

        $leaderboard = DB::table('tbl_presensi')
        ->join('tbl_karyawan', 'tbl_presensi.nik', '=', 'tbl_karyawan.nik')
        ->where('tgl_presensi', $hariini)
        ->orderBy('jam_in')
        ->get();

        $namabulan = ["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('dashboard.dashboard', compact('presensihariini','historybulanini', 'namabulan', 'bulanini',
         'tahunini', 'rekappresensi', 'leaderboard', 'rekappengajuan'));
    }

    public function dashboardadmin()
    {
        return view('dashboard.dashboardadmin');
    }
}
