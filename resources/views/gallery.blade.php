@extends('layouts.app')

@section('title', 'School Gallery - St. Anne Marie Academy Schools')

@section('styles')
<style>
    .gallery-page {
        background: #f9fafb;
        min-height: 100vh;
    }

    /* Hero Section */
    .gallery-hero {
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
        font-family: 'Inter', sans-serif;
        font-weight: 800;
        margin-bottom: 1.5rem;
        letter-spacing: -0.025em;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        max-width: 42rem;
        margin: 0 auto 3.5rem;
        color: #e5e7eb;
        font-weight: 500;
    }

    .hero-badge {
        display: inline-block;
        padding: 0.5rem 2rem;
        background: #fbbf24;
        color: var(--school-primary, #1e5128);
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 9999px;
        font-size: 0.875rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    /* Main Container */
    .gallery-container {
        max-width: 1536px;
        margin: -4rem auto 0;
        padding: 0 1rem 5rem;
        position: relative;
        z-index: 20;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 2rem;
    }

    @media (min-width: 768px) {
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    /* Campus Card */
    .campus-gallery-card {
        background: white;
        border-radius: 2rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.4s ease;
        border: 1px solid #f3f4f6;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .campus-gallery-card:hover {
        transform: translateY(-0.5rem);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .card-image-box {
        height: 25rem;
        position: relative;
        overflow: hidden;
    }

    .card-image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .campus-gallery-card:hover .card-image-box img {
        transform: scale(1.05);
    }

    .card-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 2.5rem;
    }

    .card-title {
        color: white;
        font-size: 1.75rem;
        font-family: Georgia, serif;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .card-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        background: var(--school-secondary, #c41e3a);
        color: white;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-radius: 0.375rem;
        margin-bottom: 1.5rem;
        align-self: flex-start;
    }

    .view-gallery-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        color: #fbbf24;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.875rem;
        text-decoration: none;
        transition: gap 0.3s;
    }

    .campus-gallery-card:hover .view-gallery-btn {
        gap: 1.25rem;
    }
</style>
@endsection

@section('content')
<div class="gallery-page">
    <!-- Hero Section -->
    <div class="gallery-hero">
        <div class="hero-background">
            <img src="/images/school/student_celebration.jpg" alt="Student Celebration" fetchpriority="high">
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Our School Gallery</h1>
            <p class="hero-subtitle">
                Explore the vibrant life and world-class facilities across our diverse campuses.
            </p>
            <span class="hero-badge">
                Towards Excellence
            </span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="gallery-container">
        <div class="gallery-grid">
            @foreach($campuses as $campus)
                <a href="{{ route('gallery.show', $campus->slug) }}" class="campus-gallery-card">
                    <div class="card-image-box">
                        <img src="{{ $campus->image }}" alt="{{ $campus->name }}" loading="lazy">
                        <div class="card-overlay">
                            <span class="card-badge">{{ $campus->level }}</span>
                            <h2 class="card-title">{{ $campus->name }}</h2>
                            <div class="view-gallery-btn">
                                Browse Photos
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
