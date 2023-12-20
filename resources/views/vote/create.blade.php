@extends('layout.presensi');
@section('header')

    <div class="appHeader bg-danger text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBacc">
                <ion-icon name="chevron-bacc-outline"></ion-icon>
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

    </div>
</div>

<div class="row">
    <div class="col">
        <div class="card mt-2">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th width="30px">No</th>
                            <th class="text-center">Nama candidat</th>
                            <th class="text-center">Jumlah Suara</th>
                            <th class="text-center">#</th>
                        </tr>
                        <?php
                            $jml =0;
                            $jml_vote=0;
                        ?>
                        @foreach ($suara as $c)
                        <?php
                            $jml = $c->jml_vote;
                            $jml_vote += $jml;
                        ?>
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $c->nama_caleg }}</td>
                                <td class="text-center">{{ $c->jml_vote }}</td>
                                <td class="text-center">
                                    <form action="/vote/{{ $c->id }}/{{ $c->id_tps }}/deleteVote" method="POST" style="margin-left: 5px;">
                                        @csrf
                                        <a class="btn btn-danger btn-sm btnEdit">
                                            &nbsp;<ion-icon name="trash-outline"></ion-icon>
                                        </a>
                                    </form>
                                    </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" class="text-right">Jumlah</td>
                            <td class="text-center">{{ $jml_vote }}</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fab-button animate bottom-right dropdown" style="margin-bottom: 70px;">
    <a href="#" class="fab bg-danger" data-toggle="dropdown">
        <ion-icon name="add-outline" role="img" class="md hydrated"></ion-icon>
    </a>
    <div class="dropdown-menu">
        <button type="button" class="dropdown-item bg-success" data-toggle="modal" data-target="#suara">
            <ion-icon name="person-add-outline"></ion-icon>
            <p>Tambah Suara</p>
        </button>
        <button type="button" class="dropdown-item bg-primary" data-toggle="modal" data-target="#foto">
            <ion-icon name="camera-outline"></ion-icon>
            <p>Tambah Bucti</p>
        </button>
    </div>
</div>

<div class="modal fade" id="suara" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/vote/addvote" method="POST" id="frmsuara">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Suara</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <label for="jml_vote">candidat</label>
                            <select name="id" id="id" class="form-control">
                                <option value="">Pilih candidat</option>
                                @foreach($caleg as $c)
                                    <option value="{{ $c->id }}">{{ $c->nama_caleg }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jml_vote">Jumlah Vote</label>
                            <input type="number" name="jml_vote" id="jml_vote" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/vote/addbucti" method="POST" enctype="multipart/form-data" id="frbucti">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Foto Bucti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Foto">Foto</label>
                        <input type="file" name="foto_bucti" id="foto_bucti" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('myscript')
    <script>
        $(function(){
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
            $("#frmsuara").submit(function() {
                var id = $("#id").val();
                var jml_vote = $("#frmsuara").find("#jml_vote").val();

                if(id == ""){
                    Swal.fire({
                    title: 'Oops!',
                    text: "candidat harus diisi!!",
                    icon: 'warning',
                    });
                    return false;
                }else if(jml_vote == ""){
                    Swal.fire({
                    title: 'Oops!',
                    text: "Jumlah vote harus diisi!!",
                    icon: 'warning',
                    });
                    return false;
                }
            });
            $("#frbucti").submit(function() {
                var foto_bucti = $("#foto_bucti").val();

                if(foto_bucti == ""){
                    Swal.fire({
                    title: 'Oops!',
                    text: "Foto harus diisi!!",
                    icon: 'warning',
                    });
                    return false;
                }
            });
        });

    </script>
@endpush
