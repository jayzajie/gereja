@extends('layouts.admin')

@section('title', 'Tambah Item Inventory')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold py-3 mb-2" style="color: #8B4513;">
                        <span class="text-muted fw-light">Manajemen / Inventory /</span> Tambah Item
                    </h4>
                </div>
                <div>
                    <a href="{{ route('inventory.index') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back me-1"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Tambah Item Inventory</h5>
                </div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('inventory.store') }}">
                        @csrf

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- Nama Barang -->
                                <div class="mb-3">
                                    <label for="nama_barang" class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" 
                                           id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" 
                                           placeholder="Masukkan nama barang">
                                    @error('nama_barang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Kategori -->
                                <div class="mb-3">
                                    <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('kategori') is-invalid @enderror" 
                                           id="kategori" name="kategori" value="{{ old('kategori') }}" 
                                           placeholder="Masukkan kategori" list="kategori-list">
                                    <datalist id="kategori-list">
                                        @foreach($categories as $category)
                                            <option value="{{ $category }}">
                                        @endforeach
                                    </datalist>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Jumlah & Satuan -->
                                <div class="row">
                                    <div class="col-8">
                                        <div class="mb-3">
                                            <label for="jumlah" class="form-label">Jumlah <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('jumlah') is-invalid @enderror" 
                                                   id="jumlah" name="jumlah" value="{{ old('jumlah') }}" 
                                                   min="0" placeholder="0">
                                            @error('jumlah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-3">
                                            <label for="satuan" class="form-label">Satuan <span class="text-danger">*</span></label>
                                            <select class="form-select @error('satuan') is-invalid @enderror" id="satuan" name="satuan">
                                                <option value="">Pilih Satuan</option>
                                                <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>pcs</option>
                                                <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>kg</option>
                                                <option value="liter" {{ old('satuan') == 'liter' ? 'selected' : '' }}>liter</option>
                                                <option value="meter" {{ old('satuan') == 'meter' ? 'selected' : '' }}>meter</option>
                                                <option value="box" {{ old('satuan') == 'box' ? 'selected' : '' }}>box</option>
                                                <option value="pack" {{ old('satuan') == 'pack' ? 'selected' : '' }}>pack</option>
                                            </select>
                                            @error('satuan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Harga Satuan -->
                                <div class="mb-3">
                                    <label for="harga_satuan" class="form-label">Harga Satuan <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control @error('harga_satuan') is-invalid @enderror" 
                                               id="harga_satuan" name="harga_satuan" value="{{ old('harga_satuan') }}" 
                                               min="0" step="0.01" placeholder="0">
                                    </div>
                                    @error('harga_satuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="">Pilih Status</option>
                                        <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="habis" {{ old('status') == 'habis' ? 'selected' : '' }}>Habis</option>
                                        <option value="rusak" {{ old('status') == 'rusak' ? 'selected' : '' }}>Rusak</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Lokasi -->
                                <div class="mb-3">
                                    <label for="lokasi" class="form-label">Lokasi</label>
                                    <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                           id="lokasi" name="lokasi" value="{{ old('lokasi') }}" 
                                           placeholder="Contoh: Gudang A, Rak 1">
                                    @error('lokasi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Supplier -->
                                <div class="mb-3">
                                    <label for="supplier" class="form-label">Supplier</label>
                                    <input type="text" class="form-control @error('supplier') is-invalid @enderror" 
                                           id="supplier" name="supplier" value="{{ old('supplier') }}" 
                                           placeholder="Nama supplier">
                                    @error('supplier')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tanggal Masuk -->
                                <div class="mb-3">
                                    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                    <input type="date" class="form-control @error('tanggal_masuk') is-invalid @enderror" 
                                           id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}">
                                    @error('tanggal_masuk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tanggal Kadaluarsa -->
                                <div class="mb-3">
                                    <label for="tanggal_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                                    <input type="date" class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror" 
                                           id="tanggal_kadaluarsa" name="tanggal_kadaluarsa" value="{{ old('tanggal_kadaluarsa') }}">
                                    @error('tanggal_kadaluarsa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Catatan -->
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    <textarea class="form-control @error('catatan') is-invalid @enderror" 
                                              id="catatan" name="catatan" rows="3" 
                                              placeholder="Catatan tambahan (opsional)">{{ old('catatan') }}</textarea>
                                    @error('catatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" name="deskripsi" rows="3" 
                                      placeholder="Deskripsi barang (opsional)">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('inventory.index') }}" class="btn btn-outline-secondary">
                                <i class="bx bx-x me-1"></i>Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-1"></i>Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto calculate total when quantity or price changes
    document.getElementById('jumlah').addEventListener('input', calculateTotal);
    document.getElementById('harga_satuan').addEventListener('input', calculateTotal);

    function calculateTotal() {
        const jumlah = parseFloat(document.getElementById('jumlah').value) || 0;
        const harga = parseFloat(document.getElementById('harga_satuan').value) || 0;
        const total = jumlah * harga;
        
        // You can add a total display field if needed
        console.log('Total Nilai:', total);
    }
</script>
@endpush
