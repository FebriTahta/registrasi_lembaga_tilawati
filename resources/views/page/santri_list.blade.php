@extends('layouts.master')

@section('style')

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" /> --}}

<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Daftar Santri Lembaga {{auth()->user()->username}}</h5>
                                <p class="mb-4">
                                    Berikut adalah daftar data santri yang telah terdaftar
                                </p>
                                <ul>
                                    <li>Anda dapat menambahkan santri baru dengan menekan tombol Tambah Santri.</li>
                                    <li>Atau anda dapat menambahkan beberapa santri sekaligus dengan mengunduh template Santri, Kemudian mengimportkannya kembali dengan mengisi data yang sesuai dengan template.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                {{-- <div class="card">
                    <div class="card-body"> --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (isset($errors) && $errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    @endif
                    {{-- </div>
                </div> --}}
            </div>
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="/create-new-santri" class="btn btn-success mb-2" style="margin-bottom: 20px; width: 100%"> Tambah Santri</a>
                            </div>
                            <div class="col-md-4">
                                <a href="/export-template-santri" class="btn btn-info mb-2" style="margin-bottom: 20px; width: 100%"> Unduh Template Santri</a>
                            </div>
                            <div class="col-md-4">
                                <a href="#" class="btn btn-primary mb-2" style="margin-bottom: 20px;width: 100%" data-toggle="modal" data-target="#modalimport"> Import Data Santri</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table id="table_guru" class="table table-bordered table-hover" style="max-width: 100%; margin-bottom:20px">
                                <thead style="margin-top: 20px">
                                    <tr>
                                        <th style="width: 7%">No</th>
                                        <th>Nama</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Wali Santri</th>
                                        <th>Nomor Wali</th>
                                        <th style="width: 13%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-capitalize"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-diklat-kirim" id="modalimport" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">IMPORT DATA SANTRI </h5>
                    <a href="#" type="button" class="close" data-dismiss="modal"  aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <hr>
                <form action="{{route('import.santri')}}" method="POST" enctype="multipart/form-data"> @csrf
                    <div class="modal-body">
                        <input type="hidden" name="lembaga_id" value="{{auth()->user()->lembagasurvey->id}}">
                        <input type="file" name="file" class="form-control" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="SUBMIT">
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade bs-example-modal-diklat-kirim" id="modalhapus" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgb(253, 147, 147)">
                        <h5 class="modal-title mt-0 text-white">HAPUS DATA SANTRI </h5>
                        <a href="#" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Apakah anda yakin akan menghapus SANTRI</p>
                            <span>ATAS NAMA : </span><span id="nama_santri"></span>
                        </div>
                    </div>
                    <hr>
                    <div class="modal-footer">
                        <form id="formhapus">@csrf
                            <input type="hidden" name="id" id="id">
                            <button type="button" id="btnclose" class="close btn btn-secondary">close</button>
                            <input type="submit" id="btnhapus" class="btn btn-danger" value="hapus">
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade bs-example-modal-diklat-kirim" id="modallihat" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgb(36, 128, 165)">
                        <h5 class="modal-title mt-0 text-white">DETAIL DATA SANTRI </h5>
                        <a href="#" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <form id="formsubmit"> @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="nama_guru" class="mb-1" style="font-weight: bold">Nama Santri</label>
                                <input type="text" class="form-control" id="nama_santri2" name="nama_santri">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="tempat_lahir_guru" class="mb-1" style="font-weight: bold">Tempat Lahir Santri</label>
                                        <input type="text" class="form-control" id="tempat_lahir_santri" name="tempat_lahir_santri">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3" >
                                        <label for="tanggal_lahir_guru" class="mb-1" style="font-weight: bold">Tanggal Lahir Santri</label>
                                        <input type="date" class="form-control" id="tanggal_lahir_santri" name="tanggal_lahir_santri" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3 ">
                                    <div class="form-group">
                                        <label for="telp_guru" style="font-weight: bold">Wali Santri</label>
                                        <div class="col-md">
                                            <div class="form-check form-check-inline mt-3">
                                              <input class="form-check-input" type="radio" name="jenis_wali_santri" id="ayah" value="ayah" required>
                                              <label class="form-check-label" for="inlineRadio1">Ayah </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" type="radio" name="jenis_wali_santri" id="ibu" value="ibu" required>
                                              <label class="form-check-label" for="inlineRadio2">Ibu </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="jenis_wali_santri" id="lainnya" value="lainnya" required>
                                                <label class="form-check-label" for="inlineRadio3">Selain Ayah & Ibu </label>
                                              </div>
                                          </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group mb-3">
                                        <label for="nama_wali_santri" class="mb-1" style="font-weight: bold">Nama Wali Santri</label>
                                        <input type="text" class="form-control" id="nama_wali_santri" name="nama_wali_santri">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="telp_guru" class="mb-1" style="font-weight: bold">No. Telp (Wali Santri)</label>
                                        <input type="text" class="form-control" id="telp_wali_santri" name="telp_wali_santri">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="alamat_guru" class="mb-1" style="font-weight: bold">Alamat Santri</label>
                                        <textarea name="alamat_santri" id="alamat_santri" class="form-control" cols="30" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <input type="hidden" class="form-control" name="id" id="id2">
                            </div>
                        </div>
                        <hr>
                        <div class="modal-footer">
                            <button type="button" id="btnclose" class="close btn btn-secondary">close</button>
                            <input type="submit" id="btnsubmit" class="btn btn-primary" value="update">
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@section('script')
    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#modallihat').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var nama_santri = button.data('nama')
                var tanggal_lahir_santri = button.data('tanggal')
                var tempat_lahir_santri = button.data('tempat')
                var alamat_santri = button.data('alamat')
                var telp_wali_santri = button.data('telp')
                var nama_wali_santri = button.data('nama_wali')
                var jenis_wali_santri = button.data('jenis')
                var modal = $(this)
                $('#nama_santri2').val(nama_santri);
                $('#tanggal_lahir_santri').val(tanggal_lahir_santri);
                $('#tempat_lahir_santri').val(tempat_lahir_santri);
                $('#alamat_santri').val(alamat_santri);
                $('#telp_wali_santri').val(telp_wali_santri);
                $('#id2').val(id);
                $('#nama_wali_santri').val(nama_wali_santri);
                console.log(nama_wali_santri);
                if (jenis_wali_santri == 'ayah') {
                    var ayah = document.getElementById("ayah");
                    ayah.checked = true;
                }else if(jenis_wali_santri == 'ibu'){
                    var ibu = document.getElementById("ibu");
                    ibu.checked = true;
                }else{
                    var lainnya = document.getElementById("lainnya");
                    lainnya.checked = true;
                }
            })

        $('#download_sertifikat2').on('click', function() {
                $.ajax({
                    type:'GET',
                    url:'/check-guru-dan-santri',
                    success:function(response) {
                        if (response.guru == 0 || response.santri == 0) {
                            swal({
                                title: "PERHATIAN",
                                text: 'sertifikat tersedia setelah lembaga melakukan update data guru & santri',
                                type: "error"
                            });
                        }else{
                            swal({
                                title: "OK",
                                text: 'Tekan OK untuk mengunduh Sertifikat',
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    window.location.href = "/download-sertifikat";
                                }
                            });
                        }
                    }
                });
            })

        $(document).ready(function () {
            $('#table_guru').DataTable({
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url:'/daftar-santri',
                        },
                        columns: [
                            {
                                "data": "id",
                                render: function (data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                }
                            },
                            {
                            data:'nama_santri',
                            name:'nama_santri'
                            },
                            {
                            data:'tgllahir',
                            name:'tanggal_lahir_santri '
                            },
                            {
                            data:'wali',
                            name:'nama_wali_santri'
                            },
                            
                            {
                            data:'telp_wali_santri',
                            name:'telp_wali_santri'
                            },

                            {
                            data:'opsi',
                            name:'opsi'
                            },
                            
                        ]
                    });
        })

        $('#modalhapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var nama_santri = button.data('nama')
                var modal = $(this)
                $('#nama_santri').html(nama_santri);
                $('#id').val(id);
            })

        $('#formhapus').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/remove-santri",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnhapus').attr('disabled', 'disabled');
                    $('#btnhapus').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $("#formhapus")[0].reset();
                        $('#btnhapus').val('Daftar');
                        $('#btnhapus').attr('disabled', false);
                        $('#modalhapus').modal('hide');
                        var oTable = $('#table_guru').dataTable();
                        oTable.fnDraw(false);
                        toastr.success(response.message);
                        swal({
                            title: "SUKSES!",
                            text: response.message,
                            type: "success"
                        });
                    } else {
                        $('#modalhapus').modal('hide');
                        $('#btnhapus').val('Daftar');
                        $('#btnhapus').attr('disabled', false);
                        toastr.error(response.message);
                        swal({
                            title: "OOPS SORRY!",
                            text: response.message,
                            type: "error"
                        });
                        $('#errList').html("");
                        $('#errList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values) {
                            $('#errList').append('<div>' + err_values + '</div>');
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('.close').on('click',function () {
            $('#modalhapus').modal('hide');
            $('#modallihat').modal('hide');
        });

        $('#formsubmit').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/update-santri",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnsubmit').attr('disabled', 'disabled');
                    $('#btnsubmit').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $("#formsubmit")[0].reset();
                        $('#btnsubmit').val('Daftar');
                        $('#btnsubmit').attr('disabled', false);
                        $('#modallihat').modal('hide');
                        var oTable = $('#table_guru').dataTable();
                        oTable.fnDraw(false);
                        toastr.success(response.message);
                        swal({
                            title: "SUKSES!",
                            text: response.message,
                            type: "success"
                        });
                    } else {
                        $('#modallihat').modal('hide');
                        $('#btnsubmit').val('Daftar');
                        $('#btnsubmit').attr('disabled', false);
                        toastr.error(response.message);
                        swal({
                            title: "OOPS SORRY!",
                            text: response.message,
                            type: "error"
                        });
                        $('#errList').html("");
                        $('#errList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values) {
                            $('#errList').append('<div>' + err_values + '</div>');
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>    
@endsection
