@extends('layouts.admin')

@section('title', 'SMGT - Persekutuan Kaum Bapak Gereja Toraja')

@push('styles')
<style>
    .crud-container {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        margin: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .crud-header {
        background: #f8f9fa;
        padding: 20px 25px;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .crud-header h5 {
        margin: 0;
        font-weight: 600;
        color: #495057;
        font-size: 18px;
    }

    .crud-body {
        padding: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        padding: 10px 15px;
    }

    .table {
        margin-top: 20px;
    }

    .btn-group {
        gap: 5px;
    }

    .info-card p {
        color: #6c757d;
        margin-bottom: 10px;
        line-height: 1.6;
    }

    .btn-primary {
        background: #007bff;
        border-color: #007bff;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 500;
    }

    .btn-primary:hover {
        background: #0056b3;
        border-color: #0056b3;
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-1">👶 SMGT - Sekolah Minggu Gereja Toraja</h4>
                    <p class="text-muted mb-0">Kelola data pengurus, program kerja, dan kegiatan SMGT</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#pengurus-tab" aria-controls="pengurus-tab" aria-selected="true">
                            <i class="tf-icons bx bx-user me-1"></i> Pengurus
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#program-kerja-tab" aria-controls="program-kerja-tab" aria-selected="false">
                            <i class="tf-icons bx bx-task me-1"></i> Program Kerja
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#kegiatan-tab" aria-controls="kegiatan-tab" aria-selected="false">
                            <i class="tf-icons bx bx-calendar me-1"></i> Kegiatan
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- PENGURUS TAB -->
                    <div class="tab-pane fade show active" id="pengurus-tab" role="tabpanel">
                        <div class="row">
                            <!-- Form Input Pengurus -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Form Data Pengurus SMGT</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.oig.pengurus.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="organisasi" value="SMGT">

                                            <div class="form-group mb-3">
                                                <label class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="nama_lengkap" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Jabatan</label>
                                                <input type="text" class="form-control" name="jabatan" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi" rows="3"></textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Foto</label>
                                                <input type="file" class="form-control" name="foto" accept="image/*">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">No. Telepon</label>
                                                <input type="text" class="form-control" name="no_telepon">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email">
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Periode Mulai</label>
                                                        <input type="number" class="form-control" name="periode_mulai" value="{{ date('Y') }}" min="2020" max="2030" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Periode Selesai</label>
                                                        <input type="number" class="form-control" name="periode_selesai" value="{{ date('Y') + 1 }}" min="2020" max="2030" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Urutan</label>
                                                <input type="number" class="form-control" name="urutan" value="0" min="0">
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bx bx-save me-2"></i>Simpan
                                                </button>
                                                <button type="reset" class="btn btn-secondary ms-2">
                                                    <i class="bx bx-reset me-2"></i>Reset
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Table Pengurus -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Data Pengurus SMGT</h6>
                                        <button class="btn btn-success btn-sm">
                                            <i class="bx bx-export me-1"></i>Export
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Jabatan</th>
                                                        <th>Telepon</th>
                                                        <th>Periode</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($pengurus as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $item->nama_lengkap }}</td>
                                                            <td>{{ $item->jabatan }}</td>
                                                            <td>{{ $item->no_telepon ?? '-' }}</td>
                                                            <td>{{ $item->periode_mulai }} - {{ $item->periode_selesai }}</td>
                                                            <td>
                                                                @if($item->is_active)
                                                                    <span class="badge bg-success">Aktif</span>
                                                                @else
                                                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn btn-sm btn-warning" onclick="editPengurus({{ $item->id }})">
                                                                        <i class="bx bx-edit"></i>
                                                                    </button>
                                                                    <form action="{{ route('admin.oig.pengurus.delete', $item->id) }}" method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                                            <i class="bx bx-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center">Belum ada data pengurus</td>
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

                    <!-- PROGRAM KERJA TAB -->
                    <div class="tab-pane fade" id="program-kerja-tab" role="tabpanel">
                        <div class="row">
                            <!-- Form Input Program Kerja -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Form Program Kerja SMGT</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.oig.program-kerja.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="organisasi" value="SMGT">

                                            <div class="form-group mb-3">
                                                <label class="form-label">Nama Program</label>
                                                <input type="text" class="form-control" name="nama_program" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Tujuan</label>
                                                <textarea class="form-control" name="tujuan" rows="2"></textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Sasaran</label>
                                                <textarea class="form-control" name="sasaran" rows="2"></textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Tanggal Mulai</label>
                                                        <input type="date" class="form-control" name="tanggal_mulai">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Tanggal Selesai</label>
                                                        <input type="date" class="form-control" name="tanggal_selesai">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Penanggung Jawab</label>
                                                <input type="text" class="form-control" name="penanggung_jawab">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Anggaran</label>
                                                <input type="number" class="form-control" name="anggaran" min="0">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="draft">Draft</option>
                                                    <option value="aktif">Aktif</option>
                                                    <option value="selesai">Selesai</option>
                                                    <option value="dibatalkan">Dibatalkan</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Gambar</label>
                                                <input type="file" class="form-control" name="gambar" accept="image/*">
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Tahun</label>
                                                        <input type="number" class="form-control" name="tahun" value="{{ date('Y') }}" min="2020" max="2030" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Urutan</label>
                                                        <input type="number" class="form-control" name="urutan" value="0" min="0">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bx bx-save me-2"></i>Simpan
                                                </button>
                                                <button type="reset" class="btn btn-secondary ms-2">
                                                    <i class="bx bx-reset me-2"></i>Reset
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Table Program Kerja -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Data Program Kerja SMGT</h6>
                                        <button class="btn btn-success btn-sm">
                                            <i class="bx bx-export me-1"></i>Export
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Program</th>
                                                        <th>Penanggung Jawab</th>
                                                        <th>Tanggal</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($programKerja as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $item->nama_program }}</td>
                                                            <td>{{ $item->penanggung_jawab ?? '-' }}</td>
                                                            <td>
                                                                @if($item->tanggal_mulai && $item->tanggal_selesai)
                                                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }} -
                                                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') }}
                                                                @else
                                                                    -
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @switch($item->status)
                                                                    @case('draft')
                                                                        <span class="badge bg-secondary">Draft</span>
                                                                        @break
                                                                    @case('aktif')
                                                                        <span class="badge bg-primary">Aktif</span>
                                                                        @break
                                                                    @case('selesai')
                                                                        <span class="badge bg-success">Selesai</span>
                                                                        @break
                                                                    @case('dibatalkan')
                                                                        <span class="badge bg-danger">Dibatalkan</span>
                                                                        @break
                                                                @endswitch
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn btn-sm btn-warning" onclick="editProgramKerja({{ $item->id }})">
                                                                        <i class="bx bx-edit"></i>
                                                                    </button>
                                                                    <form action="{{ route('admin.oig.program-kerja.delete', $item->id) }}" method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                                            <i class="bx bx-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center">Belum ada data program kerja</td>
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

                    <!-- KEGIATAN TAB -->
                    <div class="tab-pane fade" id="kegiatan-tab" role="tabpanel">
                        <div class="row">
                            <!-- Form Input Kegiatan -->
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="mb-0">Form Kegiatan SMGT</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('admin.oig.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="organisasi" value="SMGT">

                                            <div class="form-group mb-3">
                                                <label class="form-label">Nama Kegiatan</label>
                                                <input type="text" class="form-control" name="nama_kegiatan" required>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Tanggal Kegiatan</label>
                                                <input type="date" class="form-control" name="tanggal_kegiatan" required>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Waktu Mulai</label>
                                                        <input type="time" class="form-control" name="waktu_mulai">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Waktu Selesai</label>
                                                        <input type="time" class="form-control" name="waktu_selesai">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Tempat</label>
                                                <input type="text" class="form-control" name="tempat">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Penanggung Jawab</label>
                                                <input type="text" class="form-control" name="penanggung_jawab">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Jumlah Peserta</label>
                                                <input type="number" class="form-control" name="jumlah_peserta" min="0">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Anggaran</label>
                                                <input type="number" class="form-control" name="anggaran" min="0">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Status</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="rencana">Rencana</option>
                                                    <option value="berlangsung">Berlangsung</option>
                                                    <option value="selesai">Selesai</option>
                                                    <option value="dibatalkan">Dibatalkan</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Gambar</label>
                                                <input type="file" class="form-control" name="gambar" accept="image/*">
                                            </div>

                                            <div class="form-group mb-3">
                                                <label class="form-label">Catatan</label>
                                                <textarea class="form-control" name="catatan" rows="2"></textarea>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Tahun</label>
                                                        <input type="number" class="form-control" name="tahun" value="{{ date('Y') }}" min="2020" max="2030" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Urutan</label>
                                                        <input type="number" class="form-control" name="urutan" value="0" min="0">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bx bx-save me-2"></i>Simpan
                                                </button>
                                                <button type="reset" class="btn btn-secondary ms-2">
                                                    <i class="bx bx-reset me-2"></i>Reset
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Table Kegiatan -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Data Kegiatan SMGT</h6>
                                        <button class="btn btn-success btn-sm">
                                            <i class="bx bx-export me-1"></i>Export
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Kegiatan</th>
                                                        <th>Tanggal</th>
                                                        <th>Tempat</th>
                                                        <th>Peserta</th>
                                                        <th>Status</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($kegiatan as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $item->nama_kegiatan }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($item->tanggal_kegiatan)->format('d/m/Y') }}</td>
                                                            <td>{{ $item->tempat ?? '-' }}</td>
                                                            <td>{{ $item->jumlah_peserta ?? '-' }}</td>
                                                            <td>
                                                                @switch($item->status)
                                                                    @case('rencana')
                                                                        <span class="badge bg-secondary">Rencana</span>
                                                                        @break
                                                                    @case('berlangsung')
                                                                        <span class="badge bg-warning">Berlangsung</span>
                                                                        @break
                                                                    @case('selesai')
                                                                        <span class="badge bg-success">Selesai</span>
                                                                        @break
                                                                    @case('dibatalkan')
                                                                        <span class="badge bg-danger">Dibatalkan</span>
                                                                        @break
                                                                @endswitch
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn btn-sm btn-warning" onclick="editKegiatan({{ $item->id }})">
                                                                        <i class="bx bx-edit"></i>
                                                                    </button>
                                                                    <form action="{{ route('admin.oig.kegiatan.delete', $item->id) }}" method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                                            <i class="bx bx-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="7" class="text-center">Belum ada data kegiatan</td>
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
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function editPengurus(id) {
    // TODO: Implement edit functionality
    alert('Edit pengurus dengan ID: ' + id);
}

function editProgramKerja(id) {
    // TODO: Implement edit functionality
    alert('Edit program kerja dengan ID: ' + id);
}

function editKegiatan(id) {
    // TODO: Implement edit functionality
    alert('Edit kegiatan dengan ID: ' + id);
}

// Show success/error messages
@if(session('success'))
    toastr.success('{{ session('success') }}');
@endif

@if(session('error'))
    toastr.error('{{ session('error') }}');
@endif
</script>
@endpush
@endsection
