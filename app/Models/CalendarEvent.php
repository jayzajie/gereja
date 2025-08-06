<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CalendarEvent extends Model
{
    use HasFactory;

    protected $table = 'calendar_events';

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'event_time',
        'category',
        'is_active'
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk event yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk event mendatang
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', Carbon::today())
                    ->orderBy('event_date', 'asc')
                    ->orderBy('event_time', 'asc');
    }

    // Scope untuk event pada tanggal tertentu
    public function scopeOnDate($query, $date)
    {
        return $query->whereDate('event_date', $date);
    }

    // Scope untuk event pada bulan tertentu
    public function scopeInMonth($query, $year, $month)
    {
        return $query->whereYear('event_date', $year)
                    ->whereMonth('event_date', $month);
    }

    // Accessor untuk format tanggal Indonesia
    public function getFormattedDateAttribute()
    {
        return $this->event_date->format('d F Y');
    }

    // Accessor untuk format waktu
    public function getFormattedTimeAttribute()
    {
        if (!$this->event_time) {
            return null;
        }

        // Parse time from database (stored as TIME format)
        $time = \Carbon\Carbon::createFromFormat('H:i:s', $this->event_time);
        return $time->format('H:i') . ' WITA';
    }

    // Accessor untuk nama bulan
    public function getMonthNameAttribute()
    {
        $months = [
            1 => 'JAN', 2 => 'FEB', 3 => 'MAR', 4 => 'APR',
            5 => 'MEI', 6 => 'JUN', 7 => 'JUL', 8 => 'AGS',
            9 => 'SEP', 10 => 'OKT', 11 => 'NOV', 12 => 'DES'
        ];

        return $months[$this->event_date->month];
    }

    // Accessor untuk cek apakah event hari ini
    public function getIsTodayAttribute()
    {
        return $this->event_date->isToday();
    }

    // Accessor untuk cek apakah event sudah lewat
    public function getIsPastAttribute()
    {
        return $this->event_date->isPast();
    }

    // Categories
    public static function getCategories()
    {
        return [
            'ibadah' => 'Ibadah',
            'kegiatan' => 'Kegiatan',
            'acara' => 'Acara Khusus',
            'rapat' => 'Rapat',
            'pelayanan' => 'Pelayanan',
            'general' => 'Umum'
        ];
    }

    // Get events for calendar display
    public static function getEventsForCalendar($year, $month)
    {
        return self::active()
                  ->inMonth($year, $month)
                  ->get()
                  ->groupBy(function($event) {
                      return $event->event_date->format('Y-m-d');
                  });
    }

    // Get upcoming events for landing page
    public static function getUpcomingEvents($limit = 3)
    {
        return self::active()
                  ->upcoming()
                  ->limit($limit)
                  ->get();
    }
}
