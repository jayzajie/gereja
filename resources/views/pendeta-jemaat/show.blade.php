@extends('layouts.admin')

@section('title', 'Detail Pendeta')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="fw-bold py-3 mb-4" style="color: #8B4513;">
                    <span class="text-muted fw-light">🏠 Dashboard / 👨‍💼 Pendeta Jemaat /</span> 👁️ Detail Pendeta
                </h4>
                <div>
                    <a href="{{ route('pastors.edit', $pastor) }}" class="btn btn-warning me-2">
                        <i class="bx bx-edit me-1"></i>✏️ Edit Pendeta
                    </a>
                    <a href="{{ route('pastors.index') }}" class="btn btn-secondary">
                        <i class="bx bx-arrow-back me-1"></i>⬅️ Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Foto Pendeta -->
                        <div class="col-md-4 text-center mb-4">
                            @if($pastor->photo)
                                <img src="{{ asset('storage/' . $pastor->photo) }}" alt="{{ $pastor->name }}" class="img-fluid rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3 mx-auto" style="width: 200px; height: 200px;">
                                    <i class="bx bx-user" style="font-size: 80px; color: #ccc;"></i>
                                </div>
                            @endif
                            <h5 class="fw-bold">{{ $pastor->name }}</h5>
                            @if($pastor->status === 'active')
                                <span class="badge bg-success">✅ Aktif</span>
                            @elseif($pastor->status === 'inactive')
                                <span class="badge bg-warning">⏸️ Tidak Aktif</span>
                            @else
                                <span class="badge bg-secondary">🏁 Pensiun</span>
                            @endif
                        </div>

                        <!-- Informasi Personal -->
                        <div class="col-md-4">
                            <h6 class="fw-bold mb-3">👤 Informasi Personal</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-medium">📧 Email:</td>
                                    <td>{{ $pastor->email }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">📱 Telepon:</td>
                                    <td>{{ $pastor->phone ?? 'Tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">🏠 Alamat:</td>
                                    <td>{{ $pastor->address ?? 'Tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">🎂 Tanggal Lahir:</td>
                                    <td>{{ $pastor->birth_date?->format('d F Y') ?? 'Tidak tersedia' }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Informasi Pelayanan -->
                        <div class="col-md-4">
                            <h6 class="fw-bold mb-3">⛪ Informasi Pelayanan</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-medium">📅 Tanggal Tahbisan:</td>
                                    <td>{{ $pastor->ordination_date?->format('d F Y') ?? 'Tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">📅 Tanggal Berakhir:</td>
                                    <td>{{ $pastor->end_date?->format('d F Y') ?? 'Masih aktif' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">⏱️ Lama Pelayanan:</td>
                                    <td>
                                        @if($pastor->ordination_date)
                                            @php
                                                $endDate = $pastor->end_date ?? now();
                                                $years = $pastor->ordination_date->diffInYears($endDate);
                                                $months = $pastor->ordination_date->diffInMonths($endDate) % 12;
                                            @endphp
                                            {{ $years }} tahun {{ $months }} bulan
                                        @else
                                            Tidak tersedia
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($pastor->congregations->count() > 0)
                        <hr class="my-4">
                        <h6 class="fw-bold mb-3">🏛️ Jemaat yang Dilayani</h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Jemaat</th>
                                        <th>Alamat</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pastor->congregations as $congregation)
                                        <tr>
                                            <td>{{ $congregation->name }}</td>
                                            <td>{{ $congregation->address }}</td>
                                            <td>
                                                @if($congregation->status === 'active')
                                                    <span class="badge bg-success">✅ Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">❌ Tidak Aktif</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
