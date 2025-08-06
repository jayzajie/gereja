<?php

namespace App\Http\Controllers;

use App\Models\Pastor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PastorController extends Controller
{
    public function index()
    {
        $pastors = Pastor::latest()->paginate(10);
        return view('pendeta-jemaat.index', compact('pastors'));
    }

    public function create()
    {
        return view('pendeta-jemaat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pastors',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'ordination_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:active,inactive,retired',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('pastors', 'public');
        }

        Pastor::create($validated);

        return redirect()->route('pastors.index')
            ->with('success', 'Pastor created successfully.');
    }

    public function show(Pastor $pastor)
    {
        return view('pendeta-jemaat.show', compact('pastor'));
    }

    public function edit(Pastor $pastor)
    {
        return view('pendeta-jemaat.edit', compact('pastor'));
    }

    public function update(Request $request, Pastor $pastor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pastors,email,' . $pastor->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'ordination_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'status' => 'required|in:active,inactive,retired',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($pastor->photo) {
                \Storage::disk('public')->delete($pastor->photo);
            }
            $validated['photo'] = $request->file('photo')->store('pastors', 'public');
        }

        $pastor->update($validated);

        return redirect()->route('pastors.index')
            ->with('success', 'Pastor updated successfully.');
    }

    public function destroy(Pastor $pastor)
    {
        // Delete photo if exists
        if ($pastor->photo) {
            Storage::disk('public')->delete($pastor->photo);
        }

        $pastor->delete();

        return redirect()->route('pastors.index')
            ->with('success', 'Pastor deleted successfully.');
    }
}
