@extends('layouts.admin')

@section('title', 'Pendeta Jemaat')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Informasi /</span> Pendeta Jemaat
    </h4>

    <!-- Member Photos Grid -->
    <div class="row">
        @for($i = 0; $i < 12; $i++)
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
            <div class="card member-card">
                <div class="card-body p-0">
                    <!-- Photo Upload Area -->
                    <div class="upload-area" onclick="openFileUpload({{ $i }})">
                        <div class="upload-icon">
                            <i class="bx bx-image"></i>
                        </div>
                        <h6 style="color: #8B4513;">Upload Foto</h6>
                        <p class="text-muted small mb-0">Choose file</p>
                    </div>

                    <!-- Hidden file input -->
                    <input type="file" id="fileInput{{ $i }}" class="d-none" accept="image/*" onchange="previewImage({{ $i }}, this)">

                    <!-- Member Info Section -->
                    <div class="member-info">
                        <div class="mb-2">
                            <label class="form-label small" style="color: #8B4513;">Nama:</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Masukkan nama pendeta">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small" style="color: #8B4513;">Nomor Pendeta Jemaat:</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Nomor Pendeta Jemaat">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small" style="color: #8B4513;">Tahun Menjabat:</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Tahun Menjabat">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small" style="color: #8B4513;">Nama Gereja Toraja:</label>
                            <input type="text" class="form-control form-control-sm" placeholder="Nama Gereja Toraja">
                        </div>

                        <button class="btn btn-church btn-sm w-100">
                            <i class="bx bx-check me-1"></i>Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>

    <!-- Pagination -->
    @if(isset($members) && $members->hasPages())
    <div class="row">
        <div class="col-12">
            <nav aria-label="Page navigation">
                {{ $members->links() }}
            </nav>
        </div>
    </div>
    @endif
</div>

<!-- Photo Upload Modal -->
<div class="modal fade" id="photoUploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: #8B4513;">Upload Foto Pendeta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="photoUploadForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Pendeta:</label>
                        <select name="member_id" class="form-select" required>
                            <option value="">Pilih Pendeta...</option>
                            @if(isset($members) && $members->count() > 0)
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->nama_lengkap }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Foto:</label>
                        <select name="photo_type" class="form-select" required>
                            <option value="foto_diri">Foto Diri</option>
                            <option value="foto_resmi">Foto Resmi</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Foto:</label>
                        <input type="file" name="photo" class="form-control" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload Foto</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .member-card {
        background: #FFF;
        border: 2px dashed #D4A574;
        border-radius: 8px;
        transition: all 0.3s ease;
        min-height: 400px;
        position: relative;
    }

    .member-card:hover {
        border-color: #8B4513;
        box-shadow: 0 4px 12px rgba(139, 69, 19, 0.2);
    }

    .upload-area {
        border: 2px dashed #D4A574;
        border-radius: 8px;
        padding: 40px 20px;
        text-align: center;
        background: #FFF8F0;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .upload-area:hover {
        border-color: #8B4513;
        background: #F5E6D3;
    }

    .upload-icon {
        font-size: 48px;
        color: #D4A574;
        margin-bottom: 15px;
    }

    .member-info {
        background: linear-gradient(135deg, #FFF8F0 0%, #F5E6D3 100%);
        border-top: 1px solid #D4A574;
        padding: 15px;
    }

    .member-photo {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 4px;
    }

    .btn-church {
        background: #D4A574;
        border-color: #D4A574;
        color: #8B4513;
        font-weight: 600;
    }

    .btn-church:hover {
        background: #C8956D;
        border-color: #C8956D;
        color: #8B4513;
    }

    .form-control:focus {
        border-color: #D4A574;
        box-shadow: 0 0 0 0.2rem rgba(212, 165, 116, 0.25);
    }
</style>
@endpush

@push('scripts')
<script>
    function openFileUpload(index) {
        document.getElementById('fileInput' + index).click();
    }

    function previewImage(index, input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const uploadArea = input.parentElement.querySelector('.upload-area');
                uploadArea.innerHTML = `
                    <img src="${e.target.result}" class="member-photo" alt="Preview">
                    <div class="mt-2">
                        <small class="text-success">
                            <i class="bx bx-check-circle"></i> Foto dipilih
                        </small>
                    </div>
                `;
                uploadArea.style.padding = '10px';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Photo upload form submission
    document.getElementById('photoUploadForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('{{ route("dashboard.member-photo-upload") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Foto berhasil diupload!');
                location.reload();
            } else {
                alert('Gagal mengupload foto. Silakan coba lagi.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        });
    });
</script>
@endpush
