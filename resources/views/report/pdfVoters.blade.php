<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Rekap Laporan</title>

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
<body class="Letter landscape">
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width: 100%;">
        <tr>
            <td style="width: 30px;"><img src="{{ asset('dist/img/logo_merah.png') }}" width="100px" height="100px" alt=""></td>
            <td><span id="h3">
                <center>DATABASE CALON PEMILIH ADES SINAGA</center> <br>
                <center>CALON ANGGOTA LEGISLATIF DPRD KOTA CILEGON</center><br>
                <center>DAPIL 4</center> <br>
                <center>PARTAI DEMOKRASI INDONESIA PERJUANGAN</center> <br>
                </span>
            </td>
            <td style="width: 30px;"><img src="{{ asset('dist/img/logo.png') }}" width="100px" height="100px" alt=""></td>
        </tr>
    </table>

    <table class="presensi">
        <tr>
            <th>NO</th>
            <th>NIK</th>
            <th>NAMA</th>
            <th>USIA</th>
            <th>ALAMAT</th>
            <th>RT</th>
            <th>RW</th>
            <th>DESA</th>
            <th>KECAMATAN</th>
            <th>KOTA</th>
            <th>NO HP</th>
            <th>Asal Tps</th>
            <th>Nama Saksi</th>
        </tr>

        @foreach ($cetak as $r)
            <tr>
                <td><center>{{ $loop->iteration }}</center></td>
                <td><center>{{ $r->nik_voters }}</center></td>
                <td><center>{{ $r->nama_voters }}</center></td>
                <td><center>{{ $r->usia }}</center></td>
                <td>{{ $r->alamat }}</td>
                <td><center>{{ $r->rt }}</center></td>
                <td><center>{{ $r->rw }}</center></td>
                <td><center>{{ $r->desa }}</center></td>
                <td><center>{{ $r->kecamatan }}</center></td>
                <td><center>{{ $r->kota }}</center></td>
                <td><center>{{ $r->no_hp }}</center></td>
                <td><center>{{ $r->nama_tps }}</center></td>
                <td><center>{{ $r->nama_caleg }}</center></td>
            </tr>
        @endforeach
    </table>

    
    <table width="100%" style="margin-top: 100px;">
      <tr>
        <td></td>
        <td style="text-align: center;">Banjar, {{ date("d-m-Y") }} </td>
      </tr>
      <tr>
        <td style="text-align: center; vertical-align: bottom" height="100px">
          <u>Indra Maulana</u> <br>
          <i><b>HRD Manager</b></i>
        </td>
        <td style="text-align: center; vertical-align: bottom">
          <u>Hermin, S.Pd</u> <br>
          <i><b>Direktur</b></i>
        </td>
      </tr>
    </table>
  </section>

</body>

</html>