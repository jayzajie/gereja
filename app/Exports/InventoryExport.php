<?php

namespace App\Exports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventoryExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $search;
    protected $category;
    protected $condition;

    public function __construct($search = null, $category = null, $condition = null)
    {
        $this->search = $search;
        $this->category = $category;
        $this->condition = $condition;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Inventory::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('nama_barang', 'like', '%' . $this->search . '%')
                  ->orWhere('kode_barang', 'like', '%' . $this->search . '%')
                  ->orWhere('merk', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->category) {
            $query->where('kategori', $this->category);
        }

        if ($this->condition) {
            $query->where('kondisi', $this->condition);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'Kode Barang',
            'Nama Barang',
            'Kategori',
            'Merk',
            'Jumlah',
            'Kondisi',
            'Lokasi',
            'Tanggal Pembelian',
            'Harga',
            'Keterangan',
            'Tanggal Dibuat'
        ];
    }

    /**
    * @param mixed $inventory
    * @return array
    */
    public function map($inventory): array
    {
        return [
            $inventory->kode_barang,
            $inventory->nama_barang,
            $inventory->kategori,
            $inventory->merk,
            $inventory->jumlah,
            ucfirst($inventory->kondisi),
            $inventory->lokasi,
            $inventory->tanggal_pembelian ? \Carbon\Carbon::parse($inventory->tanggal_pembelian)->format('d/m/Y') : '-',
            $inventory->harga ? 'Rp ' . number_format($inventory->harga, 0, ',', '.') : '-',
            $inventory->keterangan ?: '-',
            $inventory->created_at->format('d/m/Y H:i')
        ];
    }

    /**
    * @param Worksheet $sheet
    * @return array
    */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true]],
            
            // Style the header row
            'A1:K1' => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '8B4513']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
            ],
        ];
    }

    /**
    * @return array
    */
    public function columnWidths(): array
    {
        return [
            'A' => 15, // Kode Barang
            'B' => 25, // Nama Barang
            'C' => 15, // Kategori
            'D' => 15, // Merk
            'E' => 10, // Jumlah
            'F' => 12, // Kondisi
            'G' => 20, // Lokasi
            'H' => 15, // Tanggal Pembelian
            'I' => 15, // Harga
            'J' => 30, // Keterangan
            'K' => 18, // Tanggal Dibuat
        ];
    }
}
