@extends('layout.presensi');
@section('header')

    <div class="appHeader bg-danger text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Edit Profile</div>
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
<form action="/sispilu/{{ $saksi->id_saksi }}/updateprofile" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="col">
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{ $saksi->nik_ktp }}" name="nik_ktp" placeholder="NIK" autocomplete="off" readonly>
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{ $saksi->nama_saksi }}" name="nama_saksi" placeholder="Nama Lengkap" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{ $saksi->alamat }}" name="alamat" placeholder="Alamat Lengkap" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="text" class="form-control" value="{{ $saksi->no_hp }}" name="no_hp" placeholder="No. HP" autocomplete="off">
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
            </div>
        </div>
        <div class="custom-file-upload" id="fileUpload1">
            <input type="file" name="foto_saksi" id="fileuploadInput" accept=".png, .jpg, .jpeg">
            <label for="fileuploadInput">
                <span>
                    <strong>
                        <ion-icon name="cloud-upload-outline" role="img" class="md hydrated" aria-label="cloud upload outline"></ion-icon>
                        <i>Tap to Upload</i>
                    </strong>
                </span>
            </label>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <button type="submit" class="btn btn-primary btn-block">
                    <ion-icon name="refresh-outline"></ion-icon>
                    Update
                </button>
            </div>
        </div>
    </div>
</form>

@endsection
