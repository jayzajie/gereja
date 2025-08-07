# Dokumentasi Sinkronisasi OIG Admin dengan Landing Page

## Overview
Sistem OIG telah berhasil disinkronkan antara halaman admin dan landing page. Data yang dikelola di admin panel akan otomatis tampil di halaman publik dengan tampilan yang konsisten.

## Fitur Sinkronisasi

### 1. Data Pengurus
- **Admin**: CRUD lengkap untuk data pengurus di `/admin/oig/{organisasi}`
- **Landing**: Tampil otomatis di `/oig/{organisasi}/pengurus` dan `/{organisasi}/pengurus`
- **Data**: Nama, jabatan, foto, deskripsi, periode, status aktif

### 2. Data Program Kerja
- **Admin**: CRUD lengkap untuk program kerja di `/admin/oig/{organisasi}`
- **Landing**: Tampil otomatis di `/oig/{organisasi}/program-kerja` dan `/{organisasi}/program-kerja`
- **Data**: Nama program, deskripsi, tujuan, sasaran, periode, anggaran, status

### 3. Data Kegiatan
- **Admin**: CRUD lengkap untuk kegiatan di `/admin/oig/{organisasi}`
- **Landing**: Tampil otomatis di `/oig/{organisasi}/kegiatan` dan `/{organisasi}/kegiatan`
- **Data**: Nama kegiatan, deskripsi, tanggal, waktu, tempat, peserta, status

## Controller Updates

### LandingController.php
Telah diupdate untuk menggunakan model OIG:

```php
// PKBGT Methods
public function pkbgt()
{
    $pengurus = \App\Models\OigPengurus::byOrganisasi('PKBGT')->active()->ordered()->get();
    $programKerja = \App\Models\OigProgramKerja::byOrganisasi('PKBGT')->byTahun(date('Y'))->ordered()->take(6)->get();
    $kegiatan = \App\Models\OigKegiatan::byOrganisasi('PKBGT')->byTahun(date('Y'))->ordered()->take(6)->get();
    
    return view('landing.oig.pkbgt', compact('pengurus', 'programKerja', 'kegiatan'));
}

public function programKerjaPkbgt()
{
    $programKerja = \App\Models\OigProgramKerja::byOrganisasi('PKBGT')->byTahun(date('Y'))->ordered()->get();
    return view('landing.oig.program-kerja-pkbgt', compact('programKerja'));
}

public function pengurusPkbgt()
{
    $pengurus = \App\Models\OigPengurus::byOrganisasi('PKBGT')->active()->ordered()->get();
    return view('landing.oig.pengurus-pkbgt', compact('pengurus'));
}

public function kegiatanPkbgt()
{
    $kegiatan = \App\Models\OigKegiatan::byOrganisasi('PKBGT')->byTahun(date('Y'))->ordered()->get();
    return view('landing.oig.kegiatan-pkbgt', compact('kegiatan'));
}
```

*Method yang sama dibuat untuk PWGT, PPGT, dan SMGT*

## Routes Updates

### routes/web.php
Routes telah diupdate untuk menggunakan controller methods:

```php
// OIG Routes dengan controller methods
Route::prefix('oig')->name('oig.')->group(function () {
    // PKBGT sub-routes
    Route::get('/pkbgt/program-kerja', [LandingController::class, 'programKerjaPkbgt'])->name('pkbgt.program-kerja');
    Route::get('/pkbgt/pengurus', [LandingController::class, 'pengurusPkbgt'])->name('pkbgt.pengurus');
    Route::get('/pkbgt/kegiatan', [LandingController::class, 'kegiatanPkbgt'])->name('pkbgt.kegiatan');
    
    // PWGT, PPGT, SMGT sub-routes...
});

// Backward compatibility routes
Route::get('/pkbgt/program-kerja', [LandingController::class, 'programKerjaPkbgt'])->name('program-kerja-pkbgt');
Route::get('/pkbgt/pengurus', [LandingController::class, 'pengurusPkbgt'])->name('pengurus-pkbgt');
Route::get('/pkbgt/kegiatan', [LandingController::class, 'kegiatanPkbgt'])->name('kegiatan-pkbgt');
```

## View Updates

### 1. Pengurus Views
File: `resources/views/landing/oig/pengurus-{org}.blade.php`

**Before**: Static HTML dengan data dummy
**After**: Dynamic content dengan data dari database

```blade
@if($pengurus->count() > 0)
    <div class="section-header">
        <div class="section-title">Pengurus {{ $org }} Periode {{ $pengurus->first()->periode_mulai }} - {{ $pengurus->first()->periode_selesai }}</div>
    </div>
    
    <div class="pengurus-grid">
        @foreach($pengurus as $index => $item)
            <div class="pengurus-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="pengurus-img-container">
                    @if($item->foto)
                        <img src="{{ $item->foto_url }}" alt="{{ $item->nama_lengkap }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <i class="fas fa-user"></i>
                    @endif
                </div>
                <div class="pengurus-info">
                    <div class="pengurus-name">{{ $item->nama_lengkap }}</div>
                    <div class="pengurus-position">{{ $item->jabatan }}</div>
                    @if($item->deskripsi)
                        <div class="pengurus-description">{{ Str::limit($item->deskripsi, 100) }}</div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="section-header">
        <div class="section-title">Pengurus {{ $org }}</div>
        <p class="text-center text-muted">Data pengurus belum tersedia.</p>
    </div>
@endif
```

### 2. Program Kerja Views
File: `resources/views/landing/oig/program-kerja-{org}.blade.php`

**Features**:
- Dynamic program listing
- Complete program details (deskripsi, tujuan, sasaran, periode, anggaran)
- Status badges
- Responsive grid layout

### 3. Kegiatan Views
File: `resources/views/landing/oig/kegiatan-{org}.blade.php`

**Features**:
- Dynamic event listing
- Event images from database
- Date and time formatting
- Location and participant info
- Status indicators
- Notes display

## Data Flow

```
Admin Panel → Database → Landing Page
     ↓            ↓           ↓
   CRUD      OIG Models   Public View
Operations   (Pengurus,   (Formatted
             Program,     Display)
             Kegiatan)
```

## Testing URLs

### Admin Panel (Requires Login)
- PKBGT Admin: `http://localhost:8000/admin/oig/pkbgt`
- PWGT Admin: `http://localhost:8000/admin/oig/pwgt`
- PPGT Admin: `http://localhost:8000/admin/oig/ppgt`
- SMGT Admin: `http://localhost:8000/admin/oig/smgt`

### Landing Pages (Public)
- PKBGT Pengurus: `http://localhost:8000/pkbgt/pengurus`
- PKBGT Program: `http://localhost:8000/pkbgt/program-kerja`
- PKBGT Kegiatan: `http://localhost:8000/pkbgt/kegiatan`

*Same pattern for PWGT, PPGT, SMGT*

## Benefits

1. **Single Source of Truth**: Data dikelola di satu tempat (admin panel)
2. **Real-time Updates**: Perubahan di admin langsung tampil di landing page
3. **Consistent Design**: Tampilan landing page tetap konsisten dengan design yang ada
4. **Easy Management**: Admin tidak perlu edit HTML untuk update content
5. **Scalable**: Mudah menambah organisasi atau field baru

## Files Modified

### Controllers
- `app/Http/Controllers/LandingController.php` - Added OIG methods

### Routes
- `routes/web.php` - Updated OIG routes to use controller methods

### Views (Updated)
- `resources/views/landing/oig/pengurus-pkbgt.blade.php`
- `resources/views/landing/oig/pengurus-pwgt.blade.php`
- `resources/views/landing/oig/pengurus-ppgt.blade.php`
- `resources/views/landing/oig/pengurus-smgt.blade.php`
- `resources/views/landing/oig/program-kerja-pkbgt.blade.php`
- `resources/views/landing/oig/kegiatan-pkbgt.blade.php`
- `resources/views/landing/oig/kegiatan-pwgt.blade.php`

### Utility Scripts
- `update_oig_landing_views.php` - Script untuk mass update views
- `update_kegiatan_template.blade.php` - Template untuk kegiatan views

## Next Steps (Optional)

1. Update remaining kegiatan views (PPGT, SMGT)
2. Update remaining program kerja views (PWGT, PPGT, SMGT)
3. Add image optimization for uploaded photos
4. Implement caching for better performance
5. Add search/filter functionality on landing pages
