@extends('layouts.admin')

@section('title', 'Tambah Pendeta')

@push('styles')
<style>
    .form-container {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        margin: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .form-header {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        padding: 20px 25px;
        border-bottom: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-header h5 {
        margin: 0;
        font-weight: 700;
        color: #495057;
        font-size: 20px;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }

    .btn-back {
        background: rgba(108, 117, 125, 0.1);
        color: #495057;
        border: 2px solid rgba(108, 117, 125, 0.3);
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .btn-back:hover {
        background: rgba(108, 117, 125, 0.2);
        border-color: rgba(108, 117, 125, 0.5);
        color: #495057;
        text-decoration: none;
        transform: translateY(-1px);
    }

    .form-content {
        padding: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-row .form-group {
        flex: 1;
        margin-bottom: 0;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
    }

    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #495057;
        font-size: 14px;
    }

    label.required::after {
        content: ' *';
        color: #dc3545;
    }

    .invalid-feedback {
        display: block;
        width: 100%;
        margin-top: 5px;
        font-size: 12px;
        color: #dc3545;
    }

    .form-actions {
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #e0e0e0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .help-text {
        color: #6c757d;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-group {
        display: flex;
        gap: 15px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,123,255,0.3);
    }

    .btn-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        color: white;
    }

    .btn-secondary:hover {
        background: linear-gradient(135deg, #5a6268 0%, #495057 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(108,117,125,0.3);
    }

    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .form-actions {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .btn-group {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="form-container">
        <!-- Form Header -->
        <div class="form-header">
            <h5>👨‍💼 Tambah Pendeta Baru</h5>
            <a href="{{ route('pastors.index') }}" class="btn-back">
                ⬅️ Kembali
            </a>
        </div>

        <!-- Form Content -->
        <div class="form-content">
                    <form action="{{ route('pastors.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="required">👤 Nama Pendeta</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Masukkan nama lengkap pendeta">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="required">📧 Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="email@gereja.com">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">📱 Nomor Telepon</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                class="form-control @error('phone') is-invalid @enderror"
                                placeholder="Contoh: 0813500971318">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">🏠 Alamat</label>
                            <textarea name="address" id="address" rows="3"
                                class="form-control @error('address') is-invalid @enderror"
                                placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="birth_date">🎂 Tanggal Lahir</label>
                                <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date') }}"
                                    class="form-control @error('birth_date') is-invalid @enderror">
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="ordination_date">⛪ Tanggal Tahbisan</label>
                                <input type="date" name="ordination_date" id="ordination_date" value="{{ old('ordination_date') }}"
                                    class="form-control @error('ordination_date') is-invalid @enderror">
                                @error('ordination_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="end_date">📅 Tanggal Berakhir Tugas</label>
                                <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                                    class="form-control @error('end_date') is-invalid @enderror">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Kosongkan jika masih aktif</small>
                            </div>

                            <div class="form-group">
                                <label for="photo">📷 Foto Pendeta</label>
                                <input type="file" name="photo" id="photo" accept="image/*"
                                    class="form-control @error('photo') is-invalid @enderror">
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="required">📊 Status</label>
                            <select name="status" id="status" required
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="">Pilih status...</option>
                                <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                <option value="retired" {{ old('status') === 'retired' ? 'selected' : '' }}>Pensiun</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <div class="help-text">
                                <i class="bx bx-info-circle"></i>
                                Field yang bertanda (*) wajib diisi
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('pastors.index') }}" class="btn btn-secondary">
                                    <i class="bx bx-x"></i>
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-save"></i>
                                    💾 Simpan Pendeta
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
@endsection
