# Dokumentasi Fitur Admin OIG (Organisasi Intra Gereja)

## Overview
Fitur Admin OIG adalah sistem manajemen untuk mengelola 4 organisasi intra gereja:
- **PKBGT** - Persekutuan Kaum Bapak Gereja Toraja
- **PWGT** - Persekutuan Wanita Gereja Toraja  
- **PPGT** - Persekutuan Pemuda Gereja Toraja
- **SMGT** - Sekolah Minggu Gereja Toraja

## Fitur Utama

### 1. Manajemen Pengurus
Setiap organisasi dapat mengelola data pengurus dengan informasi:
- Nama Lengkap
- Jabatan
- Deskripsi
- Foto
- No. Telepon
- Email
- Periode Mulai & Selesai
- Status Aktif/Tidak Aktif
- Urutan

### 2. Manajemen Program Kerja
Setiap organisasi dapat mengelola program kerja dengan informasi:
- Nama Program
- Deskripsi
- Tujuan
- Sasaran
- Tanggal Mulai & Selesai
- Penanggung Jawab
- Anggaran
- Status (Draft, Aktif, Selesai, Dibatalkan)
- Gambar
- Tahun
- Urutan

### 3. Manajemen Kegiatan
Setiap organisasi dapat mengelola kegiatan dengan informasi:
- Nama Kegiatan
- Deskripsi
- Tanggal Kegiatan
- Waktu Mulai & Selesai
- Tempat
- Penanggung Jawab
- Jumlah Peserta
- Anggaran
- Status (Rencana, Berlangsung, Selesai, Dibatalkan)
- Gambar
- Catatan
- Tahun
- Urutan

## Struktur File

### Models
- `app/Models/OigPengurus.php` - Model untuk data pengurus
- `app/Models/OigProgramKerja.php` - Model untuk data program kerja
- `app/Models/OigKegiatan.php` - Model untuk data kegiatan

### Controllers
- `app/Http/Controllers/Admin/OigController.php` - Controller untuk semua operasi CRUD OIG

### Views
- `resources/views/admin/oig/pkbgt.blade.php` - Halaman admin PKBGT
- `resources/views/admin/oig/pwgt.blade.php` - Halaman admin PWGT
- `resources/views/admin/oig/ppgt.blade.php` - Halaman admin PPGT
- `resources/views/admin/oig/smgt.blade.php` - Halaman admin SMGT

### Migrations
- `database/migrations/2025_01_15_000001_create_oig_pengurus_table.php`
- `database/migrations/2025_01_15_000002_create_oig_program_kerja_table.php`
- `database/migrations/2025_01_15_000003_create_oig_kegiatan_table.php`

### Seeders
- `database/seeders/OigSeeder.php` - Sample data untuk testing

## Routes

### Admin Routes (Protected by Auth)
```php
Route::prefix('oig')->name('admin.oig.')->group(function () {
    // Main OIG Pages
    Route::get('/pkbgt', [OigController::class, 'pkbgt'])->name('pkbgt');
    Route::get('/pwgt', [OigController::class, 'pwgt'])->name('pwgt');
    Route::get('/ppgt', [OigController::class, 'ppgt'])->name('ppgt');
    Route::get('/smgt', [OigController::class, 'smgt'])->name('smgt');
    
    // Pengurus CRUD Routes
    Route::post('/pengurus', [OigController::class, 'storePengurus'])->name('pengurus.store');
    Route::put('/pengurus/{id}', [OigController::class, 'updatePengurus'])->name('pengurus.update');
    Route::delete('/pengurus/{id}', [OigController::class, 'deletePengurus'])->name('pengurus.delete');
    
    // Program Kerja CRUD Routes
    Route::post('/program-kerja', [OigController::class, 'storeProgramKerja'])->name('program-kerja.store');
    Route::put('/program-kerja/{id}', [OigController::class, 'updateProgramKerja'])->name('program-kerja.update');
    Route::delete('/program-kerja/{id}', [OigController::class, 'deleteProgramKerja'])->name('program-kerja.delete');
    
    // Kegiatan CRUD Routes
    Route::post('/kegiatan', [OigController::class, 'storeKegiatan'])->name('kegiatan.store');
    Route::put('/kegiatan/{id}', [OigController::class, 'updateKegiatan'])->name('kegiatan.update');
    Route::delete('/kegiatan/{id}', [OigController::class, 'deleteKegiatan'])->name('kegiatan.delete');
});
```

## Interface Design

### Layout
Setiap halaman OIG menggunakan layout dengan 3 tab:
1. **Tab Pengurus** - Manajemen data pengurus
2. **Tab Program Kerja** - Manajemen program kerja
3. **Tab Kegiatan** - Manajemen kegiatan

### Komponen
- **Form Input** (Kolom kiri) - Form untuk menambah data baru
- **Data Table** (Kolom kanan) - Tabel untuk menampilkan dan mengelola data existing
- **Action Buttons** - Edit dan Delete untuk setiap record

## Validasi

### Pengurus
- Nama lengkap: required, string, max 255
- Jabatan: required, string, max 255
- Foto: optional, image (jpeg,png,jpg), max 2MB
- Email: optional, valid email format
- Periode: required, integer, range 2020-2030

### Program Kerja
- Nama program: required, string, max 255
- Deskripsi: required, string
- Tanggal selesai: harus setelah atau sama dengan tanggal mulai
- Anggaran: optional, numeric, min 0
- Status: required, enum (draft,aktif,selesai,dibatalkan)

### Kegiatan
- Nama kegiatan: required, string, max 255
- Deskripsi: required, string
- Tanggal kegiatan: required, valid date
- Waktu selesai: harus setelah waktu mulai
- Status: required, enum (rencana,berlangsung,selesai,dibatalkan)

## File Upload
- Foto pengurus disimpan di: `storage/app/public/oig/pengurus/`
- Gambar program kerja disimpan di: `storage/app/public/oig/program-kerja/`
- Gambar kegiatan disimpan di: `storage/app/public/oig/kegiatan/`

## Testing

### Sample Data
Jalankan seeder untuk membuat sample data:
```bash
php artisan db:seed --class=OigSeeder
```

### User Admin
Buat user admin untuk testing:
```php
User::create([
    'name' => 'Admin',
    'email' => 'admin@test.com',
    'password' => Hash::make('password'),
    'role' => 'admin'
]);
```

### URL Testing
- PKBGT: `http://localhost:8000/admin/oig/pkbgt`
- PWGT: `http://localhost:8000/admin/oig/pwgt`
- PPGT: `http://localhost:8000/admin/oig/ppgt`
- SMGT: `http://localhost:8000/admin/oig/smgt`

## Features Implemented ✅

1. ✅ Complete CRUD operations for all 3 entities (Pengurus, Program Kerja, Kegiatan)
2. ✅ Separate pages for each organization (PKBGT, PWGT, PPGT, SMGT)
3. ✅ Tabbed interface for better UX
4. ✅ File upload functionality for photos/images
5. ✅ Form validation
6. ✅ Responsive design
7. ✅ Sample data seeder
8. ✅ Proper route organization
9. ✅ Authentication protection
10. ✅ Database relationships and scopes

## Next Steps (Optional Enhancements)

1. Add edit modal functionality
2. Implement export to Excel feature
3. Add search and filter functionality
4. Implement pagination for large datasets
5. Add image preview and cropping
6. Create public-facing pages for each organization
7. Add email notifications for new activities
8. Implement approval workflow for programs
