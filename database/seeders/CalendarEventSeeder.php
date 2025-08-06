<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalendarEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\CalendarEvent::create([
            'title' => 'Perayaan Natal',
            'description' => 'Ibadah Natal bersama seluruh jemaat dalam suasana penuh sukacita',
            'event_date' => '2025-07-25',
            'event_time' => '09:30:00',
            'category' => 'ibadah',
            'is_active' => true
        ]);

        \App\Models\CalendarEvent::create([
            'title' => 'Ibadah Tutup Tahun',
            'description' => 'Ibadah syukur akhir tahun dengan refleksi dan doa bersama',
            'event_date' => '2025-07-31',
            'event_time' => '19:00:00',
            'category' => 'ibadah',
            'is_active' => true
        ]);

        \App\Models\CalendarEvent::create([
            'title' => 'Ibadah Tahun Baru',
            'description' => 'Menyambut tahun yang baru dengan puji-pujian dan harapan',
            'event_date' => '2025-08-02',
            'event_time' => '09:30:00',
            'category' => 'ibadah',
            'is_active' => true
        ]);

        \App\Models\CalendarEvent::create([
            'title' => 'Semua',
            'description' => 'qqwqwqwqwqwqww',
            'event_date' => '2025-08-02',
            'event_time' => '02:10:00',
            'category' => 'general',
            'is_active' => true
        ]);
    }
}
