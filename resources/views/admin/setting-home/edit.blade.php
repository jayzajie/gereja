@extends('layouts.admin')

@section('title', 'Edit Setting Home')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">✏️ Edit Setting Home</h5>
                    <a href="{{ route('setting-home.index') }}" class="btn btn-outline-secondary">
                        ⬅️ <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('setting-home.update', $setting->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Setting <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                           id="title" name="title" value="{{ old('title', $setting->title) }}"
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
                                        <option value="hero" {{ old('type', $setting->subcategory) == 'hero' ? 'selected' : '' }}>🏠 Hero Section</option>
                                        <option value="about" {{ old('type', $setting->subcategory) == 'about' ? 'selected' : '' }}>ℹ️ About Section</option>
                                        <option value="contact" {{ old('type', $setting->subcategory) == 'contact' ? 'selected' : '' }}>📞 Contact Section</option>
                                        <option value="footer" {{ old('type', $setting->subcategory) == 'footer' ? 'selected' : '' }}>📄 Footer Section</option>
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
                                        <option value="low" {{ old('priority', $setting->priority) == 'low' ? 'selected' : '' }}>🔵 Low</option>
                                        <option value="medium" {{ old('priority', $setting->priority) == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                                        <option value="high" {{ old('priority', $setting->priority) == 'high' ? 'selected' : '' }}>🔴 High</option>
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
                                      placeholder="Masukkan konten setting home...">{{ old('content', $setting->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Anda dapat menggunakan HTML untuk formatting</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                       {{ old('is_active', $setting->status == 'published') ? 'checked' : '' }}>
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
                                💾 <i class="bx bx-save me-1"></i>Update Setting
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
