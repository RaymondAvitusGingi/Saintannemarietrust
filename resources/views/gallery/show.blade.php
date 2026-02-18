@extends('layouts.app')

@section('title', $campus->name . ' Gallery - St. Anne Marie Academy Schools')

@section('styles')
<style>
    .gallery-show-page {
        background: #f9fafb;
        min-height: 100vh;
    }

    /* Hero Section */
    .gallery-show-hero {
        position: relative;
        background: var(--school-primary, #1e5128);
        color: white;
        padding: 6rem 0;
        overflow: hidden;
    }

    .hero-background {
        position: absolute;
        inset: 0;
        z-index: 0;
    }

    .hero-background img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: var(--school-primary, #1e5128);
        opacity: 0.8;
        mix-blend-mode: multiply;
    }

    .hero-content {
        max-width: 1536px;
        margin: 0 auto;
        padding: 0 1rem;
        position: relative;
        z-index: 10;
        text-align: center;
    }

    .hero-content h1 {
        font-size: 3rem;
        font-family: Georgia, serif;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        color: #e5e7eb;
        font-weight: 500;
        margin-bottom: 2rem;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #fbbf24;
        font-weight: 700;
        text-decoration: none;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        transition: transform 0.3s;
    }

    .back-btn:hover {
        transform: translateX(-0.5rem);
    }

    /* Main Grid */
    .gallery-grid-container {
        max-width: 1536px;
        margin: -4rem auto 0;
        padding: 0 1rem 5rem;
        position: relative;
        z-index: 20;
    }

    .photo-masonry {
        columns: 1;
        column-gap: 1.5rem;
    }

    @media (min-width: 640px) {
        .photo-masonry {
            columns: 2;
        }
    }

    @media (min-width: 1024px) {
        .photo-masonry {
            columns: 3;
        }
    }

    .masonry-item {
        break-inside: avoid;
        margin-bottom: 1.5rem;
        border-radius: 1.5rem;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        cursor: zoom-in;
    }

    .masonry-item:hover {
        transform: scale(1.02);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .masonry-item img {
        width: 100%;
        display: block;
        transition: transform 0.5s;
    }

    .masonry-item:hover img {
        transform: scale(1.05);
    }

    .photo-info {
        padding: 1.25rem;
        border-top: 1px solid #f3f4f6;
    }

    .photo-campus {
        font-size: 0.75rem;
        font-weight: 800;
        color: var(--school-secondary, #c41e3a);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
</style>
@endsection

@section('content')
<div class="gallery-show-page">
    <!-- Hero Section -->
    <div class="gallery-show-hero">
        <div class="hero-background">
            <img src="{{ $campus->image }}" alt="{{ $campus->name }}">
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <a href="{{ route('gallery') }}" class="back-btn mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
                Back to All Campuses
            </a>
            <h1>{{ $campus->name }}</h1>
            <p class="hero-subtitle">{{ $campus->level }} Gallery</p>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="gallery-grid-container">
        <div class="photo-masonry">
            @foreach($images as $index => $photo)
                <div class="masonry-item">
                    <img src="{{ $photo->image_url }}" alt="{{ $campus->name }} Photo {{ $index + 1 }}">
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
