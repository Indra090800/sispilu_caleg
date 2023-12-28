@extends('layout.admin.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <h2 class="page-title">
            Data Saksi
        </h2>
        </div>
        <!-- Page title actions -->
    </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
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
                        @if(Auth::guard()->user()->id_role == 2)
                        <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-primary" id="btnTambah">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                                </svg>
                                Tambah Data</a>
                            </div>
                        </div>
                        @endif
                        <div class="row mt-2">
                            <div class="col-12">
                                <form action="/saksi" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nama_saksi" id="nama_saksi" value="{{ Request('nama_saksi') }}"  class="form-control" placeholder="Nama saksi">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <select name="id_parpol" id="id_parpol" class="form-select">
                                                    <option value="">Asal Parpol</option>
                                                    @foreach ($parpol as $j)
                                                        <option {{ Request('id_parpol') == $j->id_parpol ? 'selected' : '' }} value="{{ $j->id_parpol }}">{{ $j->nama_parpol }}</option>
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

            </div>
        </div>
    </div>
</div>


<div class="modal modal-blur fade" id="modal-inputsaksi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Tambah Data Saksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/addSaksi" method="post" id="frmSaksi" enctype="multipart/form-data">
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
                            <input type="text" maxlength="17" name="nik_ktp" class="form-control" placeholder="nik_ktp" id="nik_ktp">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                            </span>
                            <input type="text" name="nama_saksi" id="nama_saksi" class="form-control" placeholder="Nama Saksi">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 21l18 0"></path>
                                <path d="M9 8l1 0"></path>
                                <path d="M9 12l1 0"></path>
                                <path d="M9 16l1 0"></path>
                                <path d="M14 8l1 0"></path>
                                <path d="M14 12l1 0"></path>
                                <path d="M14 16l1 0"></path>
                                <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16"></path>
                                </svg>
                            </span>
                            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-address-book" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z"></path>
                                <path d="M10 16h6"></path>
                                <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M4 8h3"></path>
                                <path d="M4 12h3"></path>
                                <path d="M4 16h3"></path>
                                </svg>
                            </span>
                            <input type="number" maxlength="15" name="no_hp" id="no_hp" class="form-control" placeholder="No Hp">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <select name="id_tps" id="id_tps" class="form-select">
                            <option value="">--Pilih TPS--</option>
                            @foreach ($tps as $j)
                                <option value="{{ $j->id_tps }}">{{ $j->nama_tps }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <select name="id_parpol" id="id_parpol" class="form-select">
                            <option value="">--Asal Parpol--</option>
                            @foreach ($parpol as $j)
                                <option value="{{ $j->id_parpol }}">{{ $j->nama_parpol }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <div class="mb-3">
                            <input type="file" name="foto_saksi" id="foto_saksi" class="form-control">
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

@foreach ($saksi as $k)
<div class="modal modal-blur fade" id="editsaksi{{ $k->id_saksi }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Edit Data Saksi</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/saksi/{{ $k->id_saksi }}/edit" method="POST" id="frSaksi" enctype="multipart/form-data">
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
                            <input type="number" value="{{ $k->nik_ktp }}" maxlength="17" name="nik_ktp" class="form-control" placeholder="nik_ktp" id="nik_ktp">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                            </span>
                            <input type="text" value="{{ $k->nama_saksi }}" name="nama_saksi" id="nama_saksi" class="form-control" placeholder="Nama Lengkap">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 21l18 0"></path>
                                <path d="M9 8l1 0"></path>
                                <path d="M9 12l1 0"></path>
                                <path d="M9 16l1 0"></path>
                                <path d="M14 8l1 0"></path>
                                <path d="M14 12l1 0"></path>
                                <path d="M14 16l1 0"></path>
                                <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16"></path>
                                </svg>
                            </span>
                            <input type="text" value="{{ $k->alamat }}" name="alamat" id="alamat" class="form-control" placeholder="Alamat">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-address-book" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z"></path>
                                <path d="M10 16h6"></path>
                                <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                <path d="M4 8h3"></path>
                                <path d="M4 12h3"></path>
                                <path d="M4 16h3"></path>
                                </svg>
                            </span>
                            <input type="number" value="{{ $k->no_hp }}" maxlength="15" name="no_hp" id="no_hp" class="form-control" placeholder="No Hp">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <select name="id_parpol" id="id_parpol" class="form-select">
                            <option value="{{ $k->id_parpol }}">{{ $k->nama_parpol }}</option>
                            @foreach ($parpol as $j)
                                <option value="{{ $j->id_parpol }}">{{ $j->nama_parpol }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <select name="id_tps" id="id_tps" class="form-select">
                            <option value="{{ $k->id_tps }}">{{ $k->nama_tps }}</option>
                            @foreach ($tps as $j)
                                <option value="{{ $j->id_tps }}">{{ $j->nama_tps }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <div class="mb-3">
                            <input type="file" name="foto_saksi" id="foto_saksi" class="form-control">
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
                            Edit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>
@endforeach

@endsection

@push('myscripct')
    <script>
        $(function(){

            $('#nik_ktp').mask("00000000000000000");
            $("#btnTambah").click(function(){
                $("#modal-inputsaksi").modal("show");
            });

            $(".btnEdit").click(function(e){
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah yakin ingin menghapus?',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire('Data Berhasil Di Hapus !!!', '', 'success')
                }
                })
            });


            $("#frmSaksi").submit(function(){
                var nik_ktp = $("#nik_ktp").val();
                var nama_saksi = $("#frmSaksi").find("#nama_saksi").val();
                var alamat = $("#alamat").val();
                var no_hp = $("#no_hp").val();
                var id_parpol = $("#frmSaksi").find("#id_parpol").val();
                var foto_saksi = $("#frmSaksi").find("#foto_saksi").val();

                if(nik_ktp==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'nik_ktp Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#nik_ktp").focus();
                    });

                    return false;
                }else if(nama_saksi==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'Nama Saksi Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#nama_saksi").focus();
                    });

                    return false;
                }else if(alamat==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'Alamat Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#alamat").focus();
                    });

                    return false;
                }else if(no_hp==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'No HP Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#no_hp").focus();
                    });

                    return false;
                } else if(id_parpol==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: ' Pilih Parpol Terlebih Dahulu !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#id_parpol").focus();
                    });

                    return false;
                }else if(foto_saksi==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: ' Foto Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#foto_saksi").focus();
                    });

                    return false;
                }
            });

            $("#frSaksi").submit(function(){
                var nik_ktp = $("#frSaksi").find("#nik_ktp").val();
                var nama_saksi = $("#frSaksi").find("#nama_saksi").val();
                var alamat = $("#frSaksi").find("#alamat").val();
                var no_hp = $("#frSaksi").find("#no_hp").val();
                var id_parpol = $("#frSaksi").find("#id_parpol").val();

                if(nik_ktp==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'nik_ktp Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#nik_ktp").focus();
                    });

                    return false;
                }else if(nama_saksi==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'Nama Lengkap Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#nama_saksi").focus();
                    });

                    return false;
                }else if(alamat==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'Alamat Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#alamat").focus();
                    });

                    return false;
                }else if(no_hp==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'No HP Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#no_hp").focus();
                    });

                    return false;
                } else if(id_parpol==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: ' Departemen Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#id_parpol").focus();
                    });

                    return false;
                } else if(kode_cabang==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: ' Cabang Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#kode_cabang").focus();
                    });

                    return false;
                }
            });
        });


    </script>
@endpush
