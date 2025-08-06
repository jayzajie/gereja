<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pastor;
use Carbon\Carbon;

class PastorSeeder extends Seeder
{
    public function run()
    {
        $pastors = [
            [
                'name' => 'Pdt. Dr. Yohanes Simbolon, S.Th., M.Th.',
                'email' => 'yohanes.simbolon@gereja.com',
                'phone' => '081234567890',
                'address' => 'Jl. Gereja No. 1, Toraja Utara',
                'birth_date' => '1965-03-15',
                'ordination_date' => '1995-06-20',
                'end_date' => '2010-12-31',
                'status' => 'retired',
                'photo' => null,
            ],
            [
                'name' => 'Pdt. Maria Tangdilintin, S.Th.',
                'email' => 'maria.tangdilintin@gereja.com',
                'phone' => '081234567891',
                'address' => 'Jl. Gereja No. 2, Toraja Utara',
                'birth_date' => '1970-08-22',
                'ordination_date' => '2000-09-15',
                'end_date' => '2015-06-30',
                'status' => 'retired',
                'photo' => null,
            ],
            [
                'name' => 'Pdt. Samuel Rante, S.Th., M.Div.',
                'email' => 'samuel.rante@gereja.com',
                'phone' => '081234567892',
                'address' => 'Jl. Gereja No. 3, Toraja Utara',
                'birth_date' => '1975-11-10',
                'ordination_date' => '2005-04-18',
                'end_date' => '2020-08-31',
                'status' => 'inactive',
                'photo' => null,
            ],
            [
                'name' => 'Pdt. Elisabeth Sarungallo, S.Th.',
                'email' => 'elisabeth.sarungallo@gereja.com',
                'phone' => '081234567893',
                'address' => 'Jl. Gereja No. 4, Toraja Utara',
                'birth_date' => '1980-05-25',
                'ordination_date' => '2010-07-12',
                'end_date' => null,
                'status' => 'active',
                'photo' => null,
            ],
        ];

        foreach ($pastors as $pastor) {
            Pastor::create($pastor);
        }
    }
}
