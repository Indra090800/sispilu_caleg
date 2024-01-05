<?php

namespace App\Http\Controllers;

use App\Models\Parpol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ParpolController extends Controller
{
    public function index(Request $request)
    {
        $query = Parpol::query();
        $query->select('tb_parpol.*','nama_role');
        $query->join('tb_role', 'tb_parpol.id_role', '=', 'tb_role.id_role');
        $query->orderBY('nama_parpol');
        if(!empty($request->nama_parpol)){
            $query->where('nama_parpol', 'like', '%'. $request->nama_parpol.'%');
        }
        $parpol = $query->paginate(7);
        $log = DB::table('tb_log')
        ->leftJoin('tb_saksi', 'tb_saksi.id_saksi', '=', 'tb_log.id_saksi')
        ->leftJoin('tb_tps', 'tb_tps.id_tps', '=', 'tb_log.id_tps')
        ->where('tb_log.id', Auth::guard()->user()->id)
        ->limit(5)
        ->get();
        $count = DB::table('tb_log')
        ->selectRaw('COUNT(id_saksi) as jml')
        ->first();

        return view('master.parpol', compact('parpol','log', 'count'));
    }

    public function addParpol(Request $request)
    {
        $nama_parpol    = $request->nama_parpol;
        $alamat         = $request->alamat;
        $no_telp        = $request->no_telp;
        $id_role        = Auth::guard('user')->user()->id_role;

        if($request->hasFile('foto_logo')){
            $foto_logo = $nama_parpol.".".$request->file('foto_logo')->getClientOriginalExtension();
        }else{
            $foto_logo = null;
        }

        try {
            $data = [
                'nama_parpol'   => $nama_parpol,
                'alamat'        => $alamat,
                'no_telp'       => $no_telp,
                'id_role'       => $id_role,
                'foto_logo'     => $foto_logo
            ];
            $simpan = DB::table('tb_parpol')->insert($data);
            if($simpan){
                if($request->hasFile('foto_logo')){
                    $folderPath = "public/uploads/parpol/";
                    $request->file('foto_logo')->storeAs($folderPath, $foto_logo);
                }
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

    public function editParpol($id_parpol, Request $request)
    {
        $nama_parpol    = $request->nama_parpol;
        $alamat         = $request->alamat;
        $no_telp        = $request->no_telp;
        $id_role        = Auth::guard('user')->user()->id_role;

        $parpol = DB::table('tb_parpol')->where('id_parpol', $id_parpol)->first();
        $old_foto_logo = $parpol->foto_logo;

        if($request->hasFile('foto_logo')){
            $foto_logo = $nama_parpol.".".$request->file('foto_logo')->getClientOriginalExtension();
        }else{
            $foto_logo = $old_foto_logo;
        }

        try {
            $data = [
                'nama_parpol'   => $nama_parpol,
                'alamat'        => $alamat,
                'no_telp'       => $no_telp,
                'id_role'       => $id_role,
                'foto_logo'     => $foto_logo
            ];
            $update = DB::table('tb_parpol')->where('id_parpol', $id_parpol)->update($data);
        if($update){
            if($request->hasFile('foto_logo')){
                $folderPath = "public/uploads/parpol/";
                $folderPathOld = "public/uploads/parpol/".$old_foto_logo;
                Storage::delete($folderPathOld);
                $request->file('foto_logo')->storeAs($folderPath, $foto_logo);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update!!']);
        }
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => 'Data Gagal Di Update!!']);
        }
    }

    public function delete($id_parpol)
    {
        $parpol = DB::table('tb_parpol')->where('id_parpol', $id_parpol)->first();
        $old_foto_logo = $parpol->foto_logo;
        $folderPathOld = "public/uploads/parpol/".$old_foto_logo;
        Storage::delete($folderPathOld);
        $delete =  DB::table('tb_parpol')->where('id_parpol', $id_parpol)->delete();

        if($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Delete!!']);
        }else{
            return Redirect::back()->with(['error' => 'Data Gagal Di Delete!!']);
        }
    }
}
