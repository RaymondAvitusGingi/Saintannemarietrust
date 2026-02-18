@extends('layouts.app')

@section('title', $title . ' - St. Anne Marie Academy Schools')

@section('styles')
<style>
    .construction-wrapper {
        min-height: 60vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f9fafb;
        padding: 0 1rem;
    }

    .construction-content {
        text-align: center;
        max-width: 36rem;
    }

    .construction-icon {
        width: 5rem;
        height: 5rem;
        background: rgba(0, 255, 136, 0.2);
        color: var(--school-primary, #1e5128);
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .construction-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 1.5rem;
        font-family: Georgia, serif;
    }

    .construction-description {
        font-size: 1.25rem;
        color: #4b5563;
        margin-bottom: 2.5rem;
        line-height: 1.6;
    }

    .construction-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--school-primary, #1e5128);
        color: white;
        font-weight: 700;
        padding: 0.75rem 2rem;
        border-radius: 0.5rem;
        transition: all 0.3s;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .construction-button:hover {
        background: var(--school-secondary, #c41e3a);
    }

    @media (min-width: 768px) {
        .construction-title {
            font-size: 3rem;
        }
    }
</style>
@endsection

@section('content')
    <div class="construction-wrapper">
        <div class="construction-content">
            <div class="construction-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="6" width="20" height="12" rx="2"/>
                    <path d="M12 12h.01"/>
                    <path d="M17 12h.01"/>
                    <path d="M7 12h.01"/>
                    <path d="M2 10h20"/>
                    <path d="M2 14h20"/>
                </svg>
            </div>
            <h1 class="construction-title">{{ $title }}</h1>
            <p class="construction-description">
                Thank you for your interest. This section of our website is currently under construction and will be available soon.
            </p>
            <a href="{{ url('/') }}" class="construction-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22"/>
                </svg>
                Return Home
            </a>
        </div>
    </div>
@endsection