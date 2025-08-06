<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    /**
     * Display dashboard with grid layout
     */
    public function dashboard(Request $request)
    {
        $query = Information::query();

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Search berdasarkan title atau content
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('publish_date', 'asc');
                break;
            case 'priority':
                $query->orderBy('priority', 'desc')->orderBy('publish_date', 'desc');
                break;
            default: // newest
                $query->orderBy('publish_date', 'desc');
                break;
        }

        $informations = $query->paginate(12);
        $categories = Information::getCategories();
        $currentCategory = $request->get('category');

        return view('admin.information.dashboard', compact('informations', 'categories', 'currentCategory'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Information::query();

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search berdasarkan title atau content
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Order by priority dan tanggal
        $informations = $query->ordered()->paginate(10);

        // Get categories dan statuses untuk filter dropdown
        $categories = Information::getCategories();
        $statuses = Information::getStatuses();

        return view('admin.information.index', compact('informations', 'categories', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Information::getCategories();
        $subcategories = Information::getSubcategories();
        $statuses = Information::getStatuses();
        $priorities = Information::getPriorities();

        return view('admin.information.create', compact('categories', 'subcategories', 'statuses', 'priorities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'subcategory' => 'nullable|string|max:100',
            'publish_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'priority' => 'required|in:low,medium,high',
            'notes' => 'nullable|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('information', 'public');
        }

        // Set default values
        $validated['is_featured'] = $request->has('is_featured');
        $validated['priority'] = $validated['priority'] ?? 0;

        try {
            Information::create($validated);

            return redirect()->route('information.index')
                           ->with('success', 'Informasi berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                           ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Information $information)
    {
        return view('admin.information.show', compact('information'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Information $information)
    {
        $categories = Information::getCategories();
        $statuses = Information::getStatuses();

        return view('admin.information.edit', compact('information', 'categories', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Information $information)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:pengumuman,kegiatan,warta,program-kerja',
            'author' => 'nullable|string|max:255',
            'publish_date' => 'required|date',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published,archived',
            'is_featured' => 'boolean',
            'priority' => 'integer|min:0|max:100',
            'excerpt' => 'nullable|string|max:500',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($information->image) {
                Storage::disk('public')->delete($information->image);
            }
            $validated['image'] = $request->file('image')->store('information', 'public');
        }

        // Set default values
        $validated['is_featured'] = $request->has('is_featured');
        $validated['priority'] = $validated['priority'] ?? 0;

        try {
            $information->update($validated);

            return redirect()->route('information.index')
                           ->with('success', 'Informasi berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                           ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Information $information)
    {
        try {
            // Delete image if exists
            if ($information->image) {
                Storage::disk('public')->delete($information->image);
            }

            $information->delete();

            return redirect()->route('information.index')
                           ->with('success', 'Informasi berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Export to Excel
     */
    public function exportExcel()
    {
        // Placeholder for Excel export functionality
        return redirect()->back()->with('info', 'Fitur export Excel akan segera tersedia.');
    }

    /**
     * Export to PDF
     */
    public function exportPdf()
    {
        // Placeholder for PDF export functionality
        return redirect()->back()->with('info', 'Fitur export PDF akan segera tersedia.');
    }
}
