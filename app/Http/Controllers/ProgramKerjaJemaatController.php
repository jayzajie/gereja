<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramKerjaJemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programKerjaJemaat = Information::where('category', 'program')
            ->where('subcategory', 'special')
            ->where('content', 'LIKE', '%Jemaat Selili%')
            ->orderBy('priority', 'desc')
            ->orderBy('publish_date', 'desc')
            ->paginate(10);

        return view('admin.program-kerja-jemaat.index', compact('programKerjaJemaat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.program-kerja-jemaat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publish_date' => 'required|date',
            'komisi' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120', // 5MB max
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('program-kerja-jemaat', $fileName, 'public');
            $validated['file_path'] = $filePath;
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_size'] = $file->getSize();
        }

        // Set default values for simple form
        $validated['category'] = 'program';
        $validated['subcategory'] = 'special';
        $validated['status'] = 'published';
        $validated['priority'] = 'medium';
        $validated['is_featured'] = false;
        $validated['komisi'] = $validated['komisi'] ?? 'Jemaat Selili';
        $validated['content'] = $validated['content'] ?? 'Program Kerja Jemaat Selili';
        $validated['author'] = $validated['author'] ?? 'Admin';

        Information::create($validated);

        return redirect()->route('program-kerja-jemaat.index')
            ->with('success', 'Program Kerja Jemaat Selili berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $programKerjaJemaat = Information::findOrFail($id);

        // Ensure this is a program item for Jemaat Selili
        if ($programKerjaJemaat->category !== 'program' ||
            $programKerjaJemaat->subcategory !== 'special' ||
            !str_contains($programKerjaJemaat->content, 'Jemaat Selili')) {
            abort(404);
        }

        return view('admin.program-kerja-jemaat.show', compact('programKerjaJemaat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $programKerjaJemaat = Information::findOrFail($id);

        // Ensure this is a program item for Jemaat Selili
        if ($programKerjaJemaat->category !== 'program' ||
            $programKerjaJemaat->subcategory !== 'special' ||
            !str_contains($programKerjaJemaat->content, 'Jemaat Selili')) {
            abort(404);
        }

        // Extract komisi from content
        $komisi = $this->extractKomisiFromContent($programKerjaJemaat->content);

        return view('admin.program-kerja-jemaat.edit', compact('programKerjaJemaat', 'komisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $programKerjaJemaat = Information::findOrFail($id);

        // Ensure this is a program item for Jemaat Selili
        if ($programKerjaJemaat->category !== 'program' ||
            $programKerjaJemaat->subcategory !== 'special' ||
            !str_contains($programKerjaJemaat->content, 'Jemaat Selili')) {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'publish_date' => 'required|date',
            'komisi' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'author' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120', // 5MB max
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($programKerjaJemaat->file_path && \Storage::disk('public')->exists($programKerjaJemaat->file_path)) {
                \Storage::disk('public')->delete($programKerjaJemaat->file_path);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('program-kerja-jemaat', $fileName, 'public');
            $validated['file_path'] = $filePath;
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_size'] = $file->getSize();
        }

        // Set default values for simple form
        $validated['komisi'] = $validated['komisi'] ?? 'Jemaat Selili';
        $validated['content'] = $validated['content'] ?? 'Program Kerja Jemaat Selili';
        $validated['author'] = $validated['author'] ?? 'Admin';

        $programKerjaJemaat->update($validated);

        return redirect()->route('program-kerja-jemaat.index')
            ->with('success', 'Program Kerja Jemaat Selili berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $programKerjaJemaat = Information::findOrFail($id);

        // Ensure this is a program item for Jemaat Selili
        if ($programKerjaJemaat->category !== 'program' ||
            $programKerjaJemaat->subcategory !== 'special' ||
            !str_contains($programKerjaJemaat->content, 'Jemaat Selili')) {
            abort(404);
        }

        // Delete image if exists
        if ($programKerjaJemaat->image) {
            Storage::disk('public')->delete($programKerjaJemaat->image);
        }

        // Delete file if exists
        if ($programKerjaJemaat->file_path) {
            Storage::disk('public')->delete($programKerjaJemaat->file_path);
        }

        $programKerjaJemaat->delete();

        return redirect()->route('program-kerja-jemaat.index')
            ->with('success', 'Program Kerja Jemaat Selili berhasil dihapus!');
    }

    /**
     * Extract komisi from content
     */
    private function extractKomisiFromContent($content)
    {
        if (preg_match('/^Komisi: (.+?)\\n/', $content, $matches)) {
            return $matches[1];
        }
        return '';
    }
}
