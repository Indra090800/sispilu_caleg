<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
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
        $id = Auth::guard()->user()->id;
        $setting = DB::table('users')->where('id', $id)->first();

        return view('master.setting', compact('log', 'count','setting'));
    }

    public function upsetting(Request $request)
    {
        $nik            = $request->nik;
        $nama_caleg     = $request->nama_caleg;
        $alamat         = $request->alamat;
        $no_hp          = $request->no_hp;
        $email          = $request->email;
        $id_role        = Auth::guard()->user()->id_role;
        $id             = Auth::guard()->user()->id;
        $id_parpol      = Auth::guard()->user()->id_parpol;
        $wilayah        = Auth::guard()->user()->wilayah;
        $id_kor         = Auth::guard()->user()->id_kor;

        $c = $request->password;
        $profile = DB::table('users')->where('id', $id)->first();
        if($c = null){
          $password = Hash::make('12345');
        }else{
          $password = Hash::make($request->password);
        }
        $old_foto_caleg = $profile->foto_caleg;

        if($request->hasFile('foto_caleg')){
            $foto_caleg = $nik.".".$request->file('foto_caleg')->getClientOriginalExtension();
        }else{
            $foto_caleg = $old_foto_caleg;
        }

        try {
            $data = [
                'nik'           => $nik,
                'nama_caleg'    => $nama_caleg,
                'alamat'        => $alamat,
                'no_hp'         => $no_hp,
                'email'         => $email,
                'id_role'       => $id_role,
                'wilayah'       => $wilayah,
                'id_kor'        => $id_kor,
                'password'      => $password,
                'id_parpol'     => $id_parpol,
                'foto_caleg'    => $foto_caleg
            ];
            $update = DB::table('users')->where('id', $id)->update($data);
            if($update){
                if($request->hasFile('foto_caleg')){
                    $folderPath = "public/uploads/caleg/";
                    $folderPathOld = "public/uploads/caleg/".$old_foto_caleg;
                    Storage::delete($folderPathOld);
                    $request->file('foto_caleg')->storeAs($folderPath, $foto_caleg);
                }
                return Redirect('/settings')->with(['success' => 'Data Berhasil Di Update!!']);
            }
        } catch (\Exception $e) {
            return Redirect('/settings')->with(['error' => 'Data Gagal Di Update!!']);
        }
    }
}
