@extends('layouts.admin')

@section('title', 'Inventory Management')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold py-3 mb-2" style="color: #8B4513;">
                        <span class="text-muted fw-light">🏠 Dashboard /</span> 📦 Inventory
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-package text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Total Items</span>
                    <h3 class="card-title mb-2">{{ $inventories->total() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-check-circle text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Tersedia</span>
                    <h3 class="card-title mb-2">{{ \App\Models\Inventory::tersedia()->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-x-circle text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Habis</span>
                    <h3 class="card-title mb-2">{{ \App\Models\Inventory::habis()->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class="bx bx-error-circle text-danger" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Rusak</span>
                    <h3 class="card-title mb-2">{{ \App\Models\Inventory::rusak()->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Daftar Inventory</h5>
                    <div class="d-flex gap-2">
                        <!-- Export & Print Buttons -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-download me-1"></i>Export
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#" onclick="exportExcel()">
                                        <i class="bx bx-file-blank me-1"></i>Export Excel
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <button type="button" class="btn btn-outline-info" onclick="printTable()">
                            <i class="bx bx-printer me-1"></i>Print
                        </button>

                        <!-- Filters -->
                        <form method="GET" action="{{ route('inventory.index') }}" class="d-flex gap-2">
                            <!-- Search -->
                            <div class="input-group" style="width: 200px;">
                                <input type="text" class="form-control" name="search"
                                       placeholder="Search..." value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bx bx-search"></i>
                                </button>
                            </div>

                            <!-- Category Filter -->
                            <select name="kategori" class="form-select" style="width: 150px;" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ request('kategori') == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Status Filter -->
                            <select name="status" class="form-select" style="width: 120px;" onchange="this.form.submit()">
                                <option value="">Semua Status</option>
                                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                                <option value="rusak" {{ request('status') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                        </form>

                        <!-- Create Button -->
                        <a href="{{ route('inventory.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i>Tambah Item
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Total Nilai</th>
                                    <th>Status</th>
                                    <th>Lokasi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($inventories as $item)
                                    <tr>
                                        <td>
                                            <div class="fw-medium">{{ $item->nama_barang }}</div>
                                            @if($item->supplier)
                                                <small class="text-muted">Supplier: {{ $item->supplier }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $item->kategori }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-medium">{{ $item->jumlah }}</span> {{ $item->satuan }}
                                            @if($item->jumlah <= 5 && $item->status == 'tersedia')
                                                <br><small class="text-warning"><i class="bx bx-warning"></i> Stok rendah</small>
                                            @endif
                                        </td>
                                        <td>{{ $item->formatted_harga_satuan }}</td>
                                        <td>{{ $item->formatted_total_nilai }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->status_badge_color }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                            @if($item->is_expired)
                                                <br><small class="text-danger"><i class="bx bx-time"></i> Kadaluarsa</small>
                                            @endif
                                        </td>
                                        <td>{{ $item->lokasi ?: '-' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                        data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('inventory.show', $item) }}">
                                                        <i class="bx bx-show me-1"></i> Lihat Detail
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('inventory.edit', $item) }}">
                                                        <i class="bx bx-edit me-1"></i> Edit
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <form method="POST" action="{{ route('inventory.destroy', $item) }}"
                                                          class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="bx bx-trash me-1"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="bx bx-package bx-lg mb-2"></i>
                                                <p>Belum ada data inventory</p>
                                                <a href="{{ route('inventory.create') }}" class="btn btn-primary">
                                                    <i class="bx bx-plus me-1"></i>Tambah Item Pertama
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($inventories->hasPages())
                        <div class="d-flex justify-content-center mt-4">
                            {{ $inventories->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function exportExcel() {
        const form = document.querySelector('form[method="GET"]');
        const formData = new FormData(form);
        const params = new URLSearchParams(formData);

        window.location.href = '{{ route("inventory.export.excel") }}?' + params.toString();
    }

    function printTable() {
        try {
            // Get current filters with null checks
            const search = document.querySelector('input[name="search"]')?.value || '';
            const category = document.querySelector('select[name="category"]')?.value || '';
            const condition = document.querySelector('select[name="condition"]')?.value || '';

            // Build filter info
            let filterInfo = '';
            if (search) filterInfo += `<p><strong>Pencarian:</strong> ${search}</p>`;
            if (category) filterInfo += `<p><strong>Kategori:</strong> ${category}</p>`;
            if (condition) filterInfo += `<p><strong>Kondisi:</strong> ${condition}</p>`;

            // Get table content
            const originalTable = document.querySelector('.table');
            if (!originalTable) {
                alert('Tabel tidak ditemukan!');
                return;
            }

            const table = originalTable.cloneNode(true);

            // Remove action column (last column)
            const actionHeaders = table.querySelectorAll('th:last-child, td:last-child');
            actionHeaders.forEach(header => header.remove());

        // Create print content
        const printContent = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Laporan Inventory - Gereja Toraja Jemaat Eben-Haezer Selili</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 20px;
                        font-size: 12px;
                    }
                    .header {
                        text-align: center;
                        margin-bottom: 30px;
                        border-bottom: 2px solid #8B4513;
                        padding-bottom: 20px;
                    }
                    .header h1 {
                        color: #8B4513;
                        margin: 0;
                        font-size: 18px;
                    }
                    .header h2 {
                        color: #666;
                        margin: 5px 0;
                        font-size: 14px;
                        font-weight: normal;
                    }
                    .filter-info {
                        margin-bottom: 20px;
                        padding: 10px;
                        background-color: #f8f9fa;
                        border-radius: 5px;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                    }
                    th, td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                        font-size: 10px;
                    }
                    th {
                        background-color: #8B4513;
                        color: white;
                        font-weight: bold;
                        text-align: center;
                    }
                    tr:nth-child(even) {
                        background-color: #f9f9f9;
                    }
                    .text-center { text-align: center; }
                    .text-right { text-align: right; }
                    .footer {
                        margin-top: 30px;
                        text-align: right;
                    }
                    @media print {
                        body { margin: 0; }
                        .no-print { display: none; }
                    }
                </style>
            </head>
            <body>
                <div class="header">
                    <h1>GEREJA TORAJA JEMAAT EBEN-HAEZER SELILI</h1>
                    <h2>LAPORAN INVENTORY BARANG</h2>
                </div>

                <div class="filter-info">
                    <p><strong>Tanggal Cetak:</strong> ${new Date().toLocaleString('id-ID')}</p>
                    ${filterInfo}
                </div>

                ${table.outerHTML}

                <div class="footer">
                    <p>Dicetak pada: ${new Date().toLocaleString('id-ID')}</p>
                </div>
            </body>
            </html>
        `;

            // Create a new window for printing
            const printWindow = window.open('', '_blank', 'width=800,height=600');

            if (!printWindow) {
                // Fallback if popup is blocked
                alert('Popup diblokir! Silakan izinkan popup untuk mencetak atau gunakan Ctrl+P untuk mencetak halaman ini.');
                return;
            }

            printWindow.document.write(printContent);
            printWindow.document.close();

            // Wait for content to load then print
            setTimeout(() => {
                printWindow.print();
                setTimeout(() => {
                    printWindow.close();
                }, 1000);
            }, 500);

        } catch (error) {
            console.error('Error saat mencetak:', error);
            alert('Terjadi error saat mencetak. Silakan coba lagi.');
        }
    }
</script>
@endpush
