@extends('layouts.admin')

@section('title', 'Setting Home')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">⚙️ Setting Home</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('setting-home.create') }}" class="btn btn-primary">
                            ➕ <i class="bx bx-plus me-1"></i>Tambah Setting
                        </a>
                        <button type="button" class="btn btn-outline-secondary" onclick="location.reload()">
                            🔄 <i class="bx bx-refresh me-1"></i>Refresh
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($homeSettings->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Tipe</th>
                                        <th>Prioritas</th>
                                        <th>Status</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($homeSettings as $index => $setting)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <strong>{{ $setting->title }}</strong>
                                                <br>
                                                <small class="text-muted">{{ Str::limit($setting->content, 50) }}</small>
                                            </td>
                                            <td>
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
                                            </td>
                                            <td>
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
                                            </td>
                                            <td>
                                                @if($setting->status == 'published')
                                                    <span class="badge bg-success">✅ Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">❌ Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td>{{ $setting->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('setting-home.show', $setting->id) }}" class="btn btn-sm btn-outline-info" title="Lihat Detail">
                                                        <i class="bx bx-show"></i>
                                                    </a>
                                                    <a href="{{ route('setting-home.edit', $setting->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                        <i class="bx bx-edit-alt"></i>
                                                    </a>
                                                    <form action="{{ route('setting-home.destroy', $setting->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus setting ini?')">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bx bx-cog" style="font-size: 4rem; color: #ddd;"></i>
                            <h5 class="mt-3 text-muted">Belum ada Setting Home</h5>
                            <p class="text-muted">Klik tombol "Tambah Setting" untuk menambah setting home pertama.</p>
                            <a href="{{ route('setting-home.create') }}" class="btn btn-primary">
                                🚀 <i class="bx bx-plus me-1"></i>Tambah Setting
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
