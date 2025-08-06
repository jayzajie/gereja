<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorshipSchedule;
use Carbon\Carbon;

class WorshipScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'name' => 'Ibadah Pagi',
                'time' => '05:30',
                'day' => 'Setiap Minggu',
                'icon' => 'bx-sun',
                'description' => 'Ibadah pagi untuk memulai hari dengan berkat Tuhan',
                'special_notes' => json_encode(['Semua Umur']),
                'target_audience' => 'Semua Umur',
                'duration' => 90,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Ibadah Utama',
                'time' => '09:30',
                'day' => 'Setiap Minggu',
                'icon' => 'bx-church',
                'description' => 'Ibadah utama mingguan dengan khotbah dan penyembahan',
                'special_notes' => json_encode(['Jam Budak OIG', 'Pengukuhan Iman Gereja Toraja', 'Semua Umur']),
                'target_audience' => 'Semua Umur',
                'duration' => 120,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Ibadah Malam',
                'time' => '18:30',
                'day' => 'Setiap Minggu',
                'icon' => 'bx-moon',
                'description' => 'Ibadah malam untuk menutup hari dengan syukur',
                'special_notes' => json_encode(['Semua Umur']),
                'target_audience' => 'Semua Umur',
                'duration' => 90,
                'is_featured' => true,
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($schedules as $schedule) {
            WorshipSchedule::create($schedule);
        }
    }
}