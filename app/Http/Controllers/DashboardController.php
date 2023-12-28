<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use App\Models\TPS;
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
        ->where('id_role', 1)
        ->first();
        $countparpol = DB::table('tb_parpol')
        ->selectRaw('COUNT(id_parpol) as jml_parpol')
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

    public function cari(Request $request){
        $kecamatan = $request->kecamatan;
        $desa = $request->desa;

        $log = DB::table('tb_log')
        ->leftJoin('tb_saksi', 'tb_saksi.id_saksi', '=', 'tb_log.id_saksi')
        ->leftJoin('tb_tps', 'tb_tps.id_tps', '=', 'tb_log.id_tps')
        ->where('id', Auth::guard()->user()->id)
        ->limit(5)
        ->get();
        $count = DB::table('tb_log')
        ->selectRaw('COUNT(id_saksi) as jml')
        ->first();
        //jml voters
        $jml_voters = DB::table('tb_voters')
        ->selectRaw('COUNT(id_voters) as jml_voters')
        ->where('kecamatan', 'like', '%'.Auth::guard()->user()->wilayah.'%')
        ->first();

        $jml_voters_desa = DB::table('tb_voters')
        ->selectRaw('COUNT(id_voters) as jml_voters_desa')
        ->where('kecamatan', 'like', '%'.Auth::guard()->user()->wilayah.'%')
        ->where('desa', 'like', '%'. $request->desa.'%')
        ->first();
        //jml tps
        $jml_tps = DB::table('tb_tps')
        ->selectRaw('COUNT(id_tps) as jml_tps')
        ->where('kecamatan', 'like', '%'.Auth::guard()->user()->wilayah.'%')
        ->first();
        //voters
        $query = Voters::query();
        $query->select('tb_voters.*');
        $query->orderBY('nik_voters');
        $query->where('kecamatan', 'like', '%'.Auth::guard()->user()->wilayah.'%');
        if(!empty($request->desa)){
            $query->where('desa', 'like', '%'. $request->desa.'%');
        }
        $voters = $query->paginate(7);

        //TPS
        $query = TPS::query();
        $query->select('tb_tps.*');
        $query->orderBY('desa');
        $query->where('kecamatan', 'like', '%'.Auth::guard()->user()->wilayah.'%');
        if(!empty($request->desa1)){
            $query->where('desa', 'like', '%'. $request->desa1.'%');
            $tps = $query->paginate(25);
        }else{
        $tps = $query->paginate(10);
        }
        $Otps = DB::table('tb_tps')
        ->selectRaw('desa')
        ->groupBy('desa')
        ->get();
        $Ovoters = DB::table('tb_voters')
        ->selectRaw('desa')
        ->groupBy('desa')
        ->get();

        return view('monitor.cari', compact('log', 'Otps', 'Ovoters','count', 'jml_voters', 'jml_tps', 'voters', 'jml_voters_desa','tps'));
    }
}
