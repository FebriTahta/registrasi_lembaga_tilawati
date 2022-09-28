<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Santrilembaga;
use App\Models\Lembagasurvey;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportTemplateSantri implements ToCollection,SkipsOnError, SkipsOnFailure 
{
    use Importable,SkipsErrors, SkipsFailures;

    public function __construct($lembaga_id)
    {
        $this->lembaga_id=$lembaga_id;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {

            if ($key >= 6) {

                $exist = Santrilembaga::where('lembagasurvey_id', $this->lembaga_id)->where('nama_santri',$row[0])->where('alamat_santri',$row[6])->first();
                if (is_numeric($row[2]) !== false) {
                    # code...
                    $tgllahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]);
                }else {
                    # code...
                    $tgllahir="-";
                }

                $id = 0;

                if ($exist == null) {
                    # code...
                    $id = 0;
                }else {
                    # code...
                    $id = $exist->id;
                }

                Santrilembaga::updateOrCreate(
                    [
                        'id' => $id,
                    ]
                    ,[
                        'lembagasurvey_id' => $this->lembaga_id,
                        'nama_santri'=> $row[0],
                        'tempat_lahir_santri' => $row[1],
                        'tanggal_lahir_santri'=> $tgllahir,
                        'jenis_wali_santri'=> $row[3],
                        'nama_wali_santri'=> $row[4],
                        'telp_wali_santri'=> $row[5],
                        'alamat_santri' => $row[6]
                    ]
                );
            }
        }
    }

    public function rules(): array
    {
        return [
            'NAMA_SANTRI'=>'required',
        ];
    }
}
