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
            Dashboard
        </h2>
        </div>
        <!-- Page title actions -->
    </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">

            <div class="col-md-6 col-xl-3">
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
                            {{ $countVoters->jml_voters }}
                        </div>
                        <div class="text-muted">
                            Jumlah Voters
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
                        {{ $counttps->jml_tps }}
                        </div>
                        <div class="text-muted">
                            Jumlah TPS
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
                        <span class="bg-warning text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-pentagon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13.163 2.168l8.021 5.828c.694 .504 .984 1.397 .719 2.212l-3.064 9.43a1.978 1.978 0 0 1 -1.881 1.367h-9.916a1.978 1.978 0 0 1 -1.881 -1.367l-3.064 -9.43a1.978 1.978 0 0 1 .719 -2.212l8.021 -5.828a1.978 1.978 0 0 1 2.326 0z" /><path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6z" /><path d="M6 20.703v-.703a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v.707" /></svg>
                        </span>
                        </div>
                        <div class="col">
                        <div class="font-weight-medium">
                        {{ $countusers->jml_users }}
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
                        {{ $countparpol->jml_parpol }}
                        </div>
                        <div class="text-muted">
                            Jumlah Parpol
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row">

            <div class="col-md-6 col-xl-4">
                
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="card card-sm">
                    <div class="card-body">
                        <form action="/cari/monitor" method="get" id="frmCari">
                            <div class="form-group">
                                <select name="kecamatan" id="kecamatan" class="form-control">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($Otps2 as $o)
                                        <option value="{{ $o->kecamatan }}">{{ $o->kecamatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <select name="desa" id="desa" class="form-control">
                                    <option value="">Pilih Kelurahan</option>
                                    @foreach ($Otps as $o)
                                        <option value="{{ $o->desa }}">{{ $o->desa }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-danger w-100">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                
            </div>
        </div>
    </div>
    
</div>

@endsection

@push('myscripct')
    <script>
        $(function(){



            $("#frmCari").submit(function(){
                var kecamatan = $("#kecamatan").val();

                if(kecamatan==""){
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
            
            });
        });

    </script>
@endpush
