@extends('layouts.admin')

@section('title', 'Edit Kegiatan Jemaat')

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

    .btn-submit {
        background: #ffc107;
        color: #212529;
        border: none;
        padding: 12px 24px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .btn-submit:hover {
        background: #e0a800;
    }

    .btn-cancel {
        background: #6c757d;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        transition: background 0.2s ease;
    }

    .btn-cancel:hover {
        background: #5a6268;
        color: white;
        text-decoration: none;
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="form-container">
        <div class="form-header">
            <h5>🎉 Edit Kegiatan Jemaat</h5>
            <a href="{{ route('information.show', $information) }}" class="btn-back">
                ← Kembali
            </a>
        </div>

        <div class="form-body">
            <form action="{{ route('information.update', $information) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title" class="required">Judul</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $information->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Hidden fields untuk kategori, subcategory, dan priority dengan nilai dari data existing -->
                <input type="hidden" name="category" value="{{ old('category', $information->category) }}">
                <input type="hidden" name="subcategory" value="{{ old('subcategory', $information->subcategory) }}">
                <input type="hidden" name="priority" value="{{ old('priority', $information->priority) }}">

                <div class="form-group">
                    <label for="content" class="required">Konten</label>
                    <textarea name="content" id="content" rows="8" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $information->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">📷 Foto Kegiatan</label>
                    @if($information->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $information->image) }}" alt="Current Image" style="max-width: 200px; height: auto; border-radius: 8px;">
                            <p class="text-muted small mt-1">Foto saat ini</p>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    <small class="form-text text-muted">Format yang didukung: JPG, JPEG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status" class="required">Status</label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="">Pilih Status</option>
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ old('status', $information->status) === $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="publish_date">Tanggal Publikasi</label>
                    <input type="date" name="publish_date" id="publish_date" class="form-control @error('publish_date') is-invalid @enderror"
                           value="{{ old('publish_date', $information->publish_date?->format('Y-m-d')) }}">
                    @error('publish_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="notes">Catatan</label>
                    <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $information->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{ route('information.show', $information) }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">💾 Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
