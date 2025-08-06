@extends('layouts.landing')

@section('title', 'Kegiatan PPGT 2025 - Gereja Toraja Eben-Haezer Selili')

@section('content')

    <!-- Kegiatan Header -->
    <div class="program-header">
        <div class="program-container">
            <h1 class="program-title">Kegiatan PPGT 2025</h1>
            <!-- Sub Navbar OIG -->
            <div class="oig-subnavbar">
                <a href="{{ route('program-kerja-ppgt') }}" class="oig-subnav-link{{ request()->routeIs('program-kerja-ppgt') ? ' active' : '' }}">Program Kerja</a>
                <a href="{{ route('kegiatan-ppgt') }}" class="oig-subnav-link{{ request()->routeIs('kegiatan-ppgt') ? ' active' : '' }}">Kegiatan</a>
                <a href="{{ route('pengurus-ppgt') }}" class="oig-subnav-link{{ request()->routeIs('pengurus-ppgt') ? ' active' : '' }}">Pengurus</a>
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
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Retreat Pemuda-Pemudi" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">12-14 April 2025</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Retreat Pemuda-Pemudi</h3>
                    <p class="kegiatan-desc">Kegiatan retreat tahunan untuk pemuda-pemudi yang bertujuan untuk memperkuat persekutuan dan meningkatkan kualitas spiritual. Kegiatan ini meliputi ibadah bersama, sharing pengalaman, dan kegiatan outdoor yang menantang.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Camp Sesean</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 90 Pemuda</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 2 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Seminar Kepemimpinan Muda" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">20 Mei 2025</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Seminar Kepemimpinan Muda</h3>
                    <p class="kegiatan-desc">Seminar khusus untuk mengembangkan kemampuan kepemimpinan pemuda-pemudi dalam gereja dan masyarakat. Materi meliputi visi kepemimpinan, komunikasi efektif, dan manajemen organisasi yang inovatif.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Aula Gereja</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 100 Pemuda</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 3 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Pelayanan Sosial PPGT" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">15 Juni 2025</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Pelayanan Sosial PPGT</h3>
                    <p class="kegiatan-desc">Program bakti sosial yang dilakukan pemuda-pemudi untuk membantu masyarakat sekitar. Kegiatan meliputi mengajar anak-anak, pembersihan lingkungan, dan bantuan untuk keluarga kurang mampu sebagai wujud kasih Kristus.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Desa Binaan</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 70 Pemuda</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 4 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Festival Seni Pemuda" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">25 Juli 2025</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Festival Seni Pemuda</h3>
                    <p class="kegiatan-desc">Festival seni tahunan yang menampilkan kreativitas pemuda-pemudi dalam bidang musik, tari, drama, dan seni rupa. Acara ini menjadi wadah untuk mengekspresikan iman melalui karya seni yang inspiratif.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Panggung Terbuka</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 150 Orang</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 5 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Ibadah Pemuda-Pemudi" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">Setiap Minggu Ke-4</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Ibadah Pemuda-Pemudi</h3>
                    <p class="kegiatan-desc">Ibadah khusus pemuda-pemudi yang diadakan setiap minggu keempat dengan format yang dinamis dan interaktif. Mencakup pujian kontemporer, sharing firman yang relevan, dan diskusi kelompok yang mendalam.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Youth Center</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 85 Pemuda</span>
                    </div>
                </div>
            </div>

            <!-- Kegiatan 6 -->
            <div class="kegiatan-card">
                <div class="kegiatan-img-container">
                    <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Kelas Persiapan Pelayanan" class="kegiatan-img">
                    <div class="kegiatan-overlay">
                        <div class="kegiatan-date">Setiap Bulan</div>
                    </div>
                </div>
                <div class="kegiatan-content">
                    <h3 class="kegiatan-title">Kelas Persiapan Pelayanan</h3>
                    <p class="kegiatan-desc">Program pembinaan rutin untuk mempersiapkan pemuda-pemudi dalam berbagai bidang pelayanan gereja seperti musik, multimedia, pengajaran, dan konseling. Mengembangkan talenta untuk melayani Tuhan.</p>
                    <div class="kegiatan-meta">
                        <span class="kegiatan-location"><i class="fas fa-map-marker-alt"></i> Ruang Training</span>
                        <span class="kegiatan-participants"><i class="fas fa-users"></i> 40 Pemuda</span>
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
