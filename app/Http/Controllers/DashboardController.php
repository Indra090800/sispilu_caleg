<?php

namespace App\Http\Controllers;

use App\Models\Caleg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $id_tps = Auth::guard('caleg')->user()->id_tps;
        $id_parpol = Auth::guard('caleg')->user()->id_parpol;
        $id_saksi = Auth::guard('caleg')->user()->id_saksi;
        $query = Caleg::query();
        $query->select('users.*', 'nama_parpol');
        $query->join('tb_parpol', 'users.id_parpol', '=', 'tb_parpol.id_parpol');
        $query->orderBY('nama_caleg');
        $query->where('users.id_parpol', $id_parpol);
        $caleg = $query->get();
        $tps = DB::table('tb_tps')
        ->where('id_tps', $id_tps)->first();
        $saksi = DB::table('tb_saksi')
        ->leftJoin('tb_parpol', 'tb_saksi.id_parpol', '=', 'tb_parpol.id_parpol')
        ->where('id_saksi', $id_saksi)->first();

        return view('dashboard.dashboard', compact('tps', 'caleg', 'saksi'));
    }

    public function dashboardadmin()
    {
        return view('dashboard.dashboardadmin');
    }
}
