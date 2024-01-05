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
        $query->select('users.*','nama_role', 'nama_parpol');
        $query->join('tb_role', 'users.id_role', '=', 'tb_role.id_role');
        $query->join('tb_parpol', 'users.id_parpol', '=', 'tb_parpol.id_parpol');
        $query->orderBY('nama_caleg');
        if(!empty($request->nama_caleg)){
            $query->where('nama_caleg', 'like', '%'. $request->nama_caleg.'%');
        }
        if(!empty($request->id_parpol)){
            $query->where('users.id_parpol', $request->id_parpol);
        }
        $query->where('users.id_role', 1);
        $caleg = $query->paginate(15);
        $parpol = DB::table('tb_parpol')->get();
        $log = DB::table('tb_log')
        ->leftJoin('tb_saksi', 'tb_saksi.id_saksi', '=', 'tb_log.id_saksi')
        ->leftJoin('tb_tps', 'tb_tps.id_tps', '=', 'tb_log.id_tps')
        ->where('tb_log.id', Auth::guard()->user()->id)
        ->limit(5)
        ->get();
        $count = DB::table('tb_log')
        ->selectRaw('COUNT(id_saksi) as jml')
        ->first();

        return view('master.caleg', compact('caleg','parpol','log', 'count'));
    }

    public function addCaleg(Request $request)
    {
        $nik            = $request->nik;
        $nama_caleg     = $request->nama_caleg;
        $alamat         = $request->alamat;
        $email          = $request->email;
        $no_hp          = $request->no_hp;
        $id_parpol      = $request->id_parpol;
        $id_role        = 1;
        $password       = Hash::make('12345');

        if($request->hasFile('foto_caleg')){
            $foto_caleg = $nik.".".$request->file('foto_caleg')->getClientOriginalExtension();
        }else{
            $foto_caleg = null;
        }

        try {
            $data = [
                'nik'           => $nik,
                'nama_caleg'    => $nama_caleg,
                'alamat'        => $alamat,
                'email'         => $email,
                'no_hp'         => $no_hp,
                'password'      => $password,
                'id_parpol'     => $id_parpol,
                'id_role'       => $id_role,
                'foto_caleg'    => $foto_caleg
            ];
            $simpan = DB::table('users')->insert($data);
        if($simpan){
            if($request->hasFile('foto_caleg')){
                $folderPath = "public/uploads/caleg/";
                $request->file('foto_caleg')->storeAs($folderPath, $foto_caleg);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan!!']);
        }
        } catch (\Exception $e) {
            if($e->getCode()==23000){
                $message = "Data NIK = ".$nik."/".$email." Sudah Ada!!";
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
        $email          = $request->email;
        $no_hp          = $request->no_hp;
        $id_role        = 1;
        $id_parpol      = $request->id_parpol;
        $password       = Hash::make('12345');

        $caleg = DB::table('users')->where('nik', $nik)->first();
        $old_foto_caleg = $caleg->foto_caleg;

        if($request->hasFile('foto_caleg')){
            $foto_caleg = $nik.".".$request->file('foto_caleg')->getClientOriginalExtension();
        }else{
            $foto_caleg = $old_foto_caleg;
        }

        try {
            $data = [
                'nama_caleg'    => $nama_caleg,
                'alamat'        => $alamat,
                'email'         => $email,
                'no_hp'         => $no_hp,
                'id_role'       => $id_role,
                'password'      => $password,
                'id_parpol'     => $id_parpol,
                'foto_caleg'    => $foto_caleg
            ];
            $update = DB::table('users')->where('nik', $nik)->update($data);
        if($update){
            if($request->hasFile('foto_caleg')){
                $folderPath = "public/uploads/caleg/";
                $folderPathOld = "public/uploads/caleg/".$old_foto_caleg;
                Storage::delete($folderPathOld);
                $request->file('foto_caleg')->storeAs($folderPath, $foto_caleg);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update!!']);
        }
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => 'Data Gagal Di Update!!']);
        }
    }

    public function delete($nik)
    {
        $caleg = DB::table('users')->where('nik', $nik)->first();
        $old_foto_caleg = $caleg->foto_caleg;
        $folderPathOld = "public/uploads/caleg/".$old_foto_caleg;
        Storage::delete($folderPathOld);
        $delete =  DB::table('users')->where('nik', $nik)->delete();

        if($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Delete!!']);
        }else{
            return Redirect::back()->with(['error' => 'Data Gagal Di Delete!!']);
        }
    }
}
