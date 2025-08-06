@extends('layouts.landing')

@section('title', $activity->title . ' - Gereja Toraja Eben-Haezer Selili')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/kegiatan-jemaat.css') }}">
<style>
    .detail-header {
        background: linear-gradient(135deg, #997939 0%, #b59756 100%);
        color: white;
        padding: 80px 0;
        text-align: center;
        position: relative;
    }
    
    .detail-content {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    
    .detail-image {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 30px;
    }
    
    .back-button {
        display: inline-block;
        background: #997939;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 6px;
        margin-bottom: 20px;
        transition: background 0.3s ease;
    }
    
    .back-button:hover {
        background: #7a5f2d;
    }
</style>
@endpush

@section('content')
<div class="detail-header">
    <div class="container">
        <h1>{{ $activity->title }}</h1>
        <p>Detail Kegiatan Jemaat</p>
    </div>
</div>

<div class="detail-content">
    <a href="{{ route('kegiatan-jemaat') }}" class="back-button">← Kembali ke Kegiatan Jemaat</a>
    
    @if($activity->image)
        <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" class="detail-image">
    @endif
    
    <div class="content">
        {!! nl2br(e($activity->content)) !!}
    </div>
    
    @if($activity->created_at)
        <div class="meta-info" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; color: #666;">
            <small>Dipublikasikan pada: {{ $activity->created_at->format('d F Y') }}</small>
        </div>
    @endif
</div>
@endsection