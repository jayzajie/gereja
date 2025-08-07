@extends('layouts.landing')

@section('title', 'Informasi - Gereja Toraja Eben-Haezer Selili')

@section('content')
    <!-- Header Section -->
    <div class="page-header">
        <div class="container">
            <div class="header-content">
                <h1 class="page-title">Informasi Gereja</h1>
                <p class="page-subtitle">Temukan berbagai informasi penting seputar kegiatan dan pelayanan gereja</p>
            </div>
        </div>
    </div>

    <!-- Information Grid Section -->
    <div class="information-section">
        <div class="container">
            <div class="info-grid">
                <!-- Pendeta Jemaat -->
                <div class="info-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Pendeta Jemaat</h3>
                        <p class="card-description">Informasi lengkap tentang pendeta dan pelayan gereja yang melayani jemaat</p>
                        <a href="{{ route('pendeta-jemaat') }}" class="card-link">
                            <span>Lihat Detail</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Kegiatan Jemaat -->
                <div class="info-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="card-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Kegiatan Jemaat</h3>
                        <p class="card-description">Jadwal dan informasi kegiatan gereja, ibadah, dan acara khusus</p>
                        <a href="{{ route('kegiatan-jemaat') }}" class="card-link">
                            <span>Lihat Detail</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Warta Jemaat -->
                <div class="info-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="card-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Warta Jemaat</h3>
                        <p class="card-description">Berita terkini, pengumuman, dan informasi penting untuk jemaat</p>
                        <a href="{{ route('warta-jemaat') }}" class="card-link">
                            <span>Lihat Detail</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Program Kerja -->
                <div class="info-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="card-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Program Kerja</h3>
                        <p class="card-description">Rencana dan program kerja gereja untuk periode berjalan</p>
                        <a href="{{ route('program-kerja') }}" class="card-link">
                            <span>Lihat Detail</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Jadwal Ibadah -->
                <div class="info-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="card-icon">
                        <i class="fas fa-church"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Jadwal Ibadah</h3>
                        <p class="card-description">Jadwal ibadah mingguan dan ibadah khusus sepanjang tahun</p>
                        <a href="/#schedule" class="card-link">
                            <span>Lihat Detail</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Kontak & Lokasi -->
                <div class="info-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="card-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Kontak & Lokasi</h3>
                        <p class="card-description">Informasi kontak, alamat, dan cara menghubungi gereja</p>
                        <a href="/#contact" class="card-link">
                            <span>Lihat Detail</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Footer Section -->
    <div class="contact-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <div class="church-info">
                        <h4>Gereja Toraja Eben-Haezer Selili</h4>
                        <p>Melayani dengan kasih dan ketulusan</p>
                    </div>
                </div>
                <div class="footer-contact">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong>Alamat</strong>
                            <p>Jl. Lembah Lolai, Desa Kec. Sanggalangi, Kabupaten Toraja Utara, Sulawesi Selatan 91819</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong>Telepon</strong>
                            <p>081234567890</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Email</strong>
                            <p>ebenhaezerselili@gmail.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style>
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #8B4513 0%, #A0522D 100%);
        color: white;
        padding: 80px 0 60px;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .header-content {
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .page-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .page-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Information Section */
    .information-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .info-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid #e5e7eb;
        position: relative;
        overflow: hidden;
    }

    .info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #8B4513, #A0522D);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .info-card:hover::before {
        transform: scaleX(1);
    }

    .card-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #8B4513, #A0522D);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        transition: all 0.3s ease;
    }

    .card-icon i {
        font-size: 2rem;
        color: white;
    }

    .info-card:hover .card-icon {
        transform: scale(1.1);
        box-shadow: 0 10px 20px rgba(139, 69, 19, 0.3);
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 15px;
    }

    .card-description {
        color: #718096;
        line-height: 1.6;
        margin-bottom: 25px;
        font-size: 0.95rem;
    }

    .card-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #8B4513;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        padding: 12px 24px;
        border: 2px solid #8B4513;
        border-radius: 50px;
        background: transparent;
    }

    .card-link:hover {
        background: #8B4513;
        color: white;
        transform: translateX(5px);
    }

    .card-link i {
        transition: transform 0.3s ease;
    }

    .card-link:hover i {
        transform: translateX(3px);
    }

    /* Contact Footer */
    .contact-footer {
        background: #2d3748;
        color: white;
        padding: 50px 0;
    }

    .footer-content {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 50px;
        align-items: start;
    }

    .church-info h4 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: #A0522D;
    }

    .church-info p {
        opacity: 0.8;
        font-style: italic;
    }

    .footer-contact {
        display: grid;
        gap: 20px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .contact-item i {
        color: #A0522D;
        font-size: 1.2rem;
        margin-top: 2px;
        min-width: 20px;
    }

    .contact-item strong {
        display: block;
        margin-bottom: 5px;
        color: #A0522D;
    }

    .contact-item p {
        margin: 0;
        opacity: 0.9;
        line-height: 1.5;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-title {
            font-size: 2.2rem;
        }

        .page-subtitle {
            font-size: 1rem;
        }

        .info-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 0 20px;
        }

        .info-card {
            padding: 30px 20px;
        }

        .footer-content {
            grid-template-columns: 1fr;
            gap: 30px;
            text-align: center;
        }

        .contact-item {
            justify-content: center;
            text-align: left;
        }
    }
</style>
@endsection
