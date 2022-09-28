<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Gurulembaga;
use App\Models\Lembagasurvey;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class ImportTemplateGuru implements ToCollection,SkipsOnError, SkipsOnFailure 
{
    use Importable, SkipsErrors, SkipsFailures;

    public function __construct($lembaga_id)
    {
        $this->lembaga_id=$lembaga_id;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $row) {

            if ($key >= 6) {
                # code...
                $exist = Gurulembaga::where('lembagasurvey_id', $this->lembaga_id)->where('nama_guru',$row[0])->where('telp_guru', $row[1])->where('tempat_lahir_guru', $row[2])->first();
            
                if (is_numeric($row[3]) !== false) {
                    # code...
                    $tgllahir = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]);
                }else {
                    # code...
                    $tgllahir="";
                }

                $id = 0;

                if ($exist == null) {
                    # code...
                    $id = 0;
                }else {
                    # code...
                    $id = $exist->id;
                }

                Gurulembaga::updateOrCreate(
                    [
                        'id' => $id,
                    ]
                    ,[
                        'lembagasurvey_id' => $this->lembaga_id,
                        'nama_guru'=> $row[0],
                        'tempat_lahir_guru' => $row[2],
                        'tanggal_lahir_guru'=> $tgllahir,
                        'telp_guru'=> $row[1],
                        'alamat_guru'=> $row[4],
                    ]
                );
            }
            
        }
    }

    public function rules(): array
    {
        return [
            'NAMA'=>'required',
        ];
    }
}
