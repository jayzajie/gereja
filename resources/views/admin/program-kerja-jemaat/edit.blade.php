@extends('layouts.admin')

@section('title', 'Edit Program Kerja Jemaat Selili')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">✏️ Edit Program Kerja Jemaat Selili</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('program-kerja-jemaat.show', $programKerjaJemaat->id) }}" class="btn btn-info">
                            👁️ <i class="bx bx-show me-1"></i>Lihat
                        </a>
                        <a href="{{ route('program-kerja-jemaat.index') }}" class="btn btn-outline-secondary">
                            ⬅️ <i class="bx bx-arrow-back me-1"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('program-kerja-jemaat.update', $programKerjaJemaat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Tanggal Posting -->
                        <div class="mb-3">
                            <label for="publish_date" class="form-label">Tanggal Posting <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('publish_date') is-invalid @enderror"
                                   id="publish_date" name="publish_date"
                                   value="{{ old('publish_date', $programKerjaJemaat->publish_date) }}" required>
                            @error('publish_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Program -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Nama Program <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title', $programKerjaJemaat->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload File -->
                        <div class="mb-3">
                            <label for="file" class="form-label">📎 Upload File (Opsional)</label>
                            @if($programKerjaJemaat->file_path)
                                <div class="mb-2">
                                    <small class="text-muted">File saat ini: </small>
                                    <a href="{{ asset('storage/' . $programKerjaJemaat->file_path) }}" target="_blank" class="text-primary">
                                        📄 {{ basename($programKerjaJemaat->file_path) }}
                                    </a>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                   id="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx">
                            <div class="form-text">
                                Format yang didukung: PDF, DOC, DOCX, XLS, XLSX. Maksimal ukuran: 5MB
                                @if($programKerjaJemaat->file_path)
                                    <br><small class="text-warning">Upload file baru akan mengganti file yang ada</small>
                                @endif
                            </div>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Hidden fields untuk kompatibilitas dengan controller -->
                        <input type="hidden" name="komisi" value="Jemaat Selili">
                        <input type="hidden" name="content" value="Program Kerja Jemaat Selili">
                        <input type="hidden" name="author" value="Admin">

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('program-kerja-jemaat.show', $programKerjaJemaat->id) }}" class="btn btn-outline-secondary">
                                ❌ <i class="bx bx-x me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                💾 <i class="bx bx-save me-1"></i>Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
