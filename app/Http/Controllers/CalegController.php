<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if(!empty($request->id_parpol)){
            $query->where('tb_caleg.id_parpol', $request->id_parpol);
        }
        $caleg = $query->paginate(7);
        $parpol = DB::table('tb_parpol')->get();

        return view('master.caleg', compact('caleg','parpol'));
    }

    public function addCaleg(Request $request)
    {
        $nik            = $request->nik;
        $nama_caleg     = $request->nama_caleg;
        $alamat         = $request->alamat;
        $no_hp          = $request->no_hp;
        $id_parpol      = $request->id_parpol;
        $id_role        = Auth::guard('user')->user()->id_role;
        $password       = Hash::make('12345');

        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = null;
        }

        try {
            $data = [
                'nik'           => $nik,
                'nama_caleg'    => $nama_caleg,
                'alamat'        => $alamat,
                'no_hp'         => $no_hp,
                'password'      => $password,
                'id_parpol'     => $id_parpol,
                'id_role'       => $id_role,
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
        $nik            = $request->nik;
        $nama_caleg     = $request->nama_caleg;
        $alamat         = $request->alamat;
        $no_hp          = $request->no_hp;
        $id_role        = Auth::guard('user')->user()->id_role;
        $id_parpol      = $request->id_parpol;
        $password       = Hash::make('12345');

        $caleg = DB::table('tb_caleg')->where('nik', $nik)->first();
        $old_foto = $caleg->foto;

        if($request->hasFile('foto')){
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = $old_foto;
        }

        try {
            $data = [
                'nama_caleg'    => $nama_caleg,
                'alamat'        => $alamat,
                'no_hp'         => $no_hp,
                'id_role'       => $id_role,
                'password'      => $password,
                'id_parpol'     => $id_parpol,
                'foto'          => $foto
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
