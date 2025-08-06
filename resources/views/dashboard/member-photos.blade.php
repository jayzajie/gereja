@extends('layouts.admin')

@section('title', 'Data Jemaat')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Empty State -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card text-center">
                <div class="card-body py-5">
                    <div class="mb-4">
                        <i class="bx bx-user-circle" style="font-size: 4rem; color: #D4A574;"></i>
                    </div>
                    <h4 class="mb-3" style="color: #8B4513;">👤 Data Jemaat</h4>
                    <p class="text-muted mb-4">
                        Halaman ini sedang dalam pengembangan. Konten data jemaat telah dipindahkan ke halaman Pendeta Jemaat.
                    </p>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ route('pendeta-jemaat') }}" class="btn btn-primary">
                            <i class="bx bx-user me-1"></i>Lihat Pendeta Jemaat
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                            <i class="bx bx-arrow-back me-1"></i>Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
