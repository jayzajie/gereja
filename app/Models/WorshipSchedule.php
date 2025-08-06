<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorshipSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'time',
        'day',
        'icon',
        'description',
        'special_notes',
        'target_audience',
        'duration',
        'is_featured',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'time' => 'datetime:H:i',
        'special_notes' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'duration' => 'integer',
        'sort_order' => 'integer'
    ];

    /**
     * Scope untuk jadwal yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk mengurutkan berdasarkan sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('time');
    }

    /**
     * Accessor untuk format waktu yang mudah dibaca
     */
    public function getFormattedTimeAttribute()
    {
        return $this->time ? $this->time->format('H:i') : '';
    }

    /**
     * Accessor untuk mendapatkan periode (WITA)
     */
    public function getPeriodAttribute()
    {
        return 'WITA';
    }
}