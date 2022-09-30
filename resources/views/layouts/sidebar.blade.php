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
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path=" assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Kelembagaan Tilawati</title>

    <meta name="description" content="" />

    <!-- Favicon -->
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

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href=" {{asset('assets/vendor/fonts/boxicons.css')}}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href=" {{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href=" {{asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href=" {{asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href=" {{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />

    <link rel="stylesheet" href=" {{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src=" {{asset('assets/vendor/js/helpers.js')}}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src=" {{asset('assets/js/config.js')}}"></script>
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
    @yield('style')
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" >
          <div class="" >
            <a href="/home" class="app-brand-link" style="margin-bottom: 30px; margin-top: 30px">
              {{-- <span class="app-brand-logo demo">
                
              </span>
              <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span> --}}
              <img src="{{asset('Untitled-s.png')}}" style="max-width: 120px; margin-left: 25%; padding: 10px" alt="">
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none btn btn-sm btn-secondary" style="margin-bottom: 20px; color:white; text-align: left">
              <i class="bx bx-chevron-left bx-sm align-middle"></i> close
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="/home" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">MENU</span>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Manajemen Guru</div>
              </a>
              @if (auth()->user()->lembagasurvey->bagian == null)
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modalcabang" class="menu-link">
                    <div data-i18n="Account">Daftar Guru</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modalcabang" class="menu-link">
                    <div data-i18n="Notifications">Tambah Guru</div>
                  </a>
                </li>
                {{-- <li class="menu-item">
                  <a href="/import-data-guru" class="menu-link">
                    <div data-i18n="Connections">Import Data Guru</div>
                  </a>
                </li> --}}
              </ul>
              @else
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/daftar-guru" class="menu-link">
                    <div data-i18n="Account">Daftar Guru</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/create-new-guru" class="menu-link">
                    <div data-i18n="Notifications">Tambah Guru</div>
                  </a>
                </li>
                {{-- <li class="menu-item">
                  <a href="/import-data-guru" class="menu-link">
                    <div data-i18n="Connections">Import Data Guru</div>
                  </a>
                </li> --}}
              </ul>
              @endif

              
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Authentications">Manajemen Santri</div>
              </a>
              @if (auth()->user()->lembagasurvey->bagian == null)
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modalcabang" class="menu-link">
                    <div data-i18n="Basic">Daftar Santri</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="#" data-bs-toggle="modal" data-bs-target="#modalcabang" class="menu-link">
                    <div data-i18n="Basic">Tambah Santri</div>
                  </a>
                </li>
              </ul>
              @else
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/daftar-santri" class="menu-link">
                    <div data-i18n="Basic">Daftar Santri</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/create-new-santri" class="menu-link">
                    <div data-i18n="Basic">Tambah Santri</div>
                  </a>
                </li>
              </ul>
              @endif
              
            </li>
            
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li>
           

            <li class="menu-item">
              @if (auth()->user()->lembagasurvey->bagian == null)
              <a href="#" data-bs-toggle="modal" data-bs-target="#modalcabang" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="Boxicons">Profile Lembaga</div>
              </a>
              @else
              <a href="/profile-lembaga" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="Boxicons">Profile Lembaga</div>
              </a>
              @endif
            </li>

            
          </ul>
        </aside>
        <!-- / Menu -->