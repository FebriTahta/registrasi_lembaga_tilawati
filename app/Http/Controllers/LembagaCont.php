<?php

namespace App\Http\Controllers;
use App\Models\Gurulembaga;
use App\Models\Santrilembaga;
use App\Models\Lembagasurvey;
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
            $semua_santri_usia_non_valid = Santrilembaga::where('lembagasurvey_id', auth()->user()->lembagasurvey->id)->where('tanggal_lahir_santri', null)->orWhere('tanggal_lahir_santri','-')->count();
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
}
