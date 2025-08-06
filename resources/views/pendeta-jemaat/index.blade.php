@extends('layouts.admin')

@section('title', 'Pendeta Jemaat')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4" style="color: #8B4513;">
                    <span class="text-muted fw-light">🏠 Dashboard /</span> 👨‍💼 Pendeta Jemaat
                </h4>
                <a href="{{ route('pastors.create') }}" class="btn btn-primary">
                    <i class="bx bx-plus me-1"></i>➕ Tambah Pendeta Baru
                </a>
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
                                    <th>👤 Nama Pendeta</th>
                                    <th>📧 Email</th>
                                    <th>📱 Telepon</th>
                                    <th>📊 Status</th>
                                    <th>⚙️ Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pastors as $pastor)
                                    <tr>
                                        <td>{{ $pastor->name }}</td>
                                        <td>{{ $pastor->email }}</td>
                                        <td>{{ $pastor->phone }}</td>
                                        <td>
                                            @if($pastor->status === 'active')
                                                <span class="badge bg-success">✅ Aktif</span>
                                            @elseif($pastor->status === 'inactive')
                                                <span class="badge bg-warning">⏸️ Tidak Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">🏁 Pensiun</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('pastors.show', $pastor) }}" class="btn btn-sm btn-outline-info" title="Lihat Detail">
                                                    <i class="bx bx-show me-1"></i>👁️ Lihat
                                                </a>
                                                <a href="{{ route('pastors.edit', $pastor) }}" class="btn btn-sm btn-outline-warning" title="Edit Pendeta">
                                                    <i class="bx bx-edit me-1"></i>✏️ Edit
                                                </a>
                                                <form action="{{ route('pastors.destroy', $pastor) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Pendeta" onclick="return confirm('Apakah Anda yakin ingin menghapus pendeta ini?')">
                                                        <i class="bx bx-trash me-1"></i>🗑️ Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($pastors->hasPages())
                        <div class="mt-4">
                            {{ $pastors->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
