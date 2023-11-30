@extends('layout.admin.tabler')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
        <h2 class="page-title">
            Data Caleg
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
                        <div class="row mt-2">
                            <div class="col-12">
                                <form action="/caleg" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ Request('nama_lengkap') }}"  class="form-control" placeholder="Nama caleg">
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
                                                <th class="text-center">NIK</th>
                                                <th class="text-center">Nama Caleg</th>
                                                <th class="text-center">Alamat</th>
                                                <th class="text-center">No. HP</th>
                                                <th class="text-center">Foto</th>
                                                <th class="text-center">Role</th>
                                                <th class="text-center">Asal Parpol</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($caleg as $k)
                                            @php
                                                $path = Storage::url('uploads/caleg/'.$k->foto);
                                            @endphp
                                                <tr>
                                                    <td>{{ $loop->iteration + $caleg->firstItem()-1 }}</td>
                                                    <td>{{ $k->nik }}</td>
                                                    <td>{{ $k->nama_lengkap }}</td>
                                                    <td>{{ $k->jabatan }}</td>
                                                    <td>{{ $k->no_hp }}</td>
                                                    <td class="text-center">
                                                        @if (empty($k->foto))
                                                        <img src="{{ asset('assets/img/nophoto.png') }}" class="avatar" alt="">
                                                        @else
                                                        <img src="{{ url($path) }}" class="avatar" alt="">
                                                        @endif
                                                    </td>
                                                    <td>{{ $k->nama_parpol }}</td>
                                                    <td>{{ $k->nama_cabang }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                        <form action="/caleg/{{ $k->nik }}/delete" method="POST" style="margin-left: 5px;">
                                                            @csrf
                                                            <a class="btn btn-danger btn-sm btnEdit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eraser" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3"></path>
                                                            <path d="M18 13.3l-6.3 -6.3"></path>
                                                            </svg>
                                                            </a>
                                                            <a href="/konfig/{{ $k->nik }}/setjamkerja" class="btn btn-success btn-sm">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                                    <path d="M14.647 4.081a.724 .724 0 0 0 1.08 .448c2.439 -1.485 5.23 1.305 3.745 3.744a.724 .724 0 0 0 .447 1.08c2.775 .673 2.775 4.62 0 5.294a.724 .724 0 0 0 -.448 1.08c1.485 2.439 -1.305 5.23 -3.744 3.745a.724 .724 0 0 0 -1.08 .447c-.673 2.775 -4.62 2.775 -5.294 0a.724 .724 0 0 0 -1.08 -.448c-2.439 1.485 -5.23 -1.305 -3.745 -3.744a.724 .724 0 0 0 -.447 -1.08c-2.775 -.673 -2.775 -4.62 0 -5.294a.724 .724 0 0 0 .448 -1.08c-1.485 -2.439 1.305 -5.23 3.744 -3.745a.722 .722 0 0 0 1.08 -.447c.673 -2.775 4.62 -2.775 5.294 0zm-2.647 4.919a3 3 0 1 0 0 6a3 3 0 0 0 0 -6z" stroke-width="0" fill="currentColor"></path>
                                                                 </svg>
                                                                </a>
                                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editcaleg{{ $k->nik }}">
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
                                </div>
                                {{ $caleg->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>


@endsection

@push('myscripct')
    <script>
        $(function(){
            
            $('#nik').mask("00000000000000000");
            $("#btnTambah").click(function(){
                $("#modal-inputcaleg").modal("show");
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


            $("#frmcaleg").submit(function(){
                var nik = $("#nik").val();
                var nama_lengkap = $("#frmcaleg").find("#nama_lengkap").val();
                var jabatan = $("#jabatan").val();
                var no_hp = $("#no_hp").val();
                var id_parpol = $("#frmcaleg").find("#id_parpol").val();
                var kode_cabang = $("#frmcaleg").find("#kode_cabang").val();

                if(nik==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'NIK Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#nik").focus();
                    });
                    
                    return false;
                }else if(nama_lengkap==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'Nama Lengkap Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#nama_lengkap").focus();
                    });
                    
                    return false;
                }else if(jabatan==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'Jabatan Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#jabatan").focus();
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

            $("#frcaleg").submit(function(){
                var nik = $("#frcaleg").find("#nik").val();
                var nama_lengkap = $("#frcaleg").find("#nama_lengkap").val();
                var jabatan = $("#frcaleg").find("#jabatan").val();
                var no_hp = $("#frcaleg").find("#no_hp").val();
                var id_parpol = $("#frcaleg").find("#id_parpol").val();

                if(nik==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'NIK Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#nik").focus();
                    });
                    
                    return false;
                }else if(nama_lengkap==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'Nama Lengkap Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#nama_lengkap").focus();
                    });
                    
                    return false;
                }else if(jabatan==""){
                    Swal.fire({
                    title: 'Warning!',
                    text: 'Jabatan Harus Diisi !!',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        $("#jabatan").focus();
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