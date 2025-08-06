@extends('layouts.admin')

@section('title', 'Tambah Jadwal Ibadah')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold py-3 mb-4" style="color: #8B4513;">
                <span class="text-muted fw-light">🏠 Dashboard / ⏰ Jadwal Ibadah /</span> ➕ Tambah Baru
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">📝 Form Tambah Jadwal Ibadah</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('worship-schedules.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <!-- Nama Ibadah -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">📝 Nama Ibadah <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" 
                                       placeholder="Contoh: Ibadah Pagi" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Waktu -->
                            <div class="col-md-6 mb-3">
                                <label for="time" class="form-label">⏰ Waktu <span class="text-danger">*</span></label>
                                <input type="time" class="form-control @error('time') is-invalid @enderror" 
                                       id="time" name="time" value="{{ old('time') }}" required>
                                @error('time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Hari -->
                            <div class="col-md-6 mb-3">
                                <label for="day" class="form-label">📅 Hari <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('day') is-invalid @enderror" 
                                       id="day" name="day" value="{{ old('day') }}" 
                                       placeholder="Contoh: Setiap Minggu" required>
                                @error('day')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Target Audience -->
                            <div class="col-md-6 mb-3">
                                <label for="target_audience" class="form-label">👥 Target Jemaat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('target_audience') is-invalid @enderror" 
                                       id="target_audience" name="target_audience" value="{{ old('target_audience', 'Semua Umur') }}" 
                                       placeholder="Contoh: Semua Umur" required>
                                @error('target_audience')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Icon -->
                            <div class="col-md-6 mb-3">
                                <label for="icon" class="form-label">🎨 Icon <span class="text-danger">*</span></label>
                                <select class="form-select @error('icon') is-invalid @enderror" id="icon" name="icon" required>
                                    <option value="">Pilih Icon</option>
                                    <option value="fas fa-sun" {{ old('icon') == 'fas fa-sun' ? 'selected' : '' }}>☀️ Matahari (Pagi)</option>
                                    <option value="fas fa-church" {{ old('icon') == 'fas fa-church' ? 'selected' : '' }}>⛪ Gereja (Utama)</option>
                                    <option value="fas fa-moon" {{ old('icon') == 'fas fa-moon' ? 'selected' : '' }}>🌙 Bulan (Malam)</option>
                                    <option value="fas fa-cross" {{ old('icon') == 'fas fa-cross' ? 'selected' : '' }}>✝️ Salib</option>
                                    <option value="fas fa-pray" {{ old('icon') == 'fas fa-pray' ? 'selected' : '' }}>🙏 Doa</option>
                                    <option value="fas fa-heart" {{ old('icon') == 'fas fa-heart' ? 'selected' : '' }}>❤️ Hati</option>
                                </select>
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Durasi -->
                            <div class="col-md-6 mb-3">
                                <label for="duration" class="form-label">⏱️ Durasi (Menit)</label>
                                <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                       id="duration" name="duration" value="{{ old('duration') }}" 
                                       placeholder="Contoh: 90" min="1">
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="row">
                            <!-- Sort Order -->
                            <div class="col-md-6 mb-3">
                                <label for="sort_order" class="form-label">🔢 Urutan Tampilan <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                       id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" 
                                       min="0" required>
                                <small class="form-text text-muted">Semakin kecil angka, semakin awal ditampilkan</small>
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Checkbox Options -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_featured" 
                                           name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_featured">
                                        ⭐ Jadikan Ibadah Utama
                                    </label>
                                    <small class="form-text text-muted d-block">Ibadah utama akan ditampilkan di tengah dengan highlight khusus</small>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" 
                                           name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        ✅ Aktifkan Jadwal
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('worship-schedules.index') }}" class="btn btn-secondary">
                                <i class="bx bx-arrow-back"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save"></i> Simpan Jadwal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection