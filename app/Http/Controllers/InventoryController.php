<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Exports\InventoryExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Inventory::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('nama_barang', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('supplier', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
        }

        // Filter by category
        if ($request->has('kategori') && $request->kategori) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // Order by newest first
        $inventories = $query->orderBy('created_at', 'desc')->paginate(10);

        // Get categories for filter dropdown
        $categories = Inventory::distinct()->pluck('kategori')->filter()->sort();

        return view('inventory.index', compact('inventories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get existing categories for dropdown
        $categories = Inventory::distinct()->pluck('kategori')->filter()->sort();

        return view('inventory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:50',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_masuk' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date|after:today',
            'status' => 'required|in:tersedia,habis,rusak',
            'supplier' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        try {
            Inventory::create($request->all());

            return redirect()->route('inventory.index')
                           ->with('success', 'Item inventory berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                           ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        return view('inventory.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        // Get existing categories for dropdown
        $categories = Inventory::distinct()->pluck('kategori')->filter()->sort();

        return view('inventory.edit', compact('inventory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jumlah' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric|min:0',
            'satuan' => 'required|string|max:50',
            'lokasi' => 'nullable|string|max:255',
            'tanggal_masuk' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date|after:today',
            'status' => 'required|in:tersedia,habis,rusak',
            'supplier' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator)
                           ->withInput();
        }

        try {
            $inventory->update($request->all());

            return redirect()->route('inventory.index')
                           ->with('success', 'Item inventory berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                           ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        try {
            $inventory->delete();

            return redirect()->route('inventory.index')
                           ->with('success', 'Item inventory berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update stock quantity
     */
    public function updateStock(Request $request, Inventory $inventory)
    {
        $validator = Validator::make($request->all(), [
            'jumlah' => 'required|integer|min:0',
            'catatan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                           ->withErrors($validator);
        }

        try {
            $inventory->update([
                'jumlah' => $request->jumlah,
                'catatan' => $request->catatan,
                'status' => $request->jumlah > 0 ? 'tersedia' : 'habis'
            ]);

            return redirect()->route('inventory.index')
                           ->with('success', 'Stok berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function exportExcel(Request $request)
    {
        $search = $request->get('search');
        $category = $request->get('category');
        $condition = $request->get('condition');

        $filename = 'inventory_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new InventoryExport($search, $category, $condition), $filename);
    }


}
