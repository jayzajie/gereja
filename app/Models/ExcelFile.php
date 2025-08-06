<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ExcelFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_name',
        'file_path',
        'file_size',
        'mime_type',
        'description',
        'category',
        'uploaded_at',
    ];

    protected $casts = [
        'uploaded_at' => 'datetime',
    ];

    // Accessor untuk mendapatkan ukuran file dalam format yang mudah dibaca
    public function getFormattedFileSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    // Accessor untuk mendapatkan URL download
    public function getDownloadUrlAttribute()
    {
        return route('excel-files.download', $this->id);
    }

    // Accessor untuk cek apakah file masih ada di storage
    public function getFileExistsAttribute()
    {
        return Storage::disk('public')->exists($this->file_path);
    }

    // Method untuk menghapus file dari storage
    public function deleteFile()
    {
        if ($this->file_exists) {
            Storage::disk('public')->delete($this->file_path);
        }
    }

    // Scope untuk file terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('uploaded_at', 'desc');
    }
}
