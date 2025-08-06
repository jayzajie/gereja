<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'nama_lengkap' => 'Jane Doe',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1992-05-20',
                'tempat_lahir' => 'Toraja',
                'alamat' => 'Jl. Gereja No. 1, Toraja',
                'no_hp' => '081234567891',
                'email' => 'jane@example.com',
                'pekerjaan' => 'Perawat',
                'status_pernikahan' => 'Menikah',
                'nama_ayah' => 'Bapak Jane',
                'nama_ibu' => 'Ibu Jane',
                'nama_pasangan' => 'John Doe',
                'status' => 'active'
            ],
            [
                'nama_lengkap' => 'Michael Smith',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1985-08-10',
                'tempat_lahir' => 'Toraja',
                'alamat' => 'Jl. Damai No. 5, Toraja',
                'no_hp' => '081234567892',
                'email' => 'michael@example.com',
                'pekerjaan' => 'Petani',
                'status_pernikahan' => 'Belum Menikah',
                'nama_ayah' => 'Bapak Michael',
                'nama_ibu' => 'Ibu Michael',
                'status' => 'active'
            ],
            [
                'nama_lengkap' => 'Sarah Johnson',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1988-12-03',
                'tempat_lahir' => 'Toraja',
                'alamat' => 'Jl. Sejahtera No. 8, Toraja',
                'no_hp' => '081234567893',
                'email' => 'sarah@example.com',
                'pekerjaan' => 'Dokter',
                'status_pernikahan' => 'Belum Menikah',
                'nama_ayah' => 'Bapak Sarah',
                'nama_ibu' => 'Ibu Sarah',
                'status' => 'active'
            ],
            [
                'nama_lengkap' => 'David Wilson',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1995-03-25',
                'tempat_lahir' => 'Toraja',
                'alamat' => 'Jl. Harapan No. 12, Toraja',
                'no_hp' => '081234567894',
                'email' => 'david@example.com',
                'pekerjaan' => 'Mahasiswa',
                'status_pernikahan' => 'Belum Menikah',
                'nama_ayah' => 'Bapak David',
                'nama_ibu' => 'Ibu David',
                'status' => 'active'
            ],
            [
                'nama_lengkap' => 'Maria Garcia',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '1993-07-18',
                'tempat_lahir' => 'Toraja',
                'alamat' => 'Jl. Kasih No. 3, Toraja',
                'no_hp' => '081234567895',
                'email' => 'maria@example.com',
                'pekerjaan' => 'Guru',
                'status_pernikahan' => 'Belum Menikah',
                'nama_ayah' => 'Bapak Maria',
                'nama_ibu' => 'Ibu Maria',
                'status' => 'active'
            ],
            [
                'nama_lengkap' => 'Robert Brown',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '1980-11-30',
                'tempat_lahir' => 'Toraja',
                'alamat' => 'Jl. Berkat No. 7, Toraja',
                'no_hp' => '081234567896',
                'email' => 'robert@example.com',
                'pekerjaan' => 'Wiraswasta',
                'status_pernikahan' => 'Menikah',
                'nama_ayah' => 'Bapak Robert',
                'nama_ibu' => 'Ibu Robert',
                'nama_pasangan' => 'Linda Brown',
                'status' => 'active'
            ]
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
