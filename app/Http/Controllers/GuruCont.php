<?php

namespace App\Http\Controllers;
use App\Models\Gurulembaga;
use App\Models\Cabang;
use App\Models\Lembagasurvey;
use Validator;
use Carbon;
use DataTables;
use Illuminate\Http\Request;

class GuruCont extends Controller
{
    public function create_guru()
    {
        if (auth()->user()->lembagasurvey->bagian == null) {
            # code...
            return redirect('/home');
        }else {
            $kabupaten_id = auth()->user()->lembagasurvey->kabupaten_id;
            $cabang = Cabang::where('kabupaten_id', $kabupaten_id)->where('name','!=','Tilawati Pusat')->get();
            return view('page.guru_create',compact('cabang'));
        }
        
    }

    public function import_guru()
    {
        return view('page.import_guru');
    }

    public function daftar_guru(Request $request)
    {
        if (auth()->user()->lembagasurvey->bagian == null) {
            # code...
            return redirect('/home');
        }else {
            # code...
            $akses      = auth()->user()->id;
            $lembaga    = Lembagasurvey::where('akseslembaga_id', $akses)->first();
            if ($lembaga == null) {
                # code...
                return 'cari apa anda ini saudara ?';
            }else {
                # code...
                if(request()->ajax())
                {
                    $data   =   Gurulembaga::where('lembagasurvey_id', $lembaga->id);
                                return DataTables::of($data)
                            
                                ->addColumn('tgllahir', function ($data) {
                                    if ($data->tanggal_lahir_guru !== null && $data->tanggal_lahir_guru !== '-') {
                                        # code...
                                        return $data->tempat_lahir_guru.' - '.\Carbon\Carbon::parse($data->tanggal_lahir_guru)->isoFormat('D MMMM Y');
                                    }else {
                                        # code...
                                        return $data->tempat_lahir_guru.' - ';
                                    };
                                })
                                ->addColumn('opsi', function ($data) {
                                    if ($data->tanggal_lahir_guru !== '-' && $data->tanggal_lahir_guru !== null) {
                                        # code...
                                        $btn  = ' <button style="width:70px;" class="btn btn-sm btn-primary mb-1" data-toggle="modal" data-target="#modallihat"
                                        data-id="'.$data->id.'" data-nama="'.$data->nama_guru.'" data-telp="'.$data->telp_guru.'" data-tanggal="'.\Carbon\Carbon::parse($data->tanggal_lahir_guru)->format('Y-m-d').'" data-tempat="'.$data->tempat_lahir_guru.'"
                                        data-alamat="'.$data->alamat_guru.'">edit</button> ';
                                    }else{
                                        $btn  = ' <button style="width:70px" class=" mb-1 btn btn-sm btn-primary" data-toggle="modal" data-target="#modallihat"
                                        data-id="'.$data->id.'" data-nama="'.$data->nama_guru.'" data-telp="'.$data->telp_guru.'" data-tanggal="'.$data->tanggal_lahir_guru.'" data-tempat="'.$data->tempat_lahir_guru.'"
                                        data-alamat="'.$data->alamat_guru.'">edit</button> ';
                                    }
                                    
                                    $btn .= ' <button style="width:70px" class="mb-1 btn btn-sm btn-danger" data-toggle="modal" data-target="#modalhapus" data-id="'.$data->id.'" data-nama="'.$data->nama_guru.'">hapus</button> ';
                                    return $btn;
                                })
                                ->rawColumns(['tgllahir','opsi'])
                                ->make(true);
                }
            }
            
            
            $kabupaten_id = auth()->user()->lembagasurvey->kabupaten_id;
            $cabang = Cabang::where('kabupaten_id', $kabupaten_id)->where('name','!=','Tilawati Pusat')->get();
            return view('page.guru_list',compact('cabang'));
        }
    }

    public function remove_guru(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'         => 'required',
        ]);
        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'  => 'Guru tidak ditemukan',
                'errors' => $validator->messages(),
            ]);

        }else {
            $guru = Gurulembaga::where('id', $request->id)->first();
            $guru->delete();
            return response()->json(
                [
                  'status'  => 200,
                  'message' => 'Guru berhasil dihapus dari sistem'
                ]
            );
        }
    }

    public function store_guru(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_guru'         => 'required|max:50',
            'tempat_lahir_guru' => 'required',
            'tgl'               => 'required',
            'bln'               => 'required',
            'thn'               => 'required',
            'alamat_guru'       => 'required',
            'telp_guru'         => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'  => 'Pastikan semua data sudah terisi dengan benar',
                'errors' => $validator->messages(),
            ]);

        }else {
            $exist = Gurulembaga::where('telp_guru', $request->telp_guru)->first();
            $tanggal_lahir_guru = $request->thn.'-'.$request->bln.'-'.$request->tgl;

            if (substr($request->telp_guru,0,2) !== '08' || strlen($request->telp_guru) < 10 || strlen($request->telp_guru) > 13) {
                # code...
                return response()->json([
                    'status' => 400,
                    'message'  => 'Pastikan nomor telepon anda benar dan terhubung dengan whatsapp',
                ]);

            }elseif ($exist !== null) {
                # code...
                return response()->json([
                    'status' => 400,
                    'message'  => 'Nomor telepon / whatsapp sudah terdaftar',
                ]);

            }else {

                $guru  = Gurulembaga::updateOrCreate(
                    [
                        'id'=>$request->id
                    ],
                    [
                        'lembagasurvey_id' => auth()->user()->lembagasurvey->id,
                        'nama_guru'     => $request->nama_guru,
                        'alamat_guru'   => $request->alamat_guru,
                        'telp_guru'     => $request->telp_guru,
                        'tempat_lahir_guru'     => $request->tempat_lahir_guru,
                        'tanggal_lahir_guru'     => $tanggal_lahir_guru,
                    ]
                );

                return response()->json(
                    [
                      'status'  => 200,
                      'message' => 'Guru baru berhasil didaftarkan'
                    ]
                );
            }
        }
    }

    public function update_guru(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_guru'         => 'required|max:50',
            'tempat_lahir_guru' => 'required',
            'tanggal_lahir_guru'=> 'required',
            'alamat_guru'       => 'required',
            'telp_guru'         => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status' => 400,
                'message'  => 'Pastikan semua data sudah terisi dengan benar',
                'errors' => $validator->messages(),
            ]);

        }else {
           
            if (substr($request->telp_guru,0,2) !== '08' || strlen($request->telp_guru) < 10 || strlen($request->telp_guru) > 13) {
                # code...
                return response()->json([
                    'status' => 400,
                    'message'  => 'Pastikan nomor telepon anda benar dan terhubung dengan whatsapp',
                ]);

            }else {

                $guru  = Gurulembaga::updateOrCreate(
                    [
                        'id'=>$request->id
                    ],
                    [
                        'lembagasurvey_id' => auth()->user()->lembagasurvey->id,
                        'nama_guru'     => $request->nama_guru,
                        'alamat_guru'   => $request->alamat_guru,
                        'telp_guru'     => $request->telp_guru,
                        'tempat_lahir_guru'     => $request->tempat_lahir_guru,
                        'tanggal_lahir_guru'     => $request->tanggal_lahir_guru,
                    ]
                );

                return response()->json(
                    [
                      'status'  => 200,
                      'message' => 'Guru baru berhasil didaftarkan'
                    ]
                );
            }
        }
    }
}
