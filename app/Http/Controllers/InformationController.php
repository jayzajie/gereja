<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InformationController extends Controller
{
    /**
     * Display the information dashboard.
     */
    public function dashboard(Request $request)
    {
        $query = Information::query();

        // Filter by category if provided
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Only show published information on dashboard
        $query->published();

        // Order by priority and publish date
        $query->orderByRaw("
            CASE priority
                WHEN 'high' THEN 1
                WHEN 'medium' THEN 2
                WHEN 'low' THEN 3
            END
        ")->orderBy('publish_date', 'desc');

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

        // Default filter untuk kegiatan jemaat (berbagai kategori kegiatan)
        // Jika tidak ada filter kategori yang dipilih, tampilkan semua kategori kegiatan
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        } else {
            // Tampilkan semua kategori yang berkaitan dengan kegiatan
            $query->whereIn('category', ['event', 'kegiatan', 'acara', 'activity', 'service', 'ibadah']);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Order by priority and created_at desc
        $query->orderByRaw("CASE
                WHEN priority = 'high' THEN 3
                WHEN priority = 'medium' THEN 2
                WHEN priority = 'low' THEN 1
                ELSE 0 END DESC")
              ->orderBy('created_at', 'desc');

        $informations = $query->paginate(15);

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
        $statuses = Information::getStatuses();
        $subcategories = Information::getSubcategories();

        return view('admin.information.create', compact('categories', 'statuses', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'category' => 'required|string',
            'subcategory' => 'nullable|string',
            'status' => 'required|string',
            'priority' => 'required|string',
            'publish_date' => 'nullable|date',
            'notes' => 'nullable|string'
        ]);

        try {
            $data = $request->only([
                'title', 'content', 'category', 'subcategory',
                'status', 'priority', 'publish_date', 'notes'
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('information', $imageName, 'public');
                $data['image'] = $imagePath;
            }

            Information::create($data);

            return redirect()->route('information.index')
                ->with('success', 'Informasi berhasil ditambahkan.');
        } catch (\Exception $e) {
            \Log::error('Error creating information: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())
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
        $subcategories = Information::getSubcategories();

        return view('admin.information.edit', compact('information', 'categories', 'statuses', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Information $information)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
            'category' => 'required|string',
            'subcategory' => 'nullable|string',
            'status' => 'required|string',
            'priority' => 'required|string',
            'publish_date' => 'nullable|date',
            'notes' => 'nullable|string'
        ]);

        try {
            $data = $request->only([
                'title', 'content', 'category', 'subcategory',
                'status', 'priority', 'publish_date', 'notes'
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($information->image && Storage::disk('public')->exists($information->image)) {
                    Storage::disk('public')->delete($information->image);
                }

                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('information', $imageName, 'public');
                $data['image'] = $imagePath;
            }

            $information->update($data);

            return redirect()->route('information.show', $information)
                ->with('success', 'Informasi berhasil diperbarui.');
        } catch (\Exception $e) {
            \Log::error('Error updating information: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
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
            if ($information->image && \Storage::disk('public')->exists($information->image)) {
                \Storage::disk('public')->delete($information->image);
            }

            $information->delete();

            return redirect()->route('information.index')
                ->with('success', 'Informasi berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }




}
