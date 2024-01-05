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
            Monitoring Kecamatan/Desa TPS
        </h2>
        </div>
        <!-- Page title actions -->
    </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">

            <div class="col-md-6 col-xl-12">
                <div class="card card-sm">
                    <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <span class="bg-danger text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
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

        </div>


        <div class="row mt-2">
            <div class="col-12">
                <form action="/kordinator/tps" method="GET">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <select name="desa" id="desa" class="form-select">
                                    <option value="">{{ Request('desa') != null  ? Request('desa') : 'Pilih Desa' }}</option>
                                    @foreach ($Otps as $j)
                                        <option value="{{ $j->desa }}">{{ $j->desa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <select name="kecamatan" id="kecamatan" class="form-select">
                                    <option value="">{{ Request('desa') != null  ? Request('kecamatan') : 'Pilih Kecamatan' }}</option>
                                    @foreach ($Otps2 as $j)
                                        <option value="{{ $j->kecamatan }}">{{ $j->kecamatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
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
                                ->where('id', Auth::guard()->user()->id)
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
    </div>
</div>

@endsection
