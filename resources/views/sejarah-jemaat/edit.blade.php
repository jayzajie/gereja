@extends('layouts.admin')

@section('title', 'Edit Sejarah Jemaat Eben-Haezer Selili')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">✏️ Edit Sejarah Jemaat Eben-Haezer Selili</h1>
            <p class="mb-0 text-muted">Perbarui informasi sejarah jemaat</p>
        </div>
        <a href="{{ route('sejarah-jemaat.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6><i class="fas fa-exclamation-triangle me-2"></i>Terdapat kesalahan:</h6>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Form Card -->
    <div class="card shadow">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">
                <i class="fas fa-edit me-2"></i>Form Edit Sejarah
            </h5>
        </div>
        <div class="card-body">
            <form action="{{ route('sejarah-jemaat.update', $sejarahJemaat) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Informasi Dasar -->
                <div class="section-title">📋 Informasi Dasar</div>

                <div class="form-group">
                    <label for="title" class="required">Judul</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $sejarahJemaat->title) }}"
                           placeholder="Contoh: Sejarah Gereja Toraja Jemaat Eben-Haezer Selili">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Konten Sejarah -->
                <div class="section-title">📝 Konten Sejarah</div>
                <div class="form-group">
                    <label for="content" class="required">Konten Sejarah</label>
                    <textarea id="content" name="content" class="form-control large-textarea @error('content') is-invalid @enderror"
                              rows="10" placeholder="Tulis sejarah jemaat di sini...">{{ old('content', $sejarahJemaat->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Upload Files -->
                <div class="section-title">🖼️ Gambar</div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="logo">Logo Jemaat</label>
                        <div class="file-upload-container">
                            <input type="file" id="logo" name="logo" class="file-input @error('logo') is-invalid @enderror"
                                   accept="image/*">
                            <div class="file-upload-text">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Pilih logo jemaat (JPG, PNG, GIF - Max: 2MB)</span>
                            </div>
                        </div>
                        @if($sejarahJemaat->logo)
                            <div class="current-file mt-2">
                                <small class="text-muted">File saat ini:</small>
                                <img src="{{ $sejarahJemaat->logo_url }}" alt="Current Logo" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        @endif
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>



                <!-- Status -->
                <div class="section-title">⚙️ Pengaturan</div>
                <div class="form-group">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                               {{ old('is_active', $sejarahJemaat->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            <strong>Status Aktif</strong>
                            <small class="text-muted d-block">Centang untuk menampilkan di website</small>
                        </label>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save"></i> Perbarui Sejarah
                    </button>
                    <a href="{{ route('sejarah-jemaat.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #495057;
    margin: 30px 0 20px 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #e9ecef;
}

.section-title:first-child {
    margin-top: 0;
}

.form-group {
    margin-bottom: 25px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
    }
}

.required::after {
    content: " *";
    color: #dc3545;
}

.large-textarea {
    min-height: 200px;
    resize: vertical;
}

.file-upload-container {
    position: relative;
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    background-color: #f8f9fa;
    transition: all 0.3s ease;
    cursor: pointer;
}

.file-upload-container:hover {
    border-color: #ffc107;
    background-color: #fff3cd;
}

.file-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.file-upload-text {
    color: #6c757d;
}

.file-upload-text i {
    font-size: 2rem;
    margin-bottom: 10px;
    display: block;
    color: #ffc107;
}

.form-actions {
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid #dee2e6;
    text-align: center;
}

.form-actions .btn {
    margin: 0 10px;
    min-width: 150px;
}

.card {
    border: none;
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

.current-file img {
    border-radius: 8px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload preview
    const fileInputs = document.querySelectorAll('.file-input');

    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const container = this.closest('.file-upload-container');
            const textElement = container.querySelector('.file-upload-text span');

            if (this.files && this.files[0]) {
                textElement.textContent = this.files[0].name;
                container.style.borderColor = '#28a745';
                container.style.backgroundColor = '#d4edda';
            }
        });
    });
});
</script>
@endsection
