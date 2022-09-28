<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gurulembaga extends Model
{
    use HasFactory;
    protected $fillable = [
        'lembagasurvey_id','nama_guru','alamat_guru','tempat_lahir_guru','tanggal_lahir_guru','telp_guru'
    ];


    public function lembagasurvey()
    {
        return $this->belongsTo(Lembagasurvey::class);
    }
}
