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
            Monitoring Kecamatan/Desa Voters
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

        </div>


        <div class="row mt-2">
            <div class="col-12">
                <form action="/kordinator/voters" method="GET">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <select name="desa" id="desa" class="form-select">
                                    <option value="">{{ Request('desa') != null  ? Request('desa') : 'Pilih Desa' }}</option>
                                    @foreach ($ovoters as $j)
                                        <option value="{{ $j->desa }}">{{ $j->desa }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select name="kecamatan" id="kecamatan" class="form-select">
                                    <option value="">{{ Request('desa') != null  ? Request('kecamatan') : 'Pilih Kecamatan' }}</option>
                                    @foreach ($ovoters2 as $j)
                                        <option value="{{ $j->kecamatan }}">{{ $j->kecamatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <select name="id_tps" id="id_tps" class="form-select">
                                <option value="">--Pilih TPS--</option>
                                @foreach ($tps as $j)
                                    <option value="{{ $j->id_tps }}">{{ $j->nama_tps }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
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
                                <th class="text-center">Asal. TPS</th>
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
                                    <td class="text-center">{{ $k->nama_tps }}</td>
                                    <td class="text-center">{{ $k->nama_caleg }}</td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $voters->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
