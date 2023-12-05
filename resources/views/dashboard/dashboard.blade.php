@extends('layout.presensi')
@section('content')

        <div class="section" id="user-section">
            <div id="user-detail">
                <div class="avatar">

                    {{-- @if (!empty(Auth::guard()->user()->foto))
                    @php
                        $path = Storage::url('public/uploads/karyawan/'.Auth::guard('karyawan')->user()->foto);
                    @endphp
                    <img src="{{ url($path) }}" alt="avatar" class="imaged w64 rounded" style="height: 60px;">
                    @else --}}
                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                    {{-- @endif --}}

                </div>
                <div id="user-info">
                    <h2 id="user-name">{{ Auth::guard('caleg')->user()->nama_saksi }}</h2>
                    <span id="user-role"><b>Saksi {{ $saksi->nama_parpol }}</span>
                </div>
            </div>
        </div>

        <div class="section" id="menu-section">
            <div class="card">
                <div class="card-body text-center">
                    <div class="list-menu">
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="green" style="font-size: 40px;">
                                    <ion-icon name="person-sharp"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Profil</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="danger" style="font-size: 40px;">
                                    <ion-icon name="calendar-number"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Cuti</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="warning" style="font-size: 40px;">
                                    <ion-icon name="document-text"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Histori</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="orange" style="font-size: 40px;">
                                    <ion-icon name="location"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                Lokasi
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/proseslogout" class="danger" style="font-size: 40px;">
                                    <ion-icon name="log-out-outline"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                Logout
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section mt-2" id="presence-section">
            <div class="todaypresence">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tr>
                                    <th>Nama TPS</th>
                                    <th>Alamat</th>
                                    <th>Desa</th>
                                    <th>Kecamatan</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td>{{ $tps->nama_tps }}</td>
                                    <td>{{ $tps->alamat }}</td>
                                    <td>{{ $tps->desa }}</td>
                                    <td>{{ $tps->kecamatan }}</td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="presencetab mt-2">
                <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                    <ul class="nav nav-tabs style1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                Kandidat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                Leaderboard
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-2" style="margin-bottom:100px;">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <ul class="listview image-listview">

                            @foreach ($caleg as $d)
                            @php
                                $path = Storage::url('uploads/caleg/'.$d->foto_caleg);
                            @endphp
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                        <ion-icon name="finger-print-outline" role="img" class="md hydrated"
                                            aria-label="image outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>{{ $d->nama_caleg }}</div>
                                        <span class="badge badge-success"></span>
                                        <span class="badge badge-danger">{{ $d->nama_parpol }}</span>
                                    </div>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                        <style>
                            .historycontent{
                                display: flex;
                            }
                            .datapresensi{
                                margin-left: 10px
                            }
                        </style>
                        {{-- @foreach ($historybulanini as $d)
                            <div class="card">
                                <div class="card-body">
                                    <div class="historycontent">
                                        <div class="iconpresensi">
                                            <ion-icon name="finger-print-outline" style="font-size: 48px" class="text-success"></ion-icon>
                                        </div>
                                        <div class="datapresensi">
                                            <h3 style="line-height: 3px">{{ $d->nama_jamKerja }}</h3>
                                            <h4 style="margin: 0px !important">{{ date("d-m-Y", strtotime($d->tgl_presensi)) }}</h4>
                                            <span>
                                                {!! $d->jam_in != null ? date("H:i", strtotime($d->jam_in)) : '<span class="text-danger">Belum Scan</span>' !!}
                                            </span> -
                                            <span>
                                                {!! $d->jam_out != null ? date("H:i", strtotime($d->jam_out)) : '<span class="text-danger">Belum Scan</span>' !!}
                                            </span>
                                            <br>
                                            <span>
                                                {!! date("H:i", strtotime($d->jam_in)) > date("H:i", strtotime($d->jam_masuk)) ? '<span class="text-danger">Terlambat</span>' : '<span class="text-success">Tepat Waktu</span>' !!}
                                            </span>
                                            <div class="mt-2" id="keterangan">
                                                @php
                                                    $jam_in = date("H:i", strtotime($d->jam_in));
                                                    $jam_masuk = date("H:i", strtotime($d->jam_masuk));

                                                    $jadwal_jmasuk = $d->tgl_presensi."".$jam_masuk;
                                                    $jpresensi = $d->tgl_presensi."".$jam_in;
                                                @endphp
                                                @if ($jam_in > $jam_masuk)
                                                @php
                                                    $jmlterlambat = hitungjamterlambar($jadwal_jmasuk, $jpresensi);
                                                @endphp
                                                    <span class="danger">Terlambat {{ $jmlterlambat }}</span>
                                                @else
                                                    <span style="color: green">Tepat Waktu</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach --}}
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <ul class="listview image-listview">

                            {{-- @foreach ($leaderboard as $l)
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>
                                            <b>{{ $l->nama_lengkap }}</b><br>
                                            <small class="text-muted">{{ $l->jabatan }}</small>
                                        </div>
                                        <span class="badge {{ $l->jam_in < "07:00" ? "bg-success" : "bg-danger"}}">{{ $l->jam_in }}</span>
                                    </div>
                                </div>
                            </li>
                            @endforeach --}}

                        </ul>
                    </div>

                </div>
            </div>
        </div>

@endsection
