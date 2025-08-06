# Dokumentasi Navbar Layout

## Overview
Navbar layout telah berhasil diimplementasikan untuk semua halaman landing website Gereja Toraja Eben-Haezer Selili. Sekarang semua halaman menggunakan layout yang konsisten dan mudah dikelola.

## Struktur Layout

### File Layout Utama
- **File**: `resources/views/layouts/landing.blade.php`
- **Fungsi**: Layout utama yang berisi navbar, floating shapes, footer, dan script yang diperlukan

### Komponen Layout
1. **Navbar**: Navbar dengan dropdown menu yang konsisten
2. **Floating Shapes**: Elemen dekoratif background
3. **Footer**: Footer yang sama untuk semua halaman
4. **Scripts**: AOS animation dan landing.js

## Cara Penggunaan

### Untuk Halaman Baru
Untuk membuat halaman landing baru, gunakan struktur berikut:

```blade
@extends('layouts.landing')

@section('title', 'Judul Halaman - Gereja Toraja Eben-Haezer Selili')

@push('styles')
<style>
    /* CSS khusus untuk halaman ini */
</style>
@endpush

@section('content')
    <!-- Konten halaman di sini -->
@endsection

@push('scripts')
<script>
    // JavaScript khusus untuk halaman ini
</script>
@endpush
```

### Untuk Mengedit Navbar
Untuk mengubah navbar, edit file `resources/views/layouts/landing.blade.php` pada bagian navbar. Perubahan akan otomatis berlaku untuk semua halaman.

## Halaman yang Sudah Dikonversi

### Halaman Utama
- `resources/views/landing/index.blade.php`

### Halaman Informasi
- `resources/views/landing/informasi/pendeta-jemaat.blade.php`
- `resources/views/landing/informasi/kegiatan-jemaat.blade.php`
- `resources/views/landing/informasi/program-kerja.blade.php`
- `resources/views/landing/informasi/warta-jemaat.blade.php`

### Halaman Contact
- `resources/views/landing/contact/daftar-anggota.blade.php`
- `resources/views/landing/contact/pengelolaan-baptis.blade.php`
- `resources/views/landing/contact/pengelolaan-surat-nikah.blade.php`
- `resources/views/landing/contact/saran.blade.php`

### Halaman OIG
- `resources/views/landing/oig/pkbgt.blade.php` ✅ (Baru dikonversi)
- `resources/views/landing/oig/pwgt.blade.php` ✅ (Baru dikonversi)
- `resources/views/landing/oig/ppgt.blade.php` ✅ (Baru dikonversi)
- `resources/views/landing/oig/smgt.blade.php` ✅ (Baru dikonversi)
- `resources/views/landing/oig/pengurus-pkbgt.blade.php`
- `resources/views/landing/oig/pengurus-ppgt.blade.php`
- `resources/views/landing/oig/pengurus-pwgt.blade.php`
- `resources/views/landing/oig/pengurus-smgt.blade.php`
- `resources/views/landing/oig/program-kerja-pkbgt.blade.php`
- `resources/views/landing/oig/program-kerja-ppgt.blade.php`
- `resources/views/landing/oig/program-kerja-pwgt.blade.php`
- `resources/views/landing/oig/program-kerja-smgt.blade.php`
- `resources/views/landing/oig/kegiatan-pkbgt.blade.php`
- `resources/views/landing/oig/kegiatan-ppgt.blade.php`
- `resources/views/landing/oig/kegiatan-pwgt.blade.php`
- `resources/views/landing/oig/kegiatan-smgt.blade.php`

### Halaman Profil Gereja
- `resources/views/profil-gereja/anggota-jemaat.blade.php` ✅ (Baru dikonversi)
- `resources/views/sejarah/profiles.blade.php` ✅ (Baru dikonversi)

### Halaman Test
- `resources/views/landing/test.blade.php` ✅ (Baru dikonversi)

## Keuntungan Layout Baru

### 1. Konsistensi
- Semua halaman memiliki navbar yang sama persis
- Tidak ada perbedaan tampilan antar halaman
- Mudah untuk maintenance

### 2. Efisiensi
- Tidak perlu copy-paste navbar di setiap halaman
- Perubahan navbar cukup dilakukan di satu tempat
- Mengurangi duplikasi kode

### 3. Maintainability
- Mudah untuk menambah atau mengubah menu
- Mudah untuk mengubah styling navbar
- Mudah untuk menambah halaman baru

### 4. Performance
- CSS dan JavaScript dimuat sekali untuk semua halaman
- Mengurangi ukuran file individual

## Struktur Navbar

### Menu Utama
1. **Profil Gereja**
   - Sejarah Gereja
   - Anggota Jemaat

2. **OIG** (Organisasi Intra Gereja)
   - PKBGT (Pengurus, Program Kerja, Kegiatan)
   - PWGT (Pengurus, Program Kerja, Kegiatan)
   - PPGT (Pengurus, Program Kerja, Kegiatan)
   - SMGT (Pengurus, Program Kerja, Kegiatan)

3. **Informasi**
   - Pendeta Jemaat
   - Kegiatan Jemaat
   - Warta Jemaat
   - Program Kerja

4. **Contact**
   - Pengelolaan Surat Nikah
   - Pengelolaan Baptis
   - Daftar Anggota
   - Saran

## CSS dan JavaScript

### CSS
- File utama: `public/css/landing.css`
- Navbar menggunakan margin-left: 90px untuk positioning yang optimal

### JavaScript
- File utama: `public/js/landing.js`
- AOS animation library untuk animasi
- Dropdown functionality

## Responsive Design
Navbar sudah responsive dan akan menyesuaikan dengan ukuran layar yang berbeda menggunakan hamburger menu untuk mobile.

## Troubleshooting

### Jika Navbar Tidak Muncul
1. Pastikan file `resources/views/layouts/landing.blade.php` ada
2. Pastikan halaman menggunakan `@extends('layouts.landing')`
3. Pastikan CSS file `public/css/landing.css` dapat diakses

### Jika Dropdown Tidak Berfungsi
1. Pastikan JavaScript file `public/js/landing.js` dimuat
2. Periksa console browser untuk error JavaScript

### Jika Styling Tidak Sesuai
1. Periksa apakah ada CSS konflik di halaman tertentu
2. Pastikan CSS khusus halaman menggunakan `@push('styles')`

## Update Terakhir
- Tanggal: 2025-08-01
- Navbar positioning: margin-left 90px (disesuaikan dari 80px)
- Semua halaman landing telah dikonversi ke layout baru
- Layout 100% konsisten dengan halaman utama
- **Update terbaru**: Konversi halaman OIG utama (PKBGT, PWGT, PPGT, SMGT), Anggota Jemaat, dan Profil Gereja ke layout baru
