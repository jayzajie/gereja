@extends('layouts.admin')

@section('title', 'Jadwal Ibadah')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4" style="color: #8B4513;">
                    <span class="text-muted fw-light">🏠 Dashboard /</span> ⏰ Jadwal Ibadah
                </h4>
                <a href="{{ route('worship-schedules.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i>➕ Tambah Jadwal Baru
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">📅 Daftar Jadwal Ibadah</h5>
                    <small class="text-muted">Total: {{ $schedules->total() }} jadwal</small>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($schedules->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>⏰ Waktu</th>
                                        <th>📝 Nama Ibadah</th>
                                        <th>📅 Hari</th>
                                        <th>👥 Target</th>
                                        <th>⭐ Status</th>
                                        <th>🔧 Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($schedules as $schedule)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="{{ $schedule->icon }} me-2" style="color: #8B4513;"></i>
                                                    <div>
                                                        <strong>{{ $schedule->formatted_time }}</strong>
                                                        <small class="text-muted d-block">{{ $schedule->period }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ $schedule->name }}</strong>
                                                    @if($schedule->is_featured)
                                                        <span class="badge bg-warning ms-1">Utama</span>
                                                    @endif
                                                    @if($schedule->description)
                                                        <small class="text-muted d-block">{{ Str::limit($schedule->description, 50) }}</small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>{{ $schedule->day }}</td>
                                            <td>{{ $schedule->target_audience }}</td>
                                            <td>
                                                @if($schedule->is_active)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                        Aksi
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('worship-schedules.show', $schedule) }}">
                                                                <i class="bx bx-show me-1"></i>Lihat Detail
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('worship-schedules.edit', $schedule) }}">
                                                                <i class="bx bx-edit me-1"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li>
                                                            <form action="{{ route('worship-schedules.destroy', $schedule) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    <i class="bx bx-trash me-1"></i>Hapus
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($schedules->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $schedules->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <i class="bx bx-calendar-x" style="font-size: 4rem; color: #ddd;"></i>
                            <h5 class="mt-3 text-muted">Belum ada jadwal ibadah</h5>
                            <p class="text-muted">Klik tombol "Tambah Jadwal Baru" untuk menambahkan jadwal ibadah pertama.</p>
                            <a href="{{ route('worship-schedules.create') }}" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i>Tambah Jadwal Baru
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection