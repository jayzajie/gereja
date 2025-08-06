@extends('layouts.admin')

@section('title', 'Edit Warta Mingguan')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold py-3 mb-0">
            <span class="text-muted fw-light">Informasi / Warta Mingguan /</span> Edit
        </h4>
        <a href="{{ route('warta-mingguan.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back me-1"></i>Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Warta Mingguan</h5>
        </div>
        <div class="card-body">
            <form id="editWartaForm" action="{{ route('warta-mingguan.update', $warta->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Nama Warta <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="nama_warta" value="{{ old('nama_warta', $warta->nama_warta) }}" required>
                    @error('nama_warta')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <select class="form-select" name="tanggal" required>
                                <option value="">Pilih</option>
                                @for($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}" {{ old('tanggal', $warta->tanggal) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('tanggal')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Bulan <span class="text-danger">*</span></label>
                            <select class="form-select" name="bulan" required>
                                <option value="">Pilih</option>
                                @php
                                $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                         'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                @endphp
                                @foreach($bulan as $index => $namaBulan)
                                <option value="{{ $index + 1 }}" {{ old('bulan', $warta->bulan) == ($index + 1) ? 'selected' : '' }}>{{ $namaBulan }}</option>
                                @endforeach
                            </select>
                            @error('bulan')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tahun <span class="text-danger">*</span></label>
                            <select class="form-select" name="tahun" required>
                                <option value="">Pilih</option>
                                @for($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ old('tahun', $warta->tahun) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('tahun')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">File Warta (PDF)</label>
                    <input type="file" class="form-control" name="file_warta" accept=".pdf">
                    <div class="form-text">
                        Kosongkan jika tidak ingin mengubah file. File saat ini: <strong>{{ $warta->file_name }}</strong>
                        <br>Ukuran maksimal: 10MB. Format: PDF
                    </div>
                    @error('file_warta')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi tambahan (opsional)">{{ old('deskripsi', $warta->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('warta-mingguan.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save me-1"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('editWartaForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
            alert('Terjadi kesalahan saat memperbarui warta');
        });
    });
</script>
@endpush
