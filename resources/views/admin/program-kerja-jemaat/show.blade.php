@extends('layouts.admin')

@section('title', 'Detail Program Kerja Jemaat Selili')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">👁️ Detail Program Kerja Jemaat Selili</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('program-kerja-jemaat.edit', $programKerjaJemaat->id) }}" class="btn btn-warning">
                            ✏️ <i class="bx bx-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('program-kerja-jemaat.index') }}" class="btn btn-outline-secondary">
                            ⬅️ <i class="bx bx-arrow-back me-1"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Title -->
                            <div class="mb-4">
                                <h3 class="mb-2">{{ $programKerjaJemaat->title }}</h3>
                                @if($programKerjaJemaat->is_featured)
                                    <span class="badge bg-warning">Program Unggulan</span>
                                @endif
                                <span class="badge bg-{{ $programKerjaJemaat->status === 'published' ? 'success' : 'warning' }}">
                                    {{ ucfirst($programKerjaJemaat->status) }}
                                </span>
                            </div>

                            <!-- Excerpt -->
                            @if($programKerjaJemaat->excerpt)
                                <div class="mb-4">
                                    <h6 class="text-muted">Ringkasan:</h6>
                                    <p class="lead">{{ $programKerjaJemaat->excerpt }}</p>
                                </div>
                            @endif

                            <!-- Content -->
                            <div class="mb-4">
                                <h6 class="text-muted">Deskripsi Program Kerja:</h6>
                                <div class="content-display">
                                    {!! nl2br(e($programKerjaJemaat->content)) !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <!-- Image -->
                            @if($programKerjaJemaat->image)
                                <div class="mb-4">
                                    <h6 class="text-muted">Gambar:</h6>
                                    <img src="{{ asset('storage/' . $programKerjaJemaat->image) }}"
                                         alt="{{ $programKerjaJemaat->title }}"
                                         class="img-fluid rounded">
                                </div>
                            @endif

                            <!-- File -->
                            @if($programKerjaJemaat->file_path)
                                <div class="mb-4">
                                    <h6 class="text-muted">File Lampiran:</h6>
                                    <div class="border rounded p-3">
                                        <div class="d-flex align-items-center">
                                            <i class="bx bx-file me-2" style="font-size: 1.5rem; color: #6c757d;"></i>
                                            <div>
                                                <a href="{{ asset('storage/' . $programKerjaJemaat->file_path) }}" target="_blank" class="text-primary fw-bold">
                                                    📎 {{ $programKerjaJemaat->file_name ?? basename($programKerjaJemaat->file_path) }}
                                                </a>
                                                @if($programKerjaJemaat->file_size)
                                                    <br><small class="text-muted">Ukuran: {{ number_format($programKerjaJemaat->file_size / 1024, 2) }} KB</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Details -->
                            <div class="mb-4">
                                <h6 class="text-muted">Detail:</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>Penulis:</strong></td>
                                        <td>{{ $programKerjaJemaat->author }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Tanggal Publish:</strong></td>
                                        <td>{{ \Carbon\Carbon::parse($programKerjaJemaat->publish_date)->format('d F Y') }}</td>
                                    </tr>
                                    @if($programKerjaJemaat->event_date)
                                        <tr>
                                            <td><strong>Tanggal Kegiatan:</strong></td>
                                            <td>{{ \Carbon\Carbon::parse($programKerjaJemaat->event_date)->format('d F Y') }}</td>
                                        </tr>
                                    @endif
                                    @if($programKerjaJemaat->location)
                                        <tr>
                                            <td><strong>Lokasi:</strong></td>
                                            <td>{{ $programKerjaJemaat->location }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td><strong>Prioritas:</strong></td>
                                        <td>{{ $programKerjaJemaat->priority }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kategori:</strong></td>
                                        <td>
                                            <span class="badge bg-info">Program Kerja Jemaat</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Dibuat:</strong></td>
                                        <td>{{ $programKerjaJemaat->created_at->format('d F Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Diupdate:</strong></td>
                                        <td>{{ $programKerjaJemaat->updated_at->format('d F Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <a href="{{ route('program-kerja-jemaat.index') }}" class="btn btn-outline-secondary">
                                        ⬅️ <i class="bx bx-arrow-back me-1"></i>Kembali ke Daftar
                                    </a>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('program-kerja-jemaat.edit', $programKerjaJemaat->id) }}" class="btn btn-warning">
                                        ✏️ <i class="bx bx-edit me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('program-kerja-jemaat.destroy', $programKerjaJemaat->id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus program kerja ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            🗑️ <i class="bx bx-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.content-display {
    background-color: #f8f9fa;
    padding: 1rem;
    border-radius: 0.375rem;
    border-left: 4px solid #0d6efd;
}
</style>
@endsection
