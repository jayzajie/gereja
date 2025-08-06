<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Information extends Model
{
    use HasFactory;

    protected $table = 'information';

    protected $fillable = [
        'title',
        'content',
        'image',
        'category',
        'subcategory',
        'status',
        'priority',
        'publish_date',
        'notes'
    ];

    protected $casts = [
        'publish_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Categories - Updated to include more flexible categories
    public static function getCategories()
    {
        return [
            'announcement' => 'Pengumuman',
            'pengumuman' => 'Pengumuman',
            'event' => 'Acara',
            'kegiatan' => 'Kegiatan',
            'news' => 'Berita',
            'berita' => 'Berita',
            'program' => 'Program',
            'program-kerja' => 'Program Kerja',
            'service' => 'Ibadah',
            'ibadah' => 'Ibadah',
            'ministry' => 'Pelayanan',
            'pelayanan' => 'Pelayanan',
            'warta' => 'Warta',
            'other' => 'Lainnya',
            'lainnya' => 'Lainnya'
        ];
    }

    // Subcategories - Updated to be more flexible
    public static function getSubcategories()
    {
        return [
            'urgent' => 'Mendesak',
            'mendesak' => 'Mendesak',
            'weekly' => 'Mingguan',
            'mingguan' => 'Mingguan',
            'monthly' => 'Bulanan',
            'bulanan' => 'Bulanan',
            'special' => 'Khusus',
            'khusus' => 'Khusus',
            'youth' => 'Pemuda',
            'pemuda' => 'Pemuda',
            'children' => 'Anak-anak',
            'anak-anak' => 'Anak-anak',
            'adult' => 'Dewasa',
            'dewasa' => 'Dewasa',
            'elderly' => 'Lansia',
            'lansia' => 'Lansia'
        ];
    }

    // Statuses
    public static function getStatuses()
    {
        return [
            'draft' => 'Draft',
            'published' => 'Dipublikasikan',
            'archived' => 'Diarsipkan'
        ];
    }

    // Priorities
    public static function getPriorities()
    {
        return [
            'low' => 'Rendah',
            'medium' => 'Sedang',
            'high' => 'Tinggi'
        ];
    }

    // Accessors
    public function getCategoryLabelAttribute()
    {
        $categories = self::getCategories();
        return $categories[$this->category] ?? $this->category;
    }

    public function getSubcategoryLabelAttribute()
    {
        $subcategories = self::getSubcategories();
        return $subcategories[$this->subcategory] ?? $this->subcategory;
    }

    public function getStatusLabelAttribute()
    {
        $statuses = self::getStatuses();
        return $statuses[$this->status] ?? $this->status;
    }

    public function getPriorityLabelAttribute()
    {
        $priorities = self::getPriorities();
        return $priorities[$this->priority] ?? $this->priority;
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%")
              ->orWhere('notes', 'like', "%{$search}%");
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderByRaw("CASE
                WHEN priority = 'high' THEN 3
                WHEN priority = 'medium' THEN 2
                WHEN priority = 'low' THEN 1
                ELSE 0 END DESC")
              ->orderBy('created_at', 'desc');
    }
}
