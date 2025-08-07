@extends('layouts.landing')

@section('title', 'Pengurus PPGT - Gereja Toraja Eben-Haezer Selili')

@push('styles')
<style>
    .pengurus-header {
        background-color: #f8f9fa;
        padding: 2rem 0;
        text-align: center;
        position: relative;
        margin-top: 90px;
    }

    .pengurus-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .pengurus-title {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        color: #333;
        text-align: center;
    }



    .pengurus-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-top: 2rem;
    }

    .pengurus-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
    }

    .pengurus-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .pengurus-img-container {
        width: 120px;
        height: 120px;
        margin: 0 auto 1.5rem;
        border-radius: 50%;
        overflow: hidden;
        border: 4px solid #f0f0f0;
        transition: all 0.3s ease;
        background: #333;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pengurus-card:hover .pengurus-img-container {
        border-color: var(--primary);
        transform: scale(1.05);
    }

    .pengurus-img-container i {
        font-size: 3rem;
        color: white;
    }

    .pengurus-name {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .pengurus-position {
        font-size: 1rem;
        color: #666;
        font-weight: 500;
    }

    .section-header {
        text-align: center;
        margin: 3rem 0 2rem;
    }

    .section-title {
        font-size: 1.8rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        border: 2px solid #ddd;
        display: inline-block;
    }

    @media (max-width: 992px) {
        .pengurus-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .pengurus-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
    <div class="pengurus-header">
        <div class="pengurus-container">
        @if($pengurus->count() > 0)
            <div class="section-header">
                <div class="section-title">Pengurus PPGT Periode {{ $pengurus->first()->periode_mulai }} - {{ $pengurus->first()->periode_selesai }}</div>
            </div>
            
            <div class="pengurus-grid">
                @foreach($pengurus as $index => $item)
                    <div class="pengurus-card" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="pengurus-img-container">
                            @if($item->foto)
                                <img src="{{ $item->foto_url }}" alt="{{ $item->nama_lengkap }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        </div>
                        <div class="pengurus-info">
                            <div class="pengurus-name">{{ $item->nama_lengkap }}</div>
                            <div class="pengurus-position">{{ $item->jabatan }}</div>
                            @if($item->deskripsi)
                                <div class="pengurus-description" style="font-size: 0.9rem; color: #888; margin-top: 0.5rem;">
                                    {{ Str::limit($item->deskripsi, 100) }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="section-header">
                <div class="section-title">Pengurus PPGT</div>
                <p class="text-center text-muted">Data pengurus belum tersedia.</p>
            </div>
        @endif
    </div>
@endsection
