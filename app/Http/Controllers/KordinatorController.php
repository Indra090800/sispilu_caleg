<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class KordinatorController extends Controller
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
        $query->where('users.id_role', 5);
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
        $kandidat = DB::table('users')->where('id_role',1)->get();

        return view('master.kordinator', compact('caleg','parpol','log', 'count', 'kandidat'));
    }

    public function create(Request $request)
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
        $query->where('users.id_role', 6);
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
        $kandidat = DB::table('users')->where('id_role',1)->get();

        return view('master.kor_kelurahan', compact('caleg','parpol','log', 'count', 'kandidat'));
    }

    public function addKordinator(Request $request)
    {
        $nik            = $request->nik;
        $nama_caleg     = $request->nama_caleg;
        $alamat         = $request->alamat;
        $email          = $request->email;
        $no_hp          = $request->no_hp;
        $id_parpol      = $request->id_parpol;
        $wilayah        = $request->wilayah;
        $id_kor         = $request->id_kor;
        $id_role        = 5;
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
                'wilayah'       => $wilayah,
                'id_role'       => $id_role,
                'id_kor'        => $id_kor,
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

    public function editKordinator($nik, Request $request)
    {
        $nik            = $request->nik;
        $nama_caleg     = $request->nama_caleg;
        $alamat         = $request->alamat;
        $email          = $request->email;
        $no_hp          = $request->no_hp;
        $id_role        = 5;
        $id_parpol      = $request->id_parpol;
        $wilayah        = $request->wilayah;
        $password       = Hash::make('12345');
        $id_kor         = $request->id_kor;

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
                'id_kor'        => $id_kor,
                'wilayah'       => $wilayah,
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

    public function addKordinator1(Request $request)
    {
        $nik            = $request->nik;
        $nama_caleg     = $request->nama_caleg;
        $alamat         = $request->alamat;
        $email          = $request->email;
        $no_hp          = $request->no_hp;
        $id_parpol      = $request->id_parpol;
        $wilayah        = $request->wilayah;
        $id_role        = 6;
        $password       = Hash::make('12345');
        $id_kor         = $request->id_kor;

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
                'wilayah'       => $wilayah,
                'id_role'       => $id_role,
                'id_kor'        => $id_kor,
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

    public function editKordinator1($nik, Request $request)
    {
        $nik            = $request->nik;
        $nama_caleg     = $request->nama_caleg;
        $alamat         = $request->alamat;
        $email          = $request->email;
        $no_hp          = $request->no_hp;
        $id_role        = 6;
        $id_parpol      = $request->id_parpol;
        $wilayah        = $request->wilayah;
        $password       = Hash::make('12345');
        $id_kor         = $request->id_kor;

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
                'id_kor'        => $id_kor,
                'wilayah'       => $wilayah,
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
