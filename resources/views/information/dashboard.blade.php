@extends('layouts.admin')

@section('title', 'Dashboard Kegiatan Jemaat')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title mb-0">🎉 Dashboard Kegiatan Jemaat</h4>
                        <p class="text-muted mb-0">
                            @if($currentCategory)
                                Kategori: <strong>{{ $categories[$currentCategory] ?? ucfirst($currentCategory) }}</strong> |
                            @endif
                            Total: <strong>{{ $informations->total() }}</strong> informasi
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('information.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus me-1"></i>Tambah Informasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('information.dashboard') }}" class="row g-3">
                        @if($currentCategory)
                            <input type="hidden" name="category" value="{{ $currentCategory }}">
                        @endif

                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bx-search"></i></span>
                                <input type="text" class="form-control" name="search"
                                       placeholder="Cari berdasarkan judul, konten, atau penulis..."
                                       value="{{ request('search') }}">
                                @if(request('search'))
                                    <a href="{{ route('information.dashboard', ['category' => $currentCategory]) }}"
                                       class="btn btn-outline-secondary">
                                        <i class="bx bx-x"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bx bx-search me-1"></i>Cari
                            </button>
                        </div>

                        <div class="col-md-2">
                            <div class="dropdown">
                                <button type="button" class="btn btn-outline-secondary dropdown-toggle w-100"
                                        data-bs-toggle="dropdown">
                                    <i class="bx bx-sort me-1"></i>Urutkan
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('information.dashboard', array_merge(request()->query(), ['sort' => 'newest'])) }}">
                                        <i class="bx bx-time me-2"></i>Terbaru
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('information.dashboard', array_merge(request()->query(), ['sort' => 'oldest'])) }}">
                                        <i class="bx bx-history me-2"></i>Terlama
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('information.dashboard', array_merge(request()->query(), ['sort' => 'priority'])) }}">
                                        <i class="bx bx-star me-2"></i>Prioritas
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Information Grid -->
    <div class="row">
        @forelse($informations as $information)
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="card h-100">
                    <!-- Image Section -->
                    <div class="card-img-top position-relative" style="height: 200px; background: #f8f9fa; border: 2px dashed #dee2e6;">
                        @if($information->image)
                            <img src="{{ Storage::url($information->image) }}"
                                 class="w-100 h-100"
                                 style="object-fit: cover;"
                                 alt="{{ $information->title }}">
                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-muted">
                                <i class="bx bx-image-add" style="font-size: 2rem;"></i>
                                <small class="mt-2">Upload Foto</small>
                            </div>
                        @endif

                        <!-- Priority Badge -->
                        @if($information->priority > 0)
                            <span class="badge bg-warning position-absolute top-0 end-0 m-2">
                                <i class="bx bx-star"></i> {{ $information->priority }}
                            </span>
                        @endif

                        <!-- Status Badge -->
                        <span class="badge position-absolute top-0 start-0 m-2
                            {{ $information->status === 'published' ? 'bg-success' :
                               ($information->status === 'draft' ? 'bg-warning' : 'bg-secondary') }}">
                            {{ ucfirst($information->status) }}
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column">
                        <!-- Category -->
                        <div class="mb-2">
                            <span class="badge bg-primary">{{ $categories[$information->category] ?? ucfirst($information->category) }}</span>
                        </div>

                        <!-- Title -->
                        <h6 class="card-title mb-2" style="min-height: 2.5rem; line-height: 1.25;">
                            {{ Str::limit($information->title, 50) }}
                        </h6>

                        <!-- Content Preview -->
                        <p class="card-text text-muted small mb-3" style="min-height: 3rem;">
                            {{ Str::limit(strip_tags($information->content), 80) }}
                        </p>

                        <!-- Meta Info -->
                        <div class="small text-muted mb-3">
                            <div><i class="bx bx-user me-1"></i>{{ $information->author ?: 'Admin' }}</div>
                            <div><i class="bx bx-calendar me-1"></i>{{ $information->publish_date->format('d M Y') }}</div>
                            @if($information->event_date)
                                <div><i class="bx bx-calendar-event me-1"></i>{{ $information->event_date->format('d M Y') }}</div>
                            @endif
                            @if($information->location)
                                <div><i class="bx bx-map me-1"></i>{{ Str::limit($information->location, 30) }}</div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-auto">
                            <div class="btn-group w-100" role="group">
                                <a href="{{ route('information.show', $information) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="bx bx-show"></i>
                                </a>
                                <a href="{{ route('information.edit', $information) }}"
                                   class="btn btn-outline-warning btn-sm">
                                    <i class="bx bx-edit"></i>
                                </a>
                                <form action="{{ route('information.destroy', $information) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus informasi ini?')">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="bx bx-info-circle display-1 text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada informasi</h5>
                        <p class="text-muted">
                            @if(request('search'))
                                Tidak ditemukan informasi dengan kata kunci "{{ request('search') }}"
                                @if($currentCategory)
                                    dalam kategori <strong>{{ $categories[$currentCategory] }}</strong>
                                @endif
                            @elseif($currentCategory)
                                Belum ada informasi dalam kategori <strong>{{ $categories[$currentCategory] }}</strong>
                            @else
                                Belum ada informasi yang tersedia di sistem
                            @endif
                        </p>
                        <div class="d-flex gap-2 justify-content-center">
                            @if(request('search'))
                                <a href="{{ route('information.dashboard', ['category' => $currentCategory]) }}"
                                   class="btn btn-outline-secondary">
                                    <i class="bx bx-x me-1"></i>Hapus Pencarian
                                </a>
                            @endif
                            <a href="{{ route('information.create') }}" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i>Tambah Informasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($informations->hasPages())
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{ $informations->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Floating Action Button -->
<div class="fab-container">
    <div class="dropdown">
        <button class="fab-main btn btn-primary rounded-circle" type="button"
                data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bx bx-plus"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ route('information.create') }}">
                    <i class="bx bx-plus-circle me-2 text-primary"></i>Tambah Informasi Baru
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item" href="{{ route('information.export.excel') }}">
                    <i class="bx bx-file me-2 text-success"></i>Export Excel
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
.fab-container {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    z-index: 1000;
}

.fab-main {
    width: 56px;
    height: 56px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    border: none;
}

.fab-main:hover {
    transform: scale(1.1);
    transition: transform 0.2s ease;
}

.dropdown-menu {
    margin-bottom: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
</style>
@endsection
