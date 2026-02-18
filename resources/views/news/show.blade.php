@extends('layouts.app')

@section('title', $news->title . ' - St. Anne Marie Academy Schools')

@section('styles')
<style>
    .news-detail-wrapper {
        background-color: #f9fafb;
        min-height: 100vh;
        padding-bottom: 5rem;
    }

    .detail-hero-solid {
        position: relative;
        background: var(--school-primary, #1e5128);
        color: white;
        padding: 6rem 1rem 10rem;
        overflow: hidden;
    }

    .detail-hero-container {
        max-width: 1536px;
        margin: 0 auto;
        position: relative;
        z-index: 10;
        text-align: center;
    }

    .news-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 700;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.1em;
        margin-bottom: 2rem;
        transition: color 0.3s;
    }

    .news-back-btn:hover {
        color: white;
    }

    .detail-title {
        font-family: 'Inter', sans-serif;
        font-size: 3rem;
        font-weight: 800;
        margin-bottom: 2rem;
        line-height: 1.2;
        letter-spacing: -0.025em;
    }

    .detail-meta {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.8);
    }

    .detail-badge {
        background: var(--school-secondary, #c41e3a);
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 0.4rem;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.75rem;
    }

    .detail-main-content {
        max-width: 1536px;
        margin: -4rem auto 0;
        padding: 0 1rem 5rem;
        position: relative;
        z-index: 20;
    }

    .detail-image-box {
        width: 100%;
        max-height: 550px;
        border-radius: 1.5rem;
        overflow: hidden;
        margin-bottom: 3rem;
        box-shadow: 0 20px 40px -10px rgba(0,0,0,0.15);
    }

    .detail-image-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .detail-body-text {
        background: white;
        padding: 3rem;
        border-radius: 1.25rem;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        color: #334155;
        font-size: 1.15rem;
        line-height: 1.8;
        white-space: pre-line;
    }

    .gallery-section {
        margin-top: 5rem;
    }

    .gallery-title {
        font-size: 2rem;
        font-weight: 900;
        color: var(--school-primary);
        margin-bottom: 2rem;
        text-align: center;
        font-family: serif;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .gallery-item {
        border-radius: 1rem;
        overflow: hidden;
        aspect-ratio: 16/9;
        border: 4px solid white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }

    .gallery-item:hover {
        transform: scale(1.02);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    @media (min-width: 768px) {
        .news-detail-title {
            font-size: 3.5rem;
        }

        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection

@section('content')
<div class="news-detail-wrapper">
    <header class="detail-hero-solid">
        <div class="detail-hero-container">
            <a href="{{ route('news') }}" class="news-back-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Back to News
            </a>
            <h1 class="detail-title">{{ $news->title }}</h1>
            <div class="detail-meta">
                <span class="detail-badge">{{ $news->category }}</span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    {{ $news->formatted_date }}
                </span>
                @if(!empty($news->location))
                    <span style="display: flex; align-items: center; gap: 0.25rem;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.163-7.39 11.728a1.1 1.1 0 0 1-1.22 0C9.539 20.163 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                        {{ $news->location }}
                    </span>
                @endif
            </div>
        </div>
    </header>

    <div class="detail-main-content">
        <div class="detail-image-box">
            <img src="{{ $news->image }}" alt="{{ $news->title }}">
        </div>

        <article class="detail-body-text">
            {{ $news->content }}
        </article>
    </div>
</div>
@endsection
