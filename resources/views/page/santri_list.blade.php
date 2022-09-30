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
                                        <th style="width: 5%">No</th>
                                        <th>Nama</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Wali Santri</th>
                                        <th>Nomor Wali</th>
                                        
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
                            
                        ]
                    });
        })
    </script>    
@endsection
