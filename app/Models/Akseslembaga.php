<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Akseslembaga extends Authenticatable 
{
    use Notifiable;
    // use HasFactory;

    protected $fillable = 
    [
        'id','username','role','pass','password'
    ];

    public function lembagasurvey()
    {
        return $this->hasOne(Lembagasurvey::class);
    }
}
