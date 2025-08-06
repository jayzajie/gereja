@extends('layouts.admin')

@section('title', $pageTitle ?? 'Manajemen File Excel')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4" style="color: #8B4513;">
                    @if($category == 'data-jemaat')
                        <span class="text-muted fw-light">👥</span> Data Jemaat
                    @elseif($category == 'program-kerja')
                        <span class="text-muted fw-light">📋</span> Program Kerja Jemaat
                    @else
                        <span class="text-muted fw-light">🏠 Dashboard /</span> 📁 {{ $pageTitle ?? 'Daftar File Excel' }}
                    @endif
                </h4>
                @php
                    $createRoute = route('excel-files.create');
                    if($category) {
                        $createRoute = route('excel-files.create', ['category' => $category]);
                    }
                @endphp
                <a href="{{ $createRoute }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i>📤 Upload File Excel
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bx bx-error-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-1">Total File</h6>
                            <h4 class="text-primary mb-0">{{ $excelFiles->total() }}</h4>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-primary">
                                <span style="font-size: 1.5rem;">📁</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-1">File Tersedia</h6>
                            <h4 class="text-success mb-0">{{ \App\Models\ExcelFile::count() }}</h4>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-success">
                                <span style="font-size: 1.5rem;">✅</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-1">Upload Hari Ini</h6>
                            <h4 class="text-info mb-0">{{ \App\Models\ExcelFile::whereDate('uploaded_at', today())->count() }}</h4>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-info">
                                <span style="font-size: 1.5rem;">📤</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="card-title mb-1">Total Ukuran</h6>
                            <h4 class="text-warning mb-0">
                                @php
                                    $totalSize = \App\Models\ExcelFile::sum('file_size');
                                    $units = ['B', 'KB', 'MB', 'GB'];
                                    for ($i = 0; $totalSize > 1024 && $i < count($units) - 1; $i++) {
                                        $totalSize /= 1024;
                                    }
                                    echo round($totalSize, 1) . ' ' . $units[$i];
                                @endphp
                            </h4>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-warning">
                                <span style="font-size: 1.5rem;">💾</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Files Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">📁 Daftar File Excel</h5>
            <small class="text-muted">Total: {{ $excelFiles->total() }} file</small>
        </div>
        <div class="card-body">
            @if($excelFiles->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>📄 NAMA FILE</th>
                                <th>📊 UKURAN</th>
                                <th>📅 TANGGAL UPLOAD</th>
                                <th>⚙️ AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($excelFiles as $file)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bx bx-file-blank text-success me-2 fs-4"></i>
                                            <div>
                                                <h6 class="mb-0">{{ $file->original_name }}</h6>
                                                @if($file->description)
                                                    <small class="text-muted">{{ Str::limit($file->description, 50) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-label-info">{{ $file->formatted_file_size }}</span>
                                    </td>
                                    <td>
                                        <div>
                                            <small class="text-muted">{{ $file->uploaded_at->format('d M Y') }}</small><br>
                                            <small class="text-muted">{{ $file->uploaded_at->format('H:i') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('excel-files.download', $file) }}"
                                               class="btn btn-sm btn-info" title="Download File">
                                                <i class="bx bx-download"></i> 📥
                                            </a>
                                            <a href="{{ route('excel-files.show', ['excel_file' => $file, 'category' => $category]) }}"
                                               class="btn btn-sm btn-primary" title="Lihat Detail">
                                                <i class="bx bx-show"></i> 👁️
                                            </a>
                                            <a href="{{ route('excel-files.edit', ['excel_file' => $file, 'category' => $category]) }}"
                                               class="btn btn-sm btn-warning" title="Edit File">
                                                <i class="bx bx-edit"></i> ✏️
                                            </a>
                                            <form action="{{ route('excel-files.destroy', $file) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="category" value="{{ $category }}">
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        title="Hapus File"
                                                        onclick="return confirm('Yakin ingin menghapus file ini?')">
                                                    <i class="bx bx-trash"></i> 🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($excelFiles->hasPages())
                    <div class="mt-4">
                        {{ $excelFiles->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <i class="bx bx-file-blank display-1 text-muted"></i>
                    <h5 class="mt-3">Belum ada file Excel</h5>
                    <p class="text-muted">Mulai dengan mengupload file Excel pertama Anda</p>
                    <a href="{{ route('excel-files.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus me-1"></i>📤 Upload File Excel
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
