@extends('layouts.app')

@section('title', $campus->name . ' - St. Anne Marie Academy Schools')

@section('styles')
<style>
    .campus-detail-wrapper {
        background: #f9fafb;
        min-height: 100vh;
        padding-bottom: 5rem;
        font-family: system-ui, -apple-system, sans-serif;
    }

    .campus-hero {
        position: relative;
        height: 400px;
        width: 100%;
    }

    .campus-hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .campus-hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(30, 81, 40, 0.6);
        mix-blend-mode: multiply;
    }

    .campus-hero-gradient {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
    }

    .campus-hero-content {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        padding: 1rem;
        z-index: 10;
        max-width: 1536px;
        margin: 0 auto;
    }

    .campus-level-badge {
        background: var(--school-secondary, #c41e3a);
        padding: 0.5rem 1.5rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
        letter-spacing: 0.1em;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
    }

    .campus-hero-title {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 2rem;
        font-family: 'Inter', sans-serif;
        letter-spacing: -0.025em;
    }

    .campus-motto {
        display: inline-block;
        padding: 0.5rem 2rem;
        background: #fbbf24;
        color: var(--school-primary, #1e5128);
        border-radius: 9999px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        font-size: 0.875rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }

    .campus-container {
        max-width: 1536px;
        margin: -4rem auto 0;
        padding: 0 1rem 5rem;
        position: relative;
        z-index: 20;
    }

    .campus-main-card {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 3rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        color: #6b7280;
        font-weight: 600;
        margin-bottom: 2rem;
        transition: color 0.3s;
    }

    .back-link:hover {
        color: var(--school-primary, #1e5128);
    }

    .back-link-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 9999px;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.5rem;
        transition: all 0.3s;
    }

    .back-link:hover .back-link-icon {
        background: var(--school-primary, #1e5128);
        color: white;
    }

    .campus-content-layout {
        display: flex;
        flex-direction: column;
        gap: 3rem;
    }

    .campus-main-content {
        width: 100%;
    }

    .campus-sidebar {
        width: 100%;
    }

    .section-title-main {
        font-size: 1.875rem;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 1.5rem;
        font-family: Georgia, serif;
    }

    .campus-description {
        color: #374151;
        font-size: 1.125rem;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .mission-vision-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .mission-card {
        background: rgba(34, 197, 94, 0.05);
        padding: 1.5rem;
        border-radius: 0.5rem;
        border-left: 4px solid var(--school-primary, #1e5128);
        transition: box-shadow 0.3s;
    }

    .mission-card:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .vision-card {
        background: rgba(220, 38, 38, 0.05);
        padding: 1.5rem;
        border-radius: 0.5rem;
        border-left: 4px solid var(--school-secondary, #c41e3a);
        transition: box-shadow 0.3s;
    }

    .vision-card:hover {
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .card-icon {
        padding: 0.5rem;
        border-radius: 9999px;
    }

    .mission-icon {
        background: rgba(30, 81, 40, 0.1);
        color: var(--school-primary, #1e5128);
    }

    .vision-icon {
        background: rgba(196, 30, 58, 0.1);
        color: var(--school-secondary, #c41e3a);
    }

    .card-title {
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .mission-title {
        color: var(--school-primary, #1e5128);
    }

    .vision-title {
        color: var(--school-secondary, #c41e3a);
    }

    .card-text {
        color: #374151;
        font-weight: 500;
    }

    .content-section {
        margin-bottom: 3rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 0.5rem;
    }

    .section-icon {
        color: var(--school-secondary, #c41e3a);
    }

    .history-content {
        color: #374151;
        line-height: 1.6;
        max-width: none;
    }

    .routine-table-wrapper {
        overflow: hidden;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    .routine-table {
        width: 100%;
        font-size: 0.875rem;
        text-align: left;
    }

    .routine-thead {
        font-size: 0.75rem;
        color: white;
        text-transform: uppercase;
        background: var(--school-primary, #1e5128);
    }

    .routine-thead th {
        padding: 1rem 1.5rem;
        font-weight: 700;
        letter-spacing: 0.05em;
    }

    .routine-tbody {
        background: white;
    }

    .routine-tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.3s;
    }

    .routine-tbody tr:hover {
        background: #f9fafb;
    }

    .routine-tbody tr:nth-child(even) {
        background: rgba(249, 250, 251, 0.5);
    }

    .routine-tbody tr:nth-child(even):hover {
        background: #f9fafb;
    }

    .routine-time {
        padding: 1rem 1.5rem;
        font-weight: 700;
        color: #111827;
        white-space: nowrap;
        border-right: 1px solid #f3f4f6;
    }

    .routine-activity {
        padding: 1rem 1.5rem;
        color: #374151;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .gallery-item {
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        height: 16rem;
        position: relative;
        cursor: pointer;
    }

    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0);
        transition: background 0.3s;
        z-index: 10;
    }

    .gallery-item:hover .gallery-overlay {
        background: rgba(0, 0, 0, 0.2);
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1);
        transition: transform 0.7s;
    }

    .gallery-item:hover .gallery-image {
        transform: scale(1.1);
    }

    .info-card {
        background: white;
        padding: 1.5rem;
        border-radius: 0.75rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 6rem;
    }

    .info-card-title {
        font-weight: 700;
        font-size: 1.125rem;
        margin-bottom: 1.5rem;
        color: var(--school-primary, #1e5128);
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .info-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .info-icon-wrapper {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 9999px;
        background: rgba(59, 130, 246, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-icon {
        color: var(--school-secondary, #c41e3a);
    }

    .info-content {
        flex: 1;
    }

    .info-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #9ca3af;
        margin-bottom: 0.25rem;
    }

    .info-value {
        color: #1f2937;
        font-weight: 500;
        font-size: 0.875rem;
        line-height: 1.3;
        display: block;
    }

    .rules-section {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #f3f4f6;
    }

    .rules-title {
        font-weight: 700;
        font-size: 1.125rem;
        margin-bottom: 1rem;
        color: var(--school-secondary, #c41e3a);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .rules-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .rule-item {
        font-size: 0.875rem;
        color: #4b5563;
        display: flex;
        gap: 0.5rem;
        align-items: flex-start;
    }

    .rule-bullet {
        color: var(--school-primary, #1e5128);
        font-weight: 700;
        margin-top: 0.25rem;
    }

    .rule-text {
        line-height: 1.3;
    }

    .rules-more {
        margin-top: 1rem;
        padding: 0.75rem;
        background: #f9fafb;
        border-radius: 0.25rem;
        text-align: center;
        font-size: 0.75rem;
        color: #6b7280;
        font-style: italic;
    }

    @media (min-width: 768px) {
        .campus-hero-title {
            font-size: 3.75rem;
        }

        .campus-main-card {
            padding: 3rem;
        }

        .mission-vision-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .campus-content-layout {
            flex-direction: row;
        }

        .campus-main-content {
            width: 66.666667%;
        }

        .campus-sidebar {
            width: 33.333333%;
        }
    }
</style>
@endsection

@section('content')
    <div class="campus-detail-wrapper">
        <!-- Header/Hero -->
        <div class="campus-hero">
            <img src="{{ $campus->image }}" alt="{{ $campus->name }}" class="campus-hero-image" fetchpriority="high">
            <div class="campus-hero-overlay"></div>
            <div class="campus-hero-gradient"></div>
            <div class="campus-hero-content">
                <span class="campus-level-badge">{{ $campus->level }} Campus</span>
                <h1 class="campus-hero-title">{{ $campus->name }}</h1>
                @if(!empty($campus->motto))
                    <p class="campus-motto">"{{ $campus->motto }}"</p>
                @endif
            </div>
        </div>

        <div class="campus-container">
            <div class="campus-main-card">
                <a href="{{ url('/campuses') }}" class="back-link">
                    <div class="back-link-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m12 19-7-7 7-7"/>
                            <path d="M19 12H5"/>
                        </svg>
                    </div>
                    Back to All Campuses
                </a>

                <div class="campus-content-layout">
                    <div class="campus-main-content">
                        <h2 class="section-title-main">About the Campus</h2>
                        <p class="campus-description">{{ $campus->description }}</p>

                        <!-- Mission & Vision -->
                        @if(!empty($campus->mission) || !empty($campus->vision))
                            <div class="mission-vision-grid">
                                @if(!empty($campus->mission))
                                    <div class="mission-card">
                                        <div class="card-header">
                                            <div class="card-icon mission-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"/>
                                                    <circle cx="12" cy="12" r="6"/>
                                                    <circle cx="12" cy="12" r="2"/>
                                                </svg>
                                            </div>
                                            <h3 class="card-title mission-title">Mission</h3>
                                        </div>
                                        <p class="card-text">{{ $campus->mission }}</p>
                                    </div>
                                @endif
                                @if(!empty($campus->vision))
                                    <div class="vision-card">
                                        <div class="card-header">
                                            <div class="card-icon vision-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                                                </svg>
                                            </div>
                                            <h3 class="card-title vision-title">Vision</h3>
                                        </div>
                                        <p class="card-text">{{ $campus->vision }}</p>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- History -->
                        @if(!empty($campus->history))
                            <div class="content-section">
                                <h3 class="section-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="section-icon">
                                        <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
                                        <path d="M3 3v5h5"/>
                                        <path d="M12 7v5l4 2"/>
                                    </svg>
                                    History & Background
                                </h3>
                                <div class="history-content">
                                    <p>{{ $campus->history }}</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Routine -->
                        @if(!empty($campus->routine))
                            <div class="content-section">
                                <h3 class="section-title">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="section-icon">
                                        <circle cx="12" cy="12" r="10"/>
                                        <polyline points="12 6 12 12 16 14"/>
                                    </svg>
                                    Daily Routine
                                </h3>
                                <div class="routine-table-wrapper">
                                    <table class="routine-table">
                                        <thead class="routine-thead">
                                            <tr>
                                                <th>Time</th>
                                                <th>Activity</th>
                                            </tr>
                                        </thead>
                                        <tbody class="routine-tbody">
                                            @foreach($campus->routine as $idx => $item)
                                                <tr>
                                                    <td class="routine-time">{{ $item['time'] }}</td>
                                                    <td class="routine-activity">{{ $item['activity'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Gallery -->
                        @if($images->isNotEmpty())
                            <div class="content-section">
                                <div class="flex items-center justify-between mb-6 border-bottom border-gray-100 pb-2">
                                    <h3 class="section-title mb-0 border-0 pb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="section-icon">
                                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                                            <circle cx="9" cy="9" r="2"/>
                                            <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                                        </svg>
                                        Environment Gallery
                                    </h3>
                                    <a href="{{ route('gallery.show', $campus->slug) }}" class="text-sm font-bold text-school-primary hover:text-school-secondary transition-colors flex items-center gap-2">
                                        View Full Gallery
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                                    </a>
                                </div>
                                <div class="gallery-grid">
                                    @foreach($images as $idx => $img)
                                        <div class="gallery-item">
                                            <div class="gallery-overlay"></div>
                                            <img src="{{ $img->image_url }}" alt="Campus environment {{ $idx + 1 }}" class="gallery-image" loading="lazy">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                    </div>

                    <div class="campus-sidebar">
                        <!-- Info Card -->
                        <div class="info-card">
                            <h3 class="info-card-title">Quick Facts</h3>
                            <ul class="info-list">
                                <li class="info-item">
                                    <div class="info-icon-wrapper">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-icon">
                                            <path d="M20 10c0 4.993-5.539 10.163-7.39 11.728a1.1 1.1 0 0 1-1.22 0C9.539 20.163 4 14.993 4 10a8 8 0 0 1 16 0"/>
                                            <circle cx="12" cy="10" r="3"/>
                                        </svg>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label">Location</span>
                                        <span class="info-value">{{ $campus->location ?? 'Mbezi Temboni Kwa Msuguri, Dar es Salaam' }}</span>
                                    </div>
                                </li>
                                @if(!empty($campus->email))
                                    <li class="info-item">
                                        <div class="info-icon-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-icon">
                                                <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                            </svg>
                                        </div>
                                        <div class="info-content">
                                            <span class="info-label">Email</span>
                                            <span class="info-value"><a href="mailto:{{ $campus->email }}" class="text-gray-800 hover:text-school-primary transition-colors">{{ $campus->email }}</a></span>
                                        </div>
                                    </li>
                                @endif
                                @if(!empty($campus->phone))
                                    <li class="info-item">
                                        <div class="info-icon-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-icon">
                                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                            </svg>
                                        </div>
                                        <div class="info-content">
                                            <span class="info-label">Phone</span>
                                            
                                            @php
                                                $detailPhones = preg_split('/[\/&,]/', $campus->phone);
                                            @endphp

                                            <div class="flex flex-col gap-4 mt-2">
                                                @foreach($detailPhones as $p)
                                                    @php
                                                        $cleanP = str_replace(['+', ' ', '(', ')', '-'], '', trim($p));
                                                        if (str_starts_with($cleanP, '0')) {
                                                            $cleanP = '255' . substr($cleanP, 1);
                                                        }
                                                        
                                                        $personTitle = $campus->headmaster ?? "Headmaster";
                                                        if ($campus->slug == 'st-anne-marie') {
                                                            $personTitle = ($loop->iteration == 1) ? 'Headteacher Primary' : 'Headmaster Secondary';
                                                        }
                                                    @endphp
                                                    <div class="{{ $loop->iteration > 1 ? 'pt-3 border-t border-gray-100' : '' }}">
                                                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-wider mb-1">{{ $personTitle }}</p>
                                                        <p class="text-xs font-bold text-gray-800 mb-2">{{ trim($p) }}</p>
                                                        <div class="flex items-center gap-2 mt-1">
                                                            <a href="tel:{{ $cleanP }}" class="inline-flex items-center justify-center p-1.5 rounded-md bg-school-primary text-white hover:bg-school-secondary transition-all duration-300" title="Call {{ trim($p) }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                                            </a>
                                                            <a href="https://wa.me/{{ $cleanP }}" target="_blank" class="inline-flex items-center justify-center p-1.5 rounded-md bg-green-600 text-white hover:bg-green-700 transition-all duration-300" title="WhatsApp {{ trim($p) }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if(!empty($campus->acreage))
                                    <li class="info-item">
                                        <div class="info-icon-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-icon">
                                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                                                <line x1="3" x2="21" y1="9" y2="9"/>
                                                <line x1="9" x2="9" y1="21" y2="9"/>
                                            </svg>
                                        </div>
                                        <div class="info-content">
                                            <span class="info-label">Campus Size</span>
                                            <span class="info-value">{{ $campus->acreage }}</span>
                                        </div>
                                    </li>
                                @endif
                                <li class="info-item">
                                    <div class="info-icon-wrapper">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-icon">
                                            <path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.599 9.084a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"/>
                                            <path d="M22 10v6"/>
                                            <path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>
                                        </svg>
                                    </div>
                                    <div class="info-content">
                                        <span class="info-label">Level</span>
                                        <span class="info-value">{{ $campus->level }}</span>
                                    </div>
                                </li>
                                @if(!empty($campus->ranking))
                                    <li class="info-item">
                                        <div class="info-icon-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-icon">
                                                <path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/>
                                                <circle cx="12" cy="8" r="6"/>
                                            </svg>
                                        </div>
                                        <div class="info-content">
                                            <span class="info-label">NECTA Ranking</span>
                                            <span class="info-value">{{ $campus->ranking }}</span>
                                        </div>
                                    </li>
                                @endif
                                @if(!empty($campus->headmaster))
                                    <li class="info-item">
                                        <div class="info-icon-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-icon">
                                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                                                <circle cx="12" cy="7" r="4"/>
                                            </svg>
                                        </div>
                                        <div class="info-content">
                                            <span class="info-label">Leadership</span>
                                            <span class="info-value">{{ $campus->headmaster }}</span>
                                        </div>
                                    </li>
                                @endif
                                @if(!empty($campus->registration))
                                    <li class="info-item">
                                        <div class="info-icon-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-icon">
                                                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                                <polyline points="14.5 2 14.5 8 20 8"/>
                                            </svg>
                                        </div>
                                        <div class="info-content">
                                            <span class="info-label">Registration</span>
                                            <span class="info-value">{{ $campus->registration }}</span>
                                        </div>
                                    </li>
                                @endif
                                @if(!empty($campus->instagram))
                                    <li class="info-item">
                                        <div class="info-icon-wrapper">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="info-icon">
                                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                                            </svg>
                                        </div>
                                        <div class="info-content">
                                            <span class="info-label">Instagram</span>
                                            <a href="{{ $campus->instagram }}" target="_blank" class="info-value" style="color: #c41e3a; text-decoration: none; font-weight: 600;">Follow Us</a>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                            
                            <!-- Rules Sidebar Preview -->
                            @if(!empty($campus->rules))
                                <div class="rules-section">
                                    <h3 class="rules-title">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                                            <polyline points="14.5 2 14.5 8 20 8"/>
                                            <line x1="16" x2="8" y1="13" y2="13"/>
                                            <line x1="16" x2="8" y1="17" y2="17"/>
                                            <line x1="10" x2="8" y1="9" y2="9"/>
                                        </svg>
                                        Key Rules
                                    </h3>
                                    <ul class="rules-list">
                                        @foreach(array_slice($campus->rules, 0, 5) as $rule)
                                            <li class="rule-item">
                                                <span class="rule-bullet">•</span>
                                                <span class="rule-text">{{ $rule }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if(count($campus->rules) > 5)
                                        <div class="rules-more">
                                            + {{ count($campus->rules) - 5 }} more rules available in full document
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection