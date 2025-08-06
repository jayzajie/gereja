@extends('layouts.admin')

@section('title', 'Detail Warta Mingguan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Informasi / Warta Mingguan /</span> Detail
        </h4>
        <a href="{{ route('warta-mingguan.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back me-1"></i>Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $warta->nama_warta }}</h5>
                    <div class="dropdown">
                        <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                            Aksi
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('warta-mingguan.download', $warta->id) }}">
                                <i class="bx bx-download me-1"></i>Download
                            </a>
                            <a class="dropdown-item" href="{{ route('warta-mingguan.view', $warta->id) }}" target="_blank">
                                <i class="bx bx-show me-1"></i>Lihat PDF
                            </a>
                            <a class="dropdown-item" href="{{ route('warta-mingguan.edit', $warta->id) }}">
                                <i class="bx bx-edit me-1"></i>Edit
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#" onclick="deleteFile({{ $warta->id }})">
                                <i class="bx bx-trash me-1"></i>Hapus
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Informasi File</h6>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td class="text-muted" style="width: 40%;">Nama File:</td>
                                    <td>{{ $warta->file_name }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Ukuran File:</td>
                                    <td>{{ $warta->file_size_readable }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Format:</td>
                                    <td><span class="badge bg-label-danger">PDF</span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted mb-2">Informasi Tanggal</h6>
                            <table class="table table-borderless table-sm">
                                <tr>
                                    <td class="text-muted" style="width: 40%;">Tanggal:</td>
                                    <td>{{ $warta->tanggal }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Bulan:</td>
                                    <td>{{ $warta->bulan_nama }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tahun:</td>
                                    <td>{{ $warta->tahun }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($warta->deskripsi)
                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Deskripsi</h6>
                        <p class="mb-0">{{ $warta->deskripsi }}</p>
                    </div>
                    @endif

                    <div class="mb-4">
                        <h6 class="text-muted mb-2">Informasi Sistem</h6>
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td class="text-muted" style="width: 40%;">Dibuat:</td>
                                <td>{{ $warta->created_at->format('d F Y H:i') }}</td>
                            </tr>
                            @if($warta->updated_at != $warta->created_at)
                            <tr>
                                <td class="text-muted">Diperbarui:</td>
                                <td>{{ $warta->updated_at->format('d F Y H:i') }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">Preview File</h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bx bxs-file-pdf text-danger" style="font-size: 4rem;"></i>
                    </div>
                    <h6 class="mb-2">{{ $warta->nama_warta }}</h6>
                    <p class="text-muted small mb-3">{{ $warta->file_size_readable }}</p>
                    
                    <div class="d-grid gap-2">
                        <a href="{{ route('warta-mingguan.view', $warta->id) }}" target="_blank" class="btn btn-primary">
                            <i class="bx bx-show me-1"></i>Lihat PDF
                        </a>
                        <a href="{{ route('warta-mingguan.download', $warta->id) }}" class="btn btn-outline-primary">
                            <i class="bx bx-download me-1"></i>Download
                        </a>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">Aksi Cepat</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('warta-mingguan.edit', $warta->id) }}" class="btn btn-warning">
                            <i class="bx bx-edit me-1"></i>Edit Warta
                        </a>
                        <button type="button" class="btn btn-danger" onclick="deleteFile({{ $warta->id }})">
                            <i class="bx bx-trash me-1"></i>Hapus Warta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function deleteFile(id) {
        if (confirm('Yakin ingin menghapus warta ini?')) {
            fetch(`/warta-mingguan/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.href = '{{ route("warta-mingguan.index") }}';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus warta');
            });
        }
    }
</script>
@endpush
