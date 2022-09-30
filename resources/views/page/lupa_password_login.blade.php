{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
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

    <title>Login Kelembagaan</title>

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
    <link rel="preconnect" href="{{ asset('https://fonts.googleapis.com') }}" />
    <link rel="preconnect" href="{{ asset('https://fonts.gstatic.com') }}" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="#" class="app-brand-link gap-2">
                  
                  <img src="{{asset('Untitled-s.png')}}" style="max-width: 200px" alt="">
                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Lupa Password</h4>
              <p>Isi form berikut ini untuk memastikan bahwa anda adalah anggota lembaga</p>
              <code>Username & Password akan dikirim melalui whatsapp ke nomor lembaga yang telah terdaftar</code>
              @if ($message = Session::get('error'))
              <div class="alert alert-danger alert-block" id="alert" style="display: block">
                  <button type="button" class="close btn btn-sm btn-danger" data-dismiss="alert" style="text-align: right">×</button>
                  <strong style="text-align: left">{{ $message }}</strong>
              </div>
              @endif
            {{-- <form id="formAuthentication" class="mb-3" action="index.html" method="POST"> --}}
            <hr>
             <form id="formlupapass">@csrf
                <div class="mb-3 mt-3">
                  <label for="email" class="form-label">Nama Lembaga</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="nama_lembaga"
                    placeholder="Nama Lembaga"
                    autofocus
                  />
                </div>
                <div class="mb-3">
                    <label for="telp_lembaga" class="form-label">No. Telp Yang Telah Didaftarkan</label>
                    <input
                      type="number"
                      class="form-control"
                      id="telp_lembaga"
                      name="telp_lembaga"
                      placeholder="Telp (Whatsapp) Lembaga"
                      autofocus
                    />
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

                <div class="mb-3" style="max-width: 100%">
                    <p style="width:50%">{!! NoCaptcha::display() !!}</p>
                    {!! NoCaptcha::renderJs() !!}
                    @error('g-recaptcha-response')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <div class="mb-3">
                  {{-- <button class="btn btn-primary d-grid w-100" type="submit">Kirim Lupa Password</button> --}}
                  <input type="submit" class="btn btn-primary d-grid w-100" id="btnlupapass" value="Kirim Lupa Password">
                </div>
              </form>
              <hr>
              <p class="text-left">
                <span>Lembaga Pengguna Metode Tilawati Baru ?</span>
                <a href="/register">
                  <span> buat akun</span>
                </a>
              </p>
              
            </div>
          </div>
          <!-- /Register -->
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
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
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

    <script>
      
      $('.close').click(function () {
        document.getElementById("alert").style.display = "none"
      })
    </script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
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

        $('#formlupapass').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/lupa-username-pass",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnlupapass').attr('disabled', 'disabled');
                    $('#btnlupapass').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $("#formlupapass")[0].reset();
                        $('#btnlupapass').val('Kirim Lupa Password');
                        $('#btnlupapass').attr('disabled', false);
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
                        
                        $('#btnlupapass').val('Kirim Lupa Password');
                        $('#btnlupapass').attr('disabled', false);
                        toastr.error(response.message);
                        swal({
                            title: "MAAF!",
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
