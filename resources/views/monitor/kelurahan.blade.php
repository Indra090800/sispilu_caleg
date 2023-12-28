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
            Monitoring Kelurahan
        </h2>
        </div>
        <!-- Page title actions -->
    </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">

<<<<<<< HEAD
            <div class="col-md-6 col-xl-6">
=======
            <div class="col-md-6 col-xl-3">
>>>>>>> 44a586d21952ee4300d4de68172682b58ca8b0e1
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
<<<<<<< HEAD
                            {{ $jml_voters->jml_voters }}
=======
>>>>>>> 44a586d21952ee4300d4de68172682b58ca8b0e1
                        </div>
                        <div class="text-muted">
                            Jumlah Voters
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

<<<<<<< HEAD
            <div class="col-md-6 col-xl-6">
=======
            <div class="col-md-6 col-xl-3">
>>>>>>> 44a586d21952ee4300d4de68172682b58ca8b0e1
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
<<<<<<< HEAD
                            {{ $jml_tps->jml_tps }}
=======
>>>>>>> 44a586d21952ee4300d4de68172682b58ca8b0e1
                        </div>
                        <div class="text-muted">
                            Jumlah TPS
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

<<<<<<< HEAD
        </div>

        <div class="row mt-2">
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
                                <th class="text-center">No. HP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($voters as $k)
                                <tr>
                                    <td width="5px">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $k->nama_voters }}</td>
                                    <td class="text-center">{{ $k->nik_voters }}</td>
                                    <td class="text-center">{{ $k->usia }}</td>
                                    <td class="text-center">{{ $k->alamat }}</td>
                                    <td class="text-center">{{ $k->rt }}</td>
                                    <td class="text-center">{{ $k->rw }}</td>
                                    <td class="text-center">{{ $k->desa }}</td>
                                    <td class="text-center">{{ $k->no_hp }}</td>
                                </tr>

                            @endforeach
                            <tr>
                                <td colspan="8" class="text-right">Jumlah </td>
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
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama TPS</th>
                                <th class="text-center">Desa</th>
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
                                    <th class="text-center">{{ $count->jml }}</th>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="text-right">Jumlah</td>
                                <td class="text-center">{{ $jml_tps }}</td>
                            </tr>
                        </tbody>
                    </table><br>
                    {{ $tps->links('vendor.pagination.bootstrap-4') }}
                </div>
=======
            <div class="col-md-6 col-xl-3">
            <div class="card card-sm">
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                    <span class="bg-warning text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-pentagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13.163 2.168l8.021 5.828c.694 .504 .984 1.397 .719 2.212l-3.064 9.43a1.978 1.978 0 0 1 -1.881 1.367h-9.916a1.978 1.978 0 0 1 -1.881 -1.367l-3.064 -9.43a1.978 1.978 0 0 1 .719 -2.212l8.021 -5.828a1.978 1.978 0 0 1 2.326 0z" /><path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" /><path d="M6 20.703v-.703a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.707" /></svg>
                    </span>
                    </div>
                    <div class="col">
                    <div class="font-weight-medium">
                    </div>
                    <div class="text-muted">
                        Jumlah Caleg
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>

            <div class="col-md-6 col-xl-3">
            <div class="card card-sm">
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                    <span class="bg-danger text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M9 8l1 0" /><path d="M9 12l1 0" /><path d="M9 16l1 0" /><path d="M14 8l1 0" /><path d="M14 12l1 0" /><path d="M14 16l1 0" /><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /></svg>
                    </span>
                    </div>
                    <div class="col">
                    <div class="font-weight-medium">
                    </div>
                    <div class="text-muted">
                        Jumlah Parpol
                    </div>
                    </div>
                </div>
                </div>
            </div>
>>>>>>> 44a586d21952ee4300d4de68172682b58ca8b0e1
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD
=======

>>>>>>> 44a586d21952ee4300d4de68172682b58ca8b0e1
@endsection