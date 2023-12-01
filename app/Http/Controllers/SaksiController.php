<?php

namespace App\Http\Controllers;

use App\Models\Saksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Saksi::query();
        $query->select('tb_saksi.*','nama_tps', 'nama_parpol');
        $query->join('tb_tps', 'tb_saksi.id_tps', '=', 'tb_tps.id_tps');
        $query->join('tb_parpol', 'tb_saksi.id_parpol', '=', 'tb_parpol.id_parpol');
        $query->orderBY('nama_saksi');
        if(!empty($request->nama_saksi)){
            $query->where('nama_saksi', 'like', '%'. $request->nama_saksi.'%');
        }
        if(!empty($request->id_parpol)){
            $query->where('tb_saksi.id_parpol', $request->id_parpol);
        }
        $saksi = $query->paginate(7);
        $parpol = DB::table('tb_parpol')->get();
        $tps = DB::table('tb_tps')->get();

        return view('master.saksi', compact('saksi','parpol', 'tps'));
    }

    public function addSaksi(Request $request)
    {
        $nik            = $request->nik;
        $nama_saksi     = $request->nama_saksi;
        $alamat         = $request->alamat;
        $no_hp          = $request->no_hp;
        $id_parpol      = $request->id_parpol;
        $id_tps         = $request->id_tps;
        $password       = Hash::make('12345');

        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = null;
        }

        try {
            $data = [
                'nik'           => $nik,
                'nama_saksi'    => $nama_saksi,
                'alamat'        => $alamat,
                'no_hp'         => $no_hp,
                'password'      => $password,
                'id_parpol'     => $id_parpol,
                'id_tps'        => $id_tps,
                'foto'          => $foto
            ];
            $simpan = DB::table('tb_saksi')->insert($data);
        if($simpan){
            if($request->hasFile('foto')){
                $folderPath = "public/uploads/saksi/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan!!']);
        }
        } catch (\Exception $e) {
            if($e->getCode()==23000){
                $message = "Data NIK = ".$nik." Sudah Ada!!";
            }else {
                $message = "Hubungi Tim IT";
            }
            return Redirect::back()->with(['error' => 'Data Gagal Di Simpan!! '. $message]);
        }
    }

    public function editSaksi($nik, Request $request)
    {
        $nik            = $request->nik;
        $nama_saksi     = $request->nama_saksi;
        $alamat         = $request->alamat;
        $no_hp          = $request->no_hp;
        $id_tps         = $request->id_tps;
        $id_parpol      = $request->id_parpol;
        $password       = Hash::make('12345');

        $saksi = DB::table('tb_saksi')->where('nik', $nik)->first();
        $old_foto = $saksi->foto;

        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = $old_foto;
        }

        try {
            $data = [
                'nama_saksi'    => $nama_saksi,
                'alamat'        => $alamat,
                'no_hp'         => $no_hp,
                'id_tps'        => $id_tps,
                'password'      => $password,
                'id_parpol'     => $id_parpol,
                'foto'          => $foto
            ];
            $update = DB::table('tb_saksi')->where('nik', $nik)->update($data);
        if($update){
            if($request->hasFile('foto')){
                $folderPath = "public/uploads/saksi/";
                $folderPathOld = "public/uploads/saksi/".$old_foto;
                Storage::delete($folderPathOld);
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update!!']);
        }
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => 'Data Gagal Di Update!!']);
        }
    }

    public function delete($nik)
    {
        $saksi = DB::table('tb_saksi')->where('nik', $nik)->first();
        $old_foto = $saksi->foto;
        $folderPathOld = "public/uploads/saksi/".$old_foto;
        Storage::delete($folderPathOld);
        $delete =  DB::table('tb_saksi')->where('nik', $nik)->delete();

        if($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Delete!!']);
        }else{
            return Redirect::back()->with(['error' => 'Data Gagal Di Delete!!']);
        }
    }
}
