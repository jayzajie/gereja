<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarEventController extends Controller
{
    /**
     * Get events for calendar display
     */
    public function getEvents(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));

        $events = CalendarEvent::getEventsForCalendar($year, $month);

        // Format events for calendar
        $formattedEvents = [];
        foreach ($events as $date => $dayEvents) {
            $formattedEvents[$date] = $dayEvents->map(function($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'time' => $event->event_time,
                    'category' => $event->category
                ];
            });
        }

        return response()->json($formattedEvents);
    }

    /**
     * Get events for calendar display (public access for dashboard)
     */
    public function getPublicEvents(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));

        $events = CalendarEvent::getEventsForCalendar($year, $month);

        // Format events for calendar
        $formattedEvents = [];
        foreach ($events as $date => $dayEvents) {
            $formattedEvents[$date] = $dayEvents->map(function($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'time' => $event->event_time,
                    'category' => $event->category
                ];
            });
        }

        return response()->json($formattedEvents);
    }

    /**
     * Store a new event
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'event_time' => 'nullable|date_format:H:i',
            'category' => 'required|string|in:ibadah,kegiatan,acara,rapat,pelayanan,general'
        ]);

        try {
            // Keep time as TIME format for database storage
            // No need to convert to datetime, just store as H:i:s

            $event = CalendarEvent::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Kegiatan berhasil ditambahkan!',
                'event' => [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'time' => $event->event_time,
                    'category' => $event->category
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan kegiatan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update an event
     */
    public function update(Request $request, CalendarEvent $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'event_time' => 'nullable|date_format:H:i',
            'category' => 'required|string|in:ibadah,kegiatan,acara,rapat,pelayanan,general'
        ]);

        try {
            // Keep time as TIME format for database storage

            $event->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Kegiatan berhasil diperbarui!',
                'event' => [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'time' => $event->event_time,
                    'category' => $event->category
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui kegiatan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete an event
     */
    public function destroy(CalendarEvent $event)
    {
        try {
            $event->delete();

            return response()->json([
                'success' => true,
                'message' => 'Kegiatan berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus kegiatan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get events for a specific date
     */
    public function getEventsForDate(Request $request)
    {
        $date = $request->get('date');

        if (!$date) {
            return response()->json([
                'success' => false,
                'message' => 'Tanggal harus diisi'
            ], 400);
        }

        $events = CalendarEvent::active()
                              ->onDate($date)
                              ->orderBy('event_time')
                              ->get();

        return response()->json([
            'success' => true,
            'events' => $events->map(function($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'time' => $event->event_time,
                    'category' => $event->category
                ];
            })
        ]);
    }

    /**
     * Toggle event active status
     */
    public function toggleActive(CalendarEvent $event)
    {
        try {
            $event->update(['is_active' => !$event->is_active]);

            return response()->json([
                'success' => true,
                'message' => $event->is_active ? 'Kegiatan diaktifkan!' : 'Kegiatan dinonaktifkan!',
                'is_active' => $event->is_active
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
