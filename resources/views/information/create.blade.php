@extends('layouts.admin')

@section('title', 'Tambah Informasi')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold py-3 mb-2" style="color: #8B4513;">
                <span class="text-muted fw-light">Manajemen / Informasi /</span> Tambah
            </h4>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tambah Informasi Baru</h5>
            <a href="/information-dashboard?category=kegiatan" class="btn btn-outline-secondary btn-sm">
                <i class="bx bx-arrow-back me-1"></i>Kembali
            </a>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('information.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-8">
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-3">
                            <label for="content" class="form-label">Konten <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('content') is-invalid @enderror"
                                      id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Excerpt -->
                        <div class="mb-3">
                            <label for="excerpt" class="form-label">Ringkasan</label>
                            <textarea class="form-control @error('excerpt') is-invalid @enderror"
                                      id="excerpt" name="excerpt" rows="3"
                                      placeholder="Ringkasan singkat (opsional, akan otomatis diambil dari konten jika kosong)">{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Event Details (for kegiatan category) -->
                        <div id="event-details" style="display: none;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="event_date" class="form-label">Tanggal Acara</label>
                                        <input type="date" class="form-control @error('event_date') is-invalid @enderror"
                                               id="event_date" name="event_date" value="{{ old('event_date') }}">
                                        @error('event_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Lokasi</label>
                                        <input type="text" class="form-control @error('location') is-invalid @enderror"
                                               id="location" name="location" value="{{ old('location') }}">
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-4">
                        <!-- Category -->
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('category') is-invalid @enderror"
                                    id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $key => $value)
                                    <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Subcategory -->
                        <div class="mb-3" id="subcategory-container" style="display: none;">
                            <label for="subcategory" class="form-label">Sub Kategori</label>
                            <select class="form-select @error('subcategory') is-invalid @enderror"
                                    id="subcategory" name="subcategory">
                                <option value="">Pilih Sub Kategori</option>
                            </select>
                            @error('subcategory')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Author -->
                        <div class="mb-3">
                            <label for="author" class="form-label">Penulis</label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror"
                                   id="author" name="author" value="{{ old('author', auth()->user()->name) }}">
                            @error('author')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Publish Date -->
                        <div class="mb-3">
                            <label for="publish_date" class="form-label">Tanggal Publikasi <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('publish_date') is-invalid @enderror"
                                   id="publish_date" name="publish_date" value="{{ old('publish_date', date('Y-m-d')) }}" required>
                            @error('publish_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                @foreach($statuses as $key => $value)
                                    <option value="{{ $key }}" {{ old('status', 'draft') == $key ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Priority -->
                        <div class="mb-3">
                            <label for="priority" class="form-label">Prioritas</label>
                            <input type="number" class="form-control @error('priority') is-invalid @enderror"
                                   id="priority" name="priority" value="{{ old('priority', 0) }}" min="0" max="100">
                            <div class="form-text">0-100 (semakin tinggi semakin atas)</div>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Featured -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                       {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">
                                    Tampilkan di Beranda
                                </label>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                   id="image" name="image" accept="image/*">
                            <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB</div>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Preview -->
                        <div id="image-preview" class="mb-3" style="display: none;">
                            <img id="preview-img" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i>Simpan
                            </button>
                            <a href="/information-dashboard?category=kegiatan" class="btn btn-outline-secondary">
                                <i class="bx bx-x me-1"></i>Batal
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show/hide event details based on category
    const categorySelect = document.getElementById('category');
    const eventDetails = document.getElementById('event-details');
    const subcategoryContainer = document.getElementById('subcategory-container');
    const subcategorySelect = document.getElementById('subcategory');

    // Subcategory options
    const subcategories = {
        'kegiatan': {
            // Subcategories removed as requested
        },
        'pengumuman': {
            'umum': 'Pengumuman Umum',
            'ibadah': 'Pengumuman Ibadah',
            'kegiatan': 'Pengumuman Kegiatan'
        },
        'warta': {
            'mingguan': 'Warta Mingguan',
            'bulanan': 'Warta Bulanan',
            'khusus': 'Warta Khusus'
        },
        'program-kerja': {
            'tahunan': 'Program Tahunan',
            'bulanan': 'Program Bulanan',
            'khusus': 'Program Khusus'
        }
    };

    categorySelect.addEventListener('change', function() {
        // Show/hide event details
        if (this.value === 'kegiatan') {
            eventDetails.style.display = 'block';
        } else {
            eventDetails.style.display = 'none';
        }

        // Update subcategory options
        subcategorySelect.innerHTML = '<option value="">Pilih Sub Kategori</option>';

        if (this.value && subcategories[this.value]) {
            subcategoryContainer.style.display = 'block';

            Object.entries(subcategories[this.value]).forEach(([key, value]) => {
                const option = document.createElement('option');
                option.value = key;
                option.textContent = value;
                subcategorySelect.appendChild(option);
            });
        } else {
            subcategoryContainer.style.display = 'none';
        }
    });

    // Trigger on page load
    if (categorySelect.value === 'kegiatan') {
        eventDetails.style.display = 'block';
    }

    // Trigger subcategory update on page load
    if (categorySelect.value) {
        categorySelect.dispatchEvent(new Event('change'));
    }

    // Image preview
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });
});
</script>
@endsection
