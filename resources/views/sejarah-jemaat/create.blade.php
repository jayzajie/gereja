@extends('layouts.admin')

@section('title', 'Tambah Sejarah Jemaat Eben-Haezer Selili')

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

    .form-body {
        padding: 25px;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 0;
    }

    .form-group {
        flex: 1;
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #495057;
        font-size: 14px;
    }

    .form-group label.required::after {
        content: " *";
        color: #dc3545;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 12px;
        margin-top: 4px;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    textarea.large-textarea {
        min-height: 300px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #495057;
        margin: 30px 0 20px 0;
        padding: 10px 0;
        border-bottom: 2px solid #e9ecef;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title:first-child {
        margin-top: 0;
    }

    .file-input-wrapper {
        position: relative;
        display: block;
    }

    .file-input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-input-display {
        border: 2px dashed #ced4da;
        border-radius: 4px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #f8f9fa;
    }

    .file-input-display:hover {
        border-color: #007bff;
        background: #f0f8ff;
    }

    .file-input-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .file-input-content i {
        font-size: 24px;
        color: #6c757d;
    }

    .file-input-content span {
        font-weight: 500;
        color: #495057;
    }

    .file-input-content small {
        color: #6c757d;
        font-size: 12px;
    }

    .image-preview {
        margin-top: 10px;
        display: none;
    }

    .preview-container {
        text-align: center;
        padding: 10px;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        background: #f8f9fa;
    }

    .preview-info {
        margin-top: 8px;
        color: #6c757d;
    }

    .form-actions {
        padding: 20px 25px;
        border-top: 1px solid #e0e0e0;
        background: #f8f9fa;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .checkbox-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .checkbox-wrapper input[type="checkbox"] {
        width: 18px;
        height: 18px;
    }

    .btn-group {
        display: flex;
        gap: 10px;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        transition: background 0.2s ease;
    }

    .btn-secondary:hover {
        background: #5a6268;
        color: white;
        text-decoration: none;
    }

    .btn-primary {
        background: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        font-size: 14px;
        transition: background 0.2s ease;
    }

    .btn-primary:hover {
        background: #0056b3;
    }

    .alert {
        margin: 20px 25px 0;
        border-radius: 4px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="form-container">
        <!-- Form Header -->
        <div class="form-header">
            <h5>🏛️ Tambah Sejarah Jemaat Eben-Haezer Selili</h5>
            <a href="{{ route('sejarah-jemaat.index') }}" class="btn-back">
                <i class="bx bx-arrow-back"></i>
                Kembali
            </a>
        </div>

        <!-- Form Body -->
        <form action="{{ route('sejarah-jemaat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="bx bx-error-circle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            <div class="form-body">
                <!-- Informasi Dasar -->
                <div class="section-title">📋 Informasi Dasar</div>

                <div class="form-group">
                    <label for="title" class="required">Judul</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', 'Sejarah Gereja Toraja Jemaat Eben-Haezer Selili') }}"
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
                              placeholder="Masukkan konten sejarah Jemaat Eben-Haezer Selili secara lengkap...">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>



                <!-- Media -->
                <div class="section-title">🖼️ Media</div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="logo">Logo Jemaat</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="logo" name="logo" class="file-input @error('logo') is-invalid @enderror"
                                   accept="image/*" onchange="previewImage(this, 'logo-preview')">
                            <div class="file-input-display" onclick="document.getElementById('logo').click()">
                                <div class="file-input-content">
                                    <i class="bx bx-cloud-upload"></i>
                                    <span>Upload Logo</span>
                                    <small>JPG, PNG, GIF (Max: 2MB)</small>
                                </div>
                            </div>
                            <div id="logo-preview" class="image-preview"></div>
                        </div>
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- HAPUS BAGIAN BANNER INI -->
                    <!--
                    <div class="form-group">
                        <label for="banner_image">Banner/Foto Jemaat</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="banner_image" name="banner_image" class="file-input @error('banner_image') is-invalid @enderror"
                                   accept="image/*" onchange="previewImage(this, 'banner-preview')">
                            <div class="file-input-display" onclick="document.getElementById('banner_image').click()">
                                <div class="file-input-content">
                                    <i class="bx bx-cloud-upload"></i>
                                    <span>Upload Banner</span>
                                    <small>JPG, PNG, GIF (Max: 5MB)</small>
                                </div>
                            </div>
                            <div id="banner-preview" class="image-preview"></div>
                        </div>
                        @error('banner_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    -->
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <div class="checkbox-wrapper">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label for="is_active">Aktifkan sejarah ini</label>
                </div>

                <div class="btn-group">
                    <a href="{{ route('sejarah-jemaat.index') }}" class="btn-secondary">Batal</a>
                    <button type="submit" class="btn-primary">Simpan Sejarah</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(input, previewId) {
        const preview = document.getElementById(previewId);
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <div class="preview-container">
                        <img src="${e.target.result}" alt="Preview" style="max-width: 200px; max-height: 150px; border-radius: 4px;">
                        <div class="preview-info">
                            <small>${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)</small>
                        </div>
                    </div>
                `;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
            preview.style.display = 'none';
        }
    }

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const titleInput = document.getElementById('title');
        const contentInput = document.getElementById('content');

        if (!titleInput.value.trim()) {
            e.preventDefault();
            titleInput.focus();
            alert('Judul wajib diisi!');
            return false;
        }

        if (!contentInput.value.trim()) {
            e.preventDefault();
            contentInput.focus();
            alert('Konten sejarah wajib diisi!');
            return false;
        }
    });
</script>
@endpush
@endsection
