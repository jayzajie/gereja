<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use App\Models\Pastor;
use Illuminate\Http\Request;

class CongregationController extends Controller
{
    public function index()
    {
        $congregations = Congregation::with('pastor')->latest()->paginate(10);
        return view('congregations.index', compact('congregations'));
    }

    public function create()
    {
        $pastors = Pastor::where('status', 'active')->get();
        return view('congregations.create', compact('pastors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'pastor_id' => 'nullable|exists:pastors,id',
            'status' => 'required|in:active,inactive',
        ]);

        Congregation::create($validated);

        return redirect()->route('congregations.index')
            ->with('success', 'Congregation created successfully.');
    }

    public function show(Congregation $congregation)
    {
        return view('congregations.show', compact('congregation'));
    }

    public function edit(Congregation $congregation)
    {
        $pastors = Pastor::where('status', 'active')->get();
        return view('congregations.edit', compact('congregation', 'pastors'));
    }

    public function update(Request $request, Congregation $congregation)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'pastor_id' => 'nullable|exists:pastors,id',
            'status' => 'required|in:active,inactive',
        ]);

        $congregation->update($validated);

        return redirect()->route('congregations.index')
            ->with('success', 'Congregation updated successfully.');
    }

    public function destroy(Congregation $congregation)
    {
        $congregation->delete();

        return redirect()->route('congregations.index')
            ->with('success', 'Congregation deleted successfully.');
    }
} 