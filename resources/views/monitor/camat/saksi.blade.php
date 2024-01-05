        <!-- Page title actions -->
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
                    Monitoring Kecamatan Saksi
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
                                <span class="bg-warning text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
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
                        <form action="/monitor/kordinator/saksi" method="GET">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <select name="desa" id="desa" class="form-select">
                                            <option value="">{{ Request('desa') != null  ? Request('desa') : 'Pilih Desa' }}</option>
                                            @foreach ($Osaksi as $j)
                                                <option value="{{ $j->desa }}">{{ $j->desa }}</option>
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
