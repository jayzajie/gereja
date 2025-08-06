<?php

namespace App\Http\Controllers;

use App\Models\WartaMingguan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class WartaMingguanController extends Controller
{
    public function index(Request $request)
    {
        $query = WartaMingguan::query();

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter berdasarkan tahun
        if ($request->filled('year')) {
            $query->byYear($request->year);
        }

        $wartaMingguan = $query->orderBy('tahun', 'desc')
                              ->orderBy('bulan', 'desc')
                              ->orderBy('tanggal', 'desc')
                              ->paginate(10);

        // Get available years for filter
        $availableYears = WartaMingguan::distinct()
                                     ->orderBy('tahun', 'desc')
                                     ->pluck('tahun');

        return view('admin.warta-mingguan', compact('wartaMingguan', 'availableYears'));
    }

    public function store(Request $request)
    {
        // Log untuk debugging
        \Log::info('Store method called');
        \Log::info('Request data: ', $request->all());
        \Log::info('Has file: ' . ($request->hasFile('file_pdf') ? 'YES' : 'NO'));

        try {
            // Validate request
            $validated = $request->validate([
                'nama_warta' => 'required|string|max:255',
                'tanggal' => 'required|integer|min:1|max:31',
                'bulan' => 'required|integer|min:1|max:12',
                'tahun' => 'required|integer|min:2020|max:2030',
                'file_pdf' => 'required|file|mimes:pdf|max:10240',
                'deskripsi' => 'nullable|string'
            ]);

            \Log::info('Validation passed');

            // Get uploaded file
            $file = $request->file('file_pdf');

            // Generate filename
            $fileName = time() . '_' . Str::slug($validated['nama_warta']) . '.pdf';

            // Store file
            $filePath = $file->storeAs('warta-mingguan', $fileName, 'public');

            \Log::info('File stored: ' . $filePath);

            // Create database record
            $warta = WartaMingguan::create([
                'nama_warta' => $validated['nama_warta'],
                'file_path' => $filePath,
                'file_name' => $fileName,
                'file_size' => $file->getSize(),
                'tanggal' => $validated['tanggal'],
                'bulan' => $validated['bulan'],
                'tahun' => $validated['tahun'],
                'deskripsi' => $validated['deskripsi'] ?? ''
            ]);

            \Log::info('Database record created: ' . $warta->id);

            return response()->json([
                'success' => true,
                'message' => 'Warta mingguan berhasil diupload!'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error: ', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Data yang dimasukkan tidak valid',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Exception: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $warta = WartaMingguan::findOrFail($id);

        return view('admin.warta-mingguan.show', compact('warta'));
    }

    public function edit($id)
    {
        $warta = WartaMingguan::findOrFail($id);

        return view('admin.warta-mingguan.edit', compact('warta'));
    }

    public function update(Request $request, $id)
    {
        $warta = WartaMingguan::findOrFail($id);

        $request->validate([
            'nama_warta' => 'required|string|max:255',
            'tanggal' => 'required|integer|min:1|max:31',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2030',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB
            'deskripsi' => 'nullable|string'
        ]);

        try {
            $updateData = [
                'nama_warta' => $request->nama_warta,
                'tanggal' => $request->tanggal,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'deskripsi' => $request->deskripsi
            ];

            // Jika ada file baru yang diupload
            if ($request->hasFile('file_pdf')) {
                // Hapus file lama
                if ($warta->file_path && Storage::disk('public')->exists($warta->file_path)) {
                    Storage::disk('public')->delete($warta->file_path);
                }

                // Upload file baru
                $file = $request->file('file_pdf');
                $fileName = time() . '_' . Str::slug($request->nama_warta) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('warta-mingguan', $fileName, 'public');

                $updateData['file_path'] = $filePath;
                $updateData['file_name'] = $fileName;
                $updateData['file_size'] = $file->getSize();
            }

            $warta->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Warta mingguan berhasil diperbarui!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui warta: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $warta = WartaMingguan::findOrFail($id);

            // Hapus file dari storage
            if ($warta->file_path && Storage::disk('public')->exists($warta->file_path)) {
                Storage::disk('public')->delete($warta->file_path);
            }

            $warta->delete();

            return response()->json([
                'success' => true,
                'message' => 'Warta mingguan berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus warta: ' . $e->getMessage()
            ], 500);
        }
    }

    public function download($id)
    {
        $warta = WartaMingguan::findOrFail($id);

        if (!$warta->file_path || !Storage::disk('public')->exists($warta->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        $filePath = Storage::disk('public')->path($warta->file_path);

        return Response::download($filePath, $warta->file_name);
    }

    public function view($id)
    {
        $warta = WartaMingguan::findOrFail($id);

        if (!$warta->file_path || !Storage::disk('public')->exists($warta->file_path)) {
            abort(404, 'File tidak ditemukan');
        }

        $filePath = Storage::disk('public')->path($warta->file_path);

        return Response::file($filePath);
    }
}
