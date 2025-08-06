<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'jenis_kelamin',
        'tanggal_lahir',
        'tempat_lahir',
        'alamat',
        'no_hp',
        'email',
        'pekerjaan',
        'status_pernikahan',
        'nama_ayah',
        'nama_ibu',
        'nama_pasangan',
        'tanggal_baptis',
        'tempat_baptis',
        'tanggal_sidi',
        'tempat_sidi',
        'foto',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_baptis' => 'date',
        'tanggal_sidi' => 'date',
    ];

    // Scope untuk filter berdasarkan jenis kelamin
    public function scopeLakiLaki($query)
    {
        return $query->where('jenis_kelamin', 'Lk');
    }

    public function scopePerempuan($query)
    {
        return $query->where('jenis_kelamin', 'Pr');
    }

    // Scope untuk filter berdasarkan status pernikahan
    public function scopeBelumMenikah($query)
    {
        return $query->where('status_pernikahan', 'B');
    }

    public function scopeMenikah($query)
    {
        return $query->where('status_pernikahan', 'K');
    }

    public function scopeDuda($query)
    {
        return $query->where('status_pernikahan', 'D');
    }

    public function scopeJanda($query)
    {
        return $query->where('status_pernikahan', 'J');
    }

    // Accessor untuk umur
    public function getUmurAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->age : null;
    }

    // Accessor untuk kategori umur
    public function getKategoriUmurAttribute()
    {
        $umur = $this->umur;
        if ($umur < 18) return 'Anak-anak';
        if ($umur < 30) return 'Remaja/Dewasa Muda';
        if ($umur < 50) return 'Dewasa';
        return 'Lansia';
    }
}
