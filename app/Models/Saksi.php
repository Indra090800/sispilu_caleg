<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Saksi extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "tb_saksi";
    protected $primaryKey = "id_saksi";

    protected $fillable = [
        'nik_ktp',
        'nama_saksi',
        'alamat',
        'no_hp',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
