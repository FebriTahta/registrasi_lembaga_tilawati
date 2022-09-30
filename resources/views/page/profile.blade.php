@extends('layouts.master')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
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
</style>
</head>
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
                                <h5 class="card-title text-primary">Profile / Data Kelembagaan Anda</h5>
                                <p class="mb-4">
                                    Anda dapat memanajemen data profile lembaga yang anda kelola pada halaman ini
                                </p>
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
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="card-body">
                        <form id="formuserpass">@csrf
                            <div class="form-group">
                                <span>Username yang diperlukan untuk login akan berubah sesuai dengan nama lembaga yang anda update.</span>
                                <p>Ingin mengirimkan username & password ke nomor whatsapp lembaga yang telah dicantumkan ?</p>
                            </div>
                            {{-- <div class="g-recaptcha" data-sitekey="ISI DENGAN DATA SITE KEY KALIAN"></div> --}}
                            <div class="form-group" style="max-width: 100%">
                                <p style="width:50%">{!! NoCaptcha::display() !!}</p>
                                {!! NoCaptcha::renderJs() !!}
                                @error('g-recaptcha-response')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <input type="submit" class="btn btn-info" id="btnuserpass" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="card-body">
                        <form id="formsubmit"> @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="nama_lembaga" class="form-label">Nama Lembaga</label>
                                        <input type="text" value="{{auth()->user()->lembagasurvey->nama_lembaga}}" name="nama_lembaga" class="form-control text-capitalize">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 ">
                                    <div class="form-group">
                                        <label for="telp_lembaga" class="form-label">No. Telp Lembaga (Whatsapp)</label>
                                        <input type="number" value="{{auth()->user()->lembagasurvey->telp_lembaga}}" name="telp_lembaga" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 ">
                                    <div class="form-group">
                                        <label for="kabupaten" class="form-label">ASAL LEMBAGA</label>
                                        <select name="kabupaten_id" class="form-control select2" id="kota">
                                            <option value="{{auth()->user()->lembagasurvey->kabupaten_id}}">{{auth()->user()->lembagasurvey->kabupaten->nama}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 ">
                                    <div class="form-group">
                                        <label for="alamat_lembaga">Alamat Lembaga</label>
                                        <textarea name="alamat_lembaga" class="form-control" id="alamat_lembaga" cols="30" rows="5" required>{!!auth()->user()->lembagasurvey->alamat_lembaga!!}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 ">
                                    <div class="mb-3">
                                        <label for="jenjang" class="form-label">Jenjang Pendidikan</label>
                                        <select name="jenjang_pendidikan" class="form-control" id="jenjang" required> 
                                            {{-- <option value="">Formal / Non Formal</option> --}}
                                            <option value="formal" 
                                            @if(auth()->user()->lembagasurvey->jenjang_pendidikan == 'formal')
                                            selected
                                            @endif
                                            >Formal</option>
                                            <option value="non_formal" 
                                            @if(auth()->user()->lembagasurvey->jenjang_pendidikan == 'non_formal')
                                            selected
                                            @endif
                                            >Non Formal</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 ">
                                    <div class="mb-3" class="satuan_pendidikan_formal" id="satuan_pendidikan_formal" 
                                    @if(auth()->user()->lembagasurvey->jenjang_pendidikan == 'non_formal')
                                        style="display: none"
                                    @endif
                                    >
                                        <label for="formal" class="form-label">Satuan Pendidikan Formal</label>
                                        <select name="satuan_pendidikan" class="form-control" >
                                            <option value="TK"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'TK')
                                            selected
                                            @endif
                                            >Taman Kanak-kanak (TK)</option>
                                            <option value="RA"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'RA')
                                            selected
                                            @endif
                                            >Raudatul Athfal (RA)</option>
                                            <option value="SD"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'SD')
                                            selected
                                            @endif
                                            >Sekolah Dasar (SD)</option>
                                            <option value="MI"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'MI')
                                            selected
                                            @endif
                                            >Madrasah Ibtidaiyah (MI)</option>
                                            <option value="SMP"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'SMP')
                                            selected
                                            @endif
                                            >Sekolah Menengah Pertama (SMP)</option>
                                            <option value="MTs"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'MTs')
                                            selected
                                            @endif
                                            >Madrasah Tsanawiyah (MTs)</option>
                                            <option value="SMA"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'SMA')
                                            selected
                                            @endif
                                            >Sekolah Menengah Atas (SMA)</option>
                                            <option value="MA"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'MA')
                                            selected
                                            @endif
                                            >Madrasah Aliyah (MA)</option>
                                            <option value="SMK"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'SMK')
                                            selected
                                            @endif
                                            >Sekolah Menengah Kejuruan (SMK)</option>
                                            <option value="MAK"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'MAK')
                                            selected
                                            @endif
                                            >Madrasah Aliyah Kejuruan (MAK)</option>
                                            <option value="PT"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'PT')
                                            selected
                                            @endif
                                            >Perguruan Tinggi</option>
                                            <option value="FORMAL-ETC"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'FORMAL-ETC')
                                            selected
                                            @endif
                                            >Lembaga Non Formal Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-3" class="satuan_pendidikan_non_formal" id="satuan_pendidikan_non_formal"
                                        @if(auth()->user()->lembagasurvey->jenjang_pendidikan == 'formal')
                                            style="display: none"
                                        @endif
                                        >
                                        <label for="non_formal" class="form-label">Satuan Pendidikan Non Formal</label>
                                        <select name="satuan_pendidikan" class="form-control" >
                                            <option value="KB"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'KB')
                                            selected
                                            @endif
                                            >Kelompok Bermain (KB)</option>
                                            <option value="TPQ"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'TPQ')
                                            selected
                                            @endif
                                            >Taman Pendidikan Al-Qur'an (TPQ)</option>
                                            <option value="MT"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'MT')
                                            selected
                                            @endif
                                            >Majelis Ta'lim (MT)</option>
                                            <option value="BBAQ"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'BBAQ')
                                            selected
                                            @endif
                                            >Lembaga Kursus Baca Al-Qur'an (BBAQ)</option>
                                            <option value="PONPES"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'PONPES')
                                            selected
                                            @endif
                                            >Pondok Pesantren (PONPES)</option>
                                            <option value="NON-FORMAL-ETC"
                                            @if(auth()->user()->lembagasurvey->satuan_pendidikan == 'NON-FORMAL-ETC')
                                            selected
                                            @endif
                                            >Lembaga Non Formal Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                               <hr>
                                <div class="col-md-12 mb-3 ">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Submit" id="btnsubmit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

</div>
@endsection

@section('script')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
    var url = "/select-kabupaten-kota";
      
    $('#kota').select2({
        // placeholder: 'Kota / Kabupaten',
        ajax: {
            url: url,
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.nama,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });

        $('#jenjang').on('change',function () {
            if (this.value == 'formal') {
                document.getElementById("satuan_pendidikan_formal").style.display = "block";
                document.getElementById("satuan_pendidikan_non_formal").style.display = "none";
            }
            else if(this.value == '' || this.value == null)
            {
                document.getElementById("satuan_pendidikan_formal").style.display = "none"
                document.getElementById("satuan_pendidikan_non_formal").style.display = "none"
            }
            else{
                document.getElementById("satuan_pendidikan_formal").style.display = "none"
                document.getElementById("satuan_pendidikan_non_formal").style.display = "block"
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

            $('#formsubmit').submit(function(e) {
            e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/update-lembaga",
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

            $('#formuserpass').submit(function(e) {
            e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/minta-username-password",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#btnuserpass').attr('disabled', 'disabled');
                        $('#btnuserpass').val('Process...');
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            $("#formuserpass")[0].reset();
                            $('#btnuserpass').val('Submit');
                            $('#btnuserpass').attr('disabled', false);
                            toastr.success(response.message);
                            swal({
                                title: "SUKSES!",
                                text: response.message,
                                type: "success"
                            }).then(okay => {
                                if (okay) {
                                    window.location.href = "/profile";
                                }
                            });
                        } else {
                            
                            $('#btnuserpass').val('Daftar');
                            $('#btnuserpass').attr('disabled', false);
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