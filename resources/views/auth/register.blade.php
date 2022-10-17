{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Registrasi Kelembagaan</title>

    <link rel="icon" type="image/x-icon" href="{{asset('tumbreg.jpeg')}}" />

    <meta property="og:title" content="Kelembagaan Tilawati" style="text-transform: capitalize" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{asset('tumbreg.jpeg')}}" />
    <meta property="og:description" content="Sistem informasi kelembagaan tilawati yang bertujuan untuk menghimpun seluruh lembaga untuk menjadi lembaga yang terstruktur dan terkoordinasi" />
    <meta property="og:url" content="http://lembaga-tilawati.nurulfalah.org" />
    <meta name="theme-color" content="#8CC0DE">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" content="summary_large_image">
    <meta property='og:image:width' content='1200' />
    <meta property='og:image:height' content='627' />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('logo-nf.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
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

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register Card -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="#" class="app-brand-link gap-2">
                    <img src="{{asset('Untitled-s.png')}}" style="max-width: 200px" alt="">
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Registrasi Lembaga</h4>
              <p class="mb-4" style="margin-bottom: 0">🚀 buat manajemen lembaga anda mudah dan menyenangkan!</p>

              {{-- <form id="formAuthentication" class="mb-3" action="index.html" method="POST"> --}}
                {{-- <form method="POST" action="{{ route('register') }}"> @csrf --}}
              <form id="formsubmit"> @csrf
                <div class="mb-3">
                  <label for="nama_lembaga" class="form-label">Nama Lembaga (Username)</label>
                  <input
                    type="text"
                    class="form-control"
                    id="nama_lembaga"
                    name="nama_lembaga"
                    placeholder="Nama Lembaga"
                    autofocus
                    required
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                    <div class="d-flex justify-content-between">
                      <label class="form-label" for="pass">Password</label>
                      {{-- <a href="auth-forgot-password-basic.html">
                        <small>Forgot Password?</small>
                      </a> --}}
                    </div>
                    <div class="input-group input-group-merge">
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        name="pass"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password"
                      />
                      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                  </div>
                <div class="">
                    <label for="telp_lembaga" class="form-label">No. Telp Lembaga (Whatsapp)</label>
                    <input
                      type="number"
                      class="form-control"
                      id="telp_lembaga"
                      name="telp_lembaga"
                      placeholder="Telp (Whatsapp) Lembaga"
                      autofocus
                    />
                </div>
                <small style="color: red; margin-bottom: 50px">username dan password akan dikirimkan melalui Whatsapp dari nomor yang didaftarkan</small>
                <div class="mb-3 mt-3">
                    <label for="kabupaten" class="form-label">ASAL LEMBAGA</label>
                    <select name="kabupaten_id" class="form-control select2" id="kota">
                        <option value=""></option>
                    </select>
                </div>
                <div class="mb-3 mt-3">
                  <label for="alamat_lembaga" class="form-label">ALAMAT LEMBAGA</label>
                  <textarea name="alamat_lembaga" id="alamat_lembaga" class="form-control" cols="30" rows="3" required></textarea>  
                </div>
                <div class="mb-3">
                    <label for="jenjang" class="form-label">Jenjang Pendidikan</label>
                    <select name="jenjang_pendidikan" class="form-control" id="jenjang" required> 
                        <option value="">Formal / Non Formal</option>
                        <option value="formal">Formal</option>
                        <option value="non_formal">Non Formal</option>
                    </select>
                </div>
                <div class="mb-3" class="satuan_pendidikan_formal" id="satuan_pendidikan_formal" style="display: none">
                    <label for="formal" class="form-label">Satuan Pendidikan Formal</label>
                    <select name="satuan_pendidikan" class="form-control" >
                        <option value="TK">Taman Kanak-kanak (TK)</option>
                        <option value="RA">Raudatul Athfal (RA)</option>
                        <option value="SD">Sekolah Dasar (SD)</option>
                        <option value="MI">Madrasah Ibtidaiyah (MI)</option>
                        <option value="SMP">Sekolah Menengah Pertama (SMP)</option>
                        <option value="MTs">Madrasah Tsanawiyah (MTs)</option>
                        <option value="SMA">Sekolah Menengah Atas (SMA)</option>
                        <option value="MA">Madrasah Aliyah (MA)</option>
                        <option value="SMK">Sekolah Menengah Kejuruan (SMK)</option>
                        <option value="MAK">Madrasah Aliyah Kejuruan (MAK)</option>
                        <option value="PT">Perguruan Tinggi</option>
                        <option value="FORMAL-ETC">Lembaga Non Formal Lainnya</option>
                    </select>
                </div>
                <div class="mb-3" class="satuan_pendidikan_non_formal" id="satuan_pendidikan_non_formal" style="display: none">
                    <label for="non_formal" class="form-label">Satuan Pendidikan Non Formal</label>
                    <select name="satuan_pendidikan" class="form-control" >
                        <option value="KB">Kelompok Bermain (KB)</option>
                        <option value="TPQ">Taman Pendidikan Al-Qur'an (TPQ)</option>
                        <option value="MT">Majelis Ta'lim (MT)</option>
                        <option value="BBAQ">Lembaga Kursus Baca Al-Qur'an (BBAQ)</option>
                        <option value="PONPES">Pondok Pesantren (PONPES)</option>
                        <option value="NON-FORMAL-ETC">Lembaga Non Formal Lainnya</option>
                    </select>
                </div>
                <input type="submit" class="btn btn-primary d-grid w-100" value="Daftar" id="btnsubmit">
              </form>

              <p class="text-center">
                <span>Sudah mendaftar / Sudah memiliki akun ?</span>
                <a href="/login">
                  <span>Login ke Lembaga</span>
                </a>
              </p>
              
            </div>
          </div>
          <!-- Register Card -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    {{-- <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div> --}}

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    {{-- <script src="../assets/vendor/libs/jquery/jquery.js"></script> --}}
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    
    <script type="text/javascript">
        var url = "/select-kabupaten-kota";
      
            $('#kota').select2({
                placeholder: 'Kota / Kabupaten',
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

        $('#formsubmit').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/registrasi-lembaga-baru",
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
                        toastr.success(response.message);
                        swal({
                            title: "SUKSES!",
                            text: response.message,
                            type: "success"
                        }).then(okay => {
                            if (okay) {
                                window.location.href = "/login";
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
    </script>
  </body>
</html>
