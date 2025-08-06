<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use App\Models\Pastor;
use App\Models\Congregation;
use App\Models\Marriage;
use App\Models\ChurchProfile;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin users
        $this->call(AdminUserSeeder::class);

        // Create sample pastors using seeder
        $this->call(PastorSeeder::class);

        // Create sample congregations
        Congregation::create([
            'name' => 'Jemaat Eben-Haezer Selili',
            'address' => 'Desa Selili, Kec. Toraja Utara',
            'phone' => '081234567892',
            'email' => 'selili@gereja-toraja.com',
            'pastor_id' => 1,
            'status' => 'active',
        ]);

        // Create sample members
        $memberNames = [
            'Andreas Toraja', 'Maria Sari', 'Petrus Lando', 'Ruth Sari',
            'Daniel Toraja', 'Esther Lando', 'Samuel Sari', 'Debora Toraja',
            'David Lando', 'Miriam Sari', 'Yosua Toraja', 'Hana Lando',
            'Gideon Sari', 'Lydia Toraja', 'Barnabas Lando', 'Priskila Sari'
        ];

        $previousChurches = [
            'GPIB Jakarta', 'HKBP Medan', 'GKI Surabaya', 'GMIT Kupang',
            'Gereja Toraja Makassar', 'GPIB Bandung', 'GKJ Yogyakarta', 'HKBP Batam'
        ];

        $addresses = [
            'Jl. Merdeka No. 10', 'Jl. Sudirman No. 25', 'Jl. Diponegoro No. 15',
            'Jl. Ahmad Yani No. 30', 'Jl. Gatot Subroto No. 5', 'Jl. Veteran No. 20',
            'Jl. Pahlawan No. 12', 'Jl. Kemerdekaan No. 8'
        ];

        $parentNames = [
            'Bapak Yohanes & Ibu Maria', 'Bapak Petrus & Ibu Ruth', 'Bapak Daniel & Ibu Esther',
            'Bapak Samuel & Ibu Debora', 'Bapak David & Ibu Miriam', 'Bapak Yosua & Ibu Hana',
            'Bapak Gideon & Ibu Lydia', 'Bapak Barnabas & Ibu Priskila'
        ];

        foreach ($memberNames as $index => $name) {
            Member::create([
                'nama_lengkap' => $name,
                'nama_jemaat_sebelumnya' => $previousChurches[$index % count($previousChurches)],
                'tempat_tinggal' => $addresses[$index % count($addresses)],
                'nama_orang_tua' => $parentNames[$index % count($parentNames)],
                'tanggal_lahir' => fake()->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
                'no_hp' => '0812' . str_pad($index + 1, 8, '0', STR_PAD_LEFT),
                'status' => ['pending', 'approved', 'rejected'][array_rand(['pending', 'approved', 'rejected'])],
            ]);
        }

        // Create sample marriages
        Marriage::create([
            'nama_calon_pria' => 'Andreas Toraja',
            'tanggal_lahir_pria' => '1990-05-15',
            'tempat_lahir_pria' => 'Toraja',
            'alamat_pria' => 'Jl. Merdeka No. 10',
            'pekerjaan_pria' => 'Guru',
            'no_telepon_pria' => '081234567890',
            'email_pria' => 'andreas@email.com',
            'nama_ayah_pria' => 'Yohanes Toraja',
            'nama_ibu_pria' => 'Maria Sari',
            'nama_calon_wanita' => 'Ruth Lando',
            'tanggal_lahir_wanita' => '1992-08-20',
            'tempat_lahir_wanita' => 'Toraja',
            'alamat_wanita' => 'Jl. Sudirman No. 25',
            'pekerjaan_wanita' => 'Perawat',
            'no_telepon_wanita' => '081234567891',
            'email_wanita' => 'ruth@email.com',
            'nama_ayah_wanita' => 'Petrus Lando',
            'nama_ibu_wanita' => 'Esther Sari',
            'tanggal_pernikahan' => '2024-12-25',
            'tempat_pernikahan' => 'Gereja Toraja Eben-Haezer Selili',
            'saksi' => 'Pdt. John Toraja, Daniel Toraja',
            'status' => 'pending',
        ]);

        // Create sample church profile
        ChurchProfile::create([
            'name' => 'Gereja Toraja Jemaat Eben-Haezer Selili',
            'description' => 'Gereja Toraja yang melayani jemaat di wilayah Selili dengan kasih dan dedikasi tinggi.',
            'history' => 'Gereja Toraja Jemaat Eben-Haezer Selili didirikan pada tahun 1965 oleh sekelompok umat Kristen Toraja yang berkomitmen untuk menyebarkan Injil di wilayah Selili. Nama "Eben-Haezer" yang berarti "Batu Penolong" dipilih sebagai pengingat akan pertolongan Tuhan yang selalu menyertai perjalanan gereja ini.

Dalam perjalanan sejarahnya, gereja ini telah mengalami berbagai tantangan dan berkat. Dimulai dari sebuah rumah sederhana, kini gereja telah memiliki gedung yang megah dan melayani ratusan jemaat. Gereja ini juga aktif dalam berbagai kegiatan sosial dan pendidikan di masyarakat sekitar.',
            'vision' => 'Menjadi gereja yang beriman, berharap, dan berkarya dalam kasih Kristus untuk kemuliaan Allah dan kesejahteraan sesama.',
            'mission' => 'Melaksanakan Amanat Agung Tuhan Yesus melalui:
1. Pemberitaan Firman Allah yang transformatif
2. Pelayanan kasih yang holistik kepada jemaat dan masyarakat
3. Pembinaan iman yang berkelanjutan
4. Persekutuan yang erat dalam kasih Kristus
5. Pelestarian budaya Toraja yang selaras dengan nilai-nilai Kristiani',
            'values' => 'KASIH - Mengasihi Allah dan sesama dengan tulus
IMAN - Beriman kepada Yesus Kristus sebagai Tuhan dan Juruselamat
HARAPAN - Memiliki pengharapan yang teguh dalam Kristus
PELAYANAN - Melayani dengan hati yang rela dan sukacita
PERSATUAN - Hidup dalam persatuan dan kesatuan sebagai tubuh Kristus',
            'address' => 'Desa Selili, Kecamatan Toraja Utara, Kabupaten Toraja Utara, Sulawesi Selatan',
            'phone' => '0423-21234',
            'email' => 'info@gereja-eben-haezer-selili.org',
            'website' => 'https://gereja-eben-haezer-selili.org',
            'established_year' => '1965',
            'organizational_structure' => [
                'Majelis Jemaat' => [
                    'Ketua' => 'Pdt. John Toraja',
                    'Wakil Ketua' => 'Pnt. Daniel Sari',
                    'Sekretaris' => 'Pnt. Maria Lando',
                    'Bendahara' => 'Pnt. Petrus Toraja'
                ],
                'Komisi-komisi' => [
                    'Komisi Liturgi' => 'Pnt. Ruth Sari',
                    'Komisi Diakonia' => 'Pnt. Samuel Lando',
                    'Komisi Pendidikan' => 'Pnt. Esther Toraja',
                    'Komisi Pemuda' => 'Pnt. David Sari'
                ]
            ],
            'facilities' => [
                'Gedung Gereja Utama (kapasitas 500 orang)',
                'Ruang Serbaguna',
                'Ruang Kelas Sekolah Minggu',
                'Ruang Konseling',
                'Dapur Umum',
                'Parkir Luas',
                'Sound System Modern',
                'Proyektor dan Layar'
            ],
            'programs' => [
                'Ibadah Minggu' => 'Setiap Minggu pukul 08.00 dan 17.00 WITA',
                'Sekolah Minggu' => 'Setiap Minggu pukul 08.00 WITA',
                'Ibadah Pemuda' => 'Setiap Sabtu pukul 19.00 WITA',
                'Persekutuan Doa' => 'Setiap Rabu pukul 19.00 WITA',
                'Kelas Katekisasi' => 'Setiap bulan untuk calon anggota',
                'Pelayanan Sosial' => 'Program bantuan untuk masyarakat kurang mampu',
                'Kursus Musik Gereja' => 'Pelatihan musik untuk pelayanan ibadah'
            ],
            'social_media' => [
                'facebook' => 'https://facebook.com/gereja.eben.haezer.selili',
                'instagram' => 'https://instagram.com/gereja_eben_haezer_selili',
                'youtube' => 'https://youtube.com/c/GerejaEbenHaezerSelili',
                'whatsapp' => '081234567890'
            ],
            'is_active' => true,
            'sort_order' => 1,
        ]);
    }
}
