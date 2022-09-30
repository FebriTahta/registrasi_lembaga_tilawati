<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembagasurvey extends Model
{
    use HasFactory;
    protected $fillable = [
        'slug_lembaga','kode','cabang_id','kabupaten_id','nama_lembaga','telp_lembaga','alamat_lembaga','jenjang_pendidikan','satuan_pendidikan','akseslembaga_id','provinsi_id','bagian','anggota','status','updated_at','created_at'
    ];

    public function cabang()
    {
        return $this->belongsTo(Cabang::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }

    public function akseslembaga()
    {
        return $this->belongsTo(Akseslembaga::class);
    }

    public function gurulembaga()
    {
        return $this->hasMany(Gurulembaga::class);
    }

    public function santrilembaga()
    {
        return $this->hasMany(Santrilembaga::class);
    }
}
