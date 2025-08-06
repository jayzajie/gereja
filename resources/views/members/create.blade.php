@extends('layouts.admin')

@section('title', 'Tambah Anggota Jemaat')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4" style="color: #8B4513;">
                    <span class="text-muted fw-light">📜 Kelola Profil / 👥 Anggota Jemaat /</span> ➕ Tambah Anggota
                </h4>
                <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">
                    <i class="bx bx-arrow-back me-1"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">📝 Form Tambah Anggota Jemaat</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Data Pribadi -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">👤 Data Pribadi</h6>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                       id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                        id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Lk" {{ old('jenis_kelamin') == 'Lk' ? 'selected' : '' }}>👨 Laki-laki</option>
                                    <option value="Pr" {{ old('jenis_kelamin') == 'Pr' ? 'selected' : '' }}>👩 Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                       id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                       id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label" for="alamat">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror"
                                          id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="no_hp">No HP</label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                       id="no_hp" name="no_hp" value="{{ old('no_hp') }}">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                       id="email" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                                       id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}">
                                @error('pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="status_pernikahan">Status Pernikahan <span class="text-danger">*</span></label>
                                <select class="form-select @error('status_pernikahan') is-invalid @enderror"
                                        id="status_pernikahan" name="status_pernikahan" required>
                                    <option value="">Pilih Status Pernikahan</option>
                                    <option value="B" {{ old('status_pernikahan') == 'B' ? 'selected' : '' }}>👤 Belum Menikah</option>
                                    <option value="K" {{ old('status_pernikahan') == 'K' ? 'selected' : '' }}>💑 Menikah</option>
                                    <option value="D" {{ old('status_pernikahan') == 'D' ? 'selected' : '' }}>👨 Duda</option>
                                    <option value="J" {{ old('status_pernikahan') == 'J' ? 'selected' : '' }}>👩 Janda</option>
                                </select>
                                @error('status_pernikahan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Keluarga -->
                        <div class="row mb-4 mt-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">👨‍👩‍👧‍👦 Data Keluarga</h6>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="nama_ayah">Nama Ayah</label>
                                <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror"
                                       id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}">
                                @error('nama_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="nama_ibu">Nama Ibu</label>
                                <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror"
                                       id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}">
                                @error('nama_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="nama_pasangan">Nama Pasangan</label>
                                <input type="text" class="form-control @error('nama_pasangan') is-invalid @enderror"
                                       id="nama_pasangan" name="nama_pasangan" value="{{ old('nama_pasangan') }}">
                                @error('nama_pasangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Data Gereja -->
                        <div class="row mb-4 mt-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">⛪ Data Gereja</h6>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="tanggal_baptis">Tanggal Baptis</label>
                                <input type="date" class="form-control @error('tanggal_baptis') is-invalid @enderror"
                                       id="tanggal_baptis" name="tanggal_baptis" value="{{ old('tanggal_baptis') }}">
                                @error('tanggal_baptis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="tempat_baptis">Tempat Baptis</label>
                                <input type="text" class="form-control @error('tempat_baptis') is-invalid @enderror"
                                       id="tempat_baptis" name="tempat_baptis" value="{{ old('tempat_baptis') }}">
                                @error('tempat_baptis')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="tanggal_sidi">Tanggal Sidi</label>
                                <input type="date" class="form-control @error('tanggal_sidi') is-invalid @enderror"
                                       id="tanggal_sidi" name="tanggal_sidi" value="{{ old('tanggal_sidi') }}">
                                @error('tanggal_sidi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="tempat_sidi">Tempat Sidi</label>
                                <input type="text" class="form-control @error('tempat_sidi') is-invalid @enderror"
                                       id="tempat_sidi" name="tempat_sidi" value="{{ old('tempat_sidi') }}">
                                @error('tempat_sidi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="row mb-4 mt-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">📊 Status</h6>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror"
                                        id="status" name="status" required>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>✅ Aktif</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>❌ Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save me-1"></i>💾 Simpan Data
                                    </button>
                                    <a href="{{ route('members.index') }}" class="btn btn-outline-secondary">
                                        <i class="bx bx-x me-1"></i>❌ Batal
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
