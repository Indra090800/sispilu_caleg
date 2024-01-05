@extends('layout.admin.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">
            Overview
        </div>
        <h2 class="page-title">
            Monitoring Kecamatan/Desa
        </h2>
        </div>
        <!-- Page title actions -->
    </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">

            <div class="col-md-6 col-xl-4">
                <div class="card card-sm">
                    <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <span class="bg-success text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                        </span>
                        </div>
                        <div class="col">
                        <div class="font-weight-medium">
                            {{ $jml_voters->jml_voters }}
                        </div>
                        <div class="text-muted">
                            Jumlah Voters
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card card-sm">
                    <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <span class="bg-info text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-text" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                            <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                            <path d="M9 9l1 0"></path>
                            <path d="M9 13l6 0"></path>
                            <path d="M9 17l6 0"></path>
                        </svg>
                        </span>
                        </div>
                        <div class="col">
                        <div class="font-weight-medium">
                            {{ $jml_tps->jml_tps }}
                        </div>
                        <div class="text-muted">
                            Jumlah TPS
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xl-4">
                <div class="card card-sm">
                    <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <span class="bg-dangertext-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-square-rounded" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" /><path d="M12 3c7.2 0 9 1.8 9 9s-1.8 9 -9 9s-9 -1.8 -9 -9s1.8 -9 9 -9z" /><path d="M6 20.05v-.05a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.05" /></svg>
                        </span>
                        </div>
                        <div class="col">
                        <div class="font-weight-medium">
                            {{ $jml_saksi->jml_saksi }}
                        </div>
                        <div class="text-muted">
                            Jumlah Saksi
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row mt-2">
            <div class="col-12">
                <form action="/cari/monitor/{{ $kecamatan }}" method="GET">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <input type="text" name="nama_voters" id="nama_voters" class="form-control" placeholder="Nama Voters">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <select name="desa2" id="desa2" class="form-control">
                                    <option value="">Pilih Kelurahan</option>
                                    @foreach ($Ovoters as $val)
                                        <option value="{{ $val->desa }}">{{ $val->desa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                    <path d="M21 21l-6 -6"></path>
                                    </svg>Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Voters</th>
                                <th class="text-center">NIK</th>
                                <th class="text-center">Usia</th>
                                <th class="text-center">Alamat</th>
                                <th class="text-center">RT</th>
                                <th class="text-center">RW</th>
                                <th class="text-center">Desa</th>
                                <th class="text-center">Kecamatan</th>
                                <th class="text-center">Kota</th>
                                <th class="text-center">No. HP</th>
                                <th class="text-center">Nama. Saksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($voters as $k)
                                <tr>
                                    <td width="5px">{{ $loop->iteration + $voters->firstItem()-1 }}</td>
                                    <td class="text-center">{{ $k->nama_voters }}</td>
                                    <td class="text-center">{{ $k->nik_voters }}</td>
                                    <td class="text-center">{{ $k->usia }}</td>
                                    <td class="text-center">{{ $k->alamat }}</td>
                                    <td class="text-center">{{ $k->rt }}</td>
                                    <td class="text-center">{{ $k->rw }}</td>
                                    <td class="text-center">{{ $k->desa }}</td>
                                    <td class="text-center">{{ $k->kecamatan }}</td>
                                    <td class="text-center">{{ $k->kota }}</td>
                                    <td class="text-center">{{ $k->no_hp }}</td>
                                    <td class="text-center">{{ $k->nama_saksi}}</td>
                                </tr>

                            @endforeach
                            <tr>
                                <td colspan="11" class="text-right">Jumlah </td>
                                <td class="text-center">{{ $jml_voters_desa->jml_voters_desa }}</td>
                            </tr>
                        </tbody>
                    </table><br>
                    {{ $voters->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <form action="/cari/monitor/{{ $kecamatan }}" method="GET">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <select name="desa1" id="desa1" class="form-control">
                                    <option value="">Pilih Kelurahan</option>
                                    @foreach ($Otps as $val)
                                        <option value="{{ $val->desa }}">{{ $val->desa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                    <path d="M21 21l-6 -6"></path>
                                    </svg>Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama TPS</th>
                                <th class="text-center">Desa</th>
                                <th class="text-center">Kecamatan</th>
                                <th class="text-center">Suara</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $jml =0;
                                $jml_tps=0;
                            ?>
                            @foreach ($tps as $k)
                            <?php
                                $count = DB::table('tb_vote_caleg')
                                ->selectRaw('SUM(jml_vote) as jml')
                                ->where('id_tps', $k->id_tps)
                                ->where('id', Auth::guard()->user()->id_kor)
                                ->first();
                                $jml = $count->jml;
                                $jml_tps += $jml;
                            ?>
                                <tr>
                                    <td width="5px">{{ $loop->iteration + $tps->firstItem()-1 }}</td>
                                    <td class="text-center">{{ $k->nama_tps }}</td>
                                    <td class="text-center">{{ $k->desa }}</td>
                                    <td class="text-center">{{ $k->kecamatan }}</td>
                                    <th class="text-center">{{ $count->jml }}</th>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-right">Jumlah</td>
                                <td class="text-center">{{ $jml_tps }}</td>
                            </tr>
                        </tbody>
                    </table><br>
                    {{ $tps->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>

        <div class="row mt-2">
                            <div class="col-12">
                                <form action="/cari/monitor/{{ $kecamatan }}" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="alamat" id="alamat" value="{{ Request('alamat') }}"  class="form-control" placeholder="Alamat">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <select name="id_tps" id="id_tps" class="form-select">
                                                    <option value="">Asal TPS</option>
                                                    @foreach ($tps1 as $j)
                                                        <option {{ Request('id_tps') == $j->id_tps ? 'selected' : '' }} value="{{ $j->id_tps }}">{{ $j->nama_tps }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                    <path d="M21 21l-6 -6"></path>
                                                    </svg>Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">nik_ktp</th>
                                                <th class="text-center">Nama Saksi</th>
                                                <th class="text-center">Alamat</th>
                                                <th class="text-center">Desa</th>
                                                <th class="text-center">Kecamatan</th>
                                                <th class="text-center">No. HP</th>
                                                <th class="text-center">foto_saksi</th>
                                                <th class="text-center">Asal Parpol</th>
                                                <th class="text-center">Asal TPS</th>
                                                @if(Auth::guard()->user()->id_role == 2)
                                                <th class="text-center">Aksi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($saksi as $k)
                                            @php
                                                $path = Storage::url('uploads/saksi/'.$k->foto_saksi);
                                            @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration + $saksi->firstItem()-1 }}</td>
                                                    <td>{{ $k->nik_ktp }}</td>
                                                    <td>{{ $k->nama_saksi }}</td>
                                                    <td>{{ $k->alamat }}</td>
                                                    <td>{{ $k->desa}}</td>
                                                    <td>{{ $k->kecamatan}}</td>
                                                    <td>{{ $k->no_hp }}</td>
                                                    <td class="text-center">
                                                        @if (empty($k->foto_saksi))
                                                        <img src="{{ asset('assets/img/nophoto.png') }}" class="avatar" alt="">
                                                        @else
                                                        <img src="{{ url($path) }}" class="avatar" alt="">
                                                        @endif
                                                    </td>
                                                    <td>{{ $k->nama_parpol }}</td>
                                                    <td>{{ $k->nama_tps }}</td>
                                                    @if(Auth::guard()->user()->id_role == 2)
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                        <form action="/saksi/{{ $k->id_saksi }}/delete" method="POST" style="margin-left: 5px;">
                                                            @csrf
                                                            <a class="btn btn-danger btn-sm btnEdit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eraser" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3"></path>
                                                            <path d="M18 13.3l-6.3 -6.3"></path>
                                                            </svg>
                                                            </a>
                                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editsaksi{{ $k->id_saksi }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                                <path d="M16 5l3 3"></path>
                                                                </svg>
                                                            </a>
                                                        </form>
                                                        </div>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div><br>
                                {{ $saksi->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
    </div>
</div>

@endsection
