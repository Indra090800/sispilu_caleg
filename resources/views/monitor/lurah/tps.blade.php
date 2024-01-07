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
            Monitoring Kelurahan TPS
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

        <div class="row">
            <div class="col-12">

            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (Session::get('error'))
                <div class="alert alert-error">
                    {{ Session::get('error') }}
                </div>
            @endif
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12 mr-2">
                <a href="#" class="btn btn-primary" id="btnTambah">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
                </svg>
                Tambah Suara</a>
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
    </div>
</div>

<div class="modal modal-blur fade" id="modal-inputsaksi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Tambah Suara Kandidat</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/addsuara" method="post" id="frmSaksi" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-barcode" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7v-1a2 2 0 0 1 2 -2h2"></path>
                                <path d="M4 17v1a2 2 0 0 0 2 2h2"></path>
                                <path d="M16 4h2a2 2 0 0 1 2 2v1"></path>
                                <path d="M16 20h2a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M5 11h1v2h-1z"></path>
                                <path d="M10 11l0 2"></path>
                                <path d="M14 11h1v2h-1z"></path>
                                <path d="M19 11l0 2"></path>
                                </svg>
                            </span>
                            <input type="text" maxlength="17" name="jml_vote" class="form-control" placeholder="Add Hasil Vote" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <select name="id_tps" id="id_tps" class="form-select" required>
                            <option value="">Pilih TPS</option>
                            @foreach ($tps as $j)
                                <option value="{{ $j->id_tps }}">{{ $j->nama_tps }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <div class="mb-3">
                            <input type="file" name="foto_bukti" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 14l11 -11"></path>
                                <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                                </svg>
                            Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endsection

@push('myscripct')
<script>
    $(function(){

        $("#btnTambah").click(function(){
            $("#modal-inputsaksi").modal("show");
        });
    });
</script>
@endpush
