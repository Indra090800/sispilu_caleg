<?php

namespace App\Http\Controllers;

use App\Models\Voters;
use App\Models\VoteSuara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class VotersController extends Controller
{
    public function index(Request $request)
    {
        $query = Voters::query();
        $query->select('tb_voters.*');
        $query->orderBY('nik_voters');
        if(!empty($request->nama_voters)){
            $query->where('nama_voters', 'like', '%'. $request->nama_voters.'%');
        }
        $voters = $query->paginate(7);
        return view('master.voters', compact('voters'));
    }

    public function addVoters(Request $request)
    {
        $nama_voters   = $request->nama_voters;
        $nik_voters    = $request->nik_voters;
        $alamat        = $request->alamat;
        $usia          = $request->usia;
        $rt            = $request->rt;
        $rw            = $request->rw;
        $desa          = $request->desa;
        $kecamatan     = $request->kecamatan;
        $kota          = $request->kota;
        $no_hp         = $request->no_hp;

        try {
            $data = [
                'nama_voters'  => $nama_voters,
                'nik_voters'   => $nik_voters,
                'alamat'       => $alamat,
                'usia'         => $usia,
                'rt'           => $rt,
                'rw'           => $rw,
                'no_hp'        => $no_hp,
                'desa'         => $desa,
                'desa'         => $desa,
                'kecamatan'    => $kecamatan,
                'kota'         => $kota,
            ];
            $simpan = DB::table('tb_voters')->insert($data);
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

    public function editVoters($id_voters, Request $request)
    {
        $nama_voters   = $request->nama_voters;
        $nik_voters    = $request->nik_voters;
        $alamat        = $request->alamat;
        $usia          = $request->usia;
        $rt            = $request->rt;
        $rw            = $request->rw;
        $desa          = $request->desa;
        $kecamatan     = $request->kecamatan;
        $kota          = $request->kota;
        $no_hp         = $request->no_hp;

        try {
            $data = [
                'nama_voters'  => $nama_voters,
                'nik_voters'   => $nik_voters,
                'alamat'       => $alamat,
                'usia'         => $usia,
                'rt'           => $rt,
                'rw'           => $rw,
                'no_hp'        => $no_hp,
                'desa'         => $desa,
                'kecamatan'    => $kecamatan,
                'kota'         => $kota,
            ];
            $update = DB::table('tb_voters')->where('id_voters', $id_voters)->update($data);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update!!']);
        }
        } catch (\Exception $e) {
            return Redirect::back()->with(['error' => 'Data Gagal Di Update!!']);
        }
    }

    public function delete($id_voters)
    {
        $delete =  DB::table('tb_voters')->where('id_voters', $id_voters)->delete();

        if($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Delete!!']);
        }else{
            return Redirect::back()->with(['error' => 'Data Gagal Di Delete!!']);
        }
    }

    public function cetakVoters()
    {
        $cetak = DB::table('tb_voters')->orderBy('id_voters')->get();
        if(isset($_POST['excel'])){
            $time = date("d-M-Y H:i:s");

            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=Rekap-Pemilih-Relawan-Ades.xlsx");
        }
        return view('report.pdfVoters', compact('cetak'));
    }

    public function monitoring()
    {
        $id_caleg = Auth::guard('user')->user()->id;
        $query = VoteSuara::query();
        $query->selectRaw('SUM(jml_vote) as total');
        $query->where('id', 'like', '%'. $id_caleg.'%');
        $c = $query->get();
        $query = VoteSuara::query();
        $query->orderBy('jam', 'desc');
        $query->where('id', 'like', '%'. $id_caleg.'%');
        $caleg = $query->limit(1)->get();
        
        return view('master.monitoring', compact('caleg','c'));
    }
}
