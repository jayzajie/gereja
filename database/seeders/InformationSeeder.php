<?php

namespace Database\Seeders;

use App\Models\Information;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $informations = [
            [
                'title' => 'Pengumuman Ibadah Minggu',
                'content' => 'Ibadah Minggu akan dilaksanakan pada hari Minggu, 14 Juli 2025 pukul 09.00 WITA. Semua jemaat diharapkan hadir tepat waktu. Tema ibadah: "Kasih yang Sejati".',
                'category' => 'announcement',
                'subcategory' => 'weekly',
                'publish_date' => '2025-07-08',
                'status' => 'published',
                'priority' => 'high',
                'notes' => 'Pengumuman penting untuk jemaat.',
            ],
            [
                'title' => 'Kegiatan Retreat Pemuda',
                'content' => 'Kegiatan retreat pemuda akan dilaksanakan selama 3 hari 2 malam di Pantai Melawai. Kegiatan ini bertujuan untuk mempererat persaudaraan antar pemuda gereja dan memperdalam iman.',
                'category' => 'event',
                'subcategory' => 'youth',
                'publish_date' => '2025-07-08',
                'status' => 'published',
                'priority' => 'high',
                'notes' => 'Kegiatan khusus untuk pemuda gereja.',
            ],
            [
                'title' => 'Warta Jemaat Bulan Juli 2025',
                'content' => 'Warta jemaat bulan Juli 2025 telah tersedia. Berisi informasi kegiatan gereja, renungan harian, dan doa syafaat untuk jemaat yang membutuhkan.',
                'category' => 'news',
                'subcategory' => 'monthly',
                'publish_date' => '2025-07-01',
                'status' => 'published',
                'priority' => 'medium',
                'notes' => 'Warta bulanan untuk jemaat.',
            ],
            [
                'title' => 'Program Kerja Tahun 2025',
                'content' => 'Program kerja gereja tahun 2025 telah disusun dan disahkan dalam rapat majelis. Program ini mencakup kegiatan ibadah, pelayanan sosial, dan pengembangan jemaat.',
                'category' => 'program',
                'subcategory' => 'special',
                'publish_date' => '2025-01-01',
                'status' => 'published',
                'priority' => 'medium',
                'notes' => 'Program kerja tahunan gereja.',
            ],
            [
                'title' => 'Draft: Rencana Pembangunan Gedung Baru',
                'content' => 'Rencana pembangunan gedung baru untuk ruang serbaguna sedang dalam tahap perencanaan. Diharapkan dapat dimulai pada tahun 2026.',
                'category' => 'announcement',
                'subcategory' => 'special',
                'publish_date' => '2025-07-08',
                'status' => 'draft',
                'priority' => 'low',
                'notes' => 'Masih dalam tahap perencanaan.',
            ],
        ];

        foreach ($informations as $info) {
            Information::create($info);
        }
    }
}
