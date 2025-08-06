@extends('layouts.admin')

@section('title', 'Detail Sejarah Jemaat Eben-Haezer Selili')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">📖 Detail Sejarah Jemaat Eben-Haezer Selili</h1>
            <p class="mb-0 text-muted">Lihat detail informasi sejarah jemaat</p>
        </div>
        <div>
            <a href="{{ route('sejarah-jemaat.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a href="{{ route('sejarah-jemaat.edit', $sejarahJemaat) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Detail Card -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-info-circle me-2"></i>Informasi Detail
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Left Column - Content -->
                <div class="col-md-8">
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Judul</h6>
                        <h4 class="text-primary">{{ $sejarahJemaat->title }}</h4>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Konten Sejarah</h6>
                        <div class="content-display p-3 bg-light rounded">
                            {!! nl2br(e($sejarahJemaat->content)) !!}
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-muted mb-2">Status</h6>
                                <span class="badge bg-{{ $sejarahJemaat->is_active ? 'success' : 'secondary' }} fs-6">
                                    {{ $sejarahJemaat->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h6 class="text-muted mb-2">Tanggal Dibuat</h6>
                                <p class="mb-0">{{ $sejarahJemaat->created_at->format('d F Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-muted mb-2">Terakhir Diperbarui</h6>
                        <p class="mb-0">{{ $sejarahJemaat->updated_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>

                <!-- Right Column - Images -->
                <div class="col-md-4">
                    @if($sejarahJemaat->logo)
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Logo</h6>
                            <div class="text-center">
                                <img src="{{ $sejarahJemaat->logo_url }}"
                                     alt="Logo {{ $sejarahJemaat->title }}"
                                     class="img-fluid rounded shadow-sm"
                                     style="max-height: 200px;">
                            </div>
                        </div>
                    @endif

                    @if($sejarahJemaat->banner_image)
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">Banner</h6>
                            <div class="text-center">
                                <img src="{{ $sejarahJemaat->banner_image_url }}"
                                     alt="Banner {{ $sejarahJemaat->title }}"
                                     class="img-fluid rounded shadow-sm"
                                     style="max-height: 200px;">
                            </div>
                        </div>
                    @endif

                    @if(!$sejarahJemaat->logo && !$sejarahJemaat->banner_image)
                        <div class="text-center text-muted">
                            <i class="fas fa-image fa-3x mb-3"></i>
                            <p>Tidak ada gambar</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-4 text-center">
        <a href="{{ route('sejarah-jemaat.edit', $sejarahJemaat) }}" class="btn btn-warning me-2">
            <i class="fas fa-edit"></i> Edit Sejarah
        </a>
        <a href="{{ route('sejarah-jemaat.index') }}" class="btn btn-secondary">
            <i class="fas fa-list"></i> Lihat Semua
        </a>
    </div>
</div>

<style>
.content-display {
    line-height: 1.8;
    font-size: 1rem;
    max-height: 400px;
    overflow-y: auto;
}



.card {
    border: none;
    border-radius: 15px;
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

.badge {
    padding: 8px 16px;
}

img {
    transition: transform 0.3s ease;
}

img:hover {
    transform: scale(1.05);
}
</style>
@endsection
