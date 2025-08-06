<?php

namespace App\Http\Controllers;

use App\Models\WorshipSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorshipScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = WorshipSchedule::ordered()->paginate(10);
        return view('admin.worship-schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.worship-schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'time' => 'required|date_format:H:i',
            'day' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_audience' => 'required|string|max:255',
            'duration' => 'nullable|integer|min:1',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'required|integer|min:0',
            'special_notes' => 'nullable|array',
            'special_notes.*' => 'string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');
        
        // Handle special notes
        if ($request->has('special_notes') && is_array($request->special_notes)) {
            $data['special_notes'] = array_filter($request->special_notes, function($note) {
                return !empty(trim($note));
            });
        }

        WorshipSchedule::create($data);

        return redirect()->route('worship-schedules.index')
            ->with('success', 'Jadwal ibadah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(WorshipSchedule $worshipSchedule)
    {
        return view('admin.worship-schedules.show', compact('worshipSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorshipSchedule $worshipSchedule)
    {
        return view('admin.worship-schedules.edit', compact('worshipSchedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WorshipSchedule $worshipSchedule)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'time' => 'required|date_format:H:i',
            'day' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'description' => 'nullable|string',
            'target_audience' => 'required|string|max:255',
            'duration' => 'nullable|integer|min:1',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'required|integer|min:0',
            'special_notes' => 'nullable|array',
            'special_notes.*' => 'string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $data['is_featured'] = $request->has('is_featured');
        $data['is_active'] = $request->has('is_active');
        
        // Handle special notes
        if ($request->has('special_notes') && is_array($request->special_notes)) {
            $data['special_notes'] = array_filter($request->special_notes, function($note) {
                return !empty(trim($note));
            });
        } else {
            $data['special_notes'] = [];
        }

        $worshipSchedule->update($data);

        return redirect()->route('worship-schedules.index')
            ->with('success', 'Jadwal ibadah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorshipSchedule $worshipSchedule)
    {
        $worshipSchedule->delete();

        return redirect()->route('worship-schedules.index')
            ->with('success', 'Jadwal ibadah berhasil dihapus!');
    }
}