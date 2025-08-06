@extends('layouts.admin')

@section('title', 'Detail Jadwal Ibadah')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold py-3 mb-4" style="color: #8B4513;">
                <span class="text-muted fw-light">🏠 Dashboard / ⏰ Jadwal Ibadah /</span> 👁️ Detail
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">👁️ Detail Jadwal Ibadah</h5>
                    <div>
                        <a href="{{ route('worship-schedules.edit', $worshipSchedule) }}" class="btn btn-warning btn-sm">
                            <i class="bx bx-edit"></i> Edit
                        </a>
                        <a href="{{ route('worship-schedules.index') }}" class="btn btn-secondary btn-sm">
                            <i class="bx bx-arrow-back"></i> Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Informasi Utama -->
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <h6 class="fw-bold text-primary">📝 Nama Ibadah</h6>
                                    <div class="d-flex align-items-center">
                                        <i class="{{ $worshipSchedule->icon }} me-2" style="color: #8B4513; font-size: 1.5rem;"></i>
                                        <div>
                                            <h5 class="mb-0">{{ $worshipSchedule->name }}</h5>
                                            @if($worshipSchedule->is_featured)
                                                <span class="badge bg-warning">⭐ Ibadah Utama</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <h6 class="fw-bold text-primary">⏰ Waktu & Hari</h6>
                                    <div class="time-display">
                                        <h4 class="mb-1" style="color: #8B4513;">{{ $worshipSchedule->formatted_time }}</h4>
                                        <span class="badge bg-info">{{ $worshipSchedule->period }}</span>
                                        <p class="mb-0 mt-2">{{ $worshipSchedule->day }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <h6 class="fw-bold text-primary">👥 Target Jemaat</h6>
                                    <p class="mb-0">{{ $worshipSchedule->target_audience }}</p>
                                </div>

                                @if($worshipSchedule->duration)
                                    <div class="col-md-6 mb-4">
                                        <h6 class="fw-bold text-primary">⏱️ Durasi</h6>
                                        <p class="mb-0">{{ $worshipSchedule->duration }} menit</p>
                                    </div>
                                @endif

                                @if($worshipSchedule->description)
                                    <div class="col-12 mb-4">
                                        <h6 class="fw-bold text-primary">📄 Deskripsi</h6>
                                        <p class="mb-0">{{ $worshipSchedule->description }}</p>
                                    </div>
                                @endif

                                @if($worshipSchedule->special_notes && count($worshipSchedule->special_notes) > 0)
                                    <div class="col-12 mb-4">
                                        <h6 class="fw-bold text-primary">📌 Catatan Khusus</h6>
                                        <div class="special-notes">
                                            @foreach($worshipSchedule->special_notes as $note)
                                                <div class="note-item mb-2">
                                                    <i class="fas fa-star me-2" style="color: #ffc107;"></i>
                                                    <span>{{ $note }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Sidebar Info -->
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">ℹ️ Informasi Tambahan</h6>
                                    
                                    <div class="mb-3">
                                        <small class="text-muted">Status</small>
                                        <div>
                                            @if($worshipSchedule->is_active)
                                                <span class="badge bg-success">✅ Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">❌ Nonaktif</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Urutan Tampilan</small>
                                        <div><strong>{{ $worshipSchedule->sort_order }}</strong></div>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Dibuat</small>
                                        <div>{{ $worshipSchedule->created_at->format('d M Y, H:i') }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Terakhir Diupdate</small>
                                        <div>{{ $worshipSchedule->updated_at->format('d M Y, H:i') }}</div>
                                    </div>

                                    <hr>

                                    <div class="d-grid gap-2">
                                        <a href="{{ route('worship-schedules.edit', $worshipSchedule) }}" class="btn btn-warning btn-sm">
                                            <i class="bx bx-edit"></i> Edit Jadwal
                                        </a>
                                        
                                        <form action="{{ route('worship-schedules.destroy', $worshipSchedule) }}" method="POST" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                                <i class="bx bx-trash"></i> Hapus Jadwal
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Preview Card -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">👀 Preview Tampilan di Website</h5>
                </div>
                <div class="card-body">
                    <div class="schedule-preview">
                        <div class="schedule-item {{ $worshipSchedule->is_featured ? 'center featured' : '' }}" style="max-width: 300px; margin: 0 auto;">
                            <div class="schedule-icon" style="text-align: center; margin-bottom: 1rem;">
                                <i class="{{ $worshipSchedule->icon }}" style="font-size: 2rem; color: #8B4513;"></i>
                            </div>
                            <div class="schedule-time" style="text-align: center;">
                                <h3 style="color: #8B4513; margin-bottom: 1rem;">{{ $worshipSchedule->name }}</h3>
                                <div class="time-display" style="margin-bottom: 1rem;">
                                    <span class="time" style="font-size: 2rem; font-weight: bold; color: #8B4513;">{{ $worshipSchedule->formatted_time }}</span>
                                    <span class="period" style="font-size: 1rem; color: #666; margin-left: 0.5rem;">{{ $worshipSchedule->period }}</span>
                                </div>
                                <p class="schedule-day" style="color: #666; margin-bottom: 1rem;">{{ $worshipSchedule->day }}</p>
                                
                                @if($worshipSchedule->special_notes && count($worshipSchedule->special_notes) > 0)
                                    <div class="special-note" style="margin-bottom: 1rem;">
                                        @foreach($worshipSchedule->special_notes as $note)
                                            <div class="note-item" style="margin-bottom: 0.5rem; color: #8B4513;">
                                                <i class="fas fa-star" style="margin-right: 0.5rem;"></i>
                                                <span>{{ $note }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                
                                <div class="schedule-details">
                                    @if($worshipSchedule->duration)
                                        <span class="detail-item" style="display: inline-block; margin-right: 1rem; color: #666;">
                                            <i class="fas fa-clock" style="margin-right: 0.25rem;"></i>
                                            {{ $worshipSchedule->duration }} Menit
                                        </span>
                                    @endif
                                    <span class="detail-item" style="display: inline-block; color: #666;">
                                        <i class="fas fa-users" style="margin-right: 0.25rem;"></i>
                                        {{ $worshipSchedule->target_audience }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection