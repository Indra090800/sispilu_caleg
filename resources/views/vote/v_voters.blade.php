@extends('layout.presensi');
@section('header')

    <div class="appHeader bg-danger text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBacc">
                <ion-icon name="chevron-bacc-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Data Voters</div>
        <div class="right"></div>
    </div>
    <style>
        table, th, td
         {

        border
        : 2px solid green;
        }
    </style>
@endsection

@section('content')

<div class="row" style="margin-top: 3rem;">
    <div class="col">
    @php
        $messagesuccess = Session::get('success');
        $messageerror = Session::get('error');
    @endphp
    @if (Session::get('success'))
        <div class="alert alert-outline-success">
            {{ $messagesuccess }}
        </div>
    @else
        <div class="alert alert-outline-error">
            {{ $messageerror }}
        </div>
    @endif

    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card mt-2">
            <div class="card-body">
                <div class="col-12">
                    <form action="/sispilu/voters/add" method="GET">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="text" name="nama_voters" id="nama_voters" value="{{ Request('nama_voters') }}"  class="form-control" placeholder="Nama voters">
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
                <div class="table-responsive" style="overflow-x:auto;">
                    <table class="table table-bordered" style="width:100%">
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
                                <th class="text-center">Aksi</th>
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
                                    <td class="text-center">{{ $k->kecamatan }}</td>
                                    <td class="text-center">{{ $k->kota }}</td>
                                    <td class="text-center">{{ $k->no_hp }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                        <form action="/sispilu/voters/{{ $k->id_voters }}/delete" method="POST" style="margin-left: 5px;">
                                            @csrf
                                            <a class="btn btn-danger btn-sm btnEdit">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </a>
                                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editvoters{{ $k->id_voters }}">
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><br>
                {{ $voters->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<div class="fab-button animate bottom-right dropdown" style="margin-bottom: 70px;">
    <a href="#" class="fab bg-danger" data-toggle="modal" data-target="#modal-inputvoters">
        <ion-icon name="add-outline" role="img" class="md hydrated"></ion-icon>
    </a>
</div>

<div class="modal modal-blur fade" id="modal-inputvoters" tabindex="-1" voters="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" voters="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Tambah Data Voters</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/sispilu/addVoters" method="post" id="frmVoters">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" name="nama_voters" id="nama_voters" class="form-control" placeholder="Nama Voters">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" name="nik_voters" id="nik_voters" class="form-control" placeholder="NIK">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="number" name="usia" id="usia" class="form-control" placeholder="Usia">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" name="rt" id="rt" class="form-control" placeholder="RT">
                        </div>
                    </div>
                </div><div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" name="rw" id="rw" class="form-control" placeholder="RW">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" name="desa" id="desa" class="form-control" placeholder="Nama Desa">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" name="kecamatan" id="kecamatan" class="form-control" placeholder="Nama Kecamatan">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" name="kota" id="kota" class="form-control" placeholder="kota Voters">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="No. HP">
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

@foreach ($voters as $k)
<div class="modal modal-blur fade" id="editvoters{{ $k->id_voters }}" tabindex="-1" voters="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" voters="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Edit Data Voters</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/sispilu/voters/{{ $k->id_voters }}/edit" method="POST" id="frVoters">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" value="{{ $k->nama_voters }}" name="nama_voters" id="nama_voters" class="form-control" placeholder="Nama Lengkap">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" value="{{ $k->nik_voters }}" name="nik_voters" id="nik_voters" class="form-control" placeholder="NIK">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="number" value="{{ $k->usia }}" name="usia" id="usia" class="form-control" placeholder="Usia">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" value="{{ $k->alamat }}" name="alamat" id="alamat" class="form-control" placeholder="Alamat">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" value="{{ $k->rt }}" name="rt" id="rt" class="form-control" placeholder="RT">
                        </div>
                    </div>
                </div><div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" value="{{ $k->rw }}" name="rw" id="rw" class="form-control" placeholder="RW">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" value="{{ $k->desa }}" name="desa" id="desa" class="form-control" placeholder="Nama Desa">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" value="{{ $k->kecamatan }}" name="kecamatan" id="kecamatan" class="form-control" placeholder="Nama Kecamatan">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" value="{{ $k->kota }}" name="kota" id="kota" class="form-control" placeholder="kota Voters">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <input type="text" value="{{ $k->no_hp }}" name="no_hp" id="no_hp" class="form-control" placeholder="kota Voters">
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

@push('myscript')
<script>
    $(function(){
        $("#btnTambah").click(function(){
            $("#modal-inputvoters").modal("show");
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


        $("#frmVoters").submit(function(){
            var nama_voters = $("#frmVoters").find("#nama_voters").val();
            var alamat = $("#alamat").val();
            var desa = $("#desa").val();
            var kecamatan = $("#kecamatan").val();
            var kota = $("#kota").val();

            if(nama_voters==""){
                Swal.fire({
                title: 'Warning!',
                text: 'Nama Voters Harus Diisi !!',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result) => {
                    $("#nama_voters").focus();
                });

                return false;
            }else if(alamat==""){
                Swal.fire({
                title: 'Warning!',
                text: 'Alamat Voters Harus Diisi !!',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result) => {
                    $("#alamat").focus();
                });

                return false;
            }else if(desa==""){
                Swal.fire({
                title: 'Warning!',
                text: 'Desa Harus Diisi !!',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result) => {
                    $("#desa").focus();
                });

                return false;
            }else if(kecamatan==""){
                Swal.fire({
                title: 'Warning!',
                text: 'Kecamatan Harus Diisi !!',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result) => {
                    $("#kecamatan").focus();
                });

                return false;
            }
            else if(kota==""){
                Swal.fire({
                title: 'Warning!',
                text: 'kota Voters Harus Diisi !!',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result) => {
                    $("#kota").focus();
                });

                return false;
            }
        });

        $("#frVoters").submit(function(){
            var nama_voters = $("#frVoters").find("#nama_voters").val();

            if(nama_voters==""){
                Swal.fire({
                title: 'Warning!',
                text: 'Nama Voters Harus Diisi !!',
                icon: 'warning',
                confirmButtonText: 'OK'
                }).then((result) => {
                    $("#nama_voters").focus();
                });

                return false;
            }
        });
    });


</script>
@endpush
