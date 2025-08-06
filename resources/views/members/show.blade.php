@extends('layouts.admin')

@section('title', 'Detail Anggota Jemaat')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4" style="color: #8B4513;">
                    <span class="text-muted fw-light">📜 Kelola Profil / 👥 Anggota Jemaat /</span> 👁️ Detail Anggota
                </h4>
                <div class="d-flex gap-2">
                    <a href="{{ route('members.edit', $member) }}" class="btn btn-primary">
                        <i class="bx bx-edit me-1"></i>✏️ Edit
                    </a>
                    <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Profile Card -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    @if($member->foto)
                        <img src="{{ asset('storage/' . $member->foto) }}" alt="Foto {{ $member->nama_lengkap }}"
                             class="rounded-circle mb-3" width="120" height="120" style="object-fit: cover;">
                    @else
                        <div class="avatar avatar-xl mx-auto mb-3">
                            <span class="avatar-initial rounded-circle bg-label-primary" style="font-size: 2rem;">
                                {{ substr($member->nama_lengkap, 0, 1) }}
                            </span>
                        </div>
                    @endif
                    <h5 class="mb-2">{{ $member->nama_lengkap }}</h5>
                    <p class="text-muted mb-3">{{ $member->pekerjaan ?? 'Tidak ada pekerjaan' }}</p>
                    <span class="badge bg-{{ $member->status == 'active' ? 'success' : 'secondary' }} mb-3">
                        {{ $member->status == 'active' ? '✅ Aktif' : '❌ Tidak Aktif' }}
                    </span>
                    <div class="d-flex justify-content-center gap-2">
                        @if($member->no_hp)
                            <a href="tel:{{ $member->no_hp }}" class="btn btn-outline-primary btn-sm">
                                <i class="bx bx-phone"></i>
                            </a>
                        @endif
                        @if($member->email)
                            <a href="mailto:{{ $member->email }}" class="btn btn-outline-info btn-sm">
                                <i class="bx bx-envelope"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Card -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">📋 Informasi Detail</h5>
                </div>
                <div class="card-body">
                    <!-- Data Pribadi -->
                    <h6 class="text-primary mb-3">👤 Data Pribadi</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Nama Lengkap:</strong><br>
                            <span class="text-muted">{{ $member->nama_lengkap }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Jenis Kelamin:</strong><br>
                            <span class="badge bg-{{ $member->jenis_kelamin == 'Laki-laki' ? 'primary' : 'info' }}">
                                {{ $member->jenis_kelamin == 'Laki-laki' ? '👨' : '👩' }} {{ $member->jenis_kelamin }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Tanggal Lahir:</strong><br>
                            <span class="text-muted">{{ $member->tanggal_lahir->format('d F Y') }} ({{ $member->umur }} tahun)</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Tempat Lahir:</strong><br>
                            <span class="text-muted">{{ $member->tempat_lahir }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <strong>Alamat:</strong><br>
                            <span class="text-muted">{{ $member->alamat }}</span>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <strong>No HP:</strong><br>
                            <span class="text-muted">{{ $member->no_hp ?? '-' }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Email:</strong><br>
                            <span class="text-muted">{{ $member->email ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Data Keluarga -->
                    <h6 class="text-primary mb-3">👨‍👩‍👧‍👦 Data Keluarga</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Status Pernikahan:</strong><br>
                            <span class="text-muted">{{ $member->status_pernikahan }}</span>
                        </div>
                        @if($member->nama_pasangan)
                        <div class="col-md-6">
                            <strong>Nama Pasangan:</strong><br>
                            <span class="text-muted">{{ $member->nama_pasangan }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <strong>Nama Ayah:</strong><br>
                            <span class="text-muted">{{ $member->nama_ayah ?? '-' }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Nama Ibu:</strong><br>
                            <span class="text-muted">{{ $member->nama_ibu ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Data Gereja -->
                    <h6 class="text-primary mb-3">⛪ Data Gereja</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Tanggal Baptis:</strong><br>
                            <span class="text-muted">{{ $member->tanggal_baptis ? $member->tanggal_baptis->format('d F Y') : '-' }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Tempat Baptis:</strong><br>
                            <span class="text-muted">{{ $member->tempat_baptis ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Tanggal Sidi:</strong><br>
                            <span class="text-muted">{{ $member->tanggal_sidi ? $member->tanggal_sidi->format('d F Y') : '-' }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Tempat Sidi:</strong><br>
                            <span class="text-muted">{{ $member->tempat_sidi ?? '-' }}</span>
                        </div>

                    <!-- Data Waktu -->
                    <h6 class="text-primary mb-3">🕒 Data Waktu</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Tanggal Daftar:</strong><br>
                            <span class="text-muted">{{ $member->created_at->format('d F Y H:i') }} WIB</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Terakhir Update:</strong><br>
                            <span class="text-muted">{{ $member->updated_at->format('d F Y H:i') }} WIB</span>
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
                <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">
                    <i class="bx bx-arrow-back me-1"></i>🔙 Kembali ke Daftar
                </a>
                <a href="{{ route('members.edit', $member) }}" class="btn btn-primary">
                    <i class="bx bx-edit me-1"></i>✏️ Edit Data
                </a>
                <form method="POST" action="{{ route('members.destroy', $member) }}" class="d-inline"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data anggota ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash me-1"></i>🗑️ Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
