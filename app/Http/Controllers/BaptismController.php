<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Baptism;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BaptismController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $baptisms = Baptism::latest()->paginate(10);
        return view('baptisms.index', compact('baptisms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('baptisms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jemaat' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'tanggal_baptis' => 'required|date',
            'foto' => 'nullable|image|max:2048',
            'dibaptis_oleh' => 'required|string|max:255',
            'email' => 'required|email',
            'status' => 'nullable|in:pending,approved,rejected',
        ]);

        // Generate automatic baptism number
        $year = date('Y');
        $lastBaptism = Baptism::whereYear('created_at', $year)
                             ->orderBy('id', 'desc')
                             ->first();

        if ($lastBaptism) {
            // Extract number from last baptism number (format: BAPT-YYYY-XXX)
            $lastNumber = (int) substr($lastBaptism->nomor_baptis, -3);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        $validated['nomor_baptis'] = 'BAPT-' . $year . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('baptism-photos', 'public');
        }

        $validated['status'] = $validated['status'] ?? 'pending';

        Baptism::create($validated);

        return redirect()->route('baptisms.index')
            ->with('success', 'Data baptisan berhasil disimpan dengan nomor baptis: ' . $validated['nomor_baptis']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Baptism $baptism)
    {
        return view('baptisms.show', compact('baptism'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Baptism $baptism)
    {
        return view('baptisms.edit', compact('baptism'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Baptism $baptism)
    {
        $validated = $request->validate([
            'nomor_baptis' => 'required|string|max:255', // Keep this for admin updates
            'nama_jemaat' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'tanggal_baptis' => 'required|date',
            'foto' => 'nullable|image|max:2048',
            'dibaptis_oleh' => 'required|string|max:255',
            'email' => 'required|email',
            'status' => 'nullable|in:pending,approved,rejected',
        ]);

        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($baptism->foto) {
                Storage::disk('public')->delete($baptism->foto);
            }
            $validated['foto'] = $request->file('foto')->store('baptism-photos', 'public');
        }

        $baptism->update($validated);

        return redirect()->route('baptisms.show', $baptism)
            ->with('success', 'Data baptisan berhasil diperbarui.');
    }

    /**
     * Update the status of the specified resource.
     */
    public function updateStatus(Request $request, Baptism $baptism)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $baptism->update($validated);

        return back()->with('success', 'Status baptisan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Baptism $baptism)
    {
        // Delete photo if exists
        if ($baptism->foto) {
            Storage::disk('public')->delete($baptism->foto);
        }

        $baptism->delete();

        return redirect()->route('dashboard.contact-data', ['tab' => 'baptisms'])
            ->with('success', 'Data baptisan berhasil dihapus.');
    }
}
