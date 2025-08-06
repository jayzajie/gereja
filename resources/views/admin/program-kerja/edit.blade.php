@extends('layouts.admin')

@section('title', 'Edit Program Kerja')

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

    .form-content {
        padding: 25px;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        flex: 1;
        margin-bottom: 20px;
    }

    .form-group.full-width {
        flex: 100%;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
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
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 4px;
        font-size: 12px;
        color: #dc3545;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 10px;
    }

    .form-check input[type="checkbox"] {
        width: 16px;
        height: 16px;
    }

    .form-check label {
        margin-bottom: 0;
        font-weight: 400;
        cursor: pointer;
    }

    .form-actions {
        background: #f8f9fa;
        padding: 20px 25px;
        border-top: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .btn-group {
        display: flex;
        gap: 12px;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: #007bff;
        color: white;
    }

    .btn-primary:hover {
        background: #0056b3;
        color: white;
        text-decoration: none;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
        color: white;
        text-decoration: none;
    }

    .btn-warning {
        background: #ffc107;
        color: #212529;
    }

    .btn-warning:hover {
        background: #e0a800;
        color: #212529;
        text-decoration: none;
    }

    .file-input-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .file-input {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-input-display {
        display: flex;
        align-items: center;
        padding: 10px 12px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        background: white;
        cursor: pointer;
        transition: border-color 0.2s ease;
    }

    .file-input-display:hover {
        border-color: #007bff;
    }

    .file-input-text {
        flex: 1;
        color: #6c757d;
        font-size: 14px;
    }

    .file-input-button {
        background: #f8f9fa;
        border: 1px solid #ced4da;
        padding: 4px 12px;
        border-radius: 3px;
        font-size: 12px;
        color: #495057;
    }

    .help-text {
        font-size: 12px;
        color: #6c757d;
        margin-top: 4px;
    }



    .current-image {
        max-width: 200px;
        height: auto;
        border-radius: 4px;
        margin-bottom: 10px;
        border: 1px solid #dee2e6;
    }

    .image-info {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 4px;
        padding: 10px;
        margin-bottom: 10px;
        font-size: 12px;
        color: #6c757d;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .form-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .form-actions {
            flex-direction: column;
            gap: 15px;
        }

        .btn-group {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="form-container">
        <!-- Form Header -->
        <div class="form-header">
            <h5>Edit Program Kerja</h5>
            <a href="{{ route('program-kerja.index') }}" class="btn-back">
                <i class="bx bx-arrow-back"></i>
                Kembali
            </a>
        </div>

        <!-- Form Content -->
        <form action="{{ route('program-kerja.update', $programKerja) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-content">
                <!-- Basic Information -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="title" class="required">Nama Program</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title', $programKerja->title) }}"
                               placeholder="Masukkan nama program kerja">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="komisi" class="required">Komisi</label>
                        <input type="text" class="form-control @error('komisi') is-invalid @enderror"
                               id="komisi" name="komisi" value="{{ old('komisi', $komisi) }}"
                               placeholder="Masukkan nama komisi">
                        @error('komisi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label for="author" class="required">Penulis/PIC</label>
                        <input type="text" class="form-control @error('author') is-invalid @enderror"
                               id="author" name="author" value="{{ old('author', $programKerja->author) }}"
                               placeholder="Nama penulis atau PIC">
                        @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Content -->
                <div class="form-group full-width">
                    <label for="content" class="required">Deskripsi Program</label>
                    @php
                        // Remove komisi line from content for editing
                        $contentForEdit = preg_replace('/^Komisi: .+?\\n\\n/', '', $programKerja->content);
                    @endphp
                    <textarea class="form-control @error('content') is-invalid @enderror"
                              id="content" name="content" rows="6"
                              placeholder="Masukkan deskripsi lengkap program kerja...">{{ old('content', $contentForEdit) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>











                <!-- Featured -->
                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1"
                               {{ old('is_featured', $programKerja->is_featured) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_featured">
                            Tampilkan di halaman utama (Featured)
                        </label>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <div class="help-text">
                    <i class="bx bx-info-circle"></i>
                    Field yang bertanda (*) wajib diisi
                </div>
                <div class="btn-group">
                    <a href="{{ route('program-kerja.index') }}" class="btn btn-secondary">
                        <i class="bx bx-x"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bx bx-save"></i>
                        Update Program
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // File input display
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('image');
        const fileInputText = document.querySelector('.file-input-text');
        const originalText = fileInputText.textContent;

        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    fileInputText.textContent = this.files[0].name;
                } else {
                    fileInputText.textContent = originalText;
                }
            });
        }
    });
</script>
@endpush
