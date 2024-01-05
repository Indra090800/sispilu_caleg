<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\TPS;
use App\Models\Saksi;
use App\Models\Voters;
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
        $query = Voters::query();
        $query->select('tb_voters.*');
        $query->join('tb_saksi', 'tb_voters.id_saksi', '=', 'tb_saksi.id_saksi');
        $query->orderBY('id_voters', 'desc');
        $query->where('tb_voters.id_saksi', $id_saksi);
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
        ->where('tb_log.id', Auth::guard()->user()->id)
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
        ->where('id_role', 1)
        ->first();
        $countparpol = DB::table('tb_saksi')
        ->selectRaw('COUNT(id_saksi) as jml_saksi')
        ->first();

        $Otps = DB::table('tb_tps')
        ->selectRaw('desa')
        ->groupBy('desa')
        ->get();

        $Otps2 = DB::table('tb_tps')
        ->selectRaw('kecamatan')
        ->groupBy('kecamatan')
        ->get();
        
        
        return view('dashboard.dashboardadmin', compact('log','Otps2', 'Otps','count', 'countVoters', 'counttps', 'countusers', 'countparpol'));
    }
}
