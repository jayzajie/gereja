@extends('layouts.admin')

@section('title', 'Detail Kegiatan Jemaat')

@push('styles')
<style>
    .detail-container {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .detail-header {
        background: #f8f9fa;
        padding: 20px 25px;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .detail-header h5 {
        margin: 0;
        font-weight: 600;
        color: #495057;
        font-size: 18px;
    }

    .btn-back {
        background: #6c757d;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s ease;
    }

    .btn-back:hover {
        background: #5a6268;
        color: white;
        text-decoration: none;
    }

    .detail-body {
        padding: 25px;
    }

    .info-title {
        font-size: 24px;
        font-weight: 600;
        color: #212529;
        margin-bottom: 20px;
        line-height: 1.4;
    }

    .info-meta {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .meta-label {
        font-size: 12px;
        font-weight: 500;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .meta-value {
        font-size: 14px;
        color: #495057;
        font-weight: 500;
    }

    .badge {
        font-size: 11px;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        display: inline-block;
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

    .info-content {
        background: white;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        line-height: 1.6;
        color: #495057;
    }

    .info-notes {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .notes-title {
        font-size: 14px;
        font-weight: 600;
        color: #495057;
        margin-bottom: 10px;
    }

    .notes-content {
        color: #6c757d;
        font-size: 14px;
        line-height: 1.5;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        justify-content: end;
    }

    .btn-edit {
        background: #ffc107;
        color: #212529;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s ease;
    }

    .btn-edit:hover {
        background: #e0a800;
        color: #212529;
        text-decoration: none;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s ease;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #c82333;
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="detail-container">
        <div class="detail-header">
            <h5>🎉 Detail Kegiatan Jemaat</h5>
            <a href="{{ route('information.index') }}" class="btn-back">
                ← Kembali
            </a>
        </div>

        <div class="detail-body">
            <h1 class="info-title">{{ $information->title }}</h1>

            <div class="info-meta">
                <div class="meta-item">
                    <span class="meta-label">Kategori</span>
                    <span class="meta-value">
                        <span class="badge badge-primary">{{ $information->category_label }}</span>
                        @if($information->subcategory)
                            <br><small class="text-muted">{{ $information->subcategory_label }}</small>
                        @endif
                    </span>
                </div>

                <div class="meta-item">
                    <span class="meta-label">Status</span>
                    <span class="meta-value">
                        @php
                            $statusClass = match($information->status) {
                                'published' => 'badge-success',
                                'draft' => 'badge-secondary',
                                'archived' => 'badge-warning',
                                default => 'badge-secondary'
                            };
                        @endphp
                        <span class="badge {{ $statusClass }}">{{ $information->status_label }}</span>
                    </span>
                </div>

                <div class="meta-item">
                    <span class="meta-label">Prioritas</span>
                    <span class="meta-value">
                        @php
                            $priorityClass = match($information->priority) {
                                'high' => 'badge-warning',
                                'medium' => 'badge-primary',
                                'low' => 'badge-secondary',
                                default => 'badge-secondary'
                            };
                        @endphp
                        <span class="badge {{ $priorityClass }}">{{ $information->priority_label }}</span>
                    </span>
                </div>

                <div class="meta-item">
                    <span class="meta-label">Tanggal Publikasi</span>
                    <span class="meta-value">{{ $information->publish_date?->format('d F Y') ?: 'Belum ditentukan' }}</span>
                </div>

                <div class="meta-item">
                    <span class="meta-label">Dibuat</span>
                    <span class="meta-value">{{ $information->created_at->format('d F Y H:i') }}</span>
                </div>

                @if($information->updated_at != $information->created_at)
                    <div class="meta-item">
                        <span class="meta-label">Diperbarui</span>
                        <span class="meta-value">{{ $information->updated_at->format('d F Y H:i') }}</span>
                    </div>
                @endif
            </div>

            <div class="info-content">
                {!! nl2br(e($information->content)) !!}
            </div>

            @if($information->notes)
                <div class="info-notes">
                    <div class="notes-title">📝 Catatan</div>
                    <div class="notes-content">{{ $information->notes }}</div>
                </div>
            @endif

            <div class="action-buttons">
                <a href="{{ route('information.edit', $information) }}" class="btn-edit">
                    ✏️ Edit
                </a>
                <form action="{{ route('information.destroy', $information) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">
                        🗑️ Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
