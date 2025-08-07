@extends('layouts.landing')

@section('title', 'Program Kerja PWGT - Gereja Toraja Eben-Haezer Selili')

@section('content')

    <!-- Program Kerja Header -->
    <div class="program-header">
        <div class="program-container">
            <h1 class="program-title">Program Kerja PWGT 2025</h1>
            <!-- Sub Navbar OIG -->
            <div class="oig-subnavbar">
                <a href="{{ route('program-kerja-pwgt') }}" class="oig-subnav-link{{ request()->routeIs('program-kerja-pwgt') ? ' active' : '' }}">Program Kerja</a>
                <a href="{{ route('pengurus-pwgt') }}" class="oig-subnav-link{{ request()->routeIs('pengurus-pwgt') ? ' active' : '' }}">Pengurus</a>
            </div>
        </div>
    </div>

    <!-- Program Kerja Content -->
    <div class="program-container">
        @if($programKerja->count() > 0)
            <!-- Program Kerja Grid -->
            <div class="program-grid">
                @foreach($programKerja as $program)
                    <div class="program-box">
                        <h3 class="program-box-title">{{ $program->nama_program }}</h3>
                        <div class="program-list">
                            <div class="program-item">
                                <strong>Deskripsi:</strong> {{ $program->deskripsi }}
                            </div>
                            @if($program->tujuan)
                                <div class="program-item">
                                    <strong>Tujuan:</strong> {{ $program->tujuan }}
                                </div>
                            @endif
                            @if($program->sasaran)
                                <div class="program-item">
                                    <strong>Sasaran:</strong> {{ $program->sasaran }}
                                </div>
                            @endif
                            @if($program->penanggung_jawab)
                                <div class="program-item">
                                    <strong>Penanggung Jawab:</strong> {{ $program->penanggung_jawab }}
                                </div>
                            @endif
                            @if($program->tanggal_mulai && $program->tanggal_selesai)
                                <div class="program-item">
                                    <strong>Periode:</strong> {{ \Carbon\Carbon::parse($program->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($program->tanggal_selesai)->format('d M Y') }}
                                </div>
                            @endif
                            @if($program->anggaran)
                                <div class="program-item">
                                    <strong>Anggaran:</strong> Rp {{ number_format($program->anggaran, 0, ',', '.') }}
                                </div>
                            @endif
                            <div class="program-item">
                                <strong>Status:</strong>
                                <span class="badge badge-{{ $program->status == 'aktif' ? 'success' : ($program->status == 'selesai' ? 'primary' : 'secondary') }}">
                                    {{ ucfirst($program->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <h4>Program Kerja PWGT</h4>
                <p class="text-muted">Data program kerja belum tersedia untuk tahun {{ date('Y') }}.</p>
            </div>
        @endif
    </div>

    <style>
        .program-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            margin: 2rem 0;
            padding: 0 1rem;
        }

        .program-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .program-box-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #333;
            text-align: center;
            border-bottom: 2px solid #b08a3a;
            padding-bottom: 0.5rem;
        }

        .program-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .program-item {
            font-size: 0.9rem;
            line-height: 1.5;
            color: #555;
            text-align: justify;
        }

        @media (max-width: 768px) {
            .program-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
    </style>
@endsection
