<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marriage extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_calon_pria',
        'tanggal_lahir_pria',
        'tempat_lahir_pria',
        'alamat_pria',
        'pekerjaan_pria',
        'no_telepon_pria',
        'email_pria',
        'nama_ayah_pria',
        'nama_ibu_pria',
        'nama_calon_wanita',
        'tanggal_lahir_wanita',
        'tempat_lahir_wanita',
        'alamat_wanita',
        'pekerjaan_wanita',
        'no_telepon_wanita',
        'email_wanita',
        'nama_ayah_wanita',
        'nama_ibu_wanita',
        'tanggal_pernikahan',
        'tempat_pernikahan',
        'saksi',
        'status',
    ];
}

