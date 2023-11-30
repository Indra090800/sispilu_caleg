<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CalegController extends Controller
{
    public function index(Request $request)
    {
        $query = Caleg::query();
        $query->select('tb_caleg.*','nama_role', 'nama_parpol');
        $query->join('tb_role', 'tb_caleg.id_role', '=', 'tb_role.id_role');
        $query->join('tb_parpol', 'tb_caleg.id_parpol', '=', 'tb_parpol.id_parpol');
        $query->orderBY('nama_caleg');
        if(!empty($request->nama_caleg)){
            $query->where('nama_caleg', 'like', '%'. $request->nama_caleg.'%');
        }
        if(!empty($request->kode_dept)){
            $query->where('tb_caleg.kode_dept', $request->kode_dept);
        }
        $caleg = $query->paginate(7);
        $parpol = DB::table('tb_parpol')->get();

        return view('master.caleg', compact('caleg','parpol'));
    }

    public function addCaleg(Request $request)
    {
        $nik            = $request->nik;
        $nama_caleg   = $request->nama_caleg;
        $jabatan        = $request->jabatan;
        $no_hp          = $request->no_hp;
        $kode_dept      = $request->kode_dept;
        $kode_cabang      = $request->kode_cabang;
        $password       = Hash::make('12345');
        $kode_cabang    = $request->kode_cabang;

        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = null;
        }
        
        try {
            $data = [
                'nik'           => $nik,
                'nama_caleg'  => $nama_caleg,
                'jabatan'       => $jabatan,
                'no_hp'         => $no_hp,
                'kode_dept'     => $kode_dept,
                'password'      => $password,
                'kode_cabang'   => $kode_cabang,
                'foto'          => $foto
            ];
            $simpan = DB::table('tb_caleg')->insert($data);
        if($simpan){
            if($request->hasFile('foto')){
                $folderPath = "public/uploads/caleg/";
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

    public function editCaleg($nik, Request $request)
    {
        $nama_caleg = $request->nama_caleg;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $password = Hash::make('12345');
        $kode_cabang = $request->kode_cabang;

        $caleg = DB::table('tb_caleg')->where('nik', $nik)->first();
        $old_foto = $caleg->foto;

        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = $old_foto;
        }
        
        try {
            $data = [
                'nama_caleg' => $nama_caleg,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_dept' =>$kode_dept,
                'password' => $password,
                'kode_cabang'   => $kode_cabang,
                'foto' => $foto
            ];
            $update = DB::table('tb_caleg')->where('nik', $nik)->update($data);
        if($update){
            if($request->hasFile('foto')){
                $folderPath = "public/uploads/caleg/";
                $folderPathOld = "public/uploads/caleg/".$old_foto;
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
        $caleg = DB::table('tb_caleg')->where('nik', $nik)->first();
        $old_foto = $caleg->foto;
        $folderPathOld = "public/uploads/caleg/".$old_foto;
        Storage::delete($folderPathOld);
        $delete =  DB::table('tb_caleg')->where('nik', $nik)->delete();  
        
        if($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Delete!!']);
        }else{
            return Redirect::back()->with(['error' => 'Data Gagal Di Delete!!']); 
        }
    }
}
