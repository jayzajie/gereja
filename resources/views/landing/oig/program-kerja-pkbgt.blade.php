@extends('layouts.landing')

@section('title', 'Program Kerja PKBGT 2025 - Gereja Toraja Eben-Haezer Selili')

@section('content')

    <!-- Program Kerja Header -->
    <div class="program-header">
        <div class="program-container">
            <h1 class="program-title">Program Kerja PKBGT 2025</h1>
            <!-- Sub Navbar OIG -->
            <div class="oig-subnavbar">
                <a href="{{ route('program-kerja-pkbgt') }}" class="oig-subnav-link{{ request()->routeIs('program-kerja-pkbgt') ? ' active' : '' }}">Program Kerja</a>
                <a href="{{ route('pengurus-pkbgt') }}" class="oig-subnav-link{{ request()->routeIs('pengurus-pkbgt') ? ' active' : '' }}">Pengurus</a>
            </div>
        </div>
    </div>

    <!-- Program Kerja Content -->
    <div class="program-container">
        <!-- Program Kerja Grid -->
        <div class="program-grid">
            <!-- Program Kerja Box 1 -->
            <div class="program-box">
                <h3 class="program-box-title">Nama Program Kerja</h3>
                <div class="program-list">
                    <div class="program-item">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                    <div class="program-item">2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                    <div class="program-item">3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                </div>
            </div>

            <!-- Program Kerja Box 2 -->
            <div class="program-box">
                <h3 class="program-box-title">Nama Program Kerja</h3>
                <div class="program-list">
                    <div class="program-item">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                    <div class="program-item">2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                    <div class="program-item">3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                </div>
            </div>

            <!-- Program Kerja Box 3 -->
            <div class="program-box">
                <h3 class="program-box-title">Nama Program Kerja</h3>
                <div class="program-list">
                    <div class="program-item">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                    <div class="program-item">2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                    <div class="program-item">3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                </div>
            </div>

            <!-- Program Kerja Box 4 -->
            <div class="program-box">
                <h3 class="program-box-title">Nama Program Kerja</h3>
                <div class="program-list">
                    <div class="program-item">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                    <div class="program-item">2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                    <div class="program-item">3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</div>
                </div>
            </div>
        </div>
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
