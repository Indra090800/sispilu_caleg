<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\TPS;
use App\Models\Voters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index()
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

        return view('monitor.kecamatan', compact('log', 'Otps', 'Ovoters','count', 'jml_voters', 'jml_tps', 'voters', 'jml_voters_desa','tps'));
    }


    public function create()
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
        $jml_voters = DB::table('tb_voters')
        ->selectRaw('COUNT(id_voters) as jml_voters')
        ->where('desa', 'like', '%'.Auth::guard()->user()->wilayah.'%')
        ->first();

        $jml_voters_desa = DB::table('tb_voters')
        ->selectRaw('COUNT(id_voters) as jml_voters_desa')
        ->where('desa', 'like', '%'.Auth::guard()->user()->wilayah.'%')
        ->first();
        //jml tps
        $jml_tps = DB::table('tb_tps')
        ->selectRaw('COUNT(id_tps) as jml_tps')
        ->where('desa', 'like', '%'.Auth::guard()->user()->wilayah.'%')
        ->first();
        //voters
        $query = Voters::query();
        $query->select('tb_voters.*');
        $query->orderBY('nik_voters');
        $query->where('desa', 'like', '%'.Auth::guard()->user()->wilayah.'%');
        $voters = $query->paginate(7);

        //TPS
        $query = TPS::query();
        $query->select('tb_tps.*');
        $query->orderBY('desa');
        $query->where('desa', 'like', '%'.Auth::guard()->user()->wilayah.'%');
        $tps = $query->paginate(10);

        return view('monitor.kelurahan', compact('log', 'count', 'jml_voters', 'jml_tps', 'voters', 'jml_voters_desa','tps'));
    }
}
