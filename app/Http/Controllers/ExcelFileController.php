<?php

namespace App\Http\Controllers;

use App\Models\ExcelFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ExcelFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = $request->get('category');
        
        // Redirect ke dashboard jika tidak ada kategori
        if (!$category || !in_array($category, ['data-jemaat', 'program-kerja'])) {
            return redirect()->route('admin.dashboard');
        }
        
        $query = ExcelFile::latest();
        
        // Filter berdasarkan kategori
        $query->where('category', $category);
        
        $excelFiles = $query->paginate(10);
        
        // Tentukan judul berdasarkan kategori
        $pageTitle = 'Manajemen File Excel';
        if ($category == 'data-jemaat') {
            $pageTitle = 'Manajemen File Excel - Data Jemaat';
        } elseif ($category == 'program-kerja') {
            $pageTitle = 'Manajemen File Excel - Program Kerja Jemaat';
        }
        
        return view('admin.excel-files.index', compact('excelFiles', 'category', 'pageTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $category = $request->get('category');
        
        // Redirect ke dashboard jika tidak ada kategori yang valid
        if (!$category || !in_array($category, ['data-jemaat', 'program-kerja'])) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.excel-files.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls|max:10240', // Max 10MB
            'description' => 'nullable|string|max:500',
            'category' => 'required|in:data-jemaat,program-kerja',
        ], [
            'excel_file.required' => 'File Excel wajib diupload',
            'excel_file.mimes' => 'File harus berformat Excel (.xlsx atau .xls)',
            'excel_file.max' => 'Ukuran file maksimal 10MB',
            'category.required' => 'Kategori wajib dipilih',
            'category.in' => 'Kategori tidak valid',
        ]);

        try {
            $file = $request->file('excel_file');
            $originalName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Generate unique filename
            $fileName = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            // Store file
            $filePath = $file->storeAs('excel-files', $fileName, 'public');

            // Save to database
            ExcelFile::create([
                'original_name' => $originalName,
                'file_path' => $filePath,
                'file_size' => $fileSize,
                'mime_type' => $mimeType,
                'description' => $request->description,
                'category' => $request->category,
                'uploaded_at' => now(),
            ]);

            $redirectRoute = 'excel-files.index';
            $redirectParams = [];
            if ($request->category) {
                $redirectParams['category'] = $request->category;
            }
            
            return redirect()->route($redirectRoute, $redirectParams)
                ->with('success', 'File Excel berhasil diupload!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengupload file: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ExcelFile $excelFile)
    {
        $category = $request->get('category', $excelFile->category);
        return view('admin.excel-files.show', compact('excelFile', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ExcelFile $excelFile)
    {
        $category = $request->get('category', $excelFile->category);
        return view('admin.excel-files.edit', compact('excelFile', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExcelFile $excelFile)
    {
        $request->validate([
            'excel_file' => 'nullable|file|mimes:xlsx,xls|max:10240', // Max 10MB
            'description' => 'nullable|string|max:500',
        ], [
            'excel_file.mimes' => 'File harus berformat Excel (.xlsx atau .xls)',
            'excel_file.max' => 'Ukuran file maksimal 10MB',
        ]);

        try {
            $updateData = [
                'description' => $request->description,
            ];

            // Jika ada file baru yang diupload
            if ($request->hasFile('excel_file')) {
                $file = $request->file('excel_file');
                $originalName = $file->getClientOriginalName();
                $fileSize = $file->getSize();
                $mimeType = $file->getMimeType();

                // Generate unique filename
                $fileName = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

                // Delete old file
                $excelFile->deleteFile();

                // Store new file
                $filePath = $file->storeAs('excel-files', $fileName, 'public');

                $updateData = array_merge($updateData, [
                    'original_name' => $originalName,
                    'file_path' => $filePath,
                    'file_size' => $fileSize,
                    'mime_type' => $mimeType,
                    'uploaded_at' => now(),
                ]);
            }

            $excelFile->update($updateData);

            $redirectRoute = 'excel-files.index';
            $redirectParams = [];
            $category = $request->get('category', $excelFile->category);
            if ($category) {
                $redirectParams['category'] = $category;
            }
            
            return redirect()->route($redirectRoute, $redirectParams)
                ->with('success', 'File Excel berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui file: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, ExcelFile $excelFile)
    {
        try {
            // Get category from request or file
            $category = $request->get('category', $excelFile->category);
            
            // Delete file from storage
            $excelFile->deleteFile();

            // Delete record from database
            $excelFile->delete();

            $redirectRoute = 'excel-files.index';
            $redirectParams = [];
            if ($category) {
                $redirectParams['category'] = $category;
            }

            return redirect()->route($redirectRoute, $redirectParams)
                ->with('success', 'File Excel berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus file: ' . $e->getMessage());
        }
    }

    /**
     * Download the specified file.
     */
    public function download(ExcelFile $excelFile)
    {
        try {
            if (!$excelFile->file_exists) {
                return redirect()->back()
                    ->with('error', 'File tidak ditemukan di server.');
            }

            return Storage::disk('public')->download($excelFile->file_path, $excelFile->original_name);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mendownload file: ' . $e->getMessage());
        }
    }
}
