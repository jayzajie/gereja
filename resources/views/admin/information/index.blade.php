@extends('layouts.admin')

@section('title', 'Kegiatan Jemaat')

@push('styles')
<style>
    .information-container {
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

    .filter-section {
        background: #f8f9fa;
        padding: 15px 25px;
        border-bottom: 1px solid #e9ecef;
    }

    .filter-form {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .filter-group label {
        font-size: 12px;
        font-weight: 500;
        color: #6c757d;
        margin: 0;
    }

    .filter-control {
        padding: 6px 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 14px;
        background: white;
        min-width: 120px;
    }

    .filter-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
    }

    .information-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
        background: white;
    }

    .information-table thead th {
        background: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        color: #495057;
        font-size: 14px;
        padding: 15px 12px;
        text-align: left;
    }

    .information-table tbody td {
        padding: 15px 12px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
    }

    .information-table tbody tr:hover {
        background: #f8f9fa;
    }

    .info-title {
        font-weight: 600;
        color: #212529;
        margin-bottom: 4px;
    }

    .info-excerpt {
        color: #6c757d;
        font-size: 12px;
        line-height: 1.4;
    }

    .badge {
        font-size: 11px;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
    }

    .badge-primary {
        background: #cce7ff;
        color: #004085;
    }

    .badge-success {
        background: #d4edda;
        color: #155724;
    }

    .badge-warning {
        background: #fff3cd;
        color: #856404;
    }

    .badge-secondary {
        background: #e2e3e5;
        color: #383d41;
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
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 4px;
        border: 1px solid;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-view {
        color: #007bff;
        border-color: #007bff;
        background: white;
    }

    .btn-view:hover {
        background: #007bff;
        color: white;
    }

    .btn-edit {
        color: #ffc107;
        border-color: #ffc107;
        background: white;
    }

    .btn-edit:hover {
        background: #ffc107;
        color: white;
    }

    .btn-delete {
        color: #dc3545;
        border-color: #dc3545;
        background: white;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
    }

    .export-buttons {
        display: flex;
        gap: 10px;
    }

    .btn-export {
        padding: 8px 16px;
        font-size: 12px;
        border-radius: 4px;
        border: 1px solid;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }



    .btn-pdf {
        color: #dc3545;
        border-color: #dc3545;
        background: white;
    }

    .btn-pdf:hover {
        background: #dc3545;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="information-container">
        <div class="table-header-section">
            <h5>🎉 Kegiatan Jemaat</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('information.create') }}" class="btn-create">
                    ➕ Tambah Kegiatan
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form method="GET" class="filter-form">

                <div class="filter-group">
                    <label>Status</label>
                    <select name="status" class="filter-control" id="statusFilter">
                        <option value="">Semua Status</option>
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label>Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari informasi..." class="filter-control" style="min-width: 200px;">
                </div>
                <div class="filter-group">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-sm">🔍 Filter</button>
                </div>

                <!-- Filter Status Indicator -->
                @if(request('status') || request('search'))
                    <div class="filter-group">
                        <small class="text-muted">
                            Filter aktif:
                            @if(request('status'))
                                Status: <strong>{{ $statuses[request('status')] ?? request('status') }}</strong>
                            @endif
                            @if(request('search'))
                                @if(request('status')) | @endif
                                Pencarian: <strong>"{{ request('search') }}"</strong>
                            @endif
                            <a href="{{ route('information.index') }}" class="btn btn-link btn-sm p-0 ml-2">Reset</a>
                        </small>
                    </div>
                @endif
            </form>
        </div>

        <!-- Results Info -->
        <div class="mb-3 px-3">
            <small class="text-muted">
                Menampilkan {{ $informations->count() }} dari {{ $informations->total() }} data
                @if(request('status') || request('search'))
                    (difilter)
                @endif
            </small>
        </div>

        <div class="table-responsive">
            <table class="information-table">
                <thead>
                    <tr>
                        <th>Informasi</th>
                        <th style="text-align: center;">Tanggal</th>
                        <th style="text-align: center;">Prioritas</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($informations as $item)
                        <tr>
                            <td>
                                <div class="info-title">{{ $item->title }}</div>
                                <div class="info-excerpt">{{ Str::limit($item->content, 100) }}</div>
                            </td>
                            <td style="text-align: center;">
                                <div>{{ $item->publish_date?->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                            </td>
                            <td style="text-align: center;">
                                @php
                                    $priorityClass = match($item->priority) {
                                        'high' => 'badge-warning',
                                        'medium' => 'badge-primary',
                                        'low' => 'badge-secondary',
                                        default => 'badge-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $priorityClass }}">
                                    {{ $item->priority_label }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                @php
                                    $statusClass = match($item->status) {
                                        'published' => 'badge-success',
                                        'draft' => 'badge-secondary',
                                        'archived' => 'badge-warning',
                                        default => 'badge-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">
                                    {{ $item->status_label }}
                                </span>
                            </td>
                            <td class="action-cell">
                                <div class="btn-action-group">
                                    <a href="{{ route('information.show', $item) }}" class="btn-action btn-view">
                                        👁️ Lihat
                                    </a>
                                    <a href="{{ route('information.edit', $item) }}" class="btn-action btn-edit">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('information.destroy', $item) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bx bx-info-circle" style="font-size: 48px;"></i>
                                    <p class="mt-2">Belum ada kegiatan</p>
                                    <small>Klik tombol "Tambah Kegiatan" untuk menambahkan kegiatan baru</small>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($informations->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $informations->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-submit form when status filter changes
    const statusSelect = document.getElementById('statusFilter');
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            this.form.submit();
        });
    }

    // Auto-submit form when search input changes (with debounce)
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                this.form.submit();
            }, 500); // Wait 500ms after user stops typing
        });
    }
});
</script>
@endpush
