@extends('layouts.app')

@section('title', 'Our Campuses - St. Anne Marie Academy Schools')

@section('styles')
<style>
    .campuses-page {
        background: #f9fafb;
        min-height: 100vh;
    }

    /* Hero Section */
    .campuses-hero {
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
        margin: 0 auto 3.5rem; /* Increased spacing to matching About page */
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
    .campuses-container {
        max-width: 1536px;
        margin: -4rem auto 0;
        padding: 0 1rem 5rem;
        position: relative;
        z-index: 20;
    }

    /* Campus Card */
    .campus-item {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 3rem;
        display: grid;
        grid-template-columns: 1fr;
        transition: all 0.4s ease;
        border: 1px solid #f3f4f6;
    }

    .campus-item:hover {
        transform: translateY(-0.5rem);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .campus-image-container {
        height: 20rem;
        position: relative;
        overflow: hidden;
    }

    .campus-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .campus-item:hover .campus-image-container img {
        transform: scale(1.05);
    }

    .campus-level-badge {
        position: absolute;
        top: 1.5rem;
        left: 1.5rem;
        padding: 0.5rem 1.25rem;
        background: #c41e3a;
        color: white;
        font-weight: 800;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .campus-info {
        padding: 2rem;
        display: flex;
        flex-direction: column;
    }

    .campus-info h2 {
        font-size: 2.25rem;
        font-family: Georgia, serif;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 1rem;
    }

    .campus-motto {
        font-size: 1.25rem;
        color: #6b7280;
        font-style: italic;
        font-weight: 500;
        margin-bottom: 1.5rem;
        border-left: 4px solid #fbbf24;
        padding-left: 1rem;
    }

    .campus-description {
        color: #4b5563;
        line-height: 1.75;
        font-weight: 500;
        margin-bottom: 2rem;
    }

    .campus-meta {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        margin-bottom: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid #f3f4f6;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #374151;
        font-size: 0.875rem;
        font-weight: 700;
    }

    .meta-item svg {
        width: 1.25rem;
        height: 1.25rem;
        color: #1e5128;
    }

    .campus-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        background: #1e5128;
        color: white;
        padding: 0.875rem 2rem;
        border-radius: 0.75rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s;
        align-self: flex-start;
    }

    .campus-btn:hover {
        background: #14361b;
        transform: translateX(0.25rem);
    }

    @media (min-width: 1024px) {
        .campus-item {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .campus-image-container {
            height: 35rem; /* Fixed height for uniform "picture card size" */
        }

        .campus-item:nth-child(even) .campus-image-container {
            order: 2;
        }
    }
</style>
@endsection

@section('content')
<div class="campuses-page">
    <!-- Hero Section -->
    <div class="campuses-hero">
        <div class="hero-background">
            <img src="/images/school/brilliant_entrance.jpg" alt="Student Group Photo" fetchpriority="high">
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Our Campuses</h1>
            <p class="hero-subtitle">
                Discover the unique environments of our four centers of excellence.
            </p>
            <span class="hero-badge">
                Towards Excellence
            </span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="campuses-container">
        @foreach($campuses as $campus)
            <div id="{{ $campus->slug }}" class="campus-item">
                <div class="campus-image-container">
                    @if($campus->image)
                        <img src="{{ $campus->image }}" alt="{{ $campus->name }}">
                    @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M14 22v-4a2 2 0 1 0-4 0v4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg>
                        </div>
                    @endif
                    <div class="campus-level-badge">
                        {{ $campus->level }}
                    </div>
                </div>

                <div class="campus-info">
                    <h2>{{ $campus->name }}</h2>
                    @if(!empty($campus->motto))
                        <p class="campus-motto">"{{ $campus->motto }}"</p>
                    @endif
                    <p class="campus-description">
                        {{ $campus->description }}
                    </p>
                    
                    <div class="campus-meta">
                        <div class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.163-7.39 11.728a1.1 1.1 0 0 1-1.22 0C9.539 20.163 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                            <span>{{ $campus->location ?? 'Dar es Salaam' }}</span>
                        </div>
                        @if(!empty($campus->registration))
                            <div class="meta-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14.5 2 14.5 8 20 8"/></svg>
                                <span>{{ $campus->registration }}</span>
                            </div>
                        @endif
                    </div>

                    <a href="{{ url('/campuses/'.$campus->slug) }}" class="campus-btn">
                        View Full Profile
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
