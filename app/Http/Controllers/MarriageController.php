<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Marriage;
use Illuminate\Http\Request;

class MarriageController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard.contact-data', ['tab' => 'marriages']);
    }

    public function create()
    {
        return view('marriages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_calon_pria' => 'required|string|max:255',
            'tanggal_lahir_pria' => 'required|date',
            'tempat_lahir_pria' => 'nullable|string|max:255',
            'alamat_pria' => 'required|string',
            'pekerjaan_pria' => 'required|string',
            'no_telepon_pria' => 'nullable|string|max:15',
            'email_pria' => 'nullable|email|max:255',
            'nama_ayah_pria' => 'required|string',
            'nama_ibu_pria' => 'required|string',
            'nama_calon_wanita' => 'required|string|max:255',
            'tanggal_lahir_wanita' => 'required|date',
            'tempat_lahir_wanita' => 'nullable|string|max:255',
            'alamat_wanita' => 'required|string',
            'pekerjaan_wanita' => 'required|string',
            'no_telepon_wanita' => 'nullable|string|max:15',
            'email_wanita' => 'nullable|email|max:255',
            'nama_ayah_wanita' => 'required|string',
            'nama_ibu_wanita' => 'required|string',
            'tanggal_pernikahan' => 'required|date',
            'tempat_pernikahan' => 'required|string',
            'saksi' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        Marriage::create($validated);

        return redirect()->route('dashboard.contact-data', ['tab' => 'marriages'])
            ->with('success', 'Data pernikahan berhasil ditambahkan.');
    }

    public function show(Marriage $marriage)
    {
        return view('marriages.show', compact('marriage'));
    }

    public function edit(Marriage $marriage)
    {
        return view('marriages.edit', compact('marriage'));
    }

    public function update(Request $request, Marriage $marriage)
    {
        $validated = $request->validate([
            'nama_calon_pria' => 'required|string|max:255',
            'tanggal_lahir_pria' => 'required|date',
            'tempat_lahir_pria' => 'nullable|string|max:255',
            'alamat_pria' => 'required|string',
            'pekerjaan_pria' => 'required|string',
            'no_telepon_pria' => 'nullable|string|max:15',
            'email_pria' => 'nullable|email|max:255',
            'nama_ayah_pria' => 'required|string',
            'nama_ibu_pria' => 'required|string',
            'nama_calon_wanita' => 'required|string|max:255',
            'tanggal_lahir_wanita' => 'required|date',
            'tempat_lahir_wanita' => 'nullable|string|max:255',
            'alamat_wanita' => 'required|string',
            'pekerjaan_wanita' => 'required|string',
            'no_telepon_wanita' => 'nullable|string|max:15',
            'email_wanita' => 'nullable|email|max:255',
            'nama_ayah_wanita' => 'required|string',
            'nama_ibu_wanita' => 'required|string',
            'tanggal_pernikahan' => 'required|date',
            'tempat_pernikahan' => 'required|string',
            'saksi' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $marriage->update($validated);

        return redirect()->route('dashboard.contact-data', ['tab' => 'marriages'])
            ->with('success', 'Data pernikahan berhasil diperbarui.');
    }

    public function destroy(Marriage $marriage)
    {
        $marriage->delete();

        return redirect()->route('dashboard.contact-data', ['tab' => 'marriages'])
            ->with('success', 'Data pernikahan berhasil dihapus.');
    }

    public function updateStatus(Request $request, Marriage $marriage)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $marriage->update($validated);

        return redirect()->route('dashboard.contact-data', ['tab' => 'marriages'])
            ->with('success', 'Status pernikahan berhasil diperbarui.');
    }
}
