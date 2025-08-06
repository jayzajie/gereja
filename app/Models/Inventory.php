<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'kategori',
        'deskripsi',
        'jumlah',
        'harga_satuan',
        'total_nilai',
        'satuan',
        'lokasi',
        'tanggal_masuk',
        'tanggal_kadaluarsa',
        'status',
        'supplier',
        'catatan',
    ];

    protected $casts = [
        'jumlah' => 'integer',
        'harga_satuan' => 'decimal:2',
        'total_nilai' => 'decimal:2',
        'tanggal_masuk' => 'date',
        'tanggal_kadaluarsa' => 'date',
    ];

    // Automatically calculate total_nilai when saving
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($inventory) {
            $inventory->total_nilai = $inventory->jumlah * $inventory->harga_satuan;
        });
    }

    // Accessor untuk format harga
    public function getFormattedHargaSatuanAttribute()
    {
        return 'Rp ' . number_format($this->harga_satuan, 0, ',', '.');
    }

    public function getFormattedTotalNilaiAttribute()
    {
        return 'Rp ' . number_format($this->total_nilai, 0, ',', '.');
    }

    // Scope untuk filter berdasarkan status
    public function scopeTersedia($query)
    {
        return $query->where('status', 'tersedia');
    }

    public function scopeHabis($query)
    {
        return $query->where('status', 'habis');
    }

    public function scopeRusak($query)
    {
        return $query->where('status', 'rusak');
    }

    // Scope untuk filter berdasarkan kategori
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Check if item is expired
    public function getIsExpiredAttribute()
    {
        if (!$this->tanggal_kadaluarsa) {
            return false;
        }
        return $this->tanggal_kadaluarsa->isPast();
    }

    // Get status badge color
    public function getStatusBadgeColorAttribute()
    {
        return match($this->status) {
            'tersedia' => 'success',
            'habis' => 'warning',
            'rusak' => 'danger',
            default => 'secondary'
        };
    }
}
