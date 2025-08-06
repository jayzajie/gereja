<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OigPengurus extends Model
{
    use HasFactory;

    protected $table = 'oig_pengurus';

    protected $fillable = [
        'organisasi',
        'nama_lengkap',
        'jabatan',
        'deskripsi',
        'foto',
        'no_telepon',
        'email',
        'periode_mulai',
        'periode_selesai',
        'is_active',
        'urutan'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'periode_mulai' => 'integer',
        'periode_selesai' => 'integer',
    ];

    /**
     * Scope untuk filter berdasarkan organisasi
     */
    public function scopeByOrganisasi($query, $organisasi)
    {
        return $query->where('organisasi', $organisasi);
    }

    /**
     * Scope untuk pengurus aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk periode tertentu
     */
    public function scopeByPeriode($query, $tahun)
    {
        return $query->where('periode_mulai', '<=', $tahun)
                    ->where('periode_selesai', '>=', $tahun);
    }

    /**
     * Scope untuk urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('id', 'asc');
    }

    /**
     * Get foto URL
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return asset('images/default-avatar.png');
    }
}