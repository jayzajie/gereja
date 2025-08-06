@extends('layouts.admin')

@section('title', 'Detail Informasi')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold py-3 mb-2" style="color: #8B4513;">
                <span class="text-muted fw-light">Manajemen / Informasi /</span> Detail
            </h4>
        </div>
    </div>

    <!-- Information Detail Card -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Informasi</h5>
            <div class="d-flex gap-2">
                <a href="{{ route('information.edit', $information) }}" class="btn btn-primary btn-sm">
                    <i class="bx bx-edit me-1"></i>Edit
                </a>
                <a href="{{ route('information.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bx bx-arrow-back me-1"></i>Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Left Column - Main Content -->
                <div class="col-md-8">
                    <!-- Title -->
                    <div class="mb-4">
                        <h3 class="fw-bold text-primary">{{ $information->title }}</h3>
                        @if($information->excerpt)
                            <p class="text-muted fs-5">{{ $information->excerpt }}</p>
                        @endif
                    </div>

                    <!-- Image -->
                    @if($information->image)
                        <div class="mb-4">
                            <img src="{{ $information->image_url }}" alt="{{ $information->title }}" 
                                 class="img-fluid rounded shadow-sm" style="max-height: 400px; width: 100%; object-fit: cover;">
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Konten</h5>
                        <div class="content-display">
                            {!! nl2br(e($information->content)) !!}
                        </div>
                    </div>

                    <!-- Event Details (if category is kegiatan) -->
                    @if($information->category == 'kegiatan' && ($information->event_date || $information->location))
                        <div class="mb-4">
                            <h5 class="fw-bold mb-3">Detail Acara</h5>
                            <div class="row">
                                @if($information->event_date)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bx bx-calendar text-primary me-2"></i>
                                            <strong>Tanggal Acara:</strong>
                                        </div>
                                        <p class="ms-4">{{ $information->event_date->format('d F Y') }}</p>
                                    </div>
                                @endif
                                @if($information->location)
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bx bx-map text-primary me-2"></i>
                                            <strong>Lokasi:</strong>
                                        </div>
                                        <p class="ms-4">{{ $information->location }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column - Information Details -->
                <div class="col-md-4">
                    <!-- Status Card -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="card-title">Status Publikasi</h6>
                            @if($information->status == 'published')
                                <span class="badge bg-success fs-6">{{ \App\Models\Information::getStatuses()[$information->status] }}</span>
                            @elseif($information->status == 'draft')
                                <span class="badge bg-warning fs-6">{{ \App\Models\Information::getStatuses()[$information->status] }}</span>
                            @else
                                <span class="badge bg-secondary fs-6">{{ \App\Models\Information::getStatuses()[$information->status] }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Information Details -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <h6 class="card-title">Informasi Detail</h6>
                            
                            <!-- Category -->
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="bx bx-category text-primary me-2"></i>
                                    <strong>Kategori:</strong>
                                </div>
                                <span class="badge bg-primary ms-4">{{ \App\Models\Information::getCategories()[$information->category] }}</span>
                            </div>

                            <!-- Author -->
                            @if($information->author)
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="bx bx-user text-primary me-2"></i>
                                        <strong>Penulis:</strong>
                                    </div>
                                    <p class="ms-4 mb-0">{{ $information->author }}</p>
                                </div>
                            @endif

                            <!-- Publish Date -->
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="bx bx-calendar text-primary me-2"></i>
                                    <strong>Tanggal Publikasi:</strong>
                                </div>
                                <p class="ms-4 mb-0">{{ $information->publish_date->format('d F Y') }}</p>
                            </div>

                            <!-- Priority -->
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="bx bx-sort-up text-primary me-2"></i>
                                    <strong>Prioritas:</strong>
                                </div>
                                <p class="ms-4 mb-0">{{ $information->priority }}</p>
                            </div>

                            <!-- Featured -->
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="bx bx-star text-primary me-2"></i>
                                    <strong>Featured:</strong>
                                </div>
                                <div class="ms-4">
                                    @if($information->is_featured)
                                        <span class="badge bg-warning">Ya</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Created/Updated -->
                            <div class="mb-3">
                                <div class="d-flex align-items-center mb-1">
                                    <i class="bx bx-time text-primary me-2"></i>
                                    <strong>Dibuat:</strong>
                                </div>
                                <p class="ms-4 mb-0 small">{{ $information->created_at->format('d F Y H:i') }}</p>
                            </div>

                            @if($information->updated_at != $information->created_at)
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="bx bx-edit text-primary me-2"></i>
                                        <strong>Diperbarui:</strong>
                                    </div>
                                    <p class="ms-4 mb-0 small">{{ $information->updated_at->format('d F Y H:i') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Attachments (if any) -->
                    @if($information->attachments && count($information->attachments) > 0)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-title">Lampiran</h6>
                                @foreach($information->attachments as $attachment)
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bx bx-file text-primary me-2"></i>
                                        <a href="{{ asset('storage/' . $attachment) }}" target="_blank" class="text-decoration-none">
                                            {{ basename($attachment) }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex gap-2">
                <a href="{{ route('information.index') }}" class="btn btn-outline-secondary">
                    <i class="bx bx-arrow-back me-1"></i>Kembali ke Daftar
                </a>
                <a href="{{ route('information.edit', $information) }}" class="btn btn-primary">
                    <i class="bx bx-edit me-1"></i>Edit Informasi
                </a>
                <form method="POST" action="{{ route('information.destroy', $information) }}" class="d-inline" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash me-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.content-display {
    line-height: 1.8;
    font-size: 1rem;
    color: #333;
}

.content-display p {
    margin-bottom: 1rem;
}
</style>
@endsection
