<?php

namespace App\Http\Controllers;
use App\Models\Santrilembaga;
use App\Models\Lembagasurvey;
use Validator;
use Carbon;
use DataTables;
use Illuminate\Http\Request;

class SantriCont extends Controller
{
    public function create_santri()
    {
        if (auth()->user()->lembagasurvey->bagian == null) {
            # code...
            return redirect('/home');
        }else {
            return view('page.santri_create');
        }
        
    }

    public function daftar_santri_lulus()
    {
        if (auth()->user()->lembagasurvey->bagian == null) {
            # code...
            return redirect('/home');
        }else {
            $akses      = auth()->user()->id;
            $lembaga    = Lembagasurvey::where('akseslembaga_id', $akses)->first();
            if ($lembaga == null) {
                # code...
                return 'cari apa anda ini saudara ?';
            }else {
                # code...
                if(request()->ajax())
                {
                    $data   =   Santrilembaga::where('lembagasurvey_id', $lembaga->id)->where('status','lulus');
                                return DataTables::of($data)
                            
                                ->addColumn('tgllahir', function ($data) {
                                    if ($data->tanggal_lahir_santri !== null && $data->tanggal_lahir_santri !== '-') {
                                        # code...
                                        return $data->tempat_lahir_santri.' - '.\Carbon\Carbon::parse($data->tanggal_lahir_santri)->isoFormat('D MMMM Y');
                                    }else {
                                        # code...
                                        return $data->tempat_lahir_santri.' - ';
                                    };
                                })
                                ->addColumn('wali', function ($data) {
                                    if ($data->jenis_wali_santri == 'Ayah' || $data->jenis_wali_santri == 'Ibu' || $data->jenis_wali_santri == 'Lainnya'
                                    || $data->jenis_wali_santri == 'ayah' || $data->jenis_wali_santri == 'ibu' || $data->jenis_wali_santri == 'lainnya'
                                    || $data->jenis_wali_santri == 'AYAH' || $data->jenis_wali_santri == 'IBU' || $data->jenis_wali_santri == 'LAINNYA'
                                    || $data->jenis_wali_santri == ' Ayah' || $data->jenis_wali_santri == ' Ibu' || $data->jenis_wali_santri == ' Lainnya'
                                    || $data->jenis_wali_santri == ' ayah' || $data->jenis_wali_santri == ' ibu' || $data->jenis_wali_santri == ' lainnya'
                                    || $data->jenis_wali_santri == ' AYAH' || $data->jenis_wali_santri == ' IBU' || $data->jenis_wali_santri == ' LAINNYA'
                                    || $data->jenis_wali_santri == 'Ayah ' || $data->jenis_wali_santri == 'Ibu ' || $data->jenis_wali_santri == 'Lainnya '
                                    || $data->jenis_wali_santri == 'ayah ' || $data->jenis_wali_santri == 'ibu ' || $data->jenis_wali_santri == 'lainnya '
                                    || $data->jenis_wali_santri == 'AYAH ' || $data->jenis_wali_santri == 'IBU ' || $data->jenis_wali_santri == 'LAINNYA '
                                    || $data->jenis_wali_santri == ' Ayah ' || $data->jenis_wali_santri == ' Ibu ' || $data->jenis_wali_santri == ' Lainnya '
                                    || $data->jenis_wali_santri == ' ayah ' || $data->jenis_wali_santri == ' ibu ' || $data->jenis_wali_santri == ' lainnya '
                                    || $data->jenis_wali_santri == ' AYAH ' || $data->jenis_wali_santri == ' IBU ' || $data->jenis_wali_santri == ' LAINNYA '
                                    ) {
                                        # code...
                                        return $data->jenis_wali_santri. ' - '.$data->nama_wali_santri;
                                    }else{
                                        return ' - '.$data->nama_wali_santri;
                                    }
                                })
                                ->addColumn('opsi', function ($data) {
                                    if ($data->tanggal_lahir_santri !== null && $data->tanggal_lahir_santri !== '-') {
                                        # code...
                                        $btn  = ' <button style="width:70px" class="mb-1 btn btn-sm btn-primary" data-toggle="modal" data-target="#modallihat" 
                                        data-tanggal="'.\Carbon\Carbon::parse($data->tanggal_lahir_santri)->format('Y-m-d').'"
                                        data-tempat="'.$data->tempat_lahir_santri.'" data-id="'.$data->id.'" data-nama="'.$data->nama_santri.'" data-jenis="'.$data->jenis_wali_santri.'"
                                        data-nama_wali="'.$data->nama_wali_santri.'" data-telp="'.$data->telp_wali_santri.'" data-alamat="'.$data->alamat_santri.'"
                                        >edit</button> ';
                                    }else {
                                        # code...
                                        $btn  = ' <button style="width:70px" class="mb-1 btn btn-sm btn-primary" data-toggle="modal" data-target="#modallihat" 
                                        data-tanggal="-"
                                        data-tempat="'.$data->tempat_lahir_santri.'" data-id="'.$data->id.'" data-nama="'.$data->nama_santri.'" data-jenis="'.$data->jenis_wali_santri.'"
                                        data-nama_wali="'.$data->nama_wali_santri.'" data-telp="'.$data->telp_wali_santri.'" data-alamat="'.$data->alamat_santri.'"
                                        >edit</button> ';
                                    }
                                    
                                    $btn .= ' <button style="width:70px" class="mb-1 btn btn-sm btn-danger" data-toggle="modal" data-target="#modalhapus" data-id="'.$data->id.'" data-nama="'.$data->nama_santri.'">hapus</button> ';
                                    $btn .= ' <button style="width:70px" class="mb-1 btn btn-sm btn-success" data-toggle="modal" data-target="#modallulus" data-id="'.$data->id.'" data-nama="'.$data->nama_santri.'">lulus</button> ';
                                    return $btn;
                                })
                                ->rawColumns(['tgllahir','wali','opsi'])
                                ->make(true);
                }
            }
            return view('page.santri_lulus');
        }
    }

    public function daftar_santri()
    {
        if (auth()->user()->lembagasurvey->bagian == null) {
            # code...
            return redirect('/home');
        }else {
            $akses      = auth()->user()->id;
            $lembaga    = Lembagasurvey::where('akseslembaga_id', $akses)->first();
            if ($lembaga == null) {
                # code...
                return 'cari apa anda ini saudara ?';
            }else {
                # code...
                if(request()->ajax())
                {
                    $data   =   Santrilembaga::where('lembagasurvey_id', $lembaga->id)->where('status','aktif');
                                return DataTables::of($data)
                            
                                ->addColumn('tgllahir', function ($data) {
                                    if ($data->tanggal_lahir_santri !== null && $data->tanggal_lahir_santri !== '-') {
                                        # code...
                                        return $data->tempat_lahir_santri.' - '.\Carbon\Carbon::parse($data->tanggal_lahir_santri)->isoFormat('D MMMM Y');
                                    }else {
                                        # code...
                                        return $data->tempat_lahir_santri.' - ';
                                    };
                                })
                                ->addColumn('wali', function ($data) {
                                    if ($data->jenis_wali_santri == 'Ayah' || $data->jenis_wali_santri == 'Ibu' || $data->jenis_wali_santri == 'Lainnya'
                                    || $data->jenis_wali_santri == 'ayah' || $data->jenis_wali_santri == 'ibu' || $data->jenis_wali_santri == 'lainnya'
                                    || $data->jenis_wali_santri == 'AYAH' || $data->jenis_wali_santri == 'IBU' || $data->jenis_wali_santri == 'LAINNYA'
                                    || $data->jenis_wali_santri == ' Ayah' || $data->jenis_wali_santri == ' Ibu' || $data->jenis_wali_santri == ' Lainnya'
                                    || $data->jenis_wali_santri == ' ayah' || $data->jenis_wali_santri == ' ibu' || $data->jenis_wali_santri == ' lainnya'
                                    || $data->jenis_wali_santri == ' AYAH' || $data->jenis_wali_santri == ' IBU' || $data->jenis_wali_santri == ' LAINNYA'
                                    || $data->jenis_wali_santri == 'Ayah ' || $data->jenis_wali_santri == 'Ibu ' || $data->jenis_wali_santri == 'Lainnya '
                                    || $data->jenis_wali_santri == 'ayah ' || $data->jenis_wali_santri == 'ibu ' || $data->jenis_wali_santri == 'lainnya '
                                    || $data->jenis_wali_santri == 'AYAH ' || $data->jenis_wali_santri == 'IBU ' || $data->jenis_wali_santri == 'LAINNYA '
                                    || $data->jenis_wali_santri == ' Ayah ' || $data->jenis_wali_santri == ' Ibu ' || $data->jenis_wali_santri == ' Lainnya '
                                    || $data->jenis_wali_santri == ' ayah ' || $data->jenis_wali_santri == ' ibu ' || $data->jenis_wali_santri == ' lainnya '
                                    || $data->jenis_wali_santri == ' AYAH ' || $data->jenis_wali_santri == ' IBU ' || $data->jenis_wali_santri == ' LAINNYA '
                                    ) {
                                        # code...
                                        return $data->jenis_wali_santri. ' - '.$data->nama_wali_santri;
                                    }else{
                                        return ' - '.$data->nama_wali_santri;
                                    }
                                })
                                ->addColumn('opsi', function ($data) {
                                    if ($data->tanggal_lahir_santri !== null && $data->tanggal_lahir_santri !== '-') {
                                        # code...
                                        $btn  = ' <button style="width:70px" class="mb-1 btn btn-sm btn-primary" data-toggle="modal" data-target="#modallihat" 
                                        data-tanggal="'.\Carbon\Carbon::parse($data->tanggal_lahir_santri)->format('Y-m-d').'"
                                        data-tempat="'.$data->tempat_lahir_santri.'" data-id="'.$data->id.'" data-nama="'.$data->nama_santri.'" data-jenis="'.$data->jenis_wali_santri.'"
                                        data-nama_wali="'.$data->nama_wali_santri.'" data-telp="'.$data->telp_wali_santri.'" data-alamat="'.$data->alamat_santri.'"
                                        >edit</button> ';
                                    }else {
                                        # code...
                                        $btn  = ' <button style="width:70px" class="mb-1 btn btn-sm btn-primary" data-toggle="modal" data-target="#modallihat" 
                                        data-tanggal="-"
                                        data-tempat="'.$data->tempat_lahir_santri.'" data-id="'.$data->id.'" data-nama="'.$data->nama_santri.'" data-jenis="'.$data->jenis_wali_santri.'"
                                        data-nama_wali="'.$data->nama_wali_santri.'" data-telp="'.$data->telp_wali_santri.'" data-alamat="'.$data->alamat_santri.'"
                                        >edit</button> ';
                                    }
                                    
                                    $btn .= ' <button style="width:70px" class="mb-1 btn btn-sm btn-danger" data-toggle="modal" data-target="#modalhapus" data-id="'.$data->id.'" data-nama="'.$data->nama_santri.'">hapus</button> ';
                                    $btn .= ' <button style="width:70px" class="mb-1 btn btn-sm btn-success" data-toggle="modal" data-target="#modallulus" data-id="'.$data->id.'" data-nama="'.$data->nama_santri.'">lulus</button> ';
                                    return $btn;
                                })
                                ->rawColumns(['tgllahir','wali','opsi'])
                                ->make(true);
                }
            }
            return view('page.santri_list');
        }
        
    }

    public function remove_santri(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'         => 'required',
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'  => 'Santri tidak ditemukan',
                'errors' => $validator->messages(),
            ]);

        }else {
            $guru = Santrilembaga::where('id', $request->id)->first();
            $guru->delete();
            return response()->json(
                [
                  'status'  => 200,
                  'message' => 'Santri berhasil dihapus dari sistem'
                ]
            );
        }
    }

    public function lulus_santri(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'           => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'  => 'undefined field submited',
                'errors' => $validator->messages(),
            ]);

        }else {
            $santri = Santrilembaga::findOrFail($request->id);
            $santri->update(['status'=>'lulus']);
            return response()->json(
                [
                  'status'  => 200,
                  'message' => 'Santri Atas Nama : <br>'.$santri->nama_santri.'<br> berhasil dipindahkan ke daftar santri yang lulus',
                ]
            );
        }
    }

    public function store_santri(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_santri'           => 'required|max:50',
            'tempat_lahir_santri'   => 'required',
            'tgl'                   => 'required',
            'bln'                   => 'required',
            'thn'                   => 'required',
            'jenis_wali_santri'     => 'required',
            'nama_wali_santri'      => 'required',
            'telp_wali_santri'      => 'required',
            'alamat_santri'         => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'  => 'Pastikan semua data sudah terisi dengan benar',
                'errors' => $validator->messages(),
            ]);

        }else {
            $exist = Santrilembaga::where('nama_santri', $request->nama_santri)->where('telp_wali_santri', $request->telp_wali_santri)->first();
            $tanggal_lahir_santri = $request->thn.'-'.$request->bln.'-'.$request->tgl;

            if (substr($request->telp_wali_santri,0,2) !== '08' || strlen($request->telp_wali_santri) < 10 || strlen($request->telp_wali_santri) > 15) {
                # code...
                return response()->json([
                    'status' => 400,
                    'message'  => 'Pastikan nomor telepon anda benar dan terhubung dengan whatsapp. (awali dengan 08)',
                ]);

            }elseif ($exist !== null) {
                # code...
                return response()->json([
                    'status' => 400,
                    'message'  => 'Santri dengan nama dan nomor telephone tersebut sudah terdaftar',
                ]);

            }else {

                $telp       = $request->telp_wali_santri;
                if (substr($telp,0,2) == '08') {
                    # code...
                    $telp   = $telp; 
                }elseif (substr($telp,0,2) == '62') {
                    # code...
                    $telp   = '0'.substr($telp,2);
                }

                $guru  = Santrilembaga::updateOrCreate(
                    [
                        'id'=>$request->id
                    ],
                    [
                        'lembagasurvey_id'      => auth()->user()->lembagasurvey->id,
                        'nama_santri'           => $request->nama_santri,
                        'tempat_lahir_santri'   => $request->tempat_lahir_santri,
                        'tanggal_lahir_santri'  => $tanggal_lahir_santri,
                        'jenis_wali_santri'     => $request->jenis_wali_santri,
                        'nama_wali_santri'      => $request->nama_wali_santri,
                        'telp_wali_santri'      => $telp,
                        'alamat_santri'         => $request->alamat_santri,
                        'status'                => 'aktif'
                    ]
                );

                return response()->json(
                    [
                      'status'  => 200,
                      'message' => 'Santri baru berhasil didaftarkan'
                    ]
                );
            }
        }
    }

    public function update_santri(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_santri'           => 'required|max:50',
            'tempat_lahir_santri'   => 'required',
            'tanggal_lahir_santri'  => 'required',
            'jenis_wali_santri'     => 'required',
            'nama_wali_santri'      => 'required',
            'telp_wali_santri'      => 'required',
            'alamat_santri'         => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'  => 'Pastikan semua data sudah terisi dengan benar',
                'errors' => $validator->messages(),
            ]);

        }else {

            if (substr($request->telp_wali_santri,0,2) !== '08' || strlen($request->telp_wali_santri) < 10 || strlen($request->telp_wali_santri) > 15) {
                # code...
                return response()->json([
                    'status' => 400,
                    'message'  => 'Pastikan nomor telepon anda benar dan terhubung dengan whatsapp. (awali dengan 08)',
                ]);

            }else {

                $telp       = $request->telp_wali_santri;
                if (substr($telp,0,2) == '08') {
                    # code...
                    $telp   = $telp; 
                }elseif (substr($telp,0,2) == '62') {
                    # code...
                    $telp   = '0'.substr($telp,2);
                }

                $santri  = Santrilembaga::updateOrCreate(
                    [
                        'id'=>$request->id
                    ],
                    [
                        'lembagasurvey_id'      => auth()->user()->lembagasurvey->id,
                        'nama_santri'           => $request->nama_santri,
                        'tempat_lahir_santri'   => $request->tempat_lahir_santri,
                        'tanggal_lahir_santri'  => $request->tanggal_lahir_santri,
                        'jenis_wali_santri'     => $request->jenis_wali_santri,
                        'nama_wali_santri'      => $request->nama_wali_santri,
                        'telp_wali_santri'      => $request->telp_wali_santri,
                        'alamat_santri'         => $request->alamat_santri,
                    ]
                );

                return response()->json(
                    [
                      'status'  => 200,
                      'message' => 'Santri baru berhasil didaftarkan'
                    ]
                );
            }
        }
    }
}
