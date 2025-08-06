@extends('layouts.admin')

@section('title', 'Detail Item Inventory')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold py-3 mb-2" style="color: #8B4513;">
                        <span class="text-muted fw-light">Manajemen / Inventory /</span> Detail Item
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

    <!-- Detail -->
    <div class="row">
        <!-- Main Info -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ $inventory->nama_barang }}</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('inventory.edit', $inventory) }}" 
                           class="btn btn-warning">
                            <i class="bx bx-edit me-1"></i>Edit
                        </a>
                        <form method="POST" action="{{ route('inventory.destroy', $inventory) }}" 
                              class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bx bx-trash me-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-medium" width="150">Nama Barang:</td>
                                    <td>{{ $inventory->nama_barang }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Kategori:</td>
                                    <td>
                                        <span class="badge bg-info">{{ $inventory->kategori }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Jumlah:</td>
                                    <td>
                                        <span class="fw-bold">{{ $inventory->jumlah }}</span> {{ $inventory->satuan }}
                                        @if($inventory->jumlah <= 5 && $inventory->status == 'tersedia')
                                            <br><small class="text-warning"><i class="bx bx-warning"></i> Stok rendah</small>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Harga Satuan:</td>
                                    <td>{{ $inventory->formatted_harga_satuan }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Total Nilai:</td>
                                    <td class="fw-bold text-primary">{{ $inventory->formatted_total_nilai }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Status:</td>
                                    <td>
                                        <span class="badge bg-{{ $inventory->status_badge_color }}">
                                            {{ ucfirst($inventory->status) }}
                                        </span>
                                        @if($inventory->is_expired)
                                            <br><small class="text-danger"><i class="bx bx-time"></i> Item sudah kadaluarsa</small>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-medium" width="150">Lokasi:</td>
                                    <td>{{ $inventory->lokasi ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Supplier:</td>
                                    <td>{{ $inventory->supplier ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Tanggal Masuk:</td>
                                    <td>{{ $inventory->tanggal_masuk ? $inventory->tanggal_masuk->format('d M Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Tanggal Kadaluarsa:</td>
                                    <td>
                                        @if($inventory->tanggal_kadaluarsa)
                                            {{ $inventory->tanggal_kadaluarsa->format('d M Y') }}
                                            @if($inventory->is_expired)
                                                <span class="text-danger">(Kadaluarsa)</span>
                                            @elseif($inventory->tanggal_kadaluarsa->diffInDays(now()) <= 30)
                                                <span class="text-warning">({{ $inventory->tanggal_kadaluarsa->diffInDays(now()) }} hari lagi)</span>
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Dibuat:</td>
                                    <td>{{ $inventory->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Diperbarui:</td>
                                    <td>{{ $inventory->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($inventory->deskripsi)
                        <div class="mt-4">
                            <h6 class="fw-medium">Deskripsi:</h6>
                            <div class="bg-light p-3 rounded">
                                {{ $inventory->deskripsi }}
                            </div>
                        </div>
                    @endif

                    @if($inventory->catatan)
                        <div class="mt-4">
                            <h6 class="fw-medium">Catatan:</h6>
                            <div class="bg-light p-3 rounded">
                                {{ $inventory->catatan }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-lg-4">
            <!-- Stock Update -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Update Stok</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('inventory.update-stock', $inventory) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Baru</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="jumlah" name="jumlah" 
                                       value="{{ $inventory->jumlah }}" min="0" required>
                                <span class="input-group-text">{{ $inventory->satuan }}</span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="2" 
                                      placeholder="Alasan perubahan stok..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bx bx-refresh me-1"></i>Update Stok
                        </button>
                    </form>
                </div>
            </div>

            <!-- Item Statistics -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Statistik Item</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Nilai per Unit:</span>
                        <span class="fw-bold">{{ $inventory->formatted_harga_satuan }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Total Investasi:</span>
                        <span class="fw-bold text-primary">{{ $inventory->formatted_total_nilai }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Umur Item:</span>
                        <span>{{ $inventory->created_at->diffForHumans() }}</span>
                    </div>
                    @if($inventory->tanggal_kadaluarsa)
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Masa Berlaku:</span>
                            <span class="{{ $inventory->is_expired ? 'text-danger' : ($inventory->tanggal_kadaluarsa->diffInDays(now()) <= 30 ? 'text-warning' : 'text-success') }}">
                                @if($inventory->is_expired)
                                    Kadaluarsa
                                @else
                                    {{ $inventory->tanggal_kadaluarsa->diffInDays(now()) }} hari
                                @endif
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-submit form when stock input changes
    document.getElementById('jumlah').addEventListener('change', function() {
        const currentValue = {{ $inventory->jumlah }};
        const newValue = parseInt(this.value);
        
        if (newValue !== currentValue) {
            // You can add confirmation here if needed
            console.log('Stock will be updated from', currentValue, 'to', newValue);
        }
    });
</script>
@endpush
