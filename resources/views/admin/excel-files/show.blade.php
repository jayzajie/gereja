@extends('layouts.admin')

@section('title', 'Detail File Excel')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4" style="color: #8B4513;">
                    @if($category == 'data-jemaat')
                        <span class="text-muted fw-light">👥 Data Jemaat /</span> 👁️ Detail File
                    @elseif($category == 'program-kerja')
                        <span class="text-muted fw-light">📋 Program Kerja Jemaat /</span> 👁️ Detail File
                    @else
                        <span class="text-muted fw-light">🏠 Dashboard / 📊 Manajemen File Excel /</span> 👁️ Detail File
                    @endif
                </h4>
                @php
                    $backRoute = route('excel-files.index');
                    $editRoute = route('excel-files.edit', $excelFile);
                    if($category) {
                        $backRoute = route('excel-files.index', ['category' => $category]);
                        $editRoute = route('excel-files.edit', ['excel_file' => $excelFile, 'category' => $category]);
                    }
                @endphp
                <div class="btn-group">
                    <a href="{{ $backRoute }}" class="btn btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i>⬅️ Kembali
                    </a>
                    <a href="{{ $editRoute }}" class="btn btn-warning">
                        <i class="bx bx-edit me-1"></i>✏️ Edit
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bx bx-error-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- File Information -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">📄 Informasi File</h5>
                </div>
                <div class="card-body">
                    <!-- File Icon and Name -->
                    <div class="d-flex align-items-center mb-4">
                        <div class="avatar avatar-xl me-3">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="bx bx-file-blank fs-2"></i>
                            </span>
                        </div>
                        <div>
                            <h4 class="mb-1">{{ $excelFile->original_name }}</h4>
                            <p class="text-muted mb-0">
                                @if($excelFile->description)
                                    {{ $excelFile->description }}
                                @else
                                    <em>Tidak ada deskripsi</em>
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- File Details -->
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-medium">📊 Ukuran File:</td>
                                    <td>{{ $excelFile->formatted_file_size }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">📋 Tipe MIME:</td>
                                    <td>{{ $excelFile->mime_type ?? 'N/A' }}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-medium">📅 Tanggal Upload:</td>
                                    <td>{{ $excelFile->uploaded_at->format('d M Y H:i') }}</td>
                                </tr>

                                <tr>
                                    <td class="fw-medium">🔄 Terakhir Diubah:</td>
                                    <td>{{ $excelFile->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- File Status Check -->
                    <div class="alert {{ $excelFile->file_exists ? 'alert-success' : 'alert-danger' }}">
                        <div class="d-flex align-items-center">
                            <i class="bx {{ $excelFile->file_exists ? 'bx-check-circle' : 'bx-error-circle' }} fs-4 me-2"></i>
                            <div>
                                <h6 class="mb-1">Status File di Server</h6>
                                <small>
                                    @if($excelFile->file_exists)
                                        File tersedia dan dapat didownload
                                    @else
                                        File tidak ditemukan di server
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">⚙️ Aksi</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($excelFile->file_exists)
                            <a href="{{ route('excel-files.download', $excelFile) }}"
                               class="btn btn-info">
                                <i class="bx bx-download me-2"></i>📥 Download File
                            </a>
                        @else
                            <button class="btn btn-info" disabled>
                                <i class="bx bx-download me-2"></i>📥 File Tidak Tersedia
                            </button>
                        @endif

                        <a href="{{ route('excel-files.edit', $excelFile) }}"
                           class="btn btn-warning">
                            <i class="bx bx-edit me-2"></i>✏️ Edit File
                        </a>

                        <form action="{{ route('excel-files.destroy', $excelFile) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus file ini? Aksi ini tidak dapat dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bx bx-trash me-2"></i>🗑️ Hapus File
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- File Statistics -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">📊 Statistik</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Usia File:</span>
                        <span class="fw-medium">{{ $excelFile->uploaded_at->diffForHumans() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Terakhir Diubah:</span>
                        <span class="fw-medium">{{ $excelFile->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">ID File:</span>
                        <span class="fw-medium">#{{ $excelFile->id }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Info -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">ℹ️ Info Cepat</h5>
                </div>
                <div class="card-body">
                    <small class="text-muted">
                        <strong>Path File:</strong><br>
                        <code>{{ $excelFile->file_path }}</code>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
