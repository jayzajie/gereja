@extends('layouts.landing')

@section('title', 'Kegiatan Jemaat - Gereja Toraja Eben-Haezer Selili')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kegiatan-jemaat.css') }}">
<style>
    /* Header styling */
    .kegiatan-header {
        background: linear-gradient(135deg, #997939 0%, #b59756 100%);
        color: white;
        padding: 80px 0;
        text-align: center;
        position: relative;
        margin-bottom: 50px;
    }

    .kegiatan-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('{{ asset('images/gereja-toraja.jpg') }}');
        background-size: cover;
        background-position: center;
        opacity: 0.2;
        z-index: 1;
    }

    .kegiatan-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(153, 121, 57, 0.8) 0%, rgba(181, 151, 86, 0.8) 100%);
        z-index: 2;
    }

    .kegiatan-container {
        position: relative;
        z-index: 3;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .kegiatan-title {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 15px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .kegiatan-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        font-weight: 300;
    }

    /* Grid layout yang lebih terstruktur */
    .kegiatan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 30px;
        padding: 40px 0;
    }

    /* Card styling yang lebih modern */
    .kegiatan-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        border: 1px solid rgba(153, 121, 57, 0.1);
    }

    .kegiatan-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 48px rgba(153, 121, 57, 0.2);
        border-color: rgba(153, 121, 57, 0.3);
    }

    .kegiatan-img-container {
        position: relative;
        height: 220px;
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
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.7) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: flex-end;
        padding: 20px;
    }

    .kegiatan-card:hover .kegiatan-overlay {
        opacity: 1;
    }

    .overlay-text {
        color: white;
        font-weight: 600;
        font-size: 1rem;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }

    .kegiatan-info {
        padding: 25px;
    }

    .kegiatan-name {
        font-size: 1.4rem;
        font-weight: 700;
        color: #997939;
        margin-bottom: 12px;
        line-height: 1.3;
    }

    .kegiatan-desc {
        color: #666;
        line-height: 1.6;
        font-size: 0.95rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .kegiatan-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #f0f0f0;
    }

    .kegiatan-schedule {
        font-size: 0.85rem;
        color: #997939;
        font-weight: 600;
    }

    .kegiatan-location {
        font-size: 0.85rem;
        color: #888;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .kegiatan-grid {
            grid-template-columns: 1fr;
            gap: 20px;
            padding: 20px 0;
        }
        
        .kegiatan-title {
            font-size: 2.2rem;
        }
        
        .kegiatan-subtitle {
            font-size: 1rem;
        }
        
        .kegiatan-img-container {
            height: 200px;
        }
    }

    @media (max-width: 480px) {
        .kegiatan-container {
            padding: 0 15px;
        }
        
        .kegiatan-info {
            padding: 20px;
        }
        
        .kegiatan-name {
            font-size: 1.2rem;
        }
    }
</style>
@endpush

@section('body-class', 'kegiatan-page')

@section('content')
    <!-- Kegiatan Jemaat Header -->
    <div class="kegiatan-header">
        <div class="kegiatan-container">
            <h1 class="kegiatan-title">Kegiatan Jemaat</h1>
            <p class="kegiatan-subtitle">Berbagai kegiatan rohani dan sosial untuk membangun persekutuan yang kuat dalam kasih Kristus</p>
        </div>
    </div>

    <!-- Kegiatan Jemaat Content -->
    <div class="kegiatan-container">
        <div class="kegiatan-grid">
            @if(isset($activities) && $activities->count() > 0)
                @foreach($activities as $activity)
                    <!-- Kegiatan Card from Database -->
                    <div class="kegiatan-card" onclick="window.location.href='{{ route('kegiatan-detail', $activity->id) }}'">
                        <div class="kegiatan-img-container">
                            @if($activity->image)
                                <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" class="kegiatan-img">
                            @else
                                <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="{{ $activity->title }}" class="kegiatan-img">
                            @endif
                            <div class="kegiatan-overlay">
                                <div class="overlay-text">📖 Klik untuk detail lengkap</div>
                            </div>
                        </div>
                        <div class="kegiatan-info">
                            <div class="kegiatan-name">{{ $activity->title }}</div>
                            <div class="kegiatan-desc">{{ Str::limit($activity->content, 120) }}</div>
                            <div class="kegiatan-meta">
                                <div class="kegiatan-schedule">📅 Terjadwal</div>
                                <div class="kegiatan-location">📍 Gereja</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Sample Activities when no data from database -->
                <div class="kegiatan-card" onclick="showActivityDetail('ibadah-minggu')">
                    <div class="kegiatan-img-container">
                        <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Ibadah Minggu" class="kegiatan-img">
                        <div class="kegiatan-overlay">
                            <div class="overlay-text">📖 Klik untuk detail lengkap</div>
                        </div>
                    </div>
                    <div class="kegiatan-info">
                        <div class="kegiatan-name">Ibadah Minggu</div>
                        <div class="kegiatan-desc">Ibadah minggu rutin yang diadakan setiap hari Minggu pukul 09.00 WITA. Ibadah ini merupakan kegiatan utama jemaat untuk beribadah bersama dan mendengarkan firman Tuhan.</div>
                        <div class="kegiatan-meta">
                            <div class="kegiatan-schedule">📅 Setiap Minggu</div>
                            <div class="kegiatan-location">📍 Gereja Utama</div>
                        </div>
                    </div>
                </div>

                <div class="kegiatan-card" onclick="showActivityDetail('sekolah-minggu')">
                    <div class="kegiatan-img-container">
                        <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Sekolah Minggu" class="kegiatan-img">
                        <div class="kegiatan-overlay">
                            <div class="overlay-text">📖 Klik untuk detail lengkap</div>
                        </div>
                    </div>
                    <div class="kegiatan-info">
                        <div class="kegiatan-name">Sekolah Minggu</div>
                        <div class="kegiatan-desc">Kegiatan pembelajaran alkitab untuk anak-anak yang diadakan setiap hari Minggu. Program ini bertujuan membangun karakter kristiani anak-anak sejak dini.</div>
                        <div class="kegiatan-meta">
                            <div class="kegiatan-schedule">📅 Setiap Minggu</div>
                            <div class="kegiatan-location">📍 Ruang SM</div>
                        </div>
                    </div>
                </div>

                <div class="kegiatan-card" onclick="showActivityDetail('ibadah-pemuda')">
                    <div class="kegiatan-img-container">
                        <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Ibadah Pemuda" class="kegiatan-img">
                        <div class="kegiatan-overlay">
                            <div class="overlay-text">📖 Klik untuk detail lengkap</div>
                        </div>
                    </div>
                    <div class="kegiatan-info">
                        <div class="kegiatan-name">Ibadah Pemuda</div>
                        <div class="kegiatan-desc">Ibadah khusus untuk pemuda-pemudi yang diadakan setiap Sabtu malam. Kegiatan ini menggabungkan ibadah dengan diskusi dan sharing pengalaman iman.</div>
                        <div class="kegiatan-meta">
                            <div class="kegiatan-schedule">📅 Setiap Sabtu</div>
                            <div class="kegiatan-location">📍 Aula Gereja</div>
                        </div>
                    </div>
                </div>

                <div class="kegiatan-card" onclick="showActivityDetail('persekutuan-doa')">
                    <div class="kegiatan-img-container">
                        <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Persekutuan Doa" class="kegiatan-img">
                        <div class="kegiatan-overlay">
                            <div class="overlay-text">📖 Klik untuk detail lengkap</div>
                        </div>
                    </div>
                    <div class="kegiatan-info">
                        <div class="kegiatan-name">Persekutuan Doa</div>
                        <div class="kegiatan-desc">Kegiatan doa bersama yang diadakan setiap hari Rabu malam. Jemaat berkumpul untuk berdoa syafaat dan saling mendoakan dalam berbagai kebutuhan.</div>
                        <div class="kegiatan-meta">
                            <div class="kegiatan-schedule">📅 Setiap Rabu</div>
                            <div class="kegiatan-location">📍 Gereja Utama</div>
                        </div>
                    </div>
                </div>

                <div class="kegiatan-card" onclick="showActivityDetail('kelas-katekisasi')">
                    <div class="kegiatan-img-container">
                        <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Kelas Katekisasi" class="kegiatan-img">
                        <div class="kegiatan-overlay">
                            <div class="overlay-text">📖 Klik untuk detail lengkap</div>
                        </div>
                    </div>
                    <div class="kegiatan-info">
                        <div class="kegiatan-name">Kelas Katekisasi</div>
                        <div class="kegiatan-desc">Program pembelajaran doktrin dan ajaran gereja untuk calon anggota jemaat. Mempersiapkan peserta menjadi anggota sidi dengan pemahaman mendalam.</div>
                        <div class="kegiatan-meta">
                            <div class="kegiatan-schedule">📅 Setiap Sabtu</div>
                            <div class="kegiatan-location">📍 Ruang Kelas</div>
                        </div>
                    </div>
                </div>

                <div class="kegiatan-card" onclick="showActivityDetail('visitasi-jemaat')">
                    <div class="kegiatan-img-container">
                        <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="Visitasi Jemaat" class="kegiatan-img">
                        <div class="kegiatan-overlay">
                            <div class="overlay-text">📖 Klik untuk detail lengkap</div>
                        </div>
                    </div>
                    <div class="kegiatan-info">
                        <div class="kegiatan-name">Visitasi Jemaat</div>
                        <div class="kegiatan-desc">Kegiatan kunjungan pastoral ke rumah-rumah jemaat untuk memberikan pelayanan rohani, konseling, dan mempererat hubungan pastoral.</div>
                        <div class="kegiatan-meta">
                            <div class="kegiatan-schedule">📅 Terjadwal</div>
                            <div class="kegiatan-location">📍 Rumah Jemaat</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
<script>
function showActivityDetail(activityType) {
    const activityDetails = {
        'ibadah-minggu': {
            title: 'Ibadah Minggu',
            description: 'Ibadah minggu rutin yang diadakan setiap hari Minggu pukul 09.00 WITA. Ibadah ini merupakan kegiatan utama jemaat untuk beribadah bersama dan mendengarkan firman Tuhan.',
            schedule: 'Setiap Minggu, 09:00 WITA',
            location: 'Gereja Toraja Eben-Haezer Selili',
            image: '{{ asset("images/gereja-toraja.jpg") }}'
        },
        'sekolah-minggu': {
            title: 'Sekolah Minggu',
            description: 'Kegiatan pembelajaran alkitab untuk anak-anak yang diadakan setiap hari Minggu bersamaan dengan ibadah dewasa. Program ini bertujuan untuk membangun karakter kristiani anak-anak sejak dini melalui cerita alkitab, lagu rohani, dan aktivitas kreatif yang mendidik.',
            schedule: 'Setiap Minggu, 09:00 WITA',
            location: 'Ruang Sekolah Minggu',
            image: '{{ asset("images/gereja-toraja.jpg") }}'
        },
        'ibadah-pemuda': {
            title: 'Ibadah Pemuda',
            description: 'Ibadah khusus untuk pemuda-pemudi yang diadakan setiap Sabtu malam. Kegiatan ini menggabungkan ibadah dengan diskusi, sharing, dan kegiatan persekutuan yang relevan dengan kehidupan pemuda masa kini. Pemuda dapat berbagi pengalaman iman dan saling menguatkan dalam perjalanan rohani.',
            schedule: 'Setiap Sabtu, 19:00 WITA',
            location: 'Aula Gereja',
            image: '{{ asset("images/gereja-toraja.jpg") }}'
        },
        'persekutuan-doa': {
            title: 'Persekutuan Doa',
            description: 'Kegiatan doa bersama yang diadakan setiap hari Rabu malam. Jemaat berkumpul untuk berdoa syafaat, memuji Tuhan, dan saling mendoakan satu sama lain dalam berbagai kebutuhan rohani dan jasmani. Ini adalah waktu khusus untuk mendekatkan diri kepada Tuhan dan membangun persekutuan yang kuat.',
            schedule: 'Setiap Rabu, 19:00 WITA',
            location: 'Gereja Toraja Eben-Haezer Selili',
            image: '{{ asset("images/gereja-toraja.jpg") }}'
        },
        'kelas-katekisasi': {
            title: 'Kelas Katekisasi',
            description: 'Program pembelajaran doktrin dan ajaran gereja untuk calon anggota jemaat. Kelas ini mempersiapkan peserta untuk menjadi anggota sidi gereja dengan pemahaman yang mendalam tentang iman Kristen, sejarah gereja, dan tanggung jawab sebagai anggota jemaat.',
            schedule: 'Setiap Sabtu, 16:00 WITA',
            location: 'Ruang Kelas Gereja',
            image: '{{ asset("images/gereja-toraja.jpg") }}'
        },
        'visitasi-jemaat': {
            title: 'Visitasi Jemaat',
            description: 'Kegiatan kunjungan pastoral ke rumah-rumah jemaat untuk memberikan pelayanan rohani, konseling, dan mempererat hubungan antara pendeta dengan jemaat. Visitasi dilakukan secara berkala sesuai kebutuhan untuk memberikan dukungan spiritual dan pastoral care.',
            schedule: 'Sesuai jadwal yang ditentukan',
            location: 'Rumah-rumah jemaat',
            image: '{{ asset("images/gereja-toraja.jpg") }}'
        }
    };
    
    const activity = activityDetails[activityType];
    if (activity) {
        const modal = document.createElement('div');
        modal.className = 'activity-modal';
        modal.innerHTML = `
            <div class="modal-content">
                <span class="close-modal">&times;</span>
                <div class="modal-header">
                    <img src="${activity.image}" alt="${activity.title}" class="modal-image">
                    <h2>${activity.title}</h2>
                </div>
                <div class="activity-detail">
                    <div class="detail-section">
                        <h3>📝 Deskripsi Kegiatan</h3>
                        <p>${activity.description}</p>
                    </div>
                    <div class="detail-section">
                        <h3>📅 Jadwal</h3>
                        <p>${activity.schedule}</p>
                    </div>
                    <div class="detail-section">
                        <h3>📍 Lokasi</h3>
                        <p>${activity.location}</p>
                    </div>
                </div>
            </div>
        `;
        
        const style = document.createElement('style');
        style.textContent = `
            .activity-modal {
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.6);
                display: flex;
                justify-content: center;
                align-items: center;
                backdrop-filter: blur(5px);
            }
            .modal-content {
                background-color: white;
                border-radius: 20px;
                max-width: 700px;
                width: 90%;
                max-height: 85vh;
                overflow-y: auto;
                position: relative;
                box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            }
            .modal-header {
                position: relative;
                text-align: center;
                color: white;
            }
            .modal-image {
                width: 100%;
                height: 250px;
                object-fit: cover;
                border-radius: 20px 20px 0 0;
            }
            .modal-header h2 {
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                margin: 0;
                font-size: 2rem;
                font-weight: bold;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
                background: linear-gradient(45deg, rgba(153, 121, 57, 0.9), rgba(181, 151, 86, 0.9));
                padding: 10px 20px;
                border-radius: 25px;
                backdrop-filter: blur(10px);
            }
            .close-modal {
                position: absolute;
                right: 20px;
                top: 20px;
                font-size: 30px;
                font-weight: bold;
                cursor: pointer;
                color: white;
                background: rgba(0,0,0,0.5);
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 10;
                transition: all 0.3s ease;
            }
            .close-modal:hover {
                background: rgba(0,0,0,0.8);
                transform: scale(1.1);
            }
            .activity-detail {
                padding: 30px;
            }
            .detail-section {
                margin-bottom: 25px;
            }
            .activity-detail h3 {
                color: #997939;
                margin-bottom: 15px;
                font-size: 1.3rem;
                font-weight: 600;
                border-bottom: 2px solid #f0f0f0;
                padding-bottom: 8px;
            }
            .activity-detail p {
                line-height: 1.7;
                color: #555;
                font-size: 1rem;
                margin: 0;
            }
            @media (max-width: 768px) {
                .modal-content {
                    width: 95%;
                    margin: 20px;
                }
                .activity-detail {
                    padding: 20px;
                }
                .modal-header h2 {
                    font-size: 1.5rem;
                    padding: 8px 15px;
                }
            }
        `;
        
        document.head.appendChild(style);
        document.body.appendChild(modal);
        
        modal.querySelector('.close-modal').onclick = function() {
            document.body.removeChild(modal);
            document.head.removeChild(style);
        };
        
        modal.onclick = function(event) {
            if (event.target === modal) {
                document.body.removeChild(modal);
                document.head.removeChild(style);
            }
        };
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll untuk navigasi
    const cards = document.querySelectorAll('.kegiatan-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
    
    // Remove any large logo elements
    function removeLargeLogos() {
        const logoSelectors = [
            '.large-logo', '.background-logo', '.watermark-logo',
            '.page-logo', '.overlay-logo', '.floating-logo',
            '[class*="logo-large"]', '[class*="church-logo"]'
        ];

        logoSelectors.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(el => el.remove());
        });

        const images = document.querySelectorAll('img');
        images.forEach(img => {
            if (img.naturalWidth > 500 && img.naturalHeight > 500) {
                if (!img.closest('.kegiatan-card')) {
                    img.style.maxWidth = '100%';
                    img.style.maxHeight = '250px';
                    img.style.objectFit = 'cover';
                }
            }
        });

        document.body.style.backgroundImage = 'none';
        const containers = document.querySelectorAll('.container, .main-content, .content-wrapper');
        containers.forEach(container => {
            container.style.backgroundImage = 'none';
        });
    }

    removeLargeLogos();
    setTimeout(removeLargeLogos, 100);
    setTimeout(removeLargeLogos, 500);
});
</script>
@endpush
