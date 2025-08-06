@extends('layouts.admin')

@section('title', 'Anggota Jemaat')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4" style="color: #8B4513;">
                    <span class="text-muted fw-light">🏠 Dashboard /</span> 👥 Anggota Jemaat
                </h4>
                <div class="btn-group">
                    <!-- Export Button -->
                    <a href="{{ route('members.export') }}" class="btn btn-outline-success me-2">
                        📗 Export Excel
                    </a>
                    <!-- Add Member Button -->
                    <a href="{{ route('members.create') }}" class="btn btn-primary">
                        <i class="bx bx-plus me-1"></i>➕ Tambah Anggota
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>👤 Nama Lengkap</th>
                                    <th>📧 Email</th>
                                    <th>📱 Telepon</th>
                                    <th>📊 Status</th>
                                    <th>⚙️ Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $member)
                                    <tr>
                                        <td>{{ $member->nama_lengkap }}</td>
                                        <td>{{ $member->email ?? '-' }}</td>
                                        <td>{{ $member->no_hp ?? '-' }}</td>
                                        <td>
                                            @if($member->status === 'active')
                                                <span class="badge bg-success">✅ Aktif</span>
                                            @elseif($member->status === 'pending')
                                                <span class="badge bg-warning">⏳ Pending</span>
                                            @else
                                                <span class="badge bg-secondary">❌ Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('members.show', $member) }}" class="btn btn-sm btn-outline-info">
                                                    👁️ Lihat
                                                </a>
                                                <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-outline-warning">
                                                    ✏️ Edit
                                                </a>
                                                <form action="{{ route('members.destroy', $member) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data anggota ini?')">
                                                        🗑️ Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="mb-3">
                                                <i class="bx bx-user-plus" style="font-size: 3rem; color: #ccc;"></i>
                                            </div>
                                            <p class="text-muted">Belum ada data anggota jemaat</p>
                                            <a href="{{ route('members.create') }}" class="btn btn-primary">
                                                <i class="bx bx-plus me-1"></i>Tambah Anggota Pertama
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
