<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChurchProfile;

class ChurchHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sejarah Gereja Toraja (Umum)
        ChurchProfile::create([
            'description' => 'Gereja Toraja adalah salah satu gereja yang memiliki sejarah panjang dalam penyebaran Injil di tanah Toraja. Didirikan pada awal abad ke-20, gereja ini telah menjadi pusat kehidupan rohani masyarakat Toraja. Dengan tradisi yang kaya dan budaya yang unik, Gereja Toraja menggabungkan nilai-nilai Kristiani dengan kearifan lokal Toraja.

Perjalanan sejarah Gereja Toraja dimulai ketika para misionaris pertama kali tiba di tanah Toraja dan mulai memberitakan Injil kepada masyarakat setempat. Melalui dedikasi dan kerja keras para pendahulu, gereja ini berkembang menjadi institusi yang tidak hanya melayani kebutuhan rohani, tetapi juga berperan aktif dalam pembangunan masyarakat Toraja.

Hingga saat ini, Gereja Toraja terus berkomitmen untuk melayani umat dan masyarakat dengan semangat kasih Kristus, sambil tetap menghargai dan melestarikan budaya Toraja yang adiluhung.',
            'is_active' => true,
        ]);

        // Sejarah Gereja Toraja Jemaat Eben-Haezer Selili
        ChurchProfile::create([
            'description' => 'Gereja Toraja Jemaat Eben-Haezer Selili adalah salah satu jemaat yang berada di bawah naungan Gereja Toraja. Berlokasi di daerah Selili, jemaat ini memiliki sejarah yang erat dengan perkembangan Kekristenan di wilayah tersebut.

Nama "Eben-Haezer" yang berarti "Batu Penolong" diambil dari 1 Samuel 7:12, melambangkan keyakinan jemaat bahwa Tuhan adalah penolong dan pelindung mereka. Jemaat ini didirikan dengan visi untuk menjadi terang dan garam bagi masyarakat Selili dan sekitarnya.

Sepanjang perjalanannya, Jemaat Eben-Haezer Selili telah mengalami berbagai tantangan dan berkat. Dengan dukungan dari para pendeta, majelis, dan seluruh anggota jemaat, gereja ini terus bertumbuh dalam iman dan pelayanan. Berbagai program pelayanan telah dilaksanakan, mulai dari pelayanan ibadah, pembinaan anak dan remaja, hingga pelayanan sosial kemasyarakatan.

Saat ini, Jemaat Eben-Haezer Selili terus berkomitmen untuk menjadi gereja yang hidup dan berkarya, melayani Tuhan dan sesama dengan penuh kasih dan dedikasi.',
            'is_active' => true,
        ]);
    }
}
