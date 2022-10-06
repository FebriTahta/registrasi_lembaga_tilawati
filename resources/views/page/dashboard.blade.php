@extends('layouts.master')

@section('style')
    <style>
        /* #container {
                height: 470px;
            } */

        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #datatable {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        #datatable caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        #datatable th {
            font-weight: 600;
            padding: 0.5em;
        }

        #datatable td,
        #datatable th,
        #datatable caption {
            padding: 0.5em;
        }

        #datatable thead tr,
        #datatable tr:nth-child(even) {
            background: #f8f8f8;
        }

        #datatable tr:hover {
            background: #f1f7ff;
        }
    </style>
@endsection

@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                @if (auth()->user()->lembagasurvey->bagian == null)
                    <div class="col-lg-12 mb-4 order-0">
                        <div class="card">
                            <form id="formsubmit"> @csrf 
                                <div class="card-body">
                                    <div class="col-md-12 mb-3 ">
                                        <div class="form-group">
                                            <label for="telp_guru" style="color: red">Lembaga anda merupakan bagian dari cabang
                                                ?</label>
                                            <div class="col-md">
                                                <div class="form-check form-check-inline mt-3" id="cabang_daerah">
                                                    <input class="form-check-input" type="radio" name="cabang" id="daerah"
                                                        value="sini" required>
                                                    <label class="form-check-label" for="inlineRadio1">Cabang di daerah saya
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="cabang"
                                                        id="luar_daerah" value="sana" required>
                                                    <label class="form-check-label" for="inlineRadio2">Dafta Cabang seluruhnya </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="cabang"
                                                        id="bukan_anggota_cabang" value="lain" required>
                                                    <label class="form-check-label" for="inlineRadio3">Bukan merupakan bagian
                                                        cabang manapun</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4" style="display: none" id="daerah_sini">
                                        <label for="form-label">CABANG
                                            {{ auth()->user()->lembagasurvey->kabupaten->nama }}</label>
                                        <div class="form-group">
                                            <select name="cabang_id1" class="form-control" id="cabang_daerah">
                                                <option value="">-</option>
                                                @foreach ($cabang as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name . ' - ' . ucwords(strtolower($item->kabupaten->nama)) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4" style="display: none" id="daerah_sana">
                                        <label for="form-label">CABANG LAINNYA</label>
                                        <div class="form-group">
                                            <select name="cabang_id2" class="form-control" style="width: 100%"
                                                id="cabang_daerah_lain">
                                                <option value="">-</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-12 mb-4">
                                        <input type="submit" id="btnsubmit" class="btn btn-primary" value="Submit">
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                @endif
                <div class="col-lg-8 mb-4 order-0">
                    <div class="card">
                        <div class="d-flex align-items-end row">
                            <div class="col-sm-7">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Selamat datang "{{ auth()->user()->username }}" 🎉
                                    </h5>
                                    <p class="mb-4">
                                        Anda dapat memanajemen struktur data lembaga anda dengan lebih mudah bersama kami
                                    </p>
                                    <span id="lembaga_id"
                                        style="display: none">{{ auth()->user()->lembagasurvey->id }}</span>
                                    @if (auth()->user()->lembagasurvey->bagian == null)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalcabang" class="btn btn-sm btn-outline-primary">Profile Lembaga</a>
                                    @else
                                    <a href="/profile-lembaga" class="btn btn-sm btn-outline-primary">Profile Lembaga</a>
                                    @endif
                                    <a href="javascript:;" id="download_sertifikat"
                                        class="btn btn-sm btn-outline-primary">Unduh Sertifikat</a>
                                    {{-- <a href="/validasi-lembaga/{{auth()->user()->lembagasurvey->id}}/{{date('Y')}}/{{auth()->user()->lembagasurvey->kabupaten_id}}/{{auth()->user()->lembagasurvey->slug_lembaga}}"  --}}
                                    @php
                                        $lembaga = App\Models\Lembagasurvey::findOrFail(auth()->user()->lembagasurvey->id);
                                    @endphp
                                    <a href="/status-lembaga/{{Crypt::encrypt($lembaga->id)}}"
                                        id="lihat_sertifikat" target="_blank"
                                    class="btn btn-sm btn-outline-primary">Lihat Sertifikat</a>
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


                <div class="col-lg-4 col-md-4 order-1">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('assets/img/icons/unicons/santri.png') }}"
                                                alt="chart success" class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                                <a class="dropdown-item" href="/daftar-santri">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span>Murid/Santri</span>
                                    <h3 class="card-title text-nowrap mb-4 mt-1" id="jumlah_murid">
                                        {{ auth()->user()->lembagasurvey->santrilembaga->count() }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0">
                                            <img src="{{ asset('assets/img/icons/unicons/guru.png') }}" alt="Credit Card"
                                                class="rounded" />
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="cardOpt6"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                                <a class="dropdown-item" href="/daftar-guru">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span>Guru/Pengajar</span>
                                    <h3 class="card-title text-nowrap mb-4 mt-1" id="jumlah_guru">
                                        {{ auth()->user()->lembagasurvey->gurulembaga->count() }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                    <div class="card">
                        <div class="row row-bordered g-0">
                            <div class="col-md-8">
                                {{-- <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5> --}}
                                {{-- <div id="totalRevenueChart" class="px-2"></div> --}}
                                <h5></h5>
                                <div id="container" class="px-2"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <div class="text-center">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                                id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                2022
                                            </button>
                                            {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                                <a class="dropdown-item" href="javascript:void(0);">2021</a>
                                                <a class="dropdown-item" href="javascript:void(0);">2020</a>
                                                <a class="dropdown-item" href="javascript:void(0);">2019</a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div id="growthChart"></div>
                                <div class="text-center fw-semibold pt-3 mb-2"><span id="pertumbuhan">-</span></div>

                                <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <span class="badge bg-label-primary p-2"><img
                                                    src="{{ asset('assets/img/icons/unicons/total.png') }}"
                                                    alt="chart success" class="rounded" style="width: 25px" /></span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <small>{{ date('Y') - 1 }}</small>
                                            <h6 class="mb-0" id="total_tahun_lalu">-</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="me-2">
                                            <span class="badge bg-label-info p-2"><img
                                                    src="{{ asset('assets/img/icons/unicons/total.png') }}"
                                                    alt="chart success" class="rounded" style="width: 25px" /></span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <small>{{ date('Y') }}</small>
                                            <h6 class="mb-0" id="total_tahun_ini">-</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Total Revenue -->






                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                    <div class="row">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2">Pengelompokan Santri</h5>
                                    <small class="text-muted">Berdasarkan usianya</small>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="orederStatistics"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                        <a class="dropdown-item" href="/home">Refresh</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex flex-column align-items-center gap-1">
                                        <h2 class="mb-2" id="jumlah_santri">-</h2>
                                        <span>Jumlah Santri</span>
                                    </div>
                                    <div id="orderStatisticsChart"></div>
                                </div>
                                <ul class="p-0 m-0">
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-primary"><img
                                                    src="{{ asset('assets/img/icons/unicons/anak.png') }}"
                                                    alt="chart success" class="rounded" style="width: 35px" /></span>
                                        </div>
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Anak - anak</h6>
                                                <small class="text-muted">Usia 5 - 11 Tahun</small>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold" id="anak">-</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-success"><img
                                                    src="{{ asset('assets/img/icons/unicons/remaja.png') }}"
                                                    alt="chart success" class="rounded" style="width: 45px" /></span>
                                        </div>
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Remaja</h6>
                                                <small class="text-muted">Usia 12 - 20 Tahun</small>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold" id="remaja">-</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-info"><img
                                                    src="{{ asset('assets/img/icons/unicons/dewasa.png') }}"
                                                    alt="chart success" class="rounded" style="width: 45px" /></span>
                                        </div>
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Dewasa</h6>
                                                <small class="text-muted">Usia 20 Tahun Keatas</small>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold" id="dewasa">-</small>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-diklat-kirim" id="modalcabang" tabindex="-1" role="dialog"
        aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">PERHATIAN</h5>
                        <a href="#" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <hr>
                    <div class="modal-body">
                        <div class="form-group mb-4">
                            <code>Pilih Cabang keanggotaan Lembaga ustadz/h terlebih dahulu</code>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <img src="{{asset('xx.png')}}" style="max-width: 100%" alt="">
                                </div>
                                <div class="col-md-8 mb-4">
                                    <img src="{{asset('info.png')}}" style="max-width: 100%" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
        
        <!-- / Content -->
        <figure class="highcharts-figure">
            <div id="container"></div>
            <table id="datatable" style="display: none">
                <thead>
                    <tr>
                        <th></th>
                        <th>Guru / Pengajar</th>
                        <th>Santri</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ date('Y') }}</th>
                        <td>{{ auth()->user()->lembagasurvey->gurulembaga->count() }}</td>
                        <td>{{ auth()->user()->lembagasurvey->santrilembaga->count() }}</td>
                    </tr>
                </tbody>
            </table>
        </figure>

        
    @endsection

    @section('script')
    <script src=" {{asset('assets/vendor/js/bootstrap.js')}}"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

        <script>
            $('#formsubmit').submit(function(e) {
            e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/update-keanggotaan-cabang-lembaga",
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
                            $('#btnsubmit').val('Submit');
                            $('#btnsubmit').attr('disabled', false);
                            toastr.success(response.message);
                            swal({
                                title: "SUKSES!",
                                text: response.message,
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    window.location.href = "/";
                                }
                            });
                        } else {
                            
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

            $(document).ready(function() {
                
                // $('#modalcabang').modal('show');
                $('.close').on('click',function () {
                    $('#modalcabang').modal('hide'); 
                });
                

                $.ajax({
                    type:'GET',
                    url:'/check-lembaga-cabang-awal',
                    success:function(response) {
                        if(response.data == 'kosong' && response.cabang == 'cabang_ada'){
                            var daerah = document.getElementById("daerah");
                            daerah.checked = true;
                            if (daerah) {
                                document.getElementById("daerah_sini").style.display = "block";
                                document.getElementById("daerah_sana").style.display = "none";
                            }
                        }

                        if (response.data == 'kosong' && response.cabang == 'cabang_kosong') {
                            var daerah = document.getElementById("luar_daerah");
                            daerah.checked = true;
                            if (daerah) {
                                document.getElementById("cabang_daerah").style.display = "none";
                                document.getElementById("daerah_sini").style.display = "none";
                                document.getElementById("daerah_sana").style.display = "block";
                            }
                        }
                    }
                });

                $('#cabang_daerah_lain').select2({
                    placeholder: 'Pilih Cabang',
                    ajax: {
                        url: '/check-lembaga-cabang',
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.name,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            })


            $('input[type=radio][name=cabang]').change(function() {
                if (this.value == 'sini') {
                    // ...
                    document.getElementById("daerah_sini").style.display = "block";
                    document.getElementById("daerah_sana").style.display = "none";
                } else if (this.value == 'sana') {
                    // ...
                    document.getElementById("daerah_sini").style.display = "none";
                    document.getElementById("daerah_sana").style.display = "block";
                } else if (this.value == 'lain') {
                    // ...
                    document.getElementById("daerah_sini").style.display = "none";
                    document.getElementById("daerah_sana").style.display = "none";
                }
            });
        </script>
        <script>
            Highcharts.chart('container', {
                data: {
                    table: 'datatable'
                },
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Grafik Guru & Santri'
                },

                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    allowDecimals: false,
                    title: {
                        text: 'Total / Jumlah'
                    }
                },
                tooltip: {
                    formatter: function() {
                        return '<b>' + this.series.name + '</b><br/>' +
                            this.point.y + ' ' + this.point.name.toLowerCase();
                    }
                }
            });

            $('#download_sertifikat').on('click', function() {
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

            $(document).ready(function() {
                let cardColor, headingColor, axisColor, shadeColor, borderColor;

                cardColor = config.colors.white;
                headingColor = config.colors.headingColor;
                axisColor = config.colors.axisColor;
                borderColor = config.colors.borderColor;


                // chart & total grafisnya
                var presentase;
                $.ajax({
                    type: 'GET',
                    url: '/total_santri_guru_tahun_ini',
                    success: function(data) {
                        $('#total_tahun_ini').html(data.total_tahun_ini);
                        $('#total_tahun_lalu').html(data.total_tahun_lalu);
                        $('#jumlah_santri').html(data.jumlah_santri);
                        $('#anak').html(data.anak);
                        $('#remaja').html(data.remaja);
                        $('#dewasa').html(data.dewasa);
                        presentase = data.presentase;
                        console.log(data);
                        if (presentase == 0) {
                            $('#pertumbuhan').html('0% Tidak Bertumbuh');
                        }

                        if (presentase < 0) {
                            $('#pertumbuhan').html('Penurunuan Kuantitas');
                        }

                        if (presentase > 0) {
                            $('#pertumbuhan').html('Pertumbuhan Lembaga ' + data.presentase + '%');
                        }

                        const nilai = Object.keys(presentase + '');

                        const growthChartEl = document.querySelector('#growthChart'),
                            growthChartOptions = {
                                series: [presentase],
                                labels: ['Pertumbuhan'],
                                chart: {
                                    height: 240,
                                    type: 'radialBar'
                                },
                                plotOptions: {
                                    radialBar: {
                                        size: 150,
                                        offsetY: 10,
                                        startAngle: -150,
                                        endAngle: 150,
                                        hollow: {
                                            size: '55%'
                                        },
                                        track: {
                                            background: cardColor,
                                            strokeWidth: '100%'
                                        },
                                        dataLabels: {
                                            name: {
                                                offsetY: 15,
                                                color: headingColor,
                                                fontSize: '15px',
                                                fontWeight: '600',
                                                fontFamily: 'Public Sans'
                                            },
                                            value: {
                                                offsetY: -25,
                                                color: headingColor,
                                                fontSize: '22px',
                                                fontWeight: '500',
                                                fontFamily: 'Public Sans'
                                            }
                                        }
                                    }
                                },
                                colors: [config.colors.primary],
                                fill: {
                                    type: 'gradient',
                                    gradient: {
                                        shade: 'dark',
                                        shadeIntensity: 0.5,
                                        gradientToColors: [config.colors.primary],
                                        inverseColors: true,
                                        opacityFrom: 1,
                                        opacityTo: 0.6,
                                        stops: [30, 70, 100]
                                    }
                                },
                                stroke: {
                                    dashArray: 5
                                },
                                grid: {
                                    padding: {
                                        top: -35,
                                        bottom: -10
                                    }
                                },
                                states: {
                                    hover: {
                                        filter: {
                                            type: 'none'
                                        }
                                    },
                                    active: {
                                        filter: {
                                            type: 'none'
                                        }
                                    }
                                }

                            };
                        if (typeof growthChartEl !== undefined && growthChartEl !== null) {
                            const growthChart = new ApexCharts(growthChartEl, growthChartOptions);
                            growthChart.render();
                        }

                        // donut chart usia
                        const chartOrderStatistics = document.querySelector('#orderStatisticsChart'),
                            orderChartConfig = {
                                chart: {
                                    height: 165,
                                    width: 130,
                                    type: 'donut'
                                },
                                labels: ['ANAK - ANAK', 'REMAJA', 'DEWASA', 'TIDAK VALID'],
                                series: [data.anak, data.remaja, data.dewasa, data.usia_non_valid],
                                colors: [config.colors.success, config.colors.info, config.colors.primary,
                                    config.colors.secondary
                                ],
                                stroke: {
                                    width: 5,
                                    colors: cardColor
                                },
                                dataLabels: {
                                    enabled: false,
                                    formatter: function(val, opt) {
                                        return parseInt(val);
                                    }
                                },
                                legend: {
                                    show: false
                                },
                                grid: {
                                    padding: {
                                        top: 0,
                                        bottom: 0,
                                        right: 15
                                    }
                                },
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            size: '75%',
                                            labels: {
                                                show: true,
                                                value: {
                                                    fontSize: '1.5rem',
                                                    fontFamily: 'Public Sans',
                                                    color: headingColor,
                                                    offsetY: 5,
                                                    formatter: function(val) {
                                                        return parseInt(val);
                                                    }
                                                },
                                                name: {
                                                    offsetY: -5,
                                                    fontFamily: 'Public Sans'
                                                },
                                                total: {
                                                    show: true,
                                                    fontSize: '0.8125rem',
                                                    color: axisColor,
                                                    label: 'click warna',
                                                    formatter: function(w) {
                                                        return 'usia';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            };
                        if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
                            const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
                            statisticsChart.render();
                        }

                    }
                });
            })
        </script>
    @endsection
