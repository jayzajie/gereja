@extends('layouts.admin')

@section('title', 'Program Kerja')

@push('styles')
<style>
    .program-kerja-container {
        background: white;
        border: none;
        border-radius: 0;
        overflow: hidden;
        margin: 0;
        box-shadow: none;
    }

    .table-header-section {
        background: white;
        padding: 20px 25px;
        border-bottom: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header-section h5 {
        margin: 0;
        font-weight: 600;
        color: #6c757d;
        font-size: 20px;
        text-shadow: none;
    }

    .header-actions {
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-input {
        padding: 8px 12px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 14px;
        width: 200px;
        background: white;
        transition: border-color 0.2s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #007bff;
        background: white;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
    }

    .search-input::placeholder {
        color: #6c757d;
    }

    .btn-create {
        background: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s ease;
        box-shadow: none;
    }

    .btn-create:hover {
        background: #0056b3;
        color: white;
        text-decoration: none;
        transform: none;
        box-shadow: none;
    }

    .program-table-wrapper {
        background: white;
        overflow-x: auto;
        position: relative;
    }

    .program-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
        background: white;
    }

    .program-table thead th {
        background: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        color: #495057;
        font-size: 14px;
        padding: 15px 12px;
        text-align: left;
    }

    .program-table thead th:last-child::after {
        content: "⚙";
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
        color: #6c757d;
    }

    .program-table tbody td {
        padding: 15px 12px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
    }

    .program-table tbody tr:hover {
        background: #f8f9fa;
    }

    .komisi-cell {
        font-weight: 500;
        color: #495057;
        text-align: left;
        vertical-align: middle;
        width: 150px;
    }

    .program-cell {
        color: #495057;
        line-height: 1.5;
        font-weight: 400;
        text-align: left;
    }

    .program-cell strong {
        color: #212529;
        font-weight: 600;
        display: block;
        margin-bottom: 4px;
    }

    .program-cell small {
        color: #6c757d;
        font-size: 12px;
        line-height: 1.4;
    }

    .date-cell {
        text-align: center;
        vertical-align: middle;
        width: 120px;
        font-weight: 500;
    }



    .action-cell {
        text-align: center !important;
        vertical-align: middle;
    }

    .btn-action-group {
        display: flex;
        gap: 8px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 8px;
        font-size: 18px;
        border-radius: 8px;
        border: 2px solid;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        text-decoration: none;
        line-height: 1;
    }

    .btn-action i {
        font-size: 16px;
    }

    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        text-decoration: none;
    }

    .btn-view {
        border-color: #17a2b8;
        color: #17a2b8;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .btn-view:hover {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
    }

    .btn-edit {
        border-color: #ffc107;
        color: #ffc107;
        background: linear-gradient(135deg, #ffffff 0%, #fff8e1 100%);
    }

    .btn-edit:hover {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
    }

    .btn-delete {
        border-color: #dc3545;
        color: #dc3545;
        background: linear-gradient(135deg, #ffffff 0%, #ffebee 100%);
    }

    .btn-delete:hover {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
    }

    .pagination-section {
        background: #f8f9fa;
        padding: 15px 20px;
        border-top: 1px solid #dee2e6;
        text-align: center;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 16px;
        color: #dee2e6;
    }

    .empty-state h5 {
        margin-bottom: 8px;
        color: #495057;
    }

    .empty-state p {
        margin-bottom: 20px;
    }

    /* Tooltip untuk button */
    .btn-action::after {
        content: attr(data-tooltip);
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0,0,0,0.8);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s ease;
        z-index: 1000;
    }

    .btn-action:hover::after {
        opacity: 1;
    }

    /* Alert styles */
    .alert {
        padding: 12px 16px;
        margin: 20px;
        border-radius: 4px;
        border: 1px solid transparent;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Program Kerja Container -->
    <div class="program-kerja-container">
        <!-- Table Header Section -->
        <div class="table-header-section">
            <div>
                <h5>Program Kerja</h5>
            </div>
            <div class="header-actions">
                <div class="search-box">
                    <input type="text" class="search-input" placeholder="Cari program..." id="searchInput">
                </div>
                <a href="{{ route('program-kerja.create') }}" class="btn-create">
                    Tambah Program
                </a>
            </div>
        </div>

        <!-- Program Table -->
        <div class="program-table-wrapper">
            @if($programKerja->count() > 0)
                <table class="program-table">
                    <thead>
                        <tr>
                            <th style="width: 150px;">Komisi</th>
                            <th>Nama Program</th>
                            <th style="width: 120px; text-align: center;">Tanggal</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($programKerja as $item)
                            @php
                                // Extract komisi from content
                                preg_match('/^Komisi: (.+?)\\n/', $item->content, $matches);
                                $komisi = $matches[1] ?? 'Tidak ada komisi';
                                $komisiShort = explode(' - ', $komisi)[0] ?? $komisi;
                            @endphp
                            <tr>
                                <td class="komisi-cell">
                                    {{ $komisiShort }}
                                </td>
                                <td class="program-cell">
                                    <strong>{{ $item->title }}</strong>
                                    @if($item->excerpt)
                                        <br><small class="text-muted">{{ Str::limit($item->excerpt, 100) }}</small>
                                    @endif
                                </td>
                                <td class="date-cell">
                                    {{ $item->publish_date->format('d/m/Y') }}
                                </td>
                                <td class="action-cell">
                                    <div class="btn-action-group">
                                        <a href="{{ route('program-kerja.edit', $item) }}" class="btn-action btn-edit" data-tooltip="✏️ Edit Program">
                                            ✏️
                                        </a>
                                        <form action="{{ route('program-kerja.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('🗑️ Apakah Anda yakin ingin menghapus program ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" data-tooltip="🗑️ Hapus Program">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    📂
                    <h5>Belum Ada Program Kerja</h5>
                    <p>Mulai dengan menambahkan program kerja pertama Anda.</p>
                    <a href="{{ route('program-kerja.create') }}" class="btn-create">
                        ➕ Tambah Program Kerja
                    </a>
                </div>
            @endif
        </div>

        <!-- Pagination Section -->
        @if($programKerja->hasPages())
            <div class="pagination-section">
                {{ $programKerja->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('.program-table tbody tr');

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                tableRows.forEach(row => {
                    const komisi = row.querySelector('.komisi-cell').textContent.toLowerCase();
                    const program = row.querySelector('.program-cell').textContent.toLowerCase();

                    if (komisi.includes(searchTerm) || program.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>
@endpush
