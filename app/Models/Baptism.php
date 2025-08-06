<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baptism extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_baptis',
        // I. KETERANGAN ANAK
        'nama_jemaat',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat_anak',
        'tanggal_baptis',

        // II. KETERANGAN ORANG TUA (AYAH)
        'nama_ayah',
        'umur_ayah',
        'gereja_ayah',
        'pekerjaan_ayah',
        'alamat_ayah',

        // III. KETERANGAN ORANG TUA (IBU)
        'nama_ibu',
        'umur_ibu',
        'gereja_ibu',
        'pekerjaan_ibu',
        'alamat_ibu',

        // IV. LAMPIRAN
        'foto',
        'no_telepon',
        'dibaptis_oleh',
        'email',
        'status',
    ];
}
