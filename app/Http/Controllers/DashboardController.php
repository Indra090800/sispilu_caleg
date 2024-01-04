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

    public function cari($kecamatan, Request $request){

        $log = DB::table('tb_log')
        ->leftJoin('tb_saksi', 'tb_saksi.id_saksi', '=', 'tb_log.id_saksi')
        ->leftJoin('tb_tps', 'tb_tps.id_tps', '=', 'tb_log.id_tps')
        ->where('tb_log.id', Auth::guard()->user()->id)
        ->limit(5)
        ->get();
        $count = DB::table('tb_log')
        ->selectRaw('COUNT(id_saksi) as jml')
        ->first();
        //jml voters
        $query = Voters::query();
        $query->selectRaw('COUNT(id_voters) as jml_voters');
        $query->where('kecamatan', 'like', '%'.$kecamatan.'%');
        if(!empty($request->desa)){
            $query->where('desa', 'like', '%'. $request->desa.'%');
        }
        $jml_voters= $query->first();

        $jml_voters_desa = DB::table('tb_voters')
        ->selectRaw('COUNT(id_voters) as jml_voters_desa')
        ->where('kecamatan', 'like', '%'.$kecamatan.'%')
        ->first();
        //jml tps
        $query = TPS::query();
        $query->selectRaw('COUNT(id_tps) as jml_tps');
        $query->where('kecamatan', 'like', '%'.$kecamatan.'%');
        if(!empty($request->desa1)){
            $query->where('desa', 'like', '%'. $request->desa1.'%');
        }
        $jml_tps= $query->first();
        //voters
        $query = Voters::query();
        $query->select('tb_voters.*');
        $query->orderBY('nik_voters');
        $query->where('kecamatan', 'like', '%'.$kecamatan.'%');
        if(!empty($request->desa2)){
            $query->where('desa', 'like', '%'. $request->desa2.'%');
        }
        if(!empty($request->nama_voters)){
            $query->where('nama_voters', 'like', '%'. $request->nama_voters.'%');
        }
        $voters = $query->paginate(7);

        //TPS
        $query = TPS::query();
        $query->select('tb_tps.*');
        $query->orderBY('desa');
        $query->where('kecamatan', 'like', '%'.$kecamatan.'%');
        if(!empty($request->desa1)){
            $query->where('desa', 'like', '%'. $request->desa1.'%');
            $tps = $query->paginate(25);
        }else{
            $tps = $query->paginate(10);
        }
        
            $Ovoters = DB::table('tb_voters')
            ->selectRaw('desa')
            ->where('kecamatan', 'like', '%'.$kecamatan.'%')
            ->groupBy('desa')
            ->get();
            $Otps = DB::table('tb_tps')
            ->selectRaw('desa')
            ->where('kecamatan', 'like', '%'.$kecamatan.'%')
            ->groupBy('desa')
            ->get();

        $query = Saksi::query();
        $query->select('tb_saksi.*','nama_tps', 'nama_parpol');
        $query->join('tb_tps', 'tb_saksi.id_tps', '=', 'tb_tps.id_tps');
        $query->join('tb_parpol', 'tb_saksi.id_parpol', '=', 'tb_parpol.id_parpol');
        $query->where('tb_saksi.kecamatan', 'like', '%'.$kecamatan.'%');
        $query->orderBY('nama_saksi');
        if(!empty($request->alamat)){
            $query->where('tb_saksi.alamat', 'like', '%'. $request->alamat.'%');
        }
        if(!empty($request->id_tps)){
            $query->where('tb_saksi.id_tps', $request->id_tps);
        }
        $saksi = $query->paginate(15);
        $tps1 = DB::table('tb_tps')->get();
        $query = Saksi::query();
        $query->selectRaw('COUNT(id_saksi) as jml_saksi');
        $query->where('kecamatan', 'like', '%'.$kecamatan.'%');
        if(!empty($request->desa)){
            $query->where('desa', 'like', '%'. $request->desa.'%');
        }
        $jml_saksi= $query->first();

        return view('monitor.cari', compact('jml_saksi','log', 'Otps', 'Ovoters','count', 'jml_voters', 'jml_tps', 'voters', 'jml_voters_desa','tps','saksi','tps1'));
    }
}