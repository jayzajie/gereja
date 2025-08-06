@extends('layouts.admin')

@section('title', 'Tambah Setting Home')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">➕ Tambah Setting Home</h5>
                    <a href="{{ route('setting-home.index') }}" class="btn btn-outline-secondary">
                        ⬅️ <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('setting-home.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Setting <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title') }}"
                                           placeholder="Masukkan judul setting">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Tipe Section <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type">
                                        <option value="">Pilih Tipe</option>
                                        <option value="hero" {{ old('type') == 'hero' ? 'selected' : '' }}>🏠 Hero Section</option>
                                        <option value="about" {{ old('type') == 'about' ? 'selected' : '' }}>ℹ️ About Section</option>
                                        <option value="contact" {{ old('type') == 'contact' ? 'selected' : '' }}>📞 Contact Section</option>
                                        <option value="footer" {{ old('type') == 'footer' ? 'selected' : '' }}>📄 Footer Section</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="priority" class="form-label">Prioritas</label>
                                    <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority">
                                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>🔵 Low</option>
                                        <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>🔴 High</option>
                                    </select>
                                    @error('priority')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Prioritas tampilan di halaman</small>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Konten <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('content') is-invalid @enderror"
                                      id="content" name="content" rows="8"
                                      placeholder="Masukkan konten setting home...">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Anda dapat menggunakan HTML untuk formatting</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                       {{ old('is_active') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    ✅ Aktifkan Setting
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('setting-home.index') }}" class="btn btn-outline-secondary">
                                ❌ Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                💾 <i class="bx bx-save me-1"></i>Simpan Setting
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-generate title based on type selection
    document.getElementById('type').addEventListener('change', function() {
        const titleInput = document.getElementById('title');
        if (!titleInput.value) {
            const typeMap = {
                'hero': 'Hero Section - Beranda',
                'about': 'About Section - Tentang Kami',
                'contact': 'Contact Section - Kontak',
                'footer': 'Footer Section - Footer'
            };
            if (typeMap[this.value]) {
                titleInput.value = typeMap[this.value];
            }
        }
    });
</script>
@endpush
@endsection
