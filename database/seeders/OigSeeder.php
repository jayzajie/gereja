<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OigPengurus;
use App\Models\OigProgramKerja;
use App\Models\OigKegiatan;

class OigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample data untuk PKBGT
        OigPengurus::create([
            'organisasi' => 'PKBGT',
            'nama_lengkap' => 'Bapak Andreas Toding',
            'jabatan' => 'Ketua',
            'deskripsi' => 'Ketua PKBGT periode 2024-2025',
            'no_telepon' => '0812-3456-7890',
            'email' => 'andreas.toding@email.com',
            'periode_mulai' => 2024,
            'periode_selesai' => 2025,
            'is_active' => true,
            'urutan' => 1
        ]);

        OigPengurus::create([
            'organisasi' => 'PKBGT',
            'nama_lengkap' => 'Bapak Paulus Rante',
            'jabatan' => 'Wakil Ketua',
            'deskripsi' => 'Wakil Ketua PKBGT periode 2024-2025',
            'no_telepon' => '0813-4567-8901',
            'email' => 'paulus.rante@email.com',
            'periode_mulai' => 2024,
            'periode_selesai' => 2025,
            'is_active' => true,
            'urutan' => 2
        ]);

        // Sample data untuk PWGT
        OigPengurus::create([
            'organisasi' => 'PWGT',
            'nama_lengkap' => 'Ibu Maria Sari',
            'jabatan' => 'Ketua',
            'deskripsi' => 'Ketua PWGT periode 2024-2025',
            'no_telepon' => '0814-5678-9012',
            'email' => 'maria.sari@email.com',
            'periode_mulai' => 2024,
            'periode_selesai' => 2025,
            'is_active' => true,
            'urutan' => 1
        ]);

        // Sample data untuk PPGT
        OigPengurus::create([
            'organisasi' => 'PPGT',
            'nama_lengkap' => 'Yosef Manurung',
            'jabatan' => 'Ketua',
            'deskripsi' => 'Ketua PPGT periode 2024-2025',
            'no_telepon' => '0815-6789-0123',
            'email' => 'yosef.manurung@email.com',
            'periode_mulai' => 2024,
            'periode_selesai' => 2025,
            'is_active' => true,
            'urutan' => 1
        ]);

        // Sample data untuk SMGT
        OigPengurus::create([
            'organisasi' => 'SMGT',
            'nama_lengkap' => 'Ibu Ruth Simbolon',
            'jabatan' => 'Koordinator',
            'deskripsi' => 'Koordinator SMGT periode 2024-2025',
            'no_telepon' => '0816-7890-1234',
            'email' => 'ruth.simbolon@email.com',
            'periode_mulai' => 2024,
            'periode_selesai' => 2025,
            'is_active' => true,
            'urutan' => 1
        ]);

        // Sample Program Kerja
        OigProgramKerja::create([
            'organisasi' => 'PKBGT',
            'nama_program' => 'Pembinaan Rohani Bapak-Bapak',
            'deskripsi' => 'Program pembinaan rohani untuk meningkatkan iman dan ketakwaan bapak-bapak jemaat',
            'tujuan' => 'Meningkatkan kualitas spiritual bapak-bapak jemaat',
            'sasaran' => 'Seluruh bapak-bapak anggota PKBGT',
            'tanggal_mulai' => '2024-01-01',
            'tanggal_selesai' => '2024-12-31',
            'penanggung_jawab' => 'Bapak Andreas Toding',
            'anggaran' => 5000000,
            'status' => 'aktif',
            'tahun' => 2024,
            'urutan' => 1
        ]);

        OigProgramKerja::create([
            'organisasi' => 'PWGT',
            'nama_program' => 'Pelatihan Keterampilan Ibu-Ibu',
            'deskripsi' => 'Program pelatihan keterampilan untuk meningkatkan kemampuan ibu-ibu dalam berbagai bidang',
            'tujuan' => 'Meningkatkan keterampilan dan kemandirian ibu-ibu jemaat',
            'sasaran' => 'Seluruh ibu-ibu anggota PWGT',
            'tanggal_mulai' => '2024-02-01',
            'tanggal_selesai' => '2024-11-30',
            'penanggung_jawab' => 'Ibu Maria Sari',
            'anggaran' => 3000000,
            'status' => 'aktif',
            'tahun' => 2024,
            'urutan' => 1
        ]);

        // Sample Program Kerja PPGT
        OigProgramKerja::create([
            'organisasi' => 'PPGT',
            'nama_program' => 'Pembinaan Karakter Pemuda',
            'deskripsi' => 'Program pembinaan karakter dan kepemimpinan untuk pemuda-pemudi gereja',
            'tujuan' => 'Membentuk karakter pemuda yang beriman dan bertanggung jawab',
            'sasaran' => 'Pemuda-pemudi usia 17-30 tahun',
            'tanggal_mulai' => '2024-03-01',
            'tanggal_selesai' => '2024-12-31',
            'penanggung_jawab' => 'Yosef Manurung',
            'anggaran' => 4000000,
            'status' => 'aktif',
            'tahun' => 2024,
            'urutan' => 1
        ]);

        // Sample Program Kerja SMGT
        OigProgramKerja::create([
            'organisasi' => 'SMGT',
            'nama_program' => 'Pendidikan Karakter Anak',
            'deskripsi' => 'Program pendidikan karakter dan nilai-nilai kristiani untuk anak-anak sekolah minggu',
            'tujuan' => 'Menanamkan nilai-nilai kristiani sejak dini',
            'sasaran' => 'Anak-anak usia 4-12 tahun',
            'tanggal_mulai' => '2024-01-15',
            'tanggal_selesai' => '2024-12-15',
            'penanggung_jawab' => 'Ibu Ruth Simbolon',
            'anggaran' => 2500000,
            'status' => 'aktif',
            'tahun' => 2024,
            'urutan' => 1
        ]);

        // Sample Kegiatan
        OigKegiatan::create([
            'organisasi' => 'PKBGT',
            'nama_kegiatan' => 'Retreat Bapak-Bapak',
            'deskripsi' => 'Kegiatan retreat untuk memperdalam iman dan mempererat persaudaraan',
            'tanggal_kegiatan' => '2024-03-15',
            'waktu_mulai' => '08:00',
            'waktu_selesai' => '17:00',
            'tempat' => 'Wisma Retreat Toraja',
            'penanggung_jawab' => 'Bapak Andreas Toding',
            'jumlah_peserta' => 50,
            'anggaran' => 2000000,
            'status' => 'selesai',
            'catatan' => 'Kegiatan berjalan lancar dengan antusias peserta yang tinggi',
            'tahun' => 2024,
            'urutan' => 1
        ]);

        OigKegiatan::create([
            'organisasi' => 'PWGT',
            'nama_kegiatan' => 'Bakti Sosial Ibu-Ibu',
            'deskripsi' => 'Kegiatan bakti sosial untuk membantu masyarakat kurang mampu',
            'tanggal_kegiatan' => '2024-04-20',
            'waktu_mulai' => '09:00',
            'waktu_selesai' => '15:00',
            'tempat' => 'Desa Buntu Pune',
            'penanggung_jawab' => 'Ibu Maria Sari',
            'jumlah_peserta' => 30,
            'anggaran' => 1500000,
            'status' => 'selesai',
            'catatan' => 'Bantuan berupa sembako dan pakaian layak pakai',
            'tahun' => 2024,
            'urutan' => 1
        ]);

        OigKegiatan::create([
            'organisasi' => 'PPGT',
            'nama_kegiatan' => 'Seminar Kepemudaan',
            'deskripsi' => 'Seminar tentang peran pemuda dalam gereja dan masyarakat',
            'tanggal_kegiatan' => '2024-05-10',
            'waktu_mulai' => '13:00',
            'waktu_selesai' => '17:00',
            'tempat' => 'Aula Gereja',
            'penanggung_jawab' => 'Yosef Manurung',
            'jumlah_peserta' => 80,
            'anggaran' => 1000000,
            'status' => 'rencana',
            'catatan' => 'Mengundang pembicara dari luar daerah',
            'tahun' => 2024,
            'urutan' => 1
        ]);

        OigKegiatan::create([
            'organisasi' => 'SMGT',
            'nama_kegiatan' => 'Perkemahan Anak-Anak',
            'deskripsi' => 'Kegiatan perkemahan untuk anak-anak sekolah minggu',
            'tanggal_kegiatan' => '2024-06-15',
            'waktu_mulai' => '08:00',
            'waktu_selesai' => '16:00',
            'tempat' => 'Taman Wisata Batu Tumonga',
            'penanggung_jawab' => 'Ibu Ruth Simbolon',
            'jumlah_peserta' => 40,
            'anggaran' => 800000,
            'status' => 'rencana',
            'catatan' => 'Kegiatan outdoor untuk meningkatkan kebersamaan anak-anak',
            'tahun' => 2024,
            'urutan' => 1
        ]);
    }
}
