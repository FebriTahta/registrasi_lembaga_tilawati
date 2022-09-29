<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sertifikat</title>
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
            top: 35%;
            z-index: 9999;
            font-size: 21px;
            width: 70%;
        }
        table {
            top: 45%;
            left: 14%;
            z-index: 9999;
            font-size: 21px;
            width: 70%;
            position: absolute;
        }

        table td, table td * {
            vertical-align: top;
        }

        .akhiran {
            position: absolute;
            left: 15%;
            top: 55%;
            z-index: 9999;
            font-size: 21px;
            width: 70%;
        }

        .tanggalan {
            position: absolute;
            left: 69%;
            bottom: 30%;
            z-index: 9999;
            font-size: 18px;
            width: 70%;
        }

        .no_sertifikat {
            position: absolute;
            left: 15%;
            bottom: 16%;
            z-index: 9999;
            font-size: 18px;
            width: 70%;
            margin-bottom:2px;
        }

        .qrcode {
            position: absolute;
            left: 15%;
            bottom: 19%;
            z-index: 9999;
            font-size: 18px;
            width: 70%;
        }
        </style>
        

        
</head>
<body>
    <div class="awalan" style="margin-top:25px">Dengan mengucap rasa syukur kehadirat Allah SWT. Dengan ini kami  menerbitkan sertifikat kepada :</div>

    <table style="margin-left: 9px">
        <tr>
            <td style="width: 20%">Nama Lembaga</td>
            <td style="width: 2%">:</td>
            <td>{{strtoupper($data['nama_lembaga'])}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Alamat</td>
            <td style="width: 2%">:</td>
            <td style="width: 75%">{{strtoupper($data['alamat'])}}
                {{--, {{strtoupper($data['kabupaten'])}} --}}
            </td>
        </tr>
    </table>

    <div class="akhiran" style="margin-top: 20px">Telah menerapkan Metode Tilawati, semoga ilmunya barokah.</div>
    <div class="qrcode">
        <img src="{!! 'data:image/png;base64,'.$data['qrcode'] !!}" alt="" style="max-width: 100px;">
    </div>
    <div class="no_sertifikat" style="font-weight: bold"><u>{{$data['no']}}</u></div>
    <div class="tanggalan" style="margin-left: 10px">Surabaya, {{ucfirst($data['tanggal'])}}</div>
    <img src="serti.jpg" style="height: 100%; z-index: 1" alt="">
</body>
</html>