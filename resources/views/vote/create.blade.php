@extends('layout.presensi');
@section('header')

    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Data Suara {{ $tps->nama_tps }}</div>
        <div class="right"></div>
    </div>

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

    @error('foto')
        <div class="alert alert-outline-error">
            <p>{{ $messageerror }}</p>
        </div>
    @enderror
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card mt-2">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Nama Kandidat</th>
                            <th>Asal Parpol</th>
                            <th>Suara</th>
                        </tr>
                        @foreach ($caleg as $c)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $c->nama_caleg }}</td>
                                <td>{{ $c->nama_parpol }}</td>
                                <td>0</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fab-button animate bottom-right dropdown" style="margin-bottom: 70px;">
        <a href="#" class="fab bg-primary" data-toggle="dropdown">
            <ion-icon name="add-outline" role="img" class="md hydrated"></ion-icon>
        </a>
        <div class="dropdown-menu">
            <a href="/izinabsen" class="dropdown-item bg-primary">
                <ion-icon name="document-outline" role="img" aria-label="image outline" class="md hydrated"></ion-icon>
                <p>Tambah Suara</p>
            </a>
            <a href="/izinsakit" class="dropdown-item bg-primary">
                <ion-icon name="medkit-outline"></ion-icon>
                <p>Tambah Bukti</p>
            </a>
        </div>
    </div>
@endsection