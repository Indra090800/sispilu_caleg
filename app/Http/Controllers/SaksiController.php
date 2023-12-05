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

    public function editprofile()
    {
        $id_saksi = Auth::guard('caleg')->user()->id_saksi;
        $saksi = DB::table('tb_saksi')->where('id_saksi', $id_saksi)->first();
        return view('vote.editprofile', compact('saksi'));
    }

    public function addSaksi(Request $request)
    {
        $nik_ktp            = $request->nik_ktp;
        $nama_saksi     = $request->nama_saksi;
        $alamat         = $request->alamat;
        $no_hp          = $request->no_hp;
        $id_parpol      = $request->id_parpol;
        $id_tps         = $request->id_tps;
        $password       = Hash::make('12345');

        if($request->hasFile('foto_saksi')){
            $foto_saksi = $nik_ktp.".".$request->file('foto_saksi')->getClientOriginalExtension();
        }else{
            $foto_saksi = null;
        }

        try {
            $data = [
                'nik_ktp'       => $nik_ktp,
                'nama_saksi'    => $nama_saksi,
                'alamat'        => $alamat,
                'no_hp'         => $no_hp,
                'password'      => $password,
                'id_parpol'     => $id_parpol,
                'id_tps'        => $id_tps,
                'foto_saksi'    => $foto_saksi
            ];
            $simpan = DB::table('tb_saksi')->insert($data);
            if($simpan){
                if($request->hasFile('foto_saksi')){
                    $folderPath = "public/uploads/saksi/";
                    $request->file('foto_saksi')->storeAs($folderPath, $foto_saksi);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan!!']);
            }

        } catch (\Exception $e) {
            if($e->getCode()==23000){
                $message = "Data nik_ktp = ".$nik_ktp." Sudah Ada!!";
            }else {
                $message = "Hubungi Tim IT";
            }
            return Redirect::back()->with(['error' => 'Data Gagal Di Simpan!! '. $message]);
        }
    }

    public function editSaksi($id_saksi, Request $request)
    {
        $nik_ktp        = $request->nik_ktp;
        $nama_saksi     = $request->nama_saksi;
        $alamat         = $request->alamat;
        $no_hp          = $request->no_hp;
        $id_tps         = $request->id_tps;
        $id_parpol      = $request->id_parpol;
        $password       = Hash::make('12345');

        $saksi = DB::table('tb_saksi')->where('id_saksi', $id_saksi)->first();
        $old_foto_saksi = $saksi->foto_saksi;

        if($request->hasFile('foto_saksi')){
            $foto_saksi = $nik_ktp.".".$request->file('foto_saksi')->getClientOriginalExtension();
        }else{
            $foto_saksi = $old_foto_saksi;
        }

        try {
            $data = [
                'nik_ktp'       => $nik_ktp,
                'nama_saksi'    => $nama_saksi,
                'alamat'        => $alamat,
                'no_hp'         => $no_hp,
                'id_tps'        => $id_tps,
                'password'      => $password,
                'id_parpol'     => $id_parpol,
                'foto_saksi'    => $foto_saksi
            ];
            $update = DB::table('tb_saksi')->where('id_saksi', $id_saksi)->update($data);
            if($update){
                if($request->hasFile('foto_saksi')){
                    $folderPath = "public/uploads/saksi/";
                    $folderPathOld = "public/uploads/saksi/".$old_foto_saksi;
                    Storage::delete($folderPathOld);
                    $request->file('foto_saksi')->storeAs($folderPath, $foto_saksi);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Di Update!!']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => 'Data Gagal Di Update!!']);
        }
    }

    public function delete($id_saksi)
    {
        $saksi = DB::table('tb_saksi')->where('id_saksi', $id_saksi)->first();
        $old_foto_saksi = $saksi->foto_saksi;
        $folderPathOld = "public/uploads/saksi/".$old_foto_saksi;
        Storage::delete($folderPathOld);
        $delete =  DB::table('tb_saksi')->where('id_saksi', $id_saksi)->delete();

        if($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Delete!!']);
        }else{
            return Redirect::back()->with(['error' => 'Data Gagal Di Delete!!']);
        }
    }

    public function updateprofile($id_saksi, Request $request)
    {
        $nik_ktp        = $request->nik_ktp;
        $nama_saksi     = $request->nama_saksi;
        $alamat         = $request->alamat;
        $no_hp          = $request->no_hp;
        $id_tps         = Auth::guard('caleg')->user()->id_tps;
        $id_parpol      = Auth::guard('caleg')->user()->id_parpol;
        $password       = Hash::make($request->password);

        $saksi = DB::table('tb_saksi')->where('id_saksi', $id_saksi)->first();
        $old_foto_saksi = $saksi->foto_saksi;

        if($request->hasFile('foto_saksi')){
            $foto_saksi = $nik_ktp.".".$request->file('foto_saksi')->getClientOriginalExtension();
        }else{
            $foto_saksi = $old_foto_saksi;
        }

        try {
            $data = [
                'nik_ktp'       => $nik_ktp,
                'nama_saksi'    => $nama_saksi,
                'alamat'        => $alamat,
                'no_hp'         => $no_hp,
                'id_tps'        => $id_tps,
                'password'      => $password,
                'id_parpol'     => $id_parpol,
                'foto_saksi'    => $foto_saksi
            ];
            $update = DB::table('tb_saksi')->where('id_saksi', $id_saksi)->update($data);
            if($update){
                if($request->hasFile('foto_saksi')){
                    $folderPath = "public/uploads/saksi/";
                    $folderPathOld = "public/uploads/saksi/".$old_foto_saksi;
                    Storage::delete($folderPathOld);
                    $request->file('foto_saksi')->storeAs($folderPath, $foto_saksi);
                }
                return Redirect('/editprofile')->with(['success' => 'Data Berhasil Di Update!!']);
            }
        } catch (\Exception $e) {
            return Redirect('/editprofile')->with(['error' => 'Data Gagal Di Update!!']);
        }
    }

    public function create()
    {
        $caleg = DB::table('users')
        ->leftJoin('tb_parpol', 'users.id_parpol', '=', 'tb_parpol.id_parpol')
        ->where('users.id_parpol', '>=', 1)
        ->orderBy('users.id_parpol', 'ASC')->get();
        //tps
        $id_tps = Auth::guard('caleg')->user()->id_tps;
        $tps = DB::table('tb_tps')
        ->where('id_tps', $id_tps)->first();
        return view('vote.create', compact('tps', 'caleg'));
    }
}
