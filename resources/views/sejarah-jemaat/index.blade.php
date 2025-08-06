@extends('layouts.admin')

@section('title', 'Kelola Sejarah Jemaat Eben-Haezer Selili')

@push('styles')
<style>
    .form-container {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .form-header {
        background: #f8f9fa;
        padding: 20px 25px;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-header h5 {
        margin: 0;
        font-weight: 600;
        color: #495057;
        font-size: 18px;
    }

    .btn-add {
        background: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s ease;
    }

    .btn-add:hover {
        background: #0056b3;
        color: white;
        text-decoration: none;
    }

    .table-container {
        padding: 25px;
    }

    .table {
        margin-bottom: 0;
    }

    .table th {
        background: #f8f9fa;
        border-top: none;
        font-weight: 600;
        color: #495057;
        font-size: 14px;
        padding: 15px 12px;
    }

    .table td {
        padding: 15px 12px;
        vertical-align: middle;
        border-top: 1px solid #e0e0e0;
    }

    .table th:nth-child(1) { width: 60px; }
    .table th:nth-child(2) { width: 100px; }
    .table th:nth-child(3) { width: auto; }
    .table th:nth-child(4) { width: 100px; }
    .table th:nth-child(5) { width: 120px; }

    .logo-thumbnail {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #e0e0e0;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .logo-thumbnail:hover {
        transform: scale(1.1);
    }

    .no-logo-placeholder {
        width: 60px;
        height: 60px;
        background: #f8f9fa;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .no-logo-placeholder i {
        font-size: 20px;
        color: #6c757d;
        margin-bottom: 2px;
    }

    .no-logo-placeholder small {
        font-size: 10px;
        color: #6c757d;
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        align-items: center;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 4px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 14px;
        transition: all 0.2s ease;
    }

    .action-btn:hover {
        transform: translateY(-1px);
        text-decoration: none;
    }

    .btn-info { background: #17a2b8; color: white; }
    .btn-warning { background: #ffc107; color: #212529; }
    .btn-danger { background: #dc3545; color: white; }
    .btn-success { background: #28a745; color: white; }
    .btn-secondary { background: #6c757d; color: white; }

    .alert {
        margin: 20px 25px 0;
        border-radius: 4px;
    }

    .pagination-wrapper {
        padding: 20px 25px;
        border-top: 1px solid #e0e0e0;
        background: #f8f9fa;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="form-container">
        <!-- Header -->
        <div class="form-header">
            <h5>🏛️ Kelola Sejarah Jemaat Eben-Haezer Selili</h5>
            <a href="{{ route('sejarah-jemaat.create') }}" class="btn-add">
                <i class="bx bx-plus"></i>
                Tambah Sejarah
            </a>
        </div>

        <!-- Alerts -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="bx bx-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="bx bx-error-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Logo</th>
                            <th>Judul & Konten</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sejarahJemaats as $index => $sejarah)
                        <tr>
                            <td>{{ ($sejarahJemaats->currentPage() - 1) * $sejarahJemaats->perPage() + $index + 1 }}</td>
                            <td class="text-center">
                                @if($sejarah->logo && $sejarah->logo_url)
                                    <img src="{{ $sejarah->logo_url }}" alt="Logo" class="logo-thumbnail">
                                @else
                                    <div class="no-logo-placeholder">
                                        <i class="bx bx-image"></i>
                                        <small>No Logo</small>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $sejarah->title }}</strong>
                                @if($sejarah->established_year)
                                    <br><small class="text-muted">Berdiri tahun {{ $sejarah->established_year }}</small>
                                @endif
                                @if($sejarah->address)
                                    <br><small class="text-muted">📍 {{ Str::limit($sejarah->address, 50) }}</small>
                                @endif
                                <br><small class="text-muted">{{ Str::limit(strip_tags($sejarah->content), 100) }}</small>
                            </td>
                            <td>
                                <span class="badge bg-{{ $sejarah->is_active ? 'success' : 'secondary' }}">
                                    {{ $sejarah->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <!-- View Button -->
                                    <a href="{{ route('sejarah-jemaat.show', $sejarah) }}" 
                                       class="btn btn-sm btn-info action-btn" 
                                       title="👁️ Lihat Detail">
                                        👁️
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('sejarah-jemaat.edit', $sejarah) }}" 
                                       class="btn btn-sm btn-warning action-btn" 
                                       title="✏️ Edit">
                                        ✏️
                                    </a>

                                    <!-- Toggle Status Button -->
                                    <form action="{{ route('sejarah-jemaat.toggle-status', $sejarah) }}" 
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="btn btn-sm btn-{{ $sejarah->is_active ? 'secondary' : 'success' }} action-btn"
                                                title="{{ $sejarah->is_active ? '🔒 Nonaktifkan' : '🔓 Aktifkan' }}"
                                                onclick="return confirm('Yakin ingin mengubah status?')">
                                            {{ $sejarah->is_active ? '🔒' : '🔓' }}
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('sejarah-jemaat.destroy', $sejarah) }}" 
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger action-btn" 
                                                title="🗑️ Hapus"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bx bx-info-circle me-2"></i>
                                    Belum ada data sejarah jemaat. 
                                    <a href="{{ route('sejarah-jemaat.create') }}" class="text-primary">Tambah sekarang</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($sejarahJemaats->hasPages())
            <div class="pagination-wrapper">
                {{ $sejarahJemaats->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
