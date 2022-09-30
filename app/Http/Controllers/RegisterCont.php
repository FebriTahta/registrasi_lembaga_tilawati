<?php

namespace App\Http\Controllers;
use App\Models\Kabupaten;
use App\Models\Akseslembaga;
use App\Models\Lembagasurvey;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterCont extends Controller
{
    public function fetch_kabupaten_kota(Request $request)
    {
        $data = [];

        if($request->has('q')){
            $search = $request->q;
            $data = Kabupaten::Where('nama','LIKE','%' .$search . '%')
            		->get();
        }
        else{
            $data = Kabupaten::orderBy('nama','desc')->limit(10)->get();
        }
        return response()->json($data);
    }

    public function registrasi_lembaga(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_lembaga'      => 'required|max:50',
            'telp_lembaga'      => 'required',
            'alamat_lembaga'    => 'required',
            'jenjang_pendidikan'=> 'required',
            'satuan_pendidikan' => 'required',
            'kabupaten_id'      => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'  => 'Pastikan semua data sudah terisi dengan benar',
                'errors' => $validator->messages(),
            ]);

        }else {
            $exist = Lembagasurvey::where('telp_lembaga', $request->telp_lembaga)->first();

            if (substr($request->telp_lembaga,0,2) !== '08' || strlen($request->telp_lembaga) < 10 || strlen($request->telp_lembaga) > 13) {
                # code...
                return response()->json([
                    'status' => 400,
                    'message'  => 'Pastikan nomor telepon anda benar dan terhubung dengan whatsapp diawali (08 dan tidak lebih dari 13 angka)',
                ]);

            }elseif ($exist !== null) {
                # code...
                return response()->json([
                    'status' => 400,
                    'message'  => 'Nomor telepon / whatsapp sudah terdaftar',
                ]);

            }else {
                # code...
                $pool1   = '0123456789';
                $pool2   = '9876543210';
                $acak1   = substr(str_shuffle(str_repeat($pool1, 5)), 0, 3);
                $acak2   = substr(str_shuffle(str_repeat($pool2, 5)), 0, 3);
                $acak3   = substr(str_shuffle(str_repeat($pool2, 5)), 0, 5);

                $kabupaten = Kabupaten::findOrFail($request->kabupaten_id);
                $lembaga_exist_kode = Lembagasurvey::where('kode',$acak3)->first();
                if ($lembaga_exist_kode == null) {
                    # code...
                    $akses  = Akseslembaga::updateOrCreate(
                        [
                            'id'=>$request->id
                        ],
                        [
                            'role'      => 'lembaga',
                            'username'  => $request->nama_lembaga,
                            'pass'      => 'lmb-'.$acak1.'-'.$acak2,
                            'password'  => Hash::make('lmb-'.$acak1.'-'.$acak2),
                            
                        ]
                    );
    
                    $lembaga = Lembagasurvey::updateOrCreate(
                        [
                            'id'=>$request->id
                        ],
                        [
                            'kode'              => $acak3,
                            'nama_lembaga'      => $request->nama_lembaga,
                            'alamat_lembaga'    => $request->alamat_lembaga,
                            'telp_lembaga'      => $request->telp_lembaga,
                            'jenjang_pendidikan'=> $request->jenjang_pendidikan,
                            'satuan_pendidikan' => $request->satuan_pendidikan,
                            'kabupaten_id'      => $request->kabupaten_id,
                            'provinsi_id'       => $kabupaten->provinsi_id,
                            'akseslembaga_id'   => $akses->id,
                            'slug_lembaga'      => Str::slug($request->nama_lembaga),
                        ]
                    );
                    
                }else {
                    # code...
                    $acak3   = substr(str_shuffle(str_repeat($pool2, 5)), 0, 5);
                    $akses  = Akseslembaga::updateOrCreate(
                        [
                            'id'=>$request->id
                        ],
                        [
                            'role'      => 'lembaga',
                            'username'  => $request->nama_lembaga,
                            'pass'      => 'lmb-'.$acak1.'-'.$acak2,
                            'password'  => Hash::make('lmb-'.$acak1.'-'.$acak2),
                            
                        ]
                    );
    
                    $lembaga = Lembagasurvey::updateOrCreate(
                        [
                            'id'=>$request->id
                        ],
                        [
                            'kode'              => $acak3,
                            'nama_lembaga'      => $request->nama_lembaga,
                            'alamat_lembaga'    => $request->alamat_lembaga,
                            'telp_lembaga'      => $request->telp_lembaga,
                            'jenjang_pendidikan'=> $request->jenjang_pendidikan,
                            'satuan_pendidikan' => $request->satuan_pendidikan,
                            'kabupaten_id'      => $request->kabupaten_id,
                            'provinsi_id'       => $kabupaten->provinsi_id,
                            'akseslembaga_id'   => $akses->id,
                            'slug_lembaga'      => Str::slug($request->nama_lembaga),
                        ]
                    );
                }

                

                set_time_limit(0);
                $curl = curl_init();
                $token = "ErPMCdWGNfhhYPrrGsTdTb1vLwUbIt35CQ2KlhffDobwUw8pgYX4TN5rDT4smiIc";
                $payload = [
                    "data" => [
                        [
                            'phone' => $lembaga->telp_lembaga,
                            'message' => 
                            '<p>Selamat bergabung di dalam keluarga besar *METODE TILAWATI* </p>'.
                            '<br><span>Kami harap dengan penerapan Pembelajaran Metode Tilawati di lembaga Ustadz/Ustadzah menjadikan mengaji santri kita lebih mudah dan menyenangkan. </span>'.
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
    }
}
