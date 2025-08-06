<?php

namespace App\Http\Controllers;

use App\Models\SejarahGereja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SejarahGerejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sejarahGerejas = SejarahGereja::orderBy('created_at', 'desc')->paginate(10);
        return view('sejarah-gereja.index', compact('sejarahGerejas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sejarah-gereja.create');
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
        ]);

        try {
            // Handle file uploads
            if ($request->hasFile('logo')) {
                $validated['logo'] = $request->file('logo')->store('sejarah-gereja/logos', 'public');
            }

            // HAPUS HANDLING BANNER
            /*
            if ($request->hasFile('banner_image')) {
                $validated['banner_image'] = $request->file('banner_image')->store('sejarah-gereja/banners', 'public');
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

            SejarahGereja::create($validated);

            return redirect()->route('sejarah-gereja.index')
                ->with('success', 'Sejarah Gereja Toraja berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SejarahGereja $sejarahGereja)
    {
        return view('sejarah-gereja.show', compact('sejarahGereja'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SejarahGereja $sejarahGereja)
    {
        return view('sejarah-gereja.edit', compact('sejarahGereja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SejarahGereja $sejarahGereja)
    {
        // Method update - ubah validasi
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            // Hapus atau ubah validasi is_active
            // 'is_active' => 'boolean',  // <- Hapus baris ini
        ]);

        try {
            // Handle file uploads
            if ($request->hasFile('logo')) {
                // Delete old logo
                if ($sejarahGereja->logo) {
                    Storage::disk('public')->delete($sejarahGereja->logo);
                }
                $validated['logo'] = $request->file('logo')->store('sejarah-gereja/logos', 'public');
            }

            // HAPUS HANDLING BANNER
            /*
            if ($request->hasFile('banner_image')) {
                // Delete old banner
                if ($sejarahGereja->banner_image) {
                    Storage::disk('public')->delete($sejarahGereja->banner_image);
                }
                $validated['banner_image'] = $request->file('banner_image')->store('sejarah-gereja/banners', 'public');
            }
            */

            // Set default values tetap sama
            $validated['is_active'] = $request->has('is_active');

            $sejarahGereja->update($validated);

            return redirect()->route('sejarah-gereja.index')
                ->with('success', 'Sejarah Gereja Toraja berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SejarahGereja $sejarahGereja)
    {
        try {
            // Delete associated files
            if ($sejarahGereja->logo) {
                Storage::disk('public')->delete($sejarahGereja->logo);
            }
            if ($sejarahGereja->banner_image) {
                Storage::disk('public')->delete($sejarahGereja->banner_image);
            }

            $sejarahGereja->delete();

            return redirect()->route('sejarah-gereja.index')
                ->with('success', 'Sejarah Gereja Toraja berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->route('sejarah-gereja.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
        }
    }

    /**
     * Toggle status of the specified resource.
     */
    public function toggleStatus(SejarahGereja $sejarahGereja)
    {
        try {
            $sejarahGereja->update([
                'is_active' => !$sejarahGereja->is_active
            ]);

            $status = $sejarahGereja->is_active ? 'diaktifkan' : 'dinonaktifkan';

            return redirect()->route('sejarah-gereja.index')
                ->with('success', "Sejarah Gereja Toraja berhasil {$status}.");

        } catch (\Exception $e) {
            return redirect()->route('sejarah-gereja.index')
                ->with('error', 'Terjadi kesalahan saat mengubah status. Silakan coba lagi.');
        }
    }
}
