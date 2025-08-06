<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OigProgramKerja extends Model
{
    use HasFactory;

    protected $table = 'oig_program_kerja';

    protected $fillable = [
        'organisasi',
        'nama_program',
        'deskripsi',
        'tujuan',
        'sasaran',
        'tanggal_mulai',
        'tanggal_selesai',
        'penanggung_jawab',
        'anggaran',
        'status',
        'gambar',
        'tahun',
        'urutan'
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'anggaran' => 'decimal:2',
        'tahun' => 'integer',
    ];

    /**
     * Scope untuk filter berdasarkan organisasi
     */
    public function scopeByOrganisasi($query, $organisasi)
    {
        return $query->where('organisasi', $organisasi);
    }

    /**
     * Scope untuk tahun tertentu
     */
    public function scopeByTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    /**
     * Scope untuk status tertentu
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk program aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope untuk urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Get gambar URL
     */
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return asset('images/default-program.png');
    }

    /**
     * Get formatted anggaran
     */
    public function getFormattedAnggaranAttribute()
    {
        if ($this->anggaran) {
            return 'Rp ' . number_format($this->anggaran, 0, ',', '.');
        }
        return '-';
    }
}