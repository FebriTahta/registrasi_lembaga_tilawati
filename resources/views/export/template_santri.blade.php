<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .notel {
        mso-number-format: "\@";
        }
    </style>
</head>
<body>
    <table>
        <thead style="font-weight: bold; text-transform: uppercase">
            <tr>
                <th rowspan="3" colspan="7">TEMPLATE IMPORT DATA SANTRI LEMBAGA {{strtoupper($data->nama_lembaga)}} <br> <small>Per - {{date('Y')}}</small></th>
            </tr>
        </thead>
    </table>
    {{-- spasi --}}
    <table>
        <thead>
            <tr></tr>
        </thead>
    </table>
    {{-- spasi --}}
    <table>
        <thead style="font-weight: bold; border: black">
            <tr style="border: black; text-transform: uppercase">
                <th rowspan="2">NAMA SANTRI</th>
                <th rowspan="2">TEMPAT LAHIR SANTRI</th>
                <th rowspan="2">TANGGAL LAHIR SANTRI</th>
                <th rowspan="2">WALI AYAH/IBU/LAINNYA</th>
                <th rowspan="2">NAMA WALI</th>
                <th rowspan="2">TELEPON WALI</th>
                <th rowspan="2">ALAMAT SANTRI</th>
            </tr>
        </thead >
        <tbody>
            <tr></tr>
            <tr>
                <td>Nama Lengkap + Gelar</td>
                <td>Tempat Lahir</td>
                <td>Tanggal Lahir (Sesuai Format Pada Excel)</td>
                <td>Ayah / Ibu / Lainnya</td>
                <td>Nama Lengkap Wali Selaku Ayah / Ibu / Lainnya</td>
                <td>UBAH COLUMN "B" INI KE FORMAT TEXT AGAR FORMAT NOMOR TELP SESUAI</td>
                <td>Alamat Lengkap Santri</td>
            </tr>
        </tbody>
    </table>
</body>
</html>