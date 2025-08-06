<?php

namespace App\Http\Controllers;

use App\Models\SejarahJemaat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SejarahJemaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sejarahJemaats = SejarahJemaat::orderBy('created_at', 'desc')->paginate(10);
        return view('sejarah-jemaat.index', compact('sejarahJemaats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sejarah-jemaat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Method store
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // HAPUS BARIS INI
        ], [
            'title.required' => 'Judul wajib diisi.',
            'content.required' => 'Konten sejarah wajib diisi.',
            'logo.image' => 'Logo harus berupa file gambar.',
            'logo.mimes' => 'Logo harus berformat jpeg, png, jpg, atau gif.',
            'logo.max' => 'Ukuran logo maksimal 2MB.',
            // HAPUS VALIDASI BANNER
            // 'banner_image.image' => 'Banner harus berupa file gambar.',
            // 'banner_image.mimes' => 'Banner harus berformat jpeg, png, jpg, atau gif.',
            // 'banner_image.max' => 'Ukuran banner maksimal 5MB.',
            'email.email' => 'Format email tidak valid.',
        ]);

        try {
            // Handle file uploads
            if ($request->hasFile('logo')) {
                $validated['logo'] = $request->file('logo')->store('sejarah-jemaat/logos', 'public');
            }

            // HAPUS HANDLING BANNER
            /*
            if ($request->hasFile('banner_image')) {
                $validated['banner_image'] = $request->file('banner_image')->store('sejarah-jemaat/banners', 'public');
            }
            */

            // Method update - sama seperti di atas
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                // 'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // HAPUS BARIS INI
            ]);

            // Set default values
            $validated['is_active'] = $request->has('is_active');

            SejarahJemaat::create($validated);

            return redirect()->route('sejarah-jemaat.index')
                ->with('success', 'Sejarah Jemaat Eben-Haezer Selili berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SejarahJemaat $sejarahJemaat)
    {
        return view('sejarah-jemaat.show', compact('sejarahJemaat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SejarahJemaat $sejarahJemaat)
    {
        return view('sejarah-jemaat.edit', compact('sejarahJemaat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SejarahJemaat $sejarahJemaat)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'is_active' => 'boolean',
        ], [
            'title.required' => 'Judul wajib diisi.',
            'content.required' => 'Konten sejarah wajib diisi.',
            'logo.image' => 'Logo harus berupa file gambar.',
            'logo.mimes' => 'Logo harus berformat jpeg, png, jpg, atau gif.',
            'logo.max' => 'Ukuran logo maksimal 2MB.',
            'banner_image.image' => 'Banner harus berupa file gambar.',
            'banner_image.mimes' => 'Banner harus berformat jpeg, png, jpg, atau gif.',
            'banner_image.max' => 'Ukuran banner maksimal 5MB.',
            'email.email' => 'Format email tidak valid.',
        ]);

        try {
            // Handle file uploads
            if ($request->hasFile('logo')) {
                // Delete old logo
                if ($sejarahJemaat->logo) {
                    Storage::disk('public')->delete($sejarahJemaat->logo);
                }
                $validated['logo'] = $request->file('logo')->store('sejarah-jemaat/logos', 'public');
            }

            // HAPUS HANDLING BANNER
            /*
            if ($request->hasFile('banner_image')) {
                // Delete old banner
                if ($sejarahJemaat->banner_image) {
                    Storage::disk('public')->delete($sejarahJemaat->banner_image);
                }
                $validated['banner_image'] = $request->file('banner_image')->store('sejarah-jemaat/banners', 'public');
            }
            */

            // Set default values
            $validated['is_active'] = $request->has('is_active');

            $sejarahJemaat->update($validated);

            return redirect()->route('sejarah-jemaat.index')
                ->with('success', 'Sejarah Jemaat Eben-Haezer Selili berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SejarahJemaat $sejarahJemaat)
    {
        try {
            // Delete associated files
            if ($sejarahJemaat->logo) {
                Storage::disk('public')->delete($sejarahJemaat->logo);
            }
            if ($sejarahJemaat->banner_image) {
                Storage::disk('public')->delete($sejarahJemaat->banner_image);
            }

            $sejarahJemaat->delete();

            return redirect()->route('sejarah-jemaat.index')
                ->with('success', 'Sejarah Jemaat Eben-Haezer Selili berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->route('sejarah-jemaat.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
        }
    }

    /**
     * Toggle status of the specified resource.
     */
    public function toggleStatus(SejarahJemaat $sejarahJemaat)
    {
        try {
            $sejarahJemaat->update([
                'is_active' => !$sejarahJemaat->is_active
            ]);

            $status = $sejarahJemaat->is_active ? 'diaktifkan' : 'dinonaktifkan';

            return redirect()->route('sejarah-jemaat.index')
                ->with('success', "Sejarah Jemaat Eben-Haezer Selili berhasil {$status}.");

        } catch (\Exception $e) {
            return redirect()->route('sejarah-jemaat.index')
                ->with('error', 'Terjadi kesalahan saat mengubah status. Silakan coba lagi.');
        }
    }
}
