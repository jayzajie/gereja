@extends('layouts.admin')

@section('title', 'Warta Mingguan')

@push('styles')
<style>
    .warta-header {
        background: linear-gradient(135deg,rgb(51, 103, 207) 0%,rgb(42, 37, 42) 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .warta-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(50%, -50%);
    }

    .warta-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        transform: translate(-50%, 50%);
    }

    .warta-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .search-section {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .modern-input {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .modern-input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        background: white;
    }

    .modern-btn {
        border-radius: 12px;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
    }

    .modern-btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .modern-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }

    .warta-table-container {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .table-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #dee2e6;
    }

    .warta-card {
        border: none;
        border-radius: 15px;
        margin-bottom: 1rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .warta-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .file-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
        color: white;
    }

    .action-btn {
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 1px solid;
        margin: 0 0.25rem;
    }

    .btn-view {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-color: #28a745;
        color: white;
    }

    .btn-download {
        background: linear-gradient(135deg, #007bff 0%, #6610f2 100%);
        border-color: #007bff;
        color: white;
    }

    .btn-edit {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        border-color: #ffc107;
        color: #212529;
    }

    .btn-delete {
        background: linear-gradient(135deg, #dc3545 0%, #e83e8c 100%);
        border-color: #dc3545;
        color: white;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6c757d;
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header Section -->
    <div class="warta-header">
        <div class="d-flex justify-content-between align-items-center position-relative">
            <div>
                <h2 class="mb-2 fw-bold">📰 Warta Mingguan</h2>
                <p class="mb-0 opacity-75">Kelola dan distribusi warta jemaat mingguan</p>
            </div>
            <button type="button" class="modern-btn modern-btn-primary" data-bs-toggle="modal" data-bs-target="#uploadWartaModal">
                <i class="bx bx-plus me-2"></i>Upload Warta Baru
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="warta-stats">
        <div class="stat-card">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">
                📄
            </div>
            <h4 class="fw-bold mb-1">{{ $wartaMingguan->total() }}</h4>
            <p class="text-muted mb-0">Total Warta</p>
        </div>
        <div class="stat-card">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">
                📅
            </div>
            <h4 class="fw-bold mb-1">{{ date('Y') }}</h4>
            <p class="text-muted mb-0">Tahun Aktif</p>
        </div>
        <div class="stat-card">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">
                📁
            </div>
            <h4 class="fw-bold mb-1">{{ $wartaMingguan->count() }}</h4>
            <p class="text-muted mb-0">File Tersedia</p>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="position-relative">
                    <i class="bx bx-search position-absolute" style="left: 1rem; top: 50%; transform: translateY(-50%); color: #6c757d; z-index: 5;"></i>
                    <input type="text" class="form-control modern-input ps-5" placeholder="🔍 Cari warta berdasarkan nama atau deskripsi..." id="searchInput">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select modern-input" id="yearFilter">
                    <option value="">📅 Semua Tahun</option>
                    @foreach($availableYears as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <button class="modern-btn w-100" style="background: linear-gradient(135deg, #6c757d 0%, #495057 100%); color: white;" onclick="resetFilters()">
                    <i class="bx bx-refresh me-2"></i>Reset Filter
                </button>
            </div>
        </div>
    </div>

    <!-- Warta Cards Container -->
    <div class="warta-table-container">
        <div class="table-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold">📋 Daftar Warta Mingguan</h5>
                <span class="badge" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 0.5rem 1rem; border-radius: 25px;">
                    Total: <span id="totalCount">{{ $wartaMingguan->total() }}</span> file
                </span>
            </div>
        </div>

        <div class="p-4" id="wartaCardsContainer">
            @forelse($wartaMingguan as $warta)
            <div class="warta-card" data-warta-year="{{ $warta->tahun }}">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-md-1">
                            <div class="file-icon">
                                <i class="bx bxs-file-pdf"></i>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h6 class="fw-bold mb-2">{{ $warta->nama_warta }}</h6>
                            <div class="d-flex align-items-center text-muted small">
                                <i class="bx bx-calendar me-1"></i>
                                <span>{{ $warta->tanggal }} {{ $warta->bulan_nama }} {{ $warta->tahun }}</span>
                                <span class="mx-2">•</span>
                                <i class="bx bx-file me-1"></i>
                                <span>{{ $warta->file_size_readable ?? 'PDF' }}</span>
                            </div>
                            @if($warta->deskripsi)
                            <p class="text-muted small mt-2 mb-0">{{ Str::limit($warta->deskripsi, 100) }}</p>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <span class="badge" style="background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%); color: white; padding: 0.5rem 1rem; border-radius: 15px;">
                                    PDF
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-end flex-wrap gap-2">
                                <a href="{{ route('warta-mingguan.view', $warta->id) }}" target="_blank" class="action-btn btn-view">
                                    <i class="bx bx-show me-1"></i>Lihat
                                </a>
                                <a href="{{ route('warta-mingguan.download', $warta->id) }}" class="action-btn btn-download">
                                    <i class="bx bx-download me-1"></i>Download
                                </a>
                                <a href="{{ route('warta-mingguan.edit', $warta->id) }}" class="action-btn btn-edit">
                                    <i class="bx bx-edit me-1"></i>Edit
                                </a>
                                <button onclick="deleteFile({{ $warta->id }})" class="action-btn btn-delete">
                                    <i class="bx bx-trash me-1"></i>Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">📰</div>
                <h5 class="fw-bold mb-3">Belum Ada Warta Mingguan</h5>
                <p class="mb-4">Mulai dengan mengupload warta mingguan pertama untuk jemaat Anda</p>
                <button type="button" class="modern-btn modern-btn-primary" data-bs-toggle="modal" data-bs-target="#uploadWartaModal">
                    <i class="bx bx-plus me-2"></i>Upload Warta Pertama
                </button>
            </div>
            @endforelse
        </div>

        @if($wartaMingguan->hasPages())
        <div class="p-4 border-top">
            <div class="d-flex justify-content-center">
                {{ $wartaMingguan->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Upload Warta Modal -->
<div class="modal fade" id="uploadWartaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);">
            <div class="modal-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 20px 20px 0 0; padding: 2rem;">
                <div>
                    <h4 class="modal-title mb-1">📤 Upload Warta Mingguan</h4>
                    <p class="mb-0 opacity-75">Tambahkan warta mingguan baru untuk jemaat</p>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="uploadWartaForm" action="{{ route('warta-mingguan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="padding: 2rem;">
                    <div class="mb-4">
                        <label class="form-label fw-bold">📝 Nama Warta</label>
                        <input type="text" class="form-control modern-input" name="nama_warta" placeholder="Contoh: Warta Jemaat Minggu I Januari 2024" required>
                        @error('nama_warta')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label class="form-label fw-bold">📅 Tanggal</label>
                                <select class="form-select modern-input" name="tanggal" required>
                                    <option value="">Pilih Tanggal</option>
                                    @for($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('tanggal')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label class="form-label fw-bold">🗓️ Bulan</label>
                                <select class="form-select modern-input" name="bulan" required>
                                    <option value="">Pilih Bulan</option>
                                    @php
                                    $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                             'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    @endphp
                                    @foreach($bulan as $index => $namaBulan)
                                    <option value="{{ $index + 1 }}">{{ $namaBulan }}</option>
                                    @endforeach
                                </select>
                                @error('bulan')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-4">
                                <label class="form-label fw-bold">📆 Tahun</label>
                                <select class="form-select modern-input" name="tahun" required>
                                    <option value="">Pilih Tahun</option>
                                    @for($i = date('Y'); $i >= 2020; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('tahun')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">📄 File PDF</label>
                        <div class="upload-area" style="border: 2px dashed #dee2e6; border-radius: 12px; padding: 2rem; text-align: center; background: #f8f9fa; transition: all 0.3s ease;">
                            <i class="bx bx-cloud-upload" style="font-size: 3rem; color: #6c757d; margin-bottom: 1rem;"></i>
                            <div class="mt-2">
                                <input type="file" class="form-control" name="file_pdf" accept=".pdf" required id="file_pdf_input">
                            </div>
                            <div class="form-text mt-2">
                                <strong>Maksimal ukuran file: 10MB</strong><br>
                                Format yang didukung: PDF
                            </div>
                        </div>
                        @error('file_pdf')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">📋 Deskripsi (Opsional)</label>
                        <textarea class="form-control modern-input" name="deskripsi" rows="4" placeholder="Tambahkan deskripsi singkat tentang warta ini untuk memudahkan pencarian..."></textarea>
                        @error('deskripsi')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer" style="padding: 2rem; border-top: 1px solid #dee2e6;">
                    <button type="button" class="modern-btn" style="background: #6c757d; color: white;" data-bs-dismiss="modal">
                        <i class="bx bx-x me-2"></i>Batal
                    </button>
                    <button type="submit" class="modern-btn modern-btn-primary">
                        <i class="bx bx-upload me-2"></i>Upload Warta
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const cards = document.querySelectorAll('.warta-card');

        cards.forEach(card => {
            const text = card.textContent.toLowerCase();
            card.style.display = text.includes(searchTerm) ? '' : 'none';
        });

        updateCount();
    });

    // Year filter
    document.getElementById('yearFilter').addEventListener('change', function() {
        const selectedYear = this.value;
        const cards = document.querySelectorAll('.warta-card');

        cards.forEach(card => {
            const cardYear = card.getAttribute('data-warta-year');
            card.style.display = (!selectedYear || cardYear === selectedYear) ? '' : 'none';
        });

        updateCount();
    });

    // Reset filters
    function resetFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('yearFilter').value = '';

        const cards = document.querySelectorAll('.warta-card');
        cards.forEach(card => {
            card.style.display = '';
        });

        updateCount();
    }

    // Update count
    function updateCount() {
        const visibleCards = document.querySelectorAll('.warta-card:not([style*="display: none"])');
        document.getElementById('totalCount').textContent = visibleCards.length;
    }

    // Upload area enhancement
    const uploadArea = document.querySelector('.upload-area');
    const fileInput = document.querySelector('input[type="file"]');

    if (uploadArea && fileInput) {
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.style.borderColor = '#667eea';
            this.style.background = '#f0f4ff';
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.style.borderColor = '#dee2e6';
            this.style.background = '#f8f9fa';
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.style.borderColor = '#dee2e6';
            this.style.background = '#f8f9fa';

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                updateFileDisplay(files[0]);
            }
        });

        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                updateFileDisplay(this.files[0]);
            }
        });
    }

    function updateFileDisplay(file) {
        const uploadArea = document.querySelector('.upload-area');
        if (uploadArea) {
            uploadArea.innerHTML = `
                <i class="bx bx-check-circle" style="font-size: 3rem; color: #28a745; margin-bottom: 1rem;"></i>
                <h6 class="mb-2">${file.name}</h6>
                <p class="text-muted mb-0">File siap untuk diupload</p>
                <input type="file" class="form-control modern-input" name="file_pdf" accept=".pdf" required style="margin-top: 1rem;">
            `;
        }
    }

    // File actions with modern confirmation
    function deleteFile(id) {
        // Create custom confirmation modal
        const confirmModal = document.createElement('div');
        confirmModal.innerHTML = `
            <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content" style="border-radius: 15px; border: none;">
                        <div class="modal-body text-center p-4">
                            <div class="mb-3">
                                <i class="bx bx-trash" style="font-size: 3rem; color: #dc3545;"></i>
                            </div>
                            <h5 class="mb-3">Hapus Warta?</h5>
                            <p class="text-muted mb-4">Tindakan ini tidak dapat dibatalkan</p>
                            <div class="d-flex gap-2 justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-danger" onclick="confirmDelete(${id})">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.appendChild(confirmModal);
        new bootstrap.Modal(document.getElementById('deleteConfirmModal')).show();
    }

    function confirmDelete(id) {
        fetch(`/warta-mingguan/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('success', data.message);
                setTimeout(() => location.reload(), 1500);
            } else {
                showNotification('error', data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('error', 'Terjadi kesalahan saat menghapus warta');
        });

        bootstrap.Modal.getInstance(document.getElementById('deleteConfirmModal')).hide();
    }

    // Form submission handler
    document.getElementById('uploadWartaForm').addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('Form submitted - starting upload process');

        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;

        // Show loading state
        submitBtn.innerHTML = '<i class="bx bx-loader-alt bx-spin me-2"></i>Mengupload...';
        submitBtn.disabled = true;

        // Create FormData
        const formData = new FormData(this);

        console.log('Sending request to:', this.action);
        console.log('FormData entries:');
        for (let [key, value] of formData.entries()) {
            if (value instanceof File) {
                console.log(`${key}: ${value.name} (${value.size} bytes)`);
            } else {
                console.log(`${key}: ${value}`);
            }
        }

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.success) {
                showNotification('success', data.message);
                this.reset();
                bootstrap.Modal.getInstance(document.getElementById('uploadWartaModal')).hide();
                setTimeout(() => location.reload(), 1500);
            } else {
                showNotification('error', data.message || 'Terjadi kesalahan');
                if (data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        showFieldError(field, data.errors[field][0]);
                    });
                }
            }
        })
        .catch(error => {
            console.error('Upload error:', error);
            showNotification('error', 'Terjadi kesalahan saat mengupload. Silakan coba lagi.');
        })
        .finally(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
    });

    // Helper function to show field errors
    function showFieldError(fieldName, message) {
        const field = document.querySelector(`[name="${fieldName}"]`);
        if (field) {
            let errorElement = field.parentNode.querySelector('.text-danger');
            if (!errorElement) {
                errorElement = document.createElement('div');
                errorElement.className = 'text-danger small mt-1';
                field.parentNode.appendChild(errorElement);
            }
            errorElement.textContent = message;

            // Add error styling to field
            field.classList.add('is-invalid');
        }
    }

    // Helper function to clear all field errors
    function clearFieldErrors() {
        // Remove all error messages
        document.querySelectorAll('#uploadWartaForm .text-danger').forEach(el => {
            if (el.textContent) {
                el.textContent = '';
            }
        });

        // Remove error styling
        document.querySelectorAll('#uploadWartaForm .is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
    }

    // Clear error messages when user starts typing
    document.querySelectorAll('#uploadWartaForm input, #uploadWartaForm select, #uploadWartaForm textarea').forEach(element => {
        element.addEventListener('input', function() {
            const errorElement = this.parentNode.querySelector('.text-danger');
            if (errorElement) {
                errorElement.textContent = '';
            }
        });
    });

    // File input change handler
    document.getElementById('file_pdf_input').addEventListener('change', function() {
        const file = this.files[0];
        const uploadArea = this.closest('.upload-area');
        const icon = uploadArea.querySelector('i');

        if (file) {
            icon.className = 'bx bxs-file-pdf';
            icon.style.color = '#dc3545';

            // Create or update file name display
            let fileNameDisplay = uploadArea.querySelector('.file-name-display');
            if (!fileNameDisplay) {
                fileNameDisplay = document.createElement('div');
                fileNameDisplay.className = 'file-name-display mt-2 fw-bold text-primary';
                icon.parentNode.insertBefore(fileNameDisplay, this);
            }
            fileNameDisplay.textContent = `📄 ${file.name}`;
        } else {
            icon.className = 'bx bx-cloud-upload';
            icon.style.color = '#6c757d';

            const fileNameDisplay = uploadArea.querySelector('.file-name-display');
            if (fileNameDisplay) {
                fileNameDisplay.remove();
            }
        }
    });

    // Modern notification system
    function showNotification(type, message) {
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} position-fixed`;
        notification.style.cssText = `
            top: 20px; right: 20px; z-index: 9999;
            border-radius: 12px; border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            min-width: 300px;
        `;
        notification.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="bx bx-${type === 'success' ? 'check-circle' : 'error-circle'} me-2" style="font-size: 1.2rem;"></i>
                <span>${message}</span>
            </div>
        `;

        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    // Initialize tooltips and animations
    document.addEventListener('DOMContentLoaded', function() {
        // Add hover effects to cards
        const cards = document.querySelectorAll('.warta-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endpush
