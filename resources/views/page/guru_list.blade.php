@extends('layouts.master')

@section('style')
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    <style>
        .select2-container--default .select2-selection--single{
            padding:6px;
            height: 40px;
            width: 100%; 
            font-size: 15px;  
            position: relative;
            border: 0.1;
        }
        span.select2-selection--single[aria-expanded=true] {
            border-color: blue !important;   
        }
    </style> --}}
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
                                    <h5 class="card-title text-primary">Daftar Guru Lembaga {{ auth()->user()->username }}
                                    </h5>
                                    <p class="mb-4">
                                        Berikut adalah daftar data guru yang telah terdaftar
                                    </p>
                                    <ul>
                                        <li>Anda dapat menambahkan guru baru dengan menekan tombol Tambah Guru.</li>
                                        <li>Atau anda dapat menambahkan beberapa guru sekaligus dengan mengunduh template
                                            Guru, Kemudian mengimportkannya kembali dengan mengisi data yang sesuai dengan
                                            template.</li>
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
                </div>
                


                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                    <div class="col-md-4">
                                        <a href="/create-new-guru" class="btn btn-success mb-2"
                                            style="margin-bottom: 20px; width: 100%"> Tambah Guru</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/export-template-guru" class="btn btn-info mb-2"
                                            style="margin-bottom: 20px;width: 100%"> Unduh Template Guru</a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="#" class="btn btn-primary mb-2"
                                            style="margin-bottom: 20px;width: 100%" data-toggle="modal"
                                            data-target="#modalimport"> Import Data Guru</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-4 order-0">
                    <div class="card">
                        <div class="card-body">

                            <div class="table-responsive">
                                <table id="table_guru" class="table table-bordered table-hover" style="max-width: 100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 7%">No</th>
                                            <th>Nama</th>
                                            <th>Telp</th>
                                            <th>Tanggal Lahir</th>
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

    

    <div class="modal fade bs-example-modal-diklat-kirim" id="modalimport" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">IMPORT DATA GURU </h5>
                        <a href="#" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <hr>
                    <form action="{{ route('import.guru') }}" method="POST" enctype="multipart/form-data"> @csrf
                        <div class="modal-body">
                            <input type="hidden" name="lembaga_id" value="{{ auth()->user()->lembagasurvey->id }}">
                            <input type="file" name="file" class="form-control"
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                required>
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
                        <h5 class="modal-title mt-0 text-white">HAPUS DATA GURU </h5>
                        <a href="#" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Apakah anda yakin akan menghapus GURU</p>
                            <span>ATAS NAMA : </span><span id="nama_guru"></span>
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
                        <h5 class="modal-title mt-0 text-white">DETAIL DATA GURU </h5>
                        <a href="#" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <form id="formsubmit"> @csrf
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="nama_guru" class="mb-1" style="font-weight: bold">NAMA</label>
                                <input type="text" class="form-control" id="nama_guru2" name="nama_guru">
                            </div>
                            <div class="form-group mb-3">
                                <label for="tempat_lahir_guru" class="mb-1" style="font-weight: bold">TEMPAT LAHIR</label>
                                <input type="text" class="form-control" id="tempat_lahir_guru" name="tempat_lahir_guru">
                            </div>
                            <div class="form-group mb-3" >
                                <label for="tanggal_lahir_guru" class="mb-1" style="font-weight: bold">TANGGAL LAHIR</label>
                                <input type="date" class="form-control" id="tanggal_lahir_guru" name="tanggal_lahir_guru" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="telp_guru" class="mb-1" style="font-weight: bold">TELP GURU</label>
                                <input type="text" class="form-control" id="telp_guru" name="telp_guru">
                            </div>
                            <div class="form-group mb-3">
                                <label for="alamat_guru" class="mb-1" style="font-weight: bold">ALAMAT GURU</label>
                                <textarea name="alamat_guru" id="alamat_guru" class="form-control" cols="30" rows="5"></textarea>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    
    <script>
        $(document).ready(function() {
            $('#table_guru').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/daftar-guru',
                },
                columns: [{
                        "data": "id",
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_guru',
                        name: 'nama_guru'
                    },
                    {
                        data: 'telp_guru',
                        name: 'telp_guru'
                    },
                    {
                        data: 'tgllahir',
                        name: 'tanggal_lahir_guru'
                    },
                    {
                        data: 'opsi',
                        name: 'opsi'
                    },

                ]
            });

            
        })

       

        $('.close').on('click',function () {
            $('#modalhapus').modal('hide');
            $('#modallihat').modal('hide');
        });


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

            $('#modalhapus').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var nama_guru = button.data('nama')
                var modal = $(this)
                $('#nama_guru').html(nama_guru);
                $('#id').val(id);
            })

            $('#modallihat').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var nama_guru = button.data('nama')
                var tanggal_lahir_guru = button.data('tanggal')
                var tempat_lahir_guru = button.data('tempat')
                var alamat_guru = button.data('alamat')
                var telp_guru = button.data('telp')
                var modal = $(this)
                $('#nama_guru2').val(nama_guru);
                $('#tanggal_lahir_guru').val(tanggal_lahir_guru);
                $('#tempat_lahir_guru').val(tempat_lahir_guru);
                $('#alamat_guru').val(alamat_guru);
                $('#telp_guru').val(telp_guru);
                $('#id2').val(id);
            })

        $('#formhapus').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/remove-guru",
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

        $('#formsubmit').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/update-guru",
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
