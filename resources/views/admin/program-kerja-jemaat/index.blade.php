@extends('layouts.admin')

@section('title', 'Program Kerja Jemaat Selili')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">📋 Program Kerja Jemaat Selili</h5>
                    <a href="{{ route('program-kerja-jemaat.create') }}" class="btn btn-primary">
                        ➕ <i class="bx bx-plus me-1"></i>Tambah Program Kerja
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($programKerjaJemaat->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tanggal Posting</th>
                                        <th>Nama Program</th>
                                        <th>File</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($programKerjaJemaat as $index => $item)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($item->publish_date)->format('Y-m-d') }}</td>
                                            <td>
                                                <strong>{{ $item->title }}</strong>
                                                @if($item->is_featured)
                                                    <span class="badge bg-warning ms-1">Featured</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->file_path)
                                                    <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="text-primary">
                                                        📎 {{ $item->file_name ?? 'File' }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('program-kerja-jemaat.show', $item->id) }}"
                                                       class="btn btn-sm btn-outline-info" title="Lihat">
                                                        👁️ <i class="bx bx-show"></i>
                                                    </a>
                                                    <a href="{{ route('program-kerja-jemaat.edit', $item->id) }}"
                                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                                        ✏️ <i class="bx bx-edit"></i>
                                                    </a>



                                                    <form action="{{ route('program-kerja-jemaat.destroy', $item->id) }}"
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('Yakin ingin menghapus program kerja ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                            🗑️ <i class="bx bx-trash"></i>
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
                        <div class="d-flex justify-content-center mt-4">
                            {{ $programKerjaJemaat->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bx bx-clipboard" style="font-size: 4rem; color: #ddd;"></i>
                            <h5 class="mt-3 text-muted">Belum ada Program Kerja Jemaat</h5>
                            <p class="text-muted">Klik tombol "Tambah Program Kerja" untuk menambah program kerja pertama.</p>
                            <a href="{{ route('program-kerja-jemaat.create') }}" class="btn btn-primary">
                                🚀 <i class="bx bx-plus me-1"></i>Tambah Program Kerja
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
