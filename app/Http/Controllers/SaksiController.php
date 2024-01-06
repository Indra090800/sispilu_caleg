<?php

namespace App\Http\Controllers;

use App\Models\Saksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\VoteSuara;
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
        if(!empty($request->alamat)){
            $query->where('tb_saksi.alamat', 'like', '%'. $request->alamat.'%');
        }
        if(!empty($request->id_tps)){
            $query->where('tb_saksi.id_tps', $request->id_tps);
        }
        $saksi = $query->paginate(15);
        $parpol = DB::table('tb_parpol')->get();
        $tps = DB::table('tb_tps')->get();
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

        return view('master.saksi', compact('saksi','parpol', 'tps','count','log','caleg'));
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
        $desa           = $request->desa;
        $kecamatan      = $request->kecamatan;
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
                'desa'          => $desa,
                'kecamatan'     => $kecamatan,
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
        $desa           = $request->desa;
        $kecamatan      = $request->kecamatan;
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
                'desa'          => $desa,
                'kecamatan'     => $kecamatan,
                'no_hp'         => $no_hp,
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

        $c = $request->password;
        $saksi = DB::table('tb_saksi')->where('id_saksi', $id_saksi)->first();
        if($c = null){
          $password = Hash::make('12345');
        }else{
          $password = Hash::make($request->password);
        }
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
        ->where('users.id_role', 1)
        ->orderBy('users.id_parpol', 'ASC')->get();
        //tps
        $id_tps = Auth::guard('caleg')->user()->id_tps;
        $tps = DB::table('tb_tps')->where('id_tps', $id_tps)->first();
        $suara = DB::table('tb_vote_caleg')
        ->leftJoin('users', 'tb_vote_caleg.id', '=', 'users.id')
        ->where('id_tps', $id_tps)
        ->orderBy('tb_vote_caleg.id', 'asc')
        ->get();

        return view('vote.create', compact('tps', 'caleg', 'suara'));
    }

    public function addvote(Request $request)
    {
        $query = VoteSuara::query();
        $query->selectRaw('SUM(jml_vote) as total');
        $query->where('id', 'like', '%'. $request->id.'%');
        $c = $query->first();
        $total = $c->total + (int)$request->jml_vote;
        $id_saksi = Auth::guard('caleg')->user()->id_saksi;
        $id_tps = Auth::guard('caleg')->user()->id_tps;
        $id = $request->id;
        $jml_vote = $request->jml_vote;
        $caleg = DB::table('users')->where('id', $id)->first();
        $cek = DB::table('tb_vote')->where('id', $id)->where('id_tps', $id_tps)->where('id_saksi', $id_saksi)->count();
        try {
            $data = [
                'id_saksi' => $id_saksi,
                'id_tps'   => $id_tps,
                'id'       => $id,
                'jml_vote' => $jml_vote,
                'jam'      => date("H:i")
            ];
            DB::table('tb_traffic')->insert([
                'jml_vote' => $total,
                'id'       => $id,
                'jam'      => date("H:i")
            ]);
            DB::table('tb_log')->insert([
                'id_saksi'  => $id_saksi,
                'deskripsi' => ' add vote '.$jml_vote. ' for '.$id.' in '.$id_tps,
                'id'        => $id,
                'id_tps'    => $id_tps,
                'jam'       => date("H:i")
            ]);
            $simpan = DB::table('tb_vote_caleg')->insert($data);
        if($simpan){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan!!']);
        }
        } catch (\Exception $e) {
            if($e->getCode()==23000){
                $message = "Data Suara Kandidat ".$caleg->nama_caleg." Sudah Ada!!";
            }else {
                $message = "Hubungi Tim IT";
            }
            return Redirect::back()->with(['error' => 'Data Gagal Di Simpan!! '. $message]);
        }
    }

    public function addbukti(Request $request)
    {
        $id_tps = Auth::guard('caleg')->user()->id_tps;
        if($request->hasFile('foto_bukti')){
            $foto_bukti = $id_tps.".".$request->file('foto_bukti')->getClientOriginalExtension();
        }else{
            $foto_bukti = null;
        }

        try {
            $data = [
                'foto_bukti'    => $foto_bukti
            ];
            $simpan = DB::table('tb_tps')->where('id_tps', $id_tps)->update($data);
        if($simpan){
            if($request->hasFile('foto_bukti')){
                $folderPath = "public/uploads/bukti_tps/";
                $request->file('foto_bukti')->storeAs($folderPath, $foto_bukti);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Di Simpan!!']);
        }
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => 'Data Gagal Di Simpan!!']);
        }
    }

    public function deleteVote($id,$id_tps)
    {
        $delete =  DB::table('tb_vote_caleg')
        ->where('id', $id)
        ->where('id_tps', $id_tps)
        ->delete();
        $id_saksi = Auth::guard('caleg')->user()->id_saksi;
        $id_tps = Auth::guard('caleg')->user()->id_tps;

        if($delete){
            DB::table('tb_log')->insert([
                'id_saksi'  => $id_saksi,
                'deskripsi' => 'delete vote from '.$id.' in '.$id_tps,
                'id'        => $id,
                'id_tps'    => $id_tps,
                'jam'       => date("H:i")
            ]);
            return Redirect::back()->with(['success' => 'Data Berhasil Di Delete!!']);
        }else{
            return Redirect::back()->with(['error' => 'Data Gagal Di Delete!!']);
        }
    }
}
