@extends('layout.presensi')
@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
        <div class="section" id="user-section">
            <div id="user-detail">
                <div class="avatar">

                    @if (!empty(Auth::guard()->user()->foto_saksi))
                    @php
                        $path = Storage::url('public/uploads/saksi/'.Auth::guard('caleg')->user()->foto_saksi);
                    @endphp
                    <img src="{{ url($path) }}" alt="avatar" class="imaged w64 rounded" style="height: 60px;">
                    @else
                    <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" alt="avatar" class="imaged w32 rounded" style="height: 40px;">
                    @endif

                </div>
                <div id="user-info">
                    <h2 id="user-name">{{ Auth::guard('caleg')->user()->nama_saksi }}</h2>
                    <span id="user-role"><b>Relawan {{ $saksi->nama_parpol }}</span>
                </div>
            </div>
        </div>

        <div class="section" id="menu-section">
            <div class="card">
                <div class="card-body text-center">
                    <div class="list-menu">
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/editprofile" class="green" style="font-size: 40px;">
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
                                <span class="text-center">Kalender</span>
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
                                    <th>Lokasi</th>
                                </tr>
                                <tr>
                                    <td>{{ $tps->nama_tps }}</td>
                                    <td>{{ $tps->alamat }}</td>
                                    <td>{{ $tps->desa }}</td>
                                    <td>{{ $tps->kecamatan }}</td>
                                    <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter{{ $tps->id_tps }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5"></path>
                                        <path d="M9 4v13"></path>
                                        <path d="M15 7v5.5"></path>
                                        <path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z"></path>
                                        <path d="M19 18v.01"></path>
                                        </svg>
                                    </button>
                                </td>
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
                                Calon Pemilih Tetap
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
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                        <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w32 rounded">
                                    </div>
                                    <div class="in">
                                        <div>{{ $d->nama_voters }}</div>
                                        <span class="badge badge-success">{{ $d->desa }}</span>
                                        <span class="badge badge-danger">{{ $d->kecamatan }}</span>
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

        <div class="modal fade" id="exampleModalCenter{{ $tps->id_tps }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <style>
                        #map { height: 250px; }
                    </style>

                    <div id="map"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

@endsection

@push('myscript')
<script>
    var lokasi = "{{ $tps->lokasi }}";
    var lok = lokasi.split(",");
    var map = L.map('map').setView([lok[0], lok[1]], 18);


    L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(map);
    var marker = L.marker([lok[0], lok[1]]).addTo(map);
    var circle = L.circle([lok[0], lok[1]], {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: 20
    }).addTo(map);
    var popup = L.popup()
    .setLatLng([lok[0], lok[1]])
    .setContent("{{ $tps->nama_tps }}")
    .openOn(map);
</script>
@endpush
