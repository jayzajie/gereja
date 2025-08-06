<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OigKegiatan extends Model
{
    use HasFactory;

    protected $table = 'oig_kegiatan';

    protected $fillable = [
        'organisasi',
        'nama_kegiatan',
        'deskripsi',
        'tanggal_kegiatan',
        'waktu_mulai',
        'waktu_selesai',
        'tempat',
        'penanggung_jawab',
        'jumlah_peserta',
        'anggaran',
        'status',
        'gambar',
        'catatan',
        'tahun',
        'urutan'
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'waktu_mulai' => 'datetime:H:i',
        'waktu_selesai' => 'datetime:H:i',
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
     * Scope untuk kegiatan yang akan datang
     */
    public function scopeUpcoming($query)
    {
        return $query->where('tanggal_kegiatan', '>=', now()->toDateString())
                    ->where('status', '!=', 'dibatalkan');
    }

    /**
     * Scope untuk urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('tanggal_kegiatan', 'desc');
    }

    /**
     * Get gambar URL
     */
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return asset('images/default-kegiatan.png');
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

    /**
     * Get formatted tanggal kegiatan
     */
    public function getFormattedTanggalAttribute()
    {
        return $this->tanggal_kegiatan->format('d F Y');
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'rencana' => 'badge-warning',
            'berlangsung' => 'badge-info',
            'selesai' => 'badge-success',
            'dibatalkan' => 'badge-danger',
            default => 'badge-secondary'
        };
    }
}