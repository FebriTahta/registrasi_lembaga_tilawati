<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
<title>Azures BootStrap</title>
<link rel="stylesheet" type="text/css" href="{{asset('mobile_asset/styles/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('mobile_asset/styles/style.css')}}">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900,900i&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('mobile_asset/fonts/css/fontawesome-all.min.css')}}">    
<link rel="manifest" href="{{asset('mobile_asset/_manifest.json')}}" data-pwa-version="set_in_manifest_and_pwa_js">
<link rel="apple-touch-icon" sizes="180x180" href="{{asset('mobile_asset/app/icons/icon-192x192.png')}}">

<style>
    body, html {
      height: 100%;
      /* width: 100%; */
      margin: 0;
    }
    
    .bg {
      /* The image used */
      background-image: url("serti.jpg");
    
      /* Full height */
      height: 100%; 
      /* width: 100%; */

      z-index: 1;

      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .centered {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
    }

    .awalan {
        position: absolute;
        left: 15%;
        top: 38%;
        z-index: 9999;
        font-size: 8px;
        width: 70%;
        line-height: 10px;
    }
    table {
        top: 50%;
        left: 12%;
        z-index: 9999;
        font-size: 8px;
        width: 70%;
        position: absolute;
        line-height: 10px;
    }

    table td, table td * {
        vertical-align: top;
    }

    .akhiran {
        position: absolute;
        left: 15%;
        top: 55%;
        z-index: 9999;
        font-size: 8px;
        width: 70%;
        line-height: 10px;
    }

    .tanggalan {
        position: absolute;
        left: 65%;
        bottom: 32%;
        z-index: 9999;
        font-size: 5px;
        width: 70%;
    }

    .no_sertifikat {
        position: absolute;
        left: 15%;
        bottom: 22%;
        z-index: 9999;
        font-size: 5px;
        width: 70%;
        margin-top:5px;
    }

    .qrcode {
        position: absolute;
        left: 15%;
        bottom: 26%;
        z-index: 9999;
        font-size: 18px;
        width: 70%;
        margin-bottom: 1px;
    }
    </style>

</head>
    
<body class="theme-light" data-highlight="blue2">
    
<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>
    
<div id="page" style="max-width: 420px; margin: 0 auto;">
    
    <!-- header and footer bar go here-->
    <div class="header header-fixed header-auto-show header-logo-app" style="max-width: 420px; margin: 0 auto;">
        <a href="#" data-back-button class="header-title header-subtitle">Back to Pages</a>
        <a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-dark"><i class="fas fa-sun"></i></a>
        <a href="#" data-toggle-theme class="header-icon header-icon-2 show-on-theme-light"><i class="fas fa-moon"></i></a>
        <a href="#" data-menu="menu-highlights" class="header-icon header-icon-3"><i class="fas fa-brush"></i></a>
        <a href="#" data-menu="menu-main" class="header-icon header-icon-4"><i class="fas fa-bars"></i></a>
    </div>
    <div id="footer-bar" class="footer-bar-5" style="max-width: 420px; margin: 0 auto;">
        {{-- <a href="index-components.html"><i data-feather="heart" data-feather-line="1" data-feather-size="21" data-feather-color="red2-dark" data-feather-bg="red2-fade-light"></i><span>Features</span></a>
        <a href="index-media.html"><i data-feather="image" data-feather-line="1" data-feather-size="21" data-feather-color="green1-dark" data-feather-bg="green1-fade-light"></i><span>Media</span></a> --}}
        {{-- <a href="/"><i data-feather="home" data-feather-line="1" data-feather-size="21" data-feather-color="blue2-dark" data-feather-bg="blue2-fade-light"></i><span>Home</span></a> --}}
        <a href="/"><img src="{{asset('logo-nf.png')}}" style="max-width: 30px" alt=""><span>Home</span></a>
        {{-- <a href="index-pages.html" class="active-nav"><i data-feather="file" data-feather-line="1" data-feather-size="21" data-feather-color="brown1-dark" data-feather-bg="brown1-fade-light"></i><span>Pages</span></a>
        <a href="index-settings.html"><i data-feather="settings" data-feather-line="1" data-feather-size="21" data-feather-color="gray2-dark" data-feather-bg="gray2-fade-light"></i><span>Settings</span></a> --}}
    </div>
    
    <div class="page-content" >
        
        <div class="page-title page-title-small">
            <h2><a href="/"><img src="{{asset('nf_logo_white.png')}}" style="max-width: 100px" alt=""></a></h2>
            {{-- <a href="/" data-menu="menu-main" class="bg-fade-gray1-dark shadow-xl preload-img" data-src="{{asset('logo-nf.png')}}"></a> --}}
        </div>
        <div class="card header-card shape-rounded" data-card-height="150">
            <div class="card-overlay bg-highlight opacity-95"></div>
            <div class="card-overlay dark-mode-tint"></div>
            <div class="card-bg preload-img" data-src="{{asset('ngaji.jpg')}}" style="max-width: 400px; margin: 0 auto;"></div>
        </div>
        
        <div class="card card-style">
            <div class="content">
                <h3 class="font-600">{{$lembaga->satuan_pendidikan.' - '.$lembaga->nama_lembaga}}</h3>
                <input type="hidden" id="lembaga_id" value="{{$lembaga->id}}">
                <p class="font-11 mt-n2 color-highlight">Penerapan pembelajaran metode TILAWATI</p>
                <div class="image">
                    <img src="{{asset('serti.jpg')}}" style="max-width: 100%" alt="">
                </div>
                <div class="isi-sertifikat">
                    <div class="awalan" style="margin-top:25px">Dengan mengucap rasa syukur kehadirat Allah SWT. Dengan ini kami  menerbitkan sertifikat kepada :</div>

                    <table style="margin-left: 11px; font-size:7px">
                        <tr>
                            <td style="width: 30%">LEMBAGA</td>
                            <td style="width: 2%">:</td>
                            <td style="font-weight:bold">{{strtoupper($data['nama_lembaga'])}}</td>
                        </tr>
                        <tr>
                            <td style="width: 30%">ALAMAT</td>
                            <td style="width: 2%">:</td>
                            <td style="width: 75%; font-weight:bold">{{strtoupper($data['alamat'])}}
                            </td>
                        </tr>
                    </table>

                    <div class="akhiran" style="margin-top: 20px">Telah menerapkan Metode Tilawati, semoga ilmunya barokah.</div>
                    <div class="qrcode">
                        <?php echo \QrCode::size(30)->generate('https://lembaga-tilawati.nurulfalah.org/status-lembaga/'.$lembaga_id) ?>
                        {{-- <img src="{!! 'data:image/png;base64,'.$data['qrcode'] !!}" alt="" style="max-width: 100px;"> --}}
                    </div>
                    <div class="no_sertifikat" style="font-weight: bold"><u>{{$data['no']}}</u></div>
                    <div class="tanggalan" style="margin-left: 10px">Surabaya, {{ucfirst($data['tanggal'])}}</div>

                </div>
                <div class="float-left">
                    <p class="font-10 opacity-80 mb-n1"><i class="far fa-calendar"></i> {{\Carbon\Carbon::parse($lembaga->created_at)->format('d F Y')}} <i class="ml-4 far fa-clock"></i> {{\Carbon\Carbon::parse($lembaga->created_at)->format('H:i')}}</p>
                    <p class="font-10 opacity-80"><i class="fa fa-map-marker-alt"></i> {{$lembaga->kabupaten->nama}} {{$lembaga->provinsi->nama}}</p>
                </div>
                <a href="#" id="download_sertifikat" class="float-right btn btn-s bg-highlight rounded-s shadow-xl text-uppercase font-900 font-11 mt-2"><i class="fa fa-download"></i></a>
            </div>
        </div>
        
        <div class="card card-style">
            <div class="content mb-4">
                <h3><i class="fa fa-exclamation-triangle mr-3 mt-1 font-17 color-yellow1-dark"></i>KETENTUAN</h3>
                <p style="line-height: 18px;">
                    Sertifikat ini berlaku satu tahun dari tanggal pendaftaran. Lembaga perlu memperbarui data guru dan santrinya untuk tetap menjadi anggota Lembaga Pengguna Metode TILAWATI
                </p>
            </div>
        </div>
        
        

           
        <!-- footer and footer card-->
        {{-- <div class="footer" data-menu-load="menu-footer.html"></div> --}}
    </div>
    <!-- end of page content-->
    
    
    {{-- <div id="menu-share" 
         class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-load="menu-share.html"
         data-menu-height="420" 
         data-menu-effect="menu-over">
    </div>
    
    <div id="menu-highlights" 
         class="menu menu-box-bottom menu-box-detached rounded-m" 
         data-menu-load="menu-colors.html"
         data-menu-height="510" 
         data-menu-effect="menu-over">        
    </div>
    
    <div id="menu-main"
         class="menu menu-box-right menu-box-detached rounded-m"
         data-menu-width="260"
         data-menu-load="menu-main.html"
         data-menu-active="nav-pages"
         data-menu-effect="menu-over">  
    </div> --}}
    


    
</div>    


<script type="text/javascript" src="{{asset('mobile_asset/scripts/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('mobile_asset/scripts/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('mobile_asset/scripts/custom.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script>
    $('#download_sertifikat').on('click', function() {
        var lembaga_id = $('#lembaga_id').val();
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
                                    window.location.href = "/download-sertifikat2/"+lembaga_id;
                                }
                            });
                        }
                    }
                });
            })
</script>
</body>
