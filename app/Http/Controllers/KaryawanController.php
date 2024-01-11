<?php

namespace App\Http\Controllers;

use App\Models\TPS;
use App\Models\Voters;
use App\Models\Saksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index(Request $request)
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
        //jml voters
        $query = Voters::query();
        $query->selectRaw('COUNT(id_voters) as jml_voters ');
        $query->where('kecamatan', Auth::guard()->user()->wilayah);
        if(!empty($request->desa)){
            $query->where('desa', 'like', '%'. $request->desa.'%');
        }
        $jml_voters = $query->first();

        $jml_voters_desa = DB::table('tb_voters')
        ->selectRaw('COUNT(id_voters) as jml_voters_desa')
        ->where('kecamatan', 'like', '%'.Auth::guard()->user()->wilayah.'%')
        ->where('desa', 'like', '%'. $request->desa.'%')
        ->first();
        //jml tps
        $query = TPS::query();
        $query->selectRaw('COUNT(id_tps) as jml_tps');
        $query->where('kecamatan', Auth::guard()->user()->wilayah);
        if(!empty($request->desa1)){
            $query->where('desa', 'like', '%'. $request->desa1.'%');
        }
        $jml_tps= $query->first();
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
        $query = Saksi::query();
        $query->select('tb_saksi.*','nama_tps', 'nama_parpol');
        $query->join('tb_tps', 'tb_saksi.id_tps', '=', 'tb_tps.id_tps');
        $query->join('tb_parpol', 'tb_saksi.id_parpol', '=', 'tb_parpol.id_parpol');
        $query->where('tb_saksi.kecamatan', 'like', '%'.Auth::guard()->user()->wilayah.'%');
        $query->orderBY('nama_saksi');
        if(!empty($request->alamat)){
            $query->where('tb_saksi.alamat', 'like', '%'. $request->alamat.'%');
        }
        if(!empty($request->id_tps)){
            $query->where('tb_saksi.id_tps', $request->id_tps);
        }
        $saksi = $query->paginate(15);
        $jml_saksi = DB::table('tb_saksi')
        ->selectRaw('COUNT(id_saksi) as jml_saksi')
        ->where('kecamatan', 'like', '%'.Auth::guard()->user()->wilayah.'%')
        ->first();
        $tps1 = DB::table('tb_tps')->get();

        return view('monitor.kecamatan', compact('saksi','jml_saksi','tps1','log', 'Otps', 'Ovoters','count', 'jml_voters', 'jml_tps', 'voters', 'jml_voters_desa','tps'));
    }


    public function create(Request $request)
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

        $query = Saksi::query();
        $query->select('tb_saksi.*','nama_tps', 'nama_parpol');
        $query->join('tb_tps', 'tb_saksi.id_tps', '=', 'tb_tps.id_tps');
        $query->join('tb_parpol', 'tb_saksi.id_parpol', '=', 'tb_parpol.id_parpol');
        $query->where('tb_saksi.desa', 'like', '%'.Auth::guard()->user()->wilayah.'%');
        $query->orderBY('nama_saksi');
        if(!empty($request->alamat)){
            $query->where('tb_saksi.alamat', 'like', '%'. $request->alamat.'%');
        }
        if(!empty($request->id_tps)){
            $query->where('tb_saksi.id_tps', $request->id_tps);
        }
        $saksi = $query->paginate(15);
        $jml_saksi = DB::table('tb_saksi')
        ->selectRaw('COUNT(id_saksi) as jml_saksi')
        ->where('desa', 'like', '%'.Auth::guard()->user()->wilayah.'%')
        ->first();
        $tps1 = DB::table('tb_tps')->get();

        return view('monitor.kelurahan', compact('saksi','jml_saksi','tps1','log', 'count', 'jml_voters', 'jml_tps', 'voters', 'jml_voters_desa','tps'));
    }

    public function saksi(Request $request)
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

        $query = Saksi::query();
        $query->selectRaw('COUNT(id_saksi) as jml_saksi');
        if(!empty($request->desa)){
            $query->where('desa', 'like', '%'. $request->desa.'%');
        }
        $jml_saksi= $query->first();
        $query = Saksi::query();
        $query->select('tb_saksi.*','nama_tps', 'nama_parpol');
        $query->join('tb_tps', 'tb_saksi.id_tps', '=', 'tb_tps.id_tps');
        $query->join('tb_parpol', 'tb_saksi.id_parpol', '=', 'tb_parpol.id_parpol');
        $query->orderBY('nama_saksi');
        if(!empty($request->id_tps)){
            $query->where('tb_saksi.id_tps', $request->id_tps);
            $saksi = $query->paginate($jml_saksi->jml_saksi);
        }else if(!empty($request->desa)){
            $query->where('tb_saksi.desa', $request->desa);
            $saksi = $query->paginate($jml_saksi->jml_saksi);
        }
        else{
            $saksi = $query->paginate(15);
        }
        $Osaksi = DB::table('tb_saksi')
        ->selectRaw('desa')
        ->groupBy('desa')
        ->get();
        $tps = DB::table('tb_tps')
        ->where('kecamatan', Auth::guard()->user()->wilayah)
        ->get();

        return view('monitor.camat.saksi', compact('jml_saksi','log', 'count', 'saksi','Osaksi', 'tps'));
    }

    public function tps(Request $request)
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
        $query = TPS::query();
        $query->selectRaw('COUNT(id_tps) as jml_tps');
        if(!empty($request->desa)){
            $query->where('desa', 'like', '%'. $request->desa.'%');
        }
        $jml_tps= $query->first();
        //TPS
        $query = TPS::query();
        $query->select('tb_tps.*');
        $query->orderBY('desa');
        if(!empty($request->desa)){
            $query->where('desa', 'like', '%'. $request->desa.'%');
            $tps = $query->paginate($jml_tps->jml_tps);
        }else{
            $tps = $query->paginate(25);
        }


        $Otps = DB::table('tb_tps')
        ->selectRaw('desa')
        ->groupBy('desa')
        ->get();


        return view('monitor.camat.tps', compact('log', 'count', 'jml_tps', 'tps', 'Otps'));
    }

    public function voters(Request $request)
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
        //jml voters
        $query = Voters::query();
        $query->selectRaw('COUNT(id_voters) as jml_voters');
        $query->where('tb_voters.kecamatan', Auth::guard()->user()->wilayah);
        if(!empty($request->desa)){
            $query->where('desa', 'like', '%'. $request->desa.'%');
        }
        if(!empty($request->id_tps)){
            $query->where('tb_voters.id_tps', 'like', '%'. $request->id_tps.'%');
        }
        $jml_voters= $query->first();

        //voters
        $query = Voters::query();
        $query->select('tb_voters.*','nama_caleg', 'nama_tps');
        $query->orderBY('nik_voters');
        $query->join('users', 'tb_voters.id', '=', 'users.id');
        $query->join('tb_tps', 'tb_voters.id_tps', '=', 'tb_tps.id_tps');
        $query->where('tb_voters.kecamatan', Auth::guard()->user()->wilayah);
        if(!empty($request->desa)){
            $query->where('tb_voters.desa', 'like', '%'. $request->desa.'%');
            $voters = $query->paginate($jml_voters->jml_voters);
        }else{
            $voters = $query->paginate(15);
        }
        if(!empty($request->id_tps)){
            $query->where('tb_voters.id_tps', 'like', '%'. $request->id_tps.'%');
            $voters = $query->paginate($jml_voters->jml_voters);
        }else{
            $voters = $query->paginate(15);
        }

        $ovoters = DB::table('tb_voters')
        ->selectRaw('desa')
        ->groupBy('desa')
        ->get();
        $tps = DB::table('tb_tps')
        ->where('kecamatan', Auth::guard()->user()->wilayah)
        ->get();

        return view('monitor.camat.voters', compact('log', 'count', 'jml_voters', 'voters', 'ovoters', 'tps'));
    }

    public function saksi1(Request $request)
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

        $query = Saksi::query();
        $query->selectRaw('COUNT(id_saksi) as jml_saksi');
        $query->where('tb_saksi.desa', Auth::guard()->user()->wilayah);
        $jml_saksi= $query->first();

        $query = Saksi::query();
        $query->select('tb_saksi.*','nama_tps', 'nama_parpol');
        $query->join('tb_tps', 'tb_saksi.id_tps', '=', 'tb_tps.id_tps');
        $query->join('tb_parpol', 'tb_saksi.id_parpol', '=', 'tb_parpol.id_parpol');
        $query->orderBY('nama_saksi');
        $query->where('tb_saksi.desa', Auth::guard()->user()->wilayah);
        if(!empty($request->alamat)){
            $query->where('tb_saksi.alamat', 'like', '%'. $request->alamat.'%');
        }
        if(!empty($request->id_tps)){
            $query->where('tb_saksi.id_tps', $request->id_tps);
        }
        $saksi = $query->paginate(15);

        $tps = DB::table('tb_tps')->get();
        $parpol = DB::table('tb_parpol')->get();

        return view('monitor.lurah.saksi', compact('jml_saksi','log', 'count', 'saksi','tps','parpol'));
    }

    public function tps1(Request $request)
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
        $query = TPS::query();
        $query->selectRaw('COUNT(id_tps) as jml_tps');
        $query->where('desa', Auth::guard()->user()->wilayah);
        $jml_tps= $query->first();
        //TPS
        $query = TPS::query();
        $query->select('tb_tps.*');
        $query->orderBY('desa');
        $query->where('desa', Auth::guard()->user()->wilayah);
        $tps = $query->paginate(25);

        $Otps = DB::table('tb_tps')
        ->selectRaw('desa')
        ->groupBy('desa')
        ->get();


        return view('monitor.lurah.tps', compact('log', 'count', 'jml_tps', 'tps', 'Otps'));
    }

    public function voters1(Request $request)
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
        //jml voters
        $query = Voters::query();
        $query->selectRaw('COUNT(id_voters) as jml_voters');
        $query->where('tb_voters.desa', Auth::guard()->user()->wilayah);
        $jml_voters= $query->first();

        //voters
        $query = Voters::query();
        $query->select('tb_voters.*', 'nama_caleg', 'nama_tps');
        $query->join('users', 'tb_voters.id', '=', 'users.id');
        $query->join('tb_tps', 'tb_voters.id_tps', '=', 'tb_tps.id_tps');
        $query->where('tb_voters.desa', Auth::guard()->user()->wilayah);
        $query->orderBY('nik_voters');
        if(!empty($request->id_tps)){
            $query->where('tb_voters.id_tps', 'like', '%'. $request->id_tps.'%');
        }
        if(!empty($request->nama_voters)){
            $query->where('nama_voters', 'like', '%'. $request->nama_voters.'%');
        }
        $voters = $query->paginate(15);
        $tps = DB::table('tb_tps')
        ->where('desa', Auth::guard()->user()->wilayah)
        ->get();

        return view('monitor.lurah.voters', compact('log', 'count', 'jml_voters', 'voters','tps'));
    }
}
