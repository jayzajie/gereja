<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SejarahJemaat extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'logo',
        'banner_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope untuk data aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Accessor untuk logo URL
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }

    // Accessor untuk banner image URL
    public function getBannerImageUrlAttribute()
    {
        return $this->banner_image ? asset('storage/' . $this->banner_image) : null;
    }
}
