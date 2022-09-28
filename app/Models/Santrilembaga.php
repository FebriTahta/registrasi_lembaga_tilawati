<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santrilembaga extends Model
{
    use HasFactory;
    protected $fillable = [
        'lembagasurvey_id','nama_santri','alamat_santri','tempat_lahir_santri','tanggal_lahir_santri','jenis_wali_santri','nama_wali_santri','telp_wali_santri'
    ];

    public function lembagasurvey()
    {
        return $this->belongsTo(Lembagasurvey::class);
    }
}
