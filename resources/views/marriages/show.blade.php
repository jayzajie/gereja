@extends('layouts.admin')

@section('title', 'Detail Pernikahan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold py-3 mb-2" style="color: #8B4513;">
                        <span class="text-muted fw-light">Contact / Pernikahan /</span> Detail
                    </h4>
                </div>
                <div>
                    <a href="{{ route('dashboard.contact-data') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Marriage Details -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detail Pernikahan</h5>
                    <div>
                        <form method="POST" action="{{ route('marriages.update-status', $marriage) }}" class="d-inline">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm d-inline-block w-auto me-2" onchange="this.form.submit()">
                                <option value="pending" {{ $marriage->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $marriage->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $marriage->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </form>
                        <span class="badge bg-{{ $marriage->status == 'approved' ? 'success' : ($marriage->status == 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($marriage->status ?? 'pending') }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Data Calon Pria -->
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3" style="color: #8B4513 !important;">Data Calon Pria</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-medium" style="width: 40%;">Nama Lengkap:</td>
                                    <td>{{ $marriage->nama_calon_pria }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Tanggal Lahir:</td>
                                    <td>{{ \Carbon\Carbon::parse($marriage->tanggal_lahir_pria)->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Tempat Lahir:</td>
                                    <td>{{ $marriage->tempat_lahir_pria ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Alamat:</td>
                                    <td>{{ $marriage->alamat_pria }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Pekerjaan:</td>
                                    <td>{{ $marriage->pekerjaan_pria }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">No. Telepon:</td>
                                    <td>{{ $marriage->no_telepon_pria ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Email:</td>
                                    <td>{{ $marriage->email_pria ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Nama Ayah:</td>
                                    <td>{{ $marriage->nama_ayah_pria }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Nama Ibu:</td>
                                    <td>{{ $marriage->nama_ibu_pria }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Data Calon Wanita -->
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3" style="color: #8B4513 !important;">Data Calon Wanita</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-medium" style="width: 40%;">Nama Lengkap:</td>
                                    <td>{{ $marriage->nama_calon_wanita }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Tanggal Lahir:</td>
                                    <td>{{ \Carbon\Carbon::parse($marriage->tanggal_lahir_wanita)->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Tempat Lahir:</td>
                                    <td>{{ $marriage->tempat_lahir_wanita ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Alamat:</td>
                                    <td>{{ $marriage->alamat_wanita }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Pekerjaan:</td>
                                    <td>{{ $marriage->pekerjaan_wanita }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">No. Telepon:</td>
                                    <td>{{ $marriage->no_telepon_wanita ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Email:</td>
                                    <td>{{ $marriage->email_wanita ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Nama Ayah:</td>
                                    <td>{{ $marriage->nama_ayah_wanita }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Nama Ibu:</td>
                                    <td>{{ $marriage->nama_ibu_wanita }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Data Pernikahan -->
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-muted mb-3" style="color: #8B4513 !important;">Data Pernikahan</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-medium" style="width: 40%;">Tanggal Pernikahan:</td>
                                            <td>{{ \Carbon\Carbon::parse($marriage->tanggal_pernikahan)->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Tempat Pernikahan:</td>
                                            <td>{{ $marriage->tempat_pernikahan }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Saksi:</td>
                                            <td>{{ $marriage->saksi }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="fw-medium" style="width: 40%;">Status:</td>
                                            <td>
                                                <span class="badge bg-{{ $marriage->status == 'approved' ? 'success' : ($marriage->status == 'rejected' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($marriage->status ?? 'pending') }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Tanggal Submit:</td>
                                            <td>{{ $marriage->created_at->format('d F Y H:i') }} WIB</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-medium">Terakhir Update:</td>
                                            <td>{{ $marriage->updated_at->format('d F Y H:i') }} WIB</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex gap-2">
                <a href="{{ route('dashboard.contact-data') }}" class="btn btn-outline-secondary">
                    <i class="bx bx-arrow-back me-1"></i>Kembali ke Daftar
                </a>
                <a href="{{ route('marriages.edit', $marriage) }}" class="btn btn-primary">
                    <i class="bx bx-edit me-1"></i>Edit Data
                </a>
                <form method="POST" action="{{ route('marriages.destroy', $marriage) }}" class="d-inline" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pernikahan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash me-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
