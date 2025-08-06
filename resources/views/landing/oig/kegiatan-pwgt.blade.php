@extends('layouts.landing')

@section('title', 'Kegiatan PWGT 2025 - Gereja Toraja Eben-Haezer Selili')

@section('content')

    <!-- Kegiatan Header -->
    <div class="program-header">
        <div class="program-container">
            <h1 class="program-title">Kegiatan PWGT 2025</h1>
            <!-- Sub Navbar OIG -->
            <div class="oig-subnavbar">
                <a href="{{ route('program-kerja-pwgt') }}" class="oig-subnav-link{{ request()->routeIs('program-kerja-pwgt') ? ' active' : '' }}">Program Kerja</a>
                <a href="{{ route('kegiatan-pwgt') }}" class="oig-subnav-link{{ request()->routeIs('kegiatan-pwgt') ? ' active' : '' }}">Kegiatan</a>
                <a href="{{ route('pengurus-pwgt') }}" class="oig-subnav-link{{ request()->routeIs('pengurus-pwgt') ? ' active' : '' }}">Pengurus</a>
            </div>
        </div>
    </div>

    <!-- Kegiatan Content -->
    <div class="program-container">
        <!-- Kegiatan Grid -->
        <div class="kegiatan-grid">
            <!-- Kegiatan 1 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Retreat Kaum Ibu" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">8-10 Maret 2025</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Retreat Kaum Ibu</h3>
                    <p class="kegiatan-desc">Kegiatan retreat tahunan untuk kaum ibu yang bertujuan untuk memperkuat persekutuan dan meningkatkan kualitas spiritual. Kegiatan ini meliputi ibadah bersama, sharing pengalaman, dan workshop pengembangan diri yang menginspirasi.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Villa Toraja</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 65 Ibu</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 2 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Seminar Keluarga Kristen" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">18 April 2025</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Seminar Keluarga Kristen</h3>
                    <p class="kegiatan-desc">Seminar khusus untuk kaum ibu tentang membangun keluarga Kristen yang harmonis. Materi meliputi parenting Kristen, komunikasi dalam keluarga, dan manajemen rumah tangga yang berdasarkan nilai-nilai Alkitab.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Aula Gereja</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 85 Ibu</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 3 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Pelayanan Sosial Kaum Ibu" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">25 Mei 2025</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Pelayanan Sosial Kaum Ibu</h3>
                    <p class="kegiatan-desc">Program bakti sosial yang dilakukan kaum ibu untuk membantu sesama, terutama ibu-ibu yang membutuhkan. Kegiatan meliputi kunjungan ke rumah sakit, bantuan untuk ibu hamil, dan program pemberdayaan ekonomi.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Rumah Sakit</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 40 Ibu</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 4 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Workshop Keterampilan Ibu" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">15 Juli 2025</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Workshop Keterampilan Ibu</h3>
                    <p class="kegiatan-desc">Workshop pelatihan keterampilan untuk kaum ibu seperti memasak, menjahit, kerajinan tangan, dan kewirausahaan. Program ini bertujuan untuk meningkatkan kemampuan dan kemandirian ekonomi kaum ibu.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Ruang Kreatif</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 50 Ibu</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 5 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Ibadah Kaum Ibu" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">Setiap Minggu Ke-3</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Ibadah Kaum Ibu</h3>
                    <p class="kegiatan-desc">Ibadah khusus kaum ibu yang diadakan setiap minggu ketiga dengan fokus pada penguatan iman dan pembahasan peran wanita Kristen dalam keluarga dan masyarakat berdasarkan teladan tokoh wanita dalam Alkitab.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Ruang Ibu</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 70 Ibu</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 6 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Program Kesehatan Ibu" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">Setiap Bulan</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Program Kesehatan Ibu</h3>
                    <p class="kegiatan-desc">Program kesehatan rutin untuk kaum ibu meliputi pemeriksaan kesehatan gratis, penyuluhan gizi, senam sehat, dan konsultasi kesehatan reproduksi. Bekerjasama dengan tenaga medis profesional.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Klinik Gereja</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 60 Ibu</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    .kegiatan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        padding: 40px 0;
    }

    .kegiatan-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
    }

    .kegiatan-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .kegiatan-img-container {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .kegiatan-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .kegiatan-card:hover .kegiatan-img {
        transform: scale(1.05);
    }

    .kegiatan-overlay {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(153, 121, 57, 0.9);
        color: white;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .kegiatan-content {
        padding: 25px;
    }

    .kegiatan-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 15px;
        line-height: 1.3;
    }

    .kegiatan-desc {
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 20px;
        font-size: 0.95rem;
    }

    .kegiatan-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #e5e7eb;
        font-size: 0.85rem;
    }

    .kegiatan-location,
    .kegiatan-participants {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #9ca3af;
        font-weight: 500;
    }

    .kegiatan-location i,
    .kegiatan-participants i {
        color: var(--primary, #997939);
        font-size: 0.8rem;
    }

    @media (max-width: 768px) {
        .kegiatan-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 20px 0;
        }

        .kegiatan-card {
            margin: 0 10px;
        }

        .kegiatan-content {
            padding: 20px;
        }

        .kegiatan-title {
            font-size: 1.2rem;
        }

        .kegiatan-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
    }
    </style>
@endsection
