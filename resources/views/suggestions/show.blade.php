@extends('layouts.admin')

@section('title', 'Detail Saran')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="fw-bold py-3 mb-2" style="color: #8B4513;">
                        <span class="text-muted fw-light">Contact / Saran /</span> Detail
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

    <!-- Suggestion Details -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Detail Saran & Masukan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Data Pengirim -->
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3" style="color: #8B4513 !important;">Data Pengirim</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-medium" style="width: 30%;">Nama:</td>
                                    <td>{{ $suggestion->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Email:</td>
                                    <td>
                                        <a href="mailto:{{ $suggestion->nama_gmail }}" class="text-decoration-none">
                                            {{ $suggestion->nama_gmail }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">No. HP:</td>
                                    <td>
                                        <a href="tel:{{ $suggestion->no_hp }}" class="text-decoration-none">
                                            {{ $suggestion->no_hp }}
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- Waktu -->
                        <div class="col-md-6">
                            <h6 class="text-muted mb-3" style="color: #8B4513 !important;">Waktu</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-medium" style="width: 40%;">Tanggal Submit:</td>
                                    <td>{{ $suggestion->created_at->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Jam Submit:</td>
                                    <td>{{ $suggestion->created_at->format('H:i') }} WIB</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">Terakhir Update:</td>
                                    <td>{{ $suggestion->updated_at->format('d F Y H:i') }} WIB</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Isi Saran -->
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-muted mb-3" style="color: #8B4513 !important;">Isi Saran & Masukan</h6>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <p class="mb-0" style="white-space: pre-wrap; line-height: 1.6;">{{ $suggestion->saran }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Quick Actions -->
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-muted mb-3" style="color: #8B4513 !important;">Tindakan Cepat</h6>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="mailto:{{ $suggestion->nama_gmail }}?subject=Re: Saran untuk Gereja&body=Terima kasih atas saran Anda..." 
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="bx bx-envelope me-1"></i>Balas via Email
                                </a>
                                <a href="tel:{{ $suggestion->no_hp }}" class="btn btn-outline-success btn-sm">
                                    <i class="bx bx-phone me-1"></i>Hubungi via Telepon
                                </a>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $suggestion->no_hp) }}?text=Terima kasih atas saran Anda untuk Gereja Toraja Jemaat Eben-Haezer Selili..." 
                                   target="_blank" class="btn btn-outline-success btn-sm">
                                    <i class="bx bxl-whatsapp me-1"></i>WhatsApp
                                </a>
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
                <form method="POST" action="{{ route('suggestions.destroy', $suggestion) }}" class="d-inline" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus saran ini?')">
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
