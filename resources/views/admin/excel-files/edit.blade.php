@extends('layouts.admin')

@section('title', 'Edit File Excel')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4" style="color: #8B4513;">
                    @if($category == 'data-jemaat')
                        <span class="text-muted fw-light">👥 Data Jemaat /</span> ✏️ Edit File
                    @elseif($category == 'program-kerja')
                        <span class="text-muted fw-light">📋 Program Kerja Jemaat /</span> ✏️ Edit File
                    @else
                        <span class="text-muted fw-light">🏠 Dashboard / 📊 Manajemen File Excel /</span> ✏️ Edit File
                    @endif
                </h4>
                @php
                    $backRoute = route('excel-files.index');
                    if($category) {
                        $backRoute = route('excel-files.index', ['category' => $category]);
                    }
                @endphp
                <a href="{{ $backRoute }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back me-1"></i>⬅️ Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bx bx-error-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Edit Form -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">✏️ Edit File Excel</h5>
                    <small class="text-muted">{{ $excelFile->original_name }}</small>
                </div>
                <div class="card-body">
                    <!-- Current File Info -->
                    <div class="alert alert-info mb-4">
                        <div class="d-flex align-items-center">
                            <i class="bx bx-file-blank fs-4 me-3"></i>
                            <div>
                                <h6 class="mb-1">File Saat Ini: {{ $excelFile->original_name }}</h6>
                                <small class="text-muted">
                                    Ukuran: {{ $excelFile->formatted_file_size }} |
                                    Upload: {{ $excelFile->uploaded_at->format('d M Y H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('excel-files.update', $excelFile) }}" method="POST" enctype="multipart/form-data" id="editForm">
                        @if($category)
                            <input type="hidden" name="category" value="{{ $category }}">
                        @endif
                        @csrf
                        @method('PUT')

                        <!-- File Upload (Optional) -->
                        <div class="mb-4">
                            <label for="excel_file" class="form-label">Ganti File Excel (Opsional)</label>
                            <div class="input-group">
                                <input type="file"
                                       class="form-control @error('excel_file') is-invalid @enderror"
                                       id="excel_file"
                                       name="excel_file"
                                       accept=".xlsx,.xls">
                                <span class="input-group-text">📄</span>
                            </div>
                            @error('excel_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="bx bx-info-circle me-1"></i>
                                Kosongkan jika tidak ingin mengganti file. Format: .xlsx atau .xls (maksimal 10MB)
                            </div>
                        </div>

                        <!-- New File Preview -->
                        <div id="filePreview" class="mb-4" style="display: none;">
                            <div class="alert alert-warning">
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-file-blank fs-4 me-3"></i>
                                    <div>
                                        <h6 class="mb-1">File Baru: <span id="fileName"></span></h6>
                                        <small id="fileSize" class="text-muted"></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">Deskripsi File</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description"
                                      name="description"
                                      rows="3"
                                      placeholder="Masukkan deskripsi file">{{ old('description', $excelFile->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- File Actions -->
                        <div class="alert alert-light">
                            <h6 class="alert-heading">🔧 Aksi File:</h6>
                            <div class="d-flex gap-2">
                                <a href="{{ route('excel-files.download', $excelFile) }}"
                                   class="btn btn-sm btn-info">
                                    <i class="bx bx-download me-1"></i>Download
                                </a>
                                @php
                                    $showRoute = route('excel-files.show', $excelFile);
                                    if($category) {
                                        $showRoute = route('excel-files.show', ['excel_file' => $excelFile, 'category' => $category]);
                                    }
                                @endphp
                                <a href="{{ $showRoute }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="bx bx-show me-1"></i>Lihat Detail
                                </a>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ $backRoute }}" class="btn btn-outline-secondary">
                                <i class="bx bx-x me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="bx bx-save me-1"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('excel_file');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    const fileSize = document.getElementById('fileSize');
    const submitBtn = document.getElementById('submitBtn');
    const editForm = document.getElementById('editForm');

    // File input change handler
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (file) {
            // Show file preview
            fileName.textContent = file.name;
            fileSize.textContent = formatFileSize(file.size);
            filePreview.style.display = 'block';

            // Validate file type
            const allowedTypes = [
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
                'application/vnd.ms-excel' // .xls
            ];

            if (!allowedTypes.includes(file.type)) {
                showAlert('danger', 'Format file tidak didukung. Gunakan file .xlsx atau .xls');
                fileInput.value = '';
                filePreview.style.display = 'none';
                return;
            }

            // Validate file size (10MB = 10 * 1024 * 1024 bytes)
            if (file.size > 10 * 1024 * 1024) {
                showAlert('danger', 'Ukuran file terlalu besar. Maksimal 10MB');
                fileInput.value = '';
                filePreview.style.display = 'none';
                return;
            }
        } else {
            filePreview.style.display = 'none';
        }
    });

    // Form submit handler
    editForm.addEventListener('submit', function(e) {
        // Disable submit button and show loading
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';
    });

    // Helper functions
    function formatFileSize(bytes) {
        const units = ['B', 'KB', 'MB', 'GB'];
        let size = bytes;
        let unitIndex = 0;

        while (size >= 1024 && unitIndex < units.length - 1) {
            size /= 1024;
            unitIndex++;
        }

        return `${size.toFixed(1)} ${units[unitIndex]}`;
    }

    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            <i class="bx bx-error-circle me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        const container = document.querySelector('.container-xxl');
        container.insertBefore(alertDiv, container.firstChild);

        // Auto dismiss after 5 seconds
        setTimeout(() => {
            alertDiv.remove();
        }, 5000);
    }
});
</script>
@endpush
@endsection
