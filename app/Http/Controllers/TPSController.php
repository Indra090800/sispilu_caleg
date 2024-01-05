<?php

namespace App\Http\Controllers;

use App\Models\TPS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class TPSController extends Controller
{
    public function index(Request $request)
    {
        $query = TPS::query();
        $query->select('tb_tps.*');
        $query->orderBY('desa');
        if(!empty($request->nama_tps)){
            $query->where('nama_tps', 'like', '%'. $request->nama_tps.'%');
        }
        if(!empty($request->denah == 'Desa')){
            $query->where('tb_tps.desa', $request->search_denah);
        }
        if(!empty($request->denah == 'Kecamatan')){
            $query->where('tb_tps.kecamatan', $request->search_denah);
        }
        $tps = $query->paginate(25);
        $log = DB::table('tb_log')
        ->leftJoin('tb_saksi', 'tb_saksi.id_saksi', '=', 'tb_log.id_saksi')
        ->leftJoin('tb_tps', 'tb_tps.id_tps', '=', 'tb_log.id_tps')
        ->where('tb_log.id', Auth::guard()->user()->id)
        ->limit(5)
        ->get();
        $count = DB::table('tb_log')
        ->selectRaw('COUNT(id_saksi) as jml')
        ->first();
        $caleg = DB::table('users')
        ->leftJoin('tb_parpol', 'users.id_parpol', '=', 'tb_parpol.id_parpol')
        ->where('users.id_parpol', '>=', 1)
        ->where('users.id_role', 1)
        ->orderBy('users.id_parpol', 'ASC')->get();
        
        return view('master.tps', compact('tps', 'log','count','caleg'));
    }

    public function addTPS(Request $request)
    {
        $nama_tps      = $request->nama_tps;
        $alamat        = $request->alamat;
        $desa          = $request->desa;
        $kecamatan     = $request->kecamatan;
        $lokasi        = $request->lokasi;
        $id            = $request->id;

        try {
            $data = [
                'nama_tps'     => $nama_tps,
                'alamat'       => $alamat,
                'desa'         => $desa,
                'kecamatan'    => $kecamatan,
                'lokasi'       => $lokasi,
                'id'           => $id,
            ];
            $simpan = DB::table('tb_tps')->insert($data);
        if($simpan){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan!!']);
        }
        } catch (\Exception $e) {
            if($e->getCode()==23000){
                $message = "Data Sudah Ada!!";
            }else {
                $message = "Hubungi Tim IT";
            }
            return Redirect::back()->with(['error' => 'Data Gagal Di Simpan!! '. $message]);
        }
    }

    public function editTPS($id_tps, Request $request)
    {
        $nama_tps      = $request->nama_tps;
        $alamat        = $request->alamat;
        $desa          = $request->desa;
        $kecamatan     = $request->kecamatan;
        $lokasi        = $request->lokasi;
        $id            = $request->id;

        try {
            $data = [
                'nama_tps'     => $nama_tps,
                'alamat'       => $alamat,
                'desa'         => $desa,
                'kecamatan'    => $kecamatan,
                'lokasi'       => $lokasi,
                'id'           => $id,
            ];
            $update = DB::table('tb_tps')->where('id_tps', $id_tps)->update($data);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update!!']);
        }
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => 'Data Gagal Di Update!!']);
        }
    }

    public function delete($id_tps)
    {
        $delete =  DB::table('tb_tps')->where('id_tps', $id_tps)->delete();

        if($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Delete!!']);
        }else{
            return Redirect::back()->with(['error' => 'Data Gagal Di Delete!!']);
        }
    }
}
