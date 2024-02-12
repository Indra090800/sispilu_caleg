<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
  @page { size: Letter }
  #h3{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 18px;
    font-weight: bold;
  }
  .tblkaryawan{
    margin-top: 40px;
  }

  .tblkaryawan td {
    padding: 5px;
  }

  .presensi{
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
  }

  .presensi tr th{
    border: 1px solid #000;
    padding: 8px;
    background: #dbdbdb;
    font-size: 10px;
  }

  .presensi tr td{
    border: 1px solid #000;
    padding: 5px;
    font-size: 12px;
  }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="Letter portrait">
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width: 100%;">
        <tr>
            <td style="width: 30px;"><img src="{{ asset('dist/img/logo_merah.png') }}" width="100px" height="100px" alt=""></td>
            <td><span id="h3">
                <center>DATABASE SAKSI PEMILIH ADES SINAGA</center> <br>
                <center>CALON ANGGOTA LEGISLATIF DPRD KOTA CILEGON</center><br>
                <center>DAPIL 4</center> <br>
                <center>PARTAI DEMOKRASI INDONESIA PERJUANGAN</center> <br>
                </span>
            </td>
            <td style="width: 30px;"><img src="{{ asset('dist/img/logo.png') }}" width="100px" height="100px" alt=""></td>
        </tr>
    </table>

    <table class="presensi">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Username</th>
                <th class="text-center">Nama Saksi</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">Desa</th>
                <th class="text-center">Kecamatan</th>
                <th class="text-center">No. HP</th>
                <th class="text-center">foto_saksi</th>
                <th class="text-center">Asal Parpol</th>
                <th class="text-center">Asal TPS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($saksi as $k)
            @php
                $path = Storage::url('uploads/saksi/'.$k->foto_saksi);
            @endphp
                <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td style="text-align: center">{{ $k->nik_ktp }}</td>
                    <td>{{ $k->nama_saksi }}</td>
                    <td>{{ $k->alamat }}</td>
                    <td>{{ $k->desa}}</td>
                    <td>{{ $k->kecamatan}}</td>
                    <td>{{ $k->no_hp }}</td>
                    <td style="text-align: center">
                        @if (empty($k->foto_saksi))
                        <img src="{{ asset('assets/img/nophoto.png') }}" width="50px" class="avatar" alt="">
                        @else
                        <img src="{{ url($path) }}" width="50px" class="avatar" alt="">
                        @endif
                    </td>
                    <td>{{ $k->nama_parpol }}</td>
                    <td style="text-align: center">{{ $k->nama_tps }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

  </section>

</body>
<script>
    window.print()
</script>
</html>