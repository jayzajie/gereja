@extends('layouts.admin')

@section('title', 'Detail Setting Home')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">👁️ Detail Setting Home</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('setting-home.edit', $setting->id) }}" class="btn btn-primary">
                            ✏️ <i class="bx bx-edit me-1"></i>Edit
                        </a>
                        <a href="{{ route('setting-home.index') }}" class="btn btn-outline-secondary">
                            ⬅️ <i class="bx bx-arrow-back me-1"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Judul Setting</h6>
                                <h4 class="mb-0">{{ $setting->title }}</h4>
                            </div>

                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Konten</h6>
                                <div class="border rounded p-3" style="background-color: #f8f9fa;">
                                    {!! nl2br(e($setting->content)) !!}
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Preview HTML</h6>
                                <div class="border rounded p-3" style="background-color: #fff;">
                                    {!! $setting->content !!}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">📊 Informasi Setting</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <small class="text-muted">Tipe Section</small>
                                        <div>
                                            @switch($setting->subcategory)
                                                @case('hero')
                                                    <span class="badge bg-primary">🏠 Hero Section</span>
                                                    @break
                                                @case('about')
                                                    <span class="badge bg-info">ℹ️ About Section</span>
                                                    @break
                                                @case('contact')
                                                    <span class="badge bg-success">📞 Contact Section</span>
                                                    @break
                                                @case('footer')
                                                    <span class="badge bg-secondary">📄 Footer Section</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-light text-dark">{{ $setting->subcategory }}</span>
                                            @endswitch
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Prioritas</small>
                                        <div>
                                            @switch($setting->priority)
                                                @case('high')
                                                    <span class="badge bg-danger">🔴 High</span>
                                                    @break
                                                @case('medium')
                                                    <span class="badge bg-warning">🟡 Medium</span>
                                                    @break
                                                @case('low')
                                                    <span class="badge bg-secondary">🔵 Low</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-light text-dark">{{ $setting->priority }}</span>
                                            @endswitch
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Status</small>
                                        <div>
                                            @if($setting->status == 'published')
                                                <span class="badge bg-success">✅ Aktif</span>
                                            @else
                                                <span class="badge bg-danger">❌ Tidak Aktif</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Catatan</small>
                                        <div>{{ $setting->notes ?? 'Tidak ada catatan' }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Tanggal Dibuat</small>
                                        <div>{{ $setting->created_at->format('d F Y, H:i') }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <small class="text-muted">Terakhir Diupdate</small>
                                        <div>{{ $setting->updated_at->format('d F Y, H:i') }}</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <form action="{{ route('setting-home.destroy', $setting->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus setting ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger w-100">
                                        🗑️ <i class="bx bx-trash me-1"></i>Hapus Setting
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
@endsection
