@extends('layouts.admin')

@section('title', 'Edit Pendeta')

@push('styles')
<style>
    .form-container {
        background: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 16px;
        margin: 20px auto;
        max-width: 800px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        padding: 24px 32px;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-header h5 {
        margin: 0;
        font-weight: 600;
        color: #2c3e50;
        font-size: 22px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back {
        background: rgba(108, 117, 125, 0.1);
        color: #495057;
        border: 2px solid rgba(108, 117, 125, 0.3);
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .btn-back:hover {
        background: rgba(108, 117, 125, 0.2);
        border-color: rgba(108, 117, 125, 0.5);
        color: #495057;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .form-content {
        padding: 32px;
    }

    .form-section {
        margin-bottom: 32px;
        padding: 24px;
        background: #f8f9fa;
        border-radius: 12px;
        border: 1px solid #e9ecef;
    }

    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 20px;
        padding-bottom: 8px;
        border-bottom: 2px solid #e9ecef;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: white;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
        background: white;
    }

    .form-control:hover {
        border-color: #bdc3c7;
    }

    .form-control.is-invalid {
        border-color: #e74c3c;
        box-shadow: 0 0 0 4px rgba(231, 76, 60, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
        font-family: inherit;
    }

    .photo-upload-section {
        border: 2px dashed #bdc3c7;
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        transition: all 0.3s ease;
        background: white;
    }

    .photo-upload-section:hover {
        border-color: #3498db;
        background: #f0f8ff;
    }

    .current-photo {
        margin-bottom: 16px;
    }

    .current-photo img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 12px;
        border: 3px solid #e9ecef;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .current-photo .text-muted {
        margin-top: 8px;
        font-size: 13px;
        color: #7f8c8d;
    }

    .file-input-wrapper {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .file-input-wrapper input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-input-button {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }

    .file-input-button:hover {
        background: linear-gradient(135deg, #2980b9 0%, #1f5f8b 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
    }

    .form-text {
        display: block;
        margin-top: 8px;
        font-size: 13px;
        color: #7f8c8d;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #495057;
        font-size: 14px;
    }

    label.required::after {
        content: ' *';
        color: #dc3545;
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 5px;
        font-size: 12px;
        color: #dc3545;
    }

    .form-actions {
        margin-top: 32px;
        padding: 24px 0;
        border-top: 2px solid #e9ecef;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8f9fa;
        margin-left: -32px;
        margin-right: -32px;
        padding-left: 32px;
        padding-right: 32px;
        border-radius: 0 0 16px 16px;
    }

    .help-text {
        color: #7f8c8d;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
    }

    .btn-group {
        display: flex;
        gap: 16px;
    }

    .btn {
        padding: 14px 28px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        min-width: 140px;
        justify-content: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(39, 174, 96, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #229954 0%, #1e8449 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(39, 174, 96, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-secondary {
        background: #95a5a6;
        color: white;
        box-shadow: 0 4px 15px rgba(149, 165, 166, 0.3);
    }

    .btn-secondary:hover {
        background: #7f8c8d;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(149, 165, 166, 0.4);
        color: white;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .form-container {
            margin: 10px;
            border-radius: 12px;
        }

        .form-header {
            padding: 20px;
            flex-direction: column;
            gap: 12px;
            text-align: center;
        }

        .form-content {
            padding: 20px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .form-section {
            padding: 20px;
            margin-bottom: 20px;
        }

        .form-actions {
            flex-direction: column;
            gap: 16px;
            text-align: center;
            padding: 20px;
            margin-left: -20px;
            margin-right: -20px;
            padding-left: 20px;
            padding-right: 20px;
        }

        .btn-group {
            flex-direction: column;
            width: 100%;
            gap: 12px;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }

        .help-text {
            order: 2;
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
            <h5>✏️ Edit Pendeta</h5>
            <a href="{{ route('pastors.index') }}" class="btn-back">
                ⬅️ Kembali
            </a>
        </div>

        <!-- Form Content -->
        <div class="form-content">
            <form action="{{ route('pastors.update', $pastor) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Personal Information Section -->
                <div class="form-section">
                    <h6 class="section-title">👤 Informasi Personal</h6>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name" class="required">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $pastor->name) }}" required
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="required">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $pastor->email) }}" required
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $pastor->phone) }}"
                                class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="birth_date">Birth Date</label>
                            <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $pastor->birth_date?->format('Y-m-d')) }}"
                                class="form-control {{ $errors->has('birth_date') ? 'is-invalid' : '' }}">
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="address">Address</label>
                        <textarea name="address" id="address" rows="3"
                            class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}">{{ old('address', $pastor->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Ministry Information Section -->
                <div class="form-section">
                    <h6 class="section-title">⛪ Informasi Pelayanan</h6>

                    <div class="form-grid">
                        <div class="form-group">
                            <label for="ordination_date">Ordination Date</label>
                            <input type="date" name="ordination_date" id="ordination_date" value="{{ old('ordination_date', $pastor->ordination_date?->format('Y-m-d')) }}"
                                class="form-control {{ $errors->has('ordination_date') ? 'is-invalid' : '' }}">
                            @error('ordination_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $pastor->end_date?->format('Y-m-d')) }}"
                                class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text">Leave empty if still active</small>
                        </div>

                        <div class="form-group">
                            <label for="status" class="required">Status</label>
                            <select name="status" id="status" required
                                class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}">
                                <option value="active" {{ old('status', $pastor->status) === 'active' ? 'selected' : '' }}>✅ Active</option>
                                <option value="inactive" {{ old('status', $pastor->status) === 'inactive' ? 'selected' : '' }}>⏸️ Inactive</option>
                                <option value="retired" {{ old('status', $pastor->status) === 'retired' ? 'selected' : '' }}>🏆 Retired</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Photo Upload Section -->
                <div class="form-section">
                    <h6 class="section-title">📷 Photo</h6>

                    <div class="photo-upload-section">
                        @if($pastor->photo)
                            <div class="current-photo">
                                <img src="{{ asset('storage/' . $pastor->photo) }}" alt="Current photo">
                                <p class="text-muted">Current photo</p>
                            </div>
                        @endif

                        <div class="file-input-wrapper">
                            <input type="file" name="photo" id="photo" accept="image/*"
                                class="{{ $errors->has('photo') ? 'is-invalid' : '' }}">
                            <div class="file-input-button">
                                📁 Choose Photo
                            </div>
                        </div>

                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <small class="form-text">
                            Format: JPG, PNG. Max 2MB. Leave empty to keep current photo.
                        </small>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <div class="help-text">
                        ℹ️ Field yang bertanda (*) wajib diisi
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('pastors.index') }}" class="btn btn-secondary">
                            ❌ Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            💾 Update Pendeta
                        </button>
                    </div>
                </div>
                    </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // File upload preview
    const photoInput = document.getElementById('photo');
    const fileButton = document.querySelector('.file-input-button');
    const currentPhoto = document.querySelector('.current-photo');

    if (photoInput && fileButton) {
        photoInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                // Update button text
                fileButton.innerHTML = `📁 ${file.name}`;
                fileButton.style.background = 'linear-gradient(135deg, #27ae60 0%, #229954 100%)';

                // Create preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Remove existing preview if any
                    const existingPreview = document.querySelector('.new-photo-preview');
                    if (existingPreview) {
                        existingPreview.remove();
                    }

                    // Create new preview
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'new-photo-preview';
                    previewDiv.style.marginBottom = '16px';

                    const previewImg = document.createElement('img');
                    previewImg.src = e.target.result;
                    previewImg.style.width = '80px';
                    previewImg.style.height = '80px';
                    previewImg.style.objectFit = 'cover';
                    previewImg.style.borderRadius = '12px';
                    previewImg.style.border = '3px solid #27ae60';
                    previewImg.style.boxShadow = '0 2px 8px rgba(0,0,0,0.1)';

                    const previewText = document.createElement('p');
                    previewText.className = 'text-muted';
                    previewText.style.marginTop = '8px';
                    previewText.style.fontSize = '13px';
                    previewText.style.color = '#27ae60';
                    previewText.style.fontWeight = '500';
                    previewText.textContent = 'New photo preview';

                    previewDiv.appendChild(previewImg);
                    previewDiv.appendChild(previewText);

                    // Insert before file input wrapper
                    const fileWrapper = document.querySelector('.file-input-wrapper');
                    fileWrapper.parentNode.insertBefore(previewDiv, fileWrapper);
                };
                reader.readAsDataURL(file);
            } else {
                // Reset button text
                fileButton.innerHTML = '📁 Choose Photo';
                fileButton.style.background = 'linear-gradient(135deg, #3498db 0%, #2980b9 100%)';

                // Remove preview
                const existingPreview = document.querySelector('.new-photo-preview');
                if (existingPreview) {
                    existingPreview.remove();
                }
            }
        });
    }

    // Form validation enhancement
    const form = document.querySelector('form');
    const requiredFields = document.querySelectorAll('input[required], select[required]');

    if (form) {
        form.addEventListener('submit', function(e) {
            let hasErrors = false;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    hasErrors = true;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            if (hasErrors) {
                e.preventDefault();
                // Scroll to first error
                const firstError = document.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });
    }
});
</script>
@endpush
