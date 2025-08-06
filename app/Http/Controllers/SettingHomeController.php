<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;

class SettingHomeController extends Controller
{
    public function index()
    {
        // Get home page settings
        $homeSettings = Information::where('category', 'home-setting')
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.setting-home.index', compact('homeSettings'));
    }

    public function create()
    {
        return view('admin.setting-home.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:hero,about,contact,footer',
            'priority' => 'nullable|string|in:low,medium,high',
            'is_active' => 'boolean'
        ]);

        Information::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => 'home-setting',
            'subcategory' => $request->type,
            'priority' => $request->priority ?? 'medium',
            'status' => $request->has('is_active') ? 'published' : 'draft',
            'publish_date' => now(),
            'notes' => 'Created by: ' . (auth()->user()->name ?? 'Admin')
        ]);

        return redirect()->route('setting-home.index')
            ->with('success', 'Setting home berhasil ditambahkan!');
    }

    public function show($id)
    {
        $setting = Information::where('category', 'home-setting')->findOrFail($id);
        return view('admin.setting-home.show', compact('setting'));
    }

    public function edit($id)
    {
        $setting = Information::where('category', 'home-setting')->findOrFail($id);
        return view('admin.setting-home.edit', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:hero,about,contact,footer',
            'priority' => 'nullable|string|in:low,medium,high',
            'is_active' => 'boolean'
        ]);

        $setting = Information::where('category', 'home-setting')->findOrFail($id);

        $setting->update([
            'title' => $request->title,
            'content' => $request->content,
            'subcategory' => $request->type,
            'priority' => $request->priority ?? 'medium',
            'status' => $request->has('is_active') ? 'published' : 'draft',
            'notes' => 'Updated by: ' . (auth()->user()->name ?? 'Admin')
        ]);

        return redirect()->route('setting-home.index')
            ->with('success', 'Setting home berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $setting = Information::where('category', 'home-setting')->findOrFail($id);
        $setting->delete();

        return redirect()->route('setting-home.index')
            ->with('success', 'Setting home berhasil dihapus!');
    }
}
