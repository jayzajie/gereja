@extends('layouts.admin')

@section('title', 'Detail Baptisan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold py-3 mb-2" style="color: #8B4513;">
                        <span class="text-muted fw-light">Contact / Baptisan /</span> Detail
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

    <!-- Baptism Details -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detail Baptisan</h5>
                    <div>
                        <form method="POST" action="{{ route('baptisms.update-status', $baptism) }}" class="d-inline">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-select form-select-sm d-inline-block w-auto me-2" onchange="this.form.submit()">
                                <option value="pending" {{ $baptism->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $baptism->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $baptism->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </form>
                        <span class="badge bg-{{ $baptism->status == 'approved' ? 'success' : ($baptism->status == 'rejected' ? 'danger' : 'warning') }}">
                            {{ ucfirst($baptism->status ?? 'pending') }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Data Baptisan -->
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3" style="color: #8B4513 !important;">Informasi Baptisan</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-medium" style="width: 40%;">Nomor Baptis:</td>
                                    <td>{{ $baptism->nomor_baptis }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Nama Jemaat:</td>
                                    <td>{{ $baptism->nama_jemaat }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Tanggal Baptis:</td>
                                    <td>{{ \Carbon\Carbon::parse($baptism->tanggal_baptis)->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Dibaptis Oleh:</td>
                                    <td>{{ $baptism->dibaptis_oleh }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Data Keluarga -->
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3" style="color: #8B4513 !important;">Data Keluarga</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-medium" style="width: 40%;">Nama Ayah:</td>
                                    <td>{{ $baptism->nama_ayah }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Nama Ibu:</td>
                                    <td>{{ $baptism->nama_ibu }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Foto Baptisan -->
                    @if($baptism->foto)
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-muted mb-3" style="color: #8B4513 !important;">Foto Baptisan</h6>
                            <div class="text-center">
                                <img src="{{ asset('storage/' . $baptism->foto) }}" 
                                     alt="Foto Baptisan {{ $baptism->nama_jemaat }}" 
                                     class="img-fluid rounded shadow"
                                     style="max-height: 400px; max-width: 100%;">
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    @endif

                    <!-- Status & Timestamp -->
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3" style="color: #8B4513 !important;">Status & Waktu</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-medium" style="width: 40%;">Status:</td>
                                    <td>
                                        <span class="badge bg-{{ $baptism->status == 'approved' ? 'success' : ($baptism->status == 'rejected' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($baptism->status ?? 'pending') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Tanggal Submit:</td>
                                    <td>{{ $baptism->created_at->format('d F Y H:i') }} WIB</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Terakhir Update:</td>
                                    <td>{{ $baptism->updated_at->format('d F Y H:i') }} WIB</td>
                                </tr>
                            </table>
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
                <a href="{{ route('baptisms.edit', $baptism) }}" class="btn btn-primary">
                    <i class="bx bx-edit me-1"></i>Edit Data
                </a>
                <form method="POST" action="{{ route('baptisms.destroy', $baptism) }}" class="d-inline" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data baptisan ini?')">
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
