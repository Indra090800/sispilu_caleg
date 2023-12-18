<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $id_tps = Auth::guard('caleg')->user()->id_tps;
        $id_parpol = Auth::guard('caleg')->user()->id_parpol;
        $id_saksi = Auth::guard('caleg')->user()->id_saksi;
        $query = Caleg::query();
        $query->select('users.*', 'nama_parpol');
        $query->join('tb_parpol', 'users.id_parpol', '=', 'tb_parpol.id_parpol');
        $query->orderBY('nama_caleg');
        $query->where('users.id_parpol', $id_parpol);
        $caleg = $query->get();
        $tps = DB::table('tb_tps')
        ->where('id_tps', $id_tps)->first();
        $saksi = DB::table('tb_saksi')
        ->leftJoin('tb_parpol', 'tb_saksi.id_parpol', '=', 'tb_parpol.id_parpol')
        ->where('id_saksi', $id_saksi)->first();

        return view('dashboard.dashboard', compact('tps', 'caleg', 'saksi'));
    }

    public function dashboardadmin()
    {
        $log = DB::table('tb_log')
        ->leftJoin('tb_saksi', 'tb_saksi.id_saksi', '=', 'tb_log.id_saksi')
        ->leftJoin('tb_tps', 'tb_tps.id_tps', '=', 'tb_log.id_tps')
        ->where('id', Auth::guard()->user()->id)
        ->limit(5)
        ->get();
        $count = DB::table('tb_log')
        ->selectRaw('COUNT(id_saksi) as jml')
        ->first();
        $countVoters = DB::table('tb_voters')
        ->selectRaw('COUNT(id_voters) as jml_voters')
        ->first();
        $counttps = DB::table('tb_tps')
        ->selectRaw('COUNT(id_tps) as jml_tps')
        ->first();
        $countusers = DB::table('users')
        ->selectRaw('COUNT(id) as jml_users')
        ->first();
        $countparpol = DB::table('tb_parpol')
        ->selectRaw('COUNT(id_parpol) as jml_parpol')
        ->first();
        
        return view('dashboard.dashboardadmin', compact('log','count', 'countVoters', 'counttps', 'countusers', 'countparpol'));
    }
}
