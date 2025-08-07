@extends('layouts.landing')

@section('title', 'Kegiatan Jemaat - Gereja Toraja Eben-Haezer Selili')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kegiatan-jemaat.css') }}">
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
                            @if($activity->image && file_exists(storage_path('app/public/' . $activity->image)))
                                <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" class="kegiatan-img" loading="lazy">
                            @else
                                <img src="{{ asset('images/gereja-toraja.jpg') }}" alt="{{ $activity->title }}" class="kegiatan-img" loading="lazy">
                            @endif
                            <div class="kegiatan-overlay">
                                <div class="overlay-text">📖 Klik untuk detail lengkap</div>
                            </div>
                        </div>
                        <div class="kegiatan-info">
                            <div class="kegiatan-name">{{ $activity->title }}</div>
                            <div class="kegiatan-desc">{{ Str::limit($activity->content, 120) }}</div>
                            <div class="kegiatan-meta">
                                <div class="kegiatan-schedule">
                                    📅 {{ $activity->publish_date ? $activity->publish_date->format('d M Y') : 'Terjadwal' }}
                                </div>
                                <div class="kegiatan-location">📍 {{ $activity->subcategory ?? 'Gereja' }}</div>
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

        @if(!isset($activities) || $activities->count() == 0)
            <!-- Message when no activities are available -->
            <div class="no-activities-message">
                <h4>📅 Kegiatan Akan Segera Hadir</h4>
                <p>Saat ini belum ada kegiatan yang terjadwal. Silakan kembali lagi nanti untuk melihat kegiatan-kegiatan terbaru dari jemaat kami.</p>
                <p>Untuk informasi lebih lanjut, hubungi sekretariat gereja.</p>
            </div>
        @endif
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
    // Enhanced card interactions
    const cards = document.querySelectorAll('.kegiatan-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px)';
        });

        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Lazy loading for images
    const images = document.querySelectorAll('.kegiatan-img');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.style.opacity = '0';
                img.style.transition = 'opacity 0.3s ease';
                img.onload = () => {
                    img.style.opacity = '1';
                };
                observer.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));

    // Smooth scrolling for better UX
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endpush
