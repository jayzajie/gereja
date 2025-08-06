@extends('layouts.landing')

@section('title', 'Program Kerja Majelis Gereja - Gereja Toraja Eben-Haezer Selili')

@push('styles')
<style>
    /* Program Kerja Page Styles */
    .program-header {
        background: linear-gradient(135deg, var(--primary), var(--accent));
        padding: 120px 0 80px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
        margin-top: 90px; /* Account for fixed navbar */
    }

    .program-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at center,
            rgba(255, 255, 255, 0.1) 0%,
            rgba(0, 0, 0, 0.1) 100%);
        z-index: 1;
    }

    .program-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }

    .program-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 0.8s ease-out;
    }

    .program-section {
        background: white;
        border-radius: 20px;
        padding: 50px 40px;
        margin: -50px 20px 50px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 3;
    }

    .program-section-title {
        font-size: 2.2rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 40px;
        text-align: center;
        position: relative;
        padding-bottom: 20px;
    }

    .program-section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--accent));
        border-radius: 2px;
    }

    .program-item-container {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 30px;
        margin-bottom: 30px;
        border-left: 5px solid var(--primary);
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .program-item-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .program-item-container h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
    }

    .program-item {
        line-height: 1.8;
        color: #555;
        font-size: 1rem;
        margin-bottom: 20px;
    }

    .program-item p {
        margin-bottom: 15px;
    }

    /* Author info styling */
    .program-item-container p[style*="font-style: italic"] {
        background: rgba(153, 121, 57, 0.1);
        padding: 12px 16px;
        border-radius: 8px;
        margin: 15px 0;
        border-left: 4px solid var(--primary);
        font-weight: 500;
        color: var(--primary) !important;
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        color: #666;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.3;
        color: var(--primary);
    }

    .empty-state h3 {
        font-size: 1.8rem;
        margin-bottom: 15px;
        color: var(--text-dark);
    }

    .empty-state p {
        font-size: 1.1rem;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .program-header {
            padding: 100px 0 60px;
        }

        .program-title {
            font-size: 2.2rem;
        }

        .program-section {
            padding: 30px 25px;
            margin: -30px 15px 30px;
        }

        .program-section-title {
            font-size: 1.8rem;
        }

        .program-item-container {
            padding: 25px 20px;
        }

        .program-item-container h3 {
            font-size: 1.3rem;
        }

        .empty-state {
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 3rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .program-container {
            padding: 0 15px;
        }

        .program-section {
            margin: -30px 10px 20px;
            padding: 25px 20px;
        }

        .program-item-container {
            padding: 20px 15px;
        }
    }
</style>
@endpush

@section('content')

    <!-- Program Kerja Header -->
    <div class="program-header">
        <div class="program-container">
            <h1 class="program-title">Program Kerja Majelis Gereja</h1>
        </div>
    </div>

    <!-- Program Kerja Content -->
    <div class="program-container">
        <!-- Program Kerja 2025 -->
        <div class="program-section">
            <h2 class="program-section-title">Program Kerja Majelis Tahun {{ date('Y') }}</h2>

            @if($programKerja->count() > 0)
                @foreach($programKerja as $index => $program)
                    <div class="program-item-container" style="margin-bottom: 2rem;">
                        <h3>{{ $index + 1 }}. {{ $program->title }}</h3>



                        <div class="program-item">
                            {!! nl2br(e($program->content)) !!}
                        </div>

                        @if($program->author)
                            <p style="font-style: italic; color: #666; margin-top: 1rem;">
                                <strong>Penanggung Jawab:</strong> {{ $program->author }}
                            </p>
                        @endif


                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <i class="fas fa-clipboard-list"></i>
                    <h3>Belum Ada Program Kerja</h3>
                    <p>Program kerja untuk tahun ini belum tersedia. Silakan periksa kembali nanti.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
