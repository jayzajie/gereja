<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WartaMingguan extends Model
{
    use HasFactory;

    protected $table = 'warta_mingguan';

    protected $fillable = [
        'nama_warta',
        'file_path',
        'file_name',
        'file_size',
        'tanggal',
        'bulan',
        'tahun',
        'deskripsi'
    ];

    protected $casts = [
        'tanggal' => 'integer',
        'bulan' => 'integer',
        'tahun' => 'integer',
        'file_size' => 'integer'
    ];

    // Accessor untuk nama bulan
    public function getBulanNamaAttribute()
    {
        $bulanNama = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return $bulanNama[$this->bulan] ?? '';
    }

    // Accessor untuk ukuran file yang readable
    public function getFileSizeReadableAttribute()
    {
        if (!$this->file_size) {
            return 'Unknown';
        }

        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }



    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where('nama_warta', 'like', '%' . $search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $search . '%');
    }

    // Scope untuk filter tahun
    public function scopeByYear($query, $year)
    {
        return $query->where('tahun', $year);
    }


}
