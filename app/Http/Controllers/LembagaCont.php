<?php

namespace App\Http\Controllers;
use App\Models\Gurulembaga;
use App\Models\Santrilembaga;
use App\Models\Akseslembaga;
use App\Models\Lembagasurvey;
use App\Models\Cabang;
use App\Models\Kabupaten;
use QrCode;
use PDF;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Http\Request;

class LembagaCont extends Controller
{
    public function total_santri_guru_tahun_ini(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $guru = Gurulembaga::where('lembagasurvey_id', auth()->user()->lembagasurvey->id)->whereYear('created_at', date('Y'))->count();
            $santri = Santrilembaga::where('lembagasurvey_id', auth()->user()->lembagasurvey->id)->whereYear('created_at', date('Y'))->count();
            $guru2 = Gurulembaga::where('lembagasurvey_id', auth()->user()->lembagasurvey->id)->whereYear('created_at', (date('Y')-1))->count();
            $santri2 = Santrilembaga::where('lembagasurvey_id', auth()->user()->lembagasurvey->id)->whereYear('created_at', (date('Y')-1))->count();

            $total_tahun_ini = $guru + $santri;
            $total_tahun_lalu = $guru2 + $santri2;

            $jumlah_santri = $santri + $santri2;

            // usia santri
            $semua_santri_usia_valid = Santrilembaga::where('lembagasurvey_id', auth()->user()->lembagasurvey->id)->where('tanggal_lahir_santri', '!=' , null)->where('tanggal_lahir_santri', '!=', '-')->get();
            $semua_santri_usia_non_valid = Santrilembaga::where('lembagasurvey_id', auth()->user()->lembagasurvey->id)->where('tanggal_lahir_santri','-')->count();
            $anak = [];
            $remaja = [];
            $dewasa = [];
            foreach ($semua_santri_usia_valid as $key => $value) {
                # code...
                $tahun = \Carbon\Carbon::parse($value->tanggal_lahir_santri)->format('Y');
                $usia  = date('Y') - $tahun;
                if ($usia < 12) {
                    # code...
                    $anak[] = $usia;
                }elseif ($usia > 11 && $usia < 20) {
                    # code...
                    $remaja[] = $usia;
                }elseif ($usia > 20) {
                    # code...
                    $dewasa[] = $usia;
                }
            }
            $val1 = count($anak);
            $val2 = count($remaja);
            $val3 = count($dewasa);

            if ($total_tahun_ini > 0) {
                # code...
                $selisih = $total_tahun_ini - $total_tahun_lalu;
                
                if ($selisih == 0) {
                    # code...
                    $presentase = 0;
                }else {
                    # code...
                    if ($total_tahun_lalu !== 0) {
                        # code...
                        $presentase = $selisih / $total_tahun_lalu;
                    }else {
                        # code...
                        $presentase = $selisih * 100;
                    }
                }
                
            }else {
                # code...
                $presentase = 0;
            }

            return response()->json(
                [
                    'total_tahun_ini' => $total_tahun_ini,
                    'total_tahun_lalu' => $total_tahun_lalu,
                    'presentase' => $presentase,
                    'jumlah_santri' => $jumlah_santri,
                    'anak'=> $val1,
                    'remaja'=> $val2,
                    'dewasa'=> $val3,
                    'usia_non_valid'=> $semua_santri_usia_non_valid
                ]
            );
        }
    }

    public function download_sertifikat()
    {
        $lembaga = Lembagasurvey::findOrFail(auth()->user()->lembagasurvey->id);

        $date = \Carbon\Carbon::parse($lembaga->created_at)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        
        $no_sertifikat = $lembaga->kode.'/'.$date->format('Y').'/'.$lembaga->kabupaten_id;
        $id = \Crypt::encrypt($lembaga->id);
        $qrcode = base64_encode(QrCode::size(300)->generate('https://lembaga-tilawati.nurulfalah.org/status-lembaga/'.$id));
        $data = [
            'nama_lembaga' => $lembaga->satuan_pendidikan.' - '.$lembaga->nama_lembaga,
            'alamat'    => $lembaga->alamat_lembaga,
            'kabupaten' => $lembaga->kabupaten->nama_kabupaten,
            'tanggal'   => $date->format('j F Y'),
            'no'        => $no_sertifikat,
            'qrcode'    => $qrcode,
        ];
          
        $customPaper = array(0,0,865,612);
    	$pdf = PDF::loadView('form.sertifikat', compact('data'))->setPaper($customPaper, 'portrait');
    	return $pdf->stream('sertifikat.pdf','I');
    }

    public function download_sertifikat2($lembaga_id)
    {
        $lembaga = Lembagasurvey::findOrFail($lembaga_id);

        $date = \Carbon\Carbon::parse($lembaga->created_at)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        
        $no_sertifikat = $lembaga->kode.'/'.$date->format('Y').'/'.$lembaga->kabupaten_id;
        $id = \Crypt::encrypt($lembaga_id);
        $qrcode = base64_encode(QrCode::size(300)->generate('https://lembaga-tilawati.nurulfalah.org/status-lembaga/'.$id));
        $data = [
            'nama_lembaga' => $lembaga->satuan_pendidikan.' - '.$lembaga->nama_lembaga,
            'alamat'    => $lembaga->alamat_lembaga,
            'kabupaten' => $lembaga->kabupaten->nama_kabupaten,
            'tanggal'   => $date->format('j F Y'),
            'no'        => $no_sertifikat,
            'qrcode'    => $qrcode,
        ];
          
        $customPaper = array(0,0,865,612);
    	$pdf = PDF::loadView('form.sertifikat', compact('data'))->setPaper($customPaper, 'portrait');
    	return $pdf->stream('sertifikat.pdf','I');
    }

    public function profile_lembaga()
    {
        $kabupaten_id = auth()->user()->lembagasurvey->kabupaten_id;
        $cabang = Cabang::where('kabupaten_id', $kabupaten_id)->where('name','!=','Tilawati Pusat')->get();
        return view('page.profile',compact('cabang'));
    }

    public function update_lembaga(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $kabupaten = Kabupaten::where('id',$request->kabupaten_id)->first();

            $lembaga = Lembagasurvey::updateOrCreate(
                [
                    'id'=>auth()->user()->lembagasurvey->id
                ],
                [
                    'nama_lembaga'      => $request->nama_lembaga,
                    'alamat_lembaga'    => $request->alamat_lembaga,
                    'telp_lembaga'      => $request->telp_lembaga,
                    'jenjang_pendidikan'=> $request->jenjang_pendidikan,
                    'satuan_pendidikan' => $request->satuan_pendidikan,
                    'kabupaten_id'      => $request->kabupaten_id,
                    'provinsi_id'       => $kabupaten->provinsi_id,
                    'slug_lembaga'      => Str::slug($request->nama_lembaga),
                ]
            );

            $akses   = Akseslembaga::where('id', $lembaga->akseslembaga_id)->update(
                [
                    'username'=>$lembaga->nama_lembaga
                ]
            );

            return response()->json(
                [
                  'status'  => 200,
                  'message' => 'Data Lembaga berhasil diupdate'
                ]
            );
        }
        
    }

    public function check_lembaga_cabang_awal(Request $request)
    {
        if ($request->ajax()) {
            $check = Lembagasurvey::where('id',auth()->user()->lembagasurvey->id)->first();
            $check_cabang = Cabang::where('kabupaten_id', $check->kabupaten_id)->first();

            $info_cabang = '';
            if ($check_cabang == null) {
                # code...
                $info_cabang = 'cabang_kosong';
            }else{
                $info_cabang = 'cabang_ada';
            }

            if ($check->bagian == null) {
                # code...
                return response()->json(
                    [
                      'data'  => 'kosong',
                      'cabang'=> $info_cabang,
                    ]
                );
            }else {
                # code...
                return response()->json(
                    [
                      'data'  => 'ada',
                      'cabang'=> $info_cabang,
                    ]
                );
            }
        }
    }

    public function check_guru_dan_santri(Request $request)
    {
        if ($request->ajax()) {
            $lembaga = Lembagasurvey::where('id',auth()->user()->lembagasurvey->id)->first();
            $guru = $lembaga->gurulembaga->count();
            $santri = $lembaga->santrilembaga->count();
            return response()->json(
                [
                    'guru'=> $guru,
                    'santri' => $santri,
                ]
            );
        }
    }

    public function check_lembaga_cabang(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = [];
            if($request->has('q')){
                $search = $request->q;
                $data = Cabang::where('name', '!=', 'Tilawati Pusat')
                        ->with('kabupaten')
                        ->whereHas('kabupaten', function($kab)use($search){
                            $kab->where('nama','LIKE','%' .$search. '%');
                        })
                        // ->whereHas('provinsi', function($prov)use($search){
                        //     $prov->where('nama','LIKE','%' .$search. '%');
                        // })
                        ->orwhere('alamat','LIKE','%' .$search . '%')
                        ->orwhere('name','LIKE','%' .$search . '%')
                        ->get();
            }
            else{
                $data = Cabang::where('name', '!=', 'Tilawati Pusat')->get();
            }
            return response()->json($data);
        }
    }

    public function update_keanggotaan_cabang_lembaga(Request $request)
    {
        if ($request->ajax()) {
            # code...
            if ($request->cabang == 'sini') {
                # code...
                if ($request->cabang_id1 == null) {
                    # code...
                    return response()->json(
                        [
                            'status'=>400,
                            'message'=>'Pilih asal cabang dengan benar'
                        ]
                    );
                }else {
                    # code...
                    $lembaga = Lembagasurvey::where('id', auth()->user()->lembagasurvey->id)->update(
                        [
                            'cabang_id' => $request->cabang_id1,
                            'bagian'=>'cabang'
                        ]
                    );

                    return response()->json(
                        [
                            'status'=>200,
                            'message'=>'Informasi keanggotaan cabang telah di update'
                        ]
                    );
                }
                

            }elseif($request->cabang == 'sana'){
                # code...
                if ($request->cabang_id2 == null) {
                    # code...
                    return response()->json(
                        [
                            'status'=>400,
                            'message'=>'Pilih asal cabang dengan benar'
                        ]
                    );
                }else {
                    $lembaga = Lembagasurvey::where('id', auth()->user()->lembagasurvey->id)->update(
                        [
                            'cabang_id' => $request->cabang_id2,
                            'bagian'=>'cabang'
                        ]
                    );
    
                    return response()->json(
                        [
                            'status'=>200,
                            'message'=>'Informasi keanggotaan cabang telah di update'
                        ]
                    );
                }
            }
            elseif($request->cabang == 'lain'){
                # code...
                $lembaga = Lembagasurvey::where('id', auth()->user()->lembagasurvey->id)->update(
                    [
                        'bagian'=>'-'
                    ]
                );

                return response()->json(
                    [
                        'status'=>200,
                        'message'=>'Informasi keanggotaan cabang telah di update'
                    ]
                );
            }
        }
    }

    public function minta_username_password(Request $request)
    {
        $lembaga = Lembagasurvey::findOrFail(auth()->user()->lembagasurvey->id);
        $akses   = Akseslembaga::findOrFail(auth()->user()->lembagasurvey->akseslembaga_id);
        
        // $token = $request->input('g-recaptcha-response');
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response'    => 'required',
           
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'  => 'Pastikan centang reCAPTCHA terlebih dahulu',
                'errors' => $validator->messages(),
            ]);

        }else {

            set_time_limit(0);
                $curl = curl_init();
                $token = "ErPMCdWGNfhhYPrrGsTdTb1vLwUbIt35CQ2KlhffDobwUw8pgYX4TN5rDT4smiIc";
                $payload = [
                    "data" => [
                        [
                            'phone' => $lembaga->telp_lembaga,
                            'message' => 
                            // '<p>*LUPA USERNAME & PASSWORD*</p>'.
                            '<p>Berikut kami infokan username dan  password lembaga Ustadz/Ustadzah</p>'.
                            '<br><span>*username :* '.$akses->username.'</span>'.
                            '<br><span>*password :* '.$akses->pass.'</span>'.
                            '<br><br><span>Login pada dashboard lembaga tilawati : </span><a href="https://lembaga-tilawati.nurulfalah.org">https://lembaga-tilawati.nurulfalah.org</a>',

                            'secret' => false, // or true
                            'retry' => false, // or true
                            'isGroup' => false, // or true
                        ]
                    ]
                
                ];
                
                
            curl_setopt($curl, CURLOPT_HTTPHEADER,
                array(
                    "Authorization: $token",
                    "Content-Type: application/json"
                )
            );
                
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload) );
                curl_setopt($curl, CURLOPT_URL, "https://solo.wablas.com/api/v2/send-message");
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                $result = curl_exec($curl);
                curl_close($curl);
    
            return response()->json(
                [
                    'status'  => 200,
                    'message' => 'Periksa username dan password yang kami kirimkan pada nomor whatsapp anda'
                ]
            );
        
        }
       
    }

    public function lupa_password_login()
    {
        return view('page.lupa_password_login');
    }

    public function lupa_username_pass(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $validator = Validator::make($request->all(), [
                'nama_lembaga'      => 'required|max:50',
                'telp_lembaga'      => 'required',
                'jenjang_pendidikan'=> 'required',
                'satuan_pendidikan' => 'required',
                'g-recaptcha-response'    => 'required',
            ]);

            if ($validator->fails()) {

                return response()->json([
                    'status' => 400,
                    'message'  => 'Pastikan semua data sudah terisi dengan benar & centang reCAPTCHA',
                    'errors' => $validator->messages(),
                ]);
    
            }else {
                
                $lembaga = Lembagasurvey::where('nama_lembaga', $request->nama_lembaga)
                                        ->where('telp_lembaga', $request->telp_lembaga)
                                        ->where('jenjang_pendidikan', $request->jenjang_pendidikan)
                                        ->where('satuan_pendidikan', $request->satuan_pendidikan)
                                        ->first();
                
                if ($lembaga !== null) {
                    # code... ada
                    $akses   = Akseslembaga::where('id', $lembaga->akseslembaga_id)->first();
                    set_time_limit(0);
                        $curl = curl_init();
                        $token = "ErPMCdWGNfhhYPrrGsTdTb1vLwUbIt35CQ2KlhffDobwUw8pgYX4TN5rDT4smiIc";
                        $payload = [
                            "data" => [
                                [
                                    'phone' => $lembaga->telp_lembaga,
                                    'message' => 
                                    '<p>*LUPA USERNAME & PASSWORD*</p>'.
                                    '<p>Berikut kami infokan username dan  password lembaga Ustadz/Ustadzah</p>'.
                                    '<br><span>*username :* '.$akses->username.'</span>'.
                                    '<br><span>*password :* '.$akses->pass.'</span>'.
                                    '<br><br><span>Login pada dashboard lembaga tilawati : </span><a href="https://lembaga-tilawati.nurulfalah.org">https://lembaga-tilawati.nurulfalah.org</a>',

                                    'secret' => false, // or true
                                    'retry' => false, // or true
                                    'isGroup' => false, // or true
                                ]
                            ]
                        
                        ];
                        
                        
                    curl_setopt($curl, CURLOPT_HTTPHEADER,
                        array(
                            "Authorization: $token",
                            "Content-Type: application/json"
                        )
                    );
                        
                        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($payload) );
                        curl_setopt($curl, CURLOPT_URL, "https://solo.wablas.com/api/v2/send-message");
                        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                        $result = curl_exec($curl);
                        curl_close($curl);
            
                    return response()->json(
                        [
                            'status'  => 200,
                            'message' => 'Periksa username dan password yang kami kirimkan pada nomor whatsapp anda'
                        ]
                    );
                }else{
                    return response()->json(
                        [
                            'status'  => 400,
                            'message' => 'KESALAHAN. Tidak ditemukan lembaga dengan data tersebut'
                        ]
                    );
                }
            }
        }
    }

    public function scan($lembaga_id)
    {
        $id = \Crypt::decrypt($lembaga_id);
        $lembaga = Lembagasurvey::where('id',$id)->first();
        $date = \Carbon\Carbon::parse($lembaga->created_at)->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $no_sertifikat = $lembaga->kode.'/'.$date->format('Y').'/'.$lembaga->kabupaten_id;

        $qrcode = base64_encode(QrCode::size(100)->generate('https://lembaga-tilawati.nurulfalah.org/status-lembaga/'.$lembaga_id));
        $data = [
            'nama_lembaga' => $lembaga->satuan_pendidikan.' - '.$lembaga->nama_lembaga,
            'alamat'    => $lembaga->alamat_lembaga,
            'kabupaten' => $lembaga->kabupaten->nama_kabupaten,
            'tanggal'   => $date->format('j F Y'),
            'no'        => $no_sertifikat,
            'qrcode'    => $qrcode,
        ];

        return view('qr.scan',compact('lembaga','data','lembaga_id'));
    }
}
