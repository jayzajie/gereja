<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programKerja = Information::where('category', 'program-kerja')
            ->orderBy('priority', 'desc')
            ->orderBy('publish_date', 'desc')
            ->paginate(10);

        return view('admin.program-kerja.index', compact('programKerja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.program-kerja.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'komisi' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'is_featured' => 'boolean',
        ]);

        // Set default values for removed fields
        $validated['publish_date'] = now();
        $validated['event_date'] = null;
        $validated['location'] = null;
        $validated['image'] = null;
        $validated['excerpt'] = null;



        // Set category and additional data
        $validated['category'] = 'program-kerja';
        $validated['subcategory'] = 'program-kerja'; // Set default subcategory
        $validated['status'] = 'published'; // Set default status
        $validated['priority'] = 'medium'; // Set default priority
        $validated['is_featured'] = $request->has('is_featured');

        // Store komisi in content
        $validated['content'] = "Komisi: " . $validated['komisi'] . "\n\n" . $validated['content'];
        unset($validated['komisi']); // Remove komisi from validated data since it's now in content

        Information::create($validated);

        return redirect()->route('program-kerja.index')
            ->with('success', 'Program Kerja berhasil dibuat!');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $programKerja = Information::findOrFail($id);

        // Ensure this is a program-kerja item
        if ($programKerja->category !== 'program-kerja') {
            abort(404);
        }

        // Extract komisi from content
        $komisi = $this->extractKomisiFromContent($programKerja->content);

        return view('admin.program-kerja.edit', compact('programKerja', 'komisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $programKerja = Information::findOrFail($id);

        // Ensure this is a program-kerja item
        if ($programKerja->category !== 'program-kerja') {
            abort(404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'komisi' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'is_featured' => 'boolean',
        ]);

        // Keep existing values for removed fields
        $validated['publish_date'] = $programKerja->publish_date;
        $validated['event_date'] = null;
        $validated['location'] = null;
        $validated['image'] = null;
        $validated['excerpt'] = null;



        // Set additional data
        $validated['is_featured'] = $request->has('is_featured');

        // Update komisi in content
        $validated['content'] = "Komisi: " . $validated['komisi'] . "\n\n" . $validated['content'];
        unset($validated['komisi']);

        $programKerja->update($validated);

        return redirect()->route('program-kerja.index')
            ->with('success', 'Program Kerja berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $programKerja = Information::findOrFail($id);

        // Ensure this is a program-kerja item
        if ($programKerja->category !== 'program-kerja') {
            abort(404);
        }

        // Delete image if exists
        if ($programKerja->image) {
            Storage::disk('public')->delete($programKerja->image);
        }

        $programKerja->delete();

        return redirect()->route('program-kerja.index')
            ->with('success', 'Program Kerja berhasil dihapus!');
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
