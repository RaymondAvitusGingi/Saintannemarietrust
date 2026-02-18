@extends('layouts.app')

@section('title', 'Our Leadership & Staff - St. Anne Marie Academy Schools')

@section('styles')
<style>
    :root {
        --school-primary-glow: rgba(30, 81, 40, 0.1);
        --school-secondary-glow: rgba(247, 147, 26, 0.1);
    }

    .staff-page {
        background: #fdfdfd;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* Hero Section */
    .staff-hero {
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
        object-position: top;
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

    .staff-hero h1 {
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

    /* Section Headers */
    .section-title-wrapper {
        text-align: center;
        margin-bottom: 4rem;
    }

    .section-tag {
        display: inline-block;
        padding: 0.5rem 1.25rem;
        background: var(--school-secondary-glow);
        color: var(--school-secondary);
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 1rem;
    }

    .section-title {
        font-size: 3rem;
        font-weight: 800;
        color: #111827;
        letter-spacing: -0.02em;
    }

    /* Leadership Grid (Featured) */
    .leadership-container {
        max-width: 1400px;
        margin: -4rem auto 5rem;
        padding: 0 1rem;
        position: relative;
        z-index: 10;
    }

    .leadership-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 2.5rem;
    }

    @media (min-width: 768px) {
        .leadership-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (min-width: 1280px) {
        .leadership-grid { grid-template-columns: repeat(3, 1fr); }
    }

    .leadership-card {
        background: white;
        border-radius: 2rem;
        padding: 2.5rem;
        box-shadow: 0 20px 50px rgba(0,0,0,0.05);
        border: 1px solid #f1f5f9;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .leadership-card:hover {
        transform: translateY(-0.75rem);
        box-shadow: 0 30px 60px rgba(30, 81, 40, 0.1);
        border-color: var(--school-primary-glow);
    }

    .leadership-card::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, transparent 50%, var(--school-secondary-glow) 50%);
        border-radius: 0 0 0 100%;
        opacity: 0;
        transition: opacity 0.4s;
    }

    .leadership-card:hover::after {
        opacity: 1;
    }

    .leader-image-outer {
        position: relative;
        width: 14rem;
        height: 14rem;
        margin-bottom: 2rem;
    }

    .leader-image-outer::before {
        content: '';
        position: absolute;
        inset: -10px;
        border: 2px dashed #e5e7eb;
        border-radius: 50%;
        transition: transform 10s linear;
    }

    .leadership-card:hover .leader-image-outer::before {
        transform: rotate(360deg);
        border-color: var(--school-secondary);
    }

    .leader-image {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        position: relative;
        z-index: 1;
        border: 8px solid white;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .leader-name {
        font-size: 1.5rem;
        font-weight: 800;
        color: #111827;
        margin-bottom: 0.5rem;
    }

    .leader-title {
        color: var(--school-secondary);
        font-weight: 700;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .leader-title::before, .leader-title::after {
        content: '';
        width: 1rem;
        height: 2px;
        background: var(--school-secondary);
        opacity: 0.3;
    }

    .leader-bio {
        color: #6b7280;
        line-height: 1.7;
        font-size: 1rem;
    }

    .leader-campus {
        margin-top: auto;
        padding-top: 1.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--school-primary);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Campus Staff Sections */
    .campus-staff-section {
        padding: 6rem 0;
        background: white;
    }

    .campus-staff-section:nth-child(even) {
        background: #f9fafb;
    }

    .staff-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .staff-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 2rem;
    }

    @media (min-width: 640px) {
        .staff-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (min-width: 1024px) {
        .staff-grid { grid-template-columns: repeat(4, 1fr); }
    }

    @media (min-width: 1280px) {
        .staff-grid { grid-template-columns: repeat(5, 1fr); }
    }

    .staff-member-card {
        text-align: center;
        padding: 1.5rem;
        border-radius: 1.5rem;
        transition: all 0.3s;
        border: 1px solid transparent;
    }

    .staff-member-card:hover {
        background: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border-color: #f1f5f9;
        transform: translateY(-5px);
    }

    .staff-img-small {
        width: 8rem;
        height: 8rem;
        border-radius: 2rem;
        object-fit: cover;
        margin: 0 auto 1.25rem;
        box-shadow: 0 8px 16px rgba(0,0,0,0.06);
    }

    .staff-info-name {
        font-weight: 700;
        color: #111827;
        font-size: 1.125rem;
        margin-bottom: 0.25rem;
    }

    .staff-info-title {
        font-size: 0.813rem;
        font-weight: 600;
        color: #6b7280;
    }

    /* Animation */
    /* Campus Headers */
    .campus-header {
        text-align: left;
        margin-bottom: 3rem;
    }

    .campus-title {
        font-size: 2.25rem;
        font-weight: 800;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .campus-divider {
        height: 4px;
        flex-grow: 1;
        background: #f3f4f6;
        border-radius: 2px;
    }

    .campus-subtitle {
        color: #6b7280;
        font-weight: 600;
        margin-top: 0.5rem;
    }

    /* Empty State */
    .empty-state {
        padding: 10rem 1rem;
        text-align: center;
    }

    .empty-icon {
        width: 5rem;
        height: 5rem;
        background: #f3f4f6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
    }

    .empty-title {
        font-size: 1.875rem;
        color: #111827;
        font-weight: 800;
    }

    .empty-text {
        color: #6b7280;
        margin-top: 0.5rem;
        font-size: 1.125rem;
    }
</style>
@endsection

@section('content')
<div class="staff-page">
    <header class="staff-hero">
        <div class="hero-background">
            <img src="/images/school/staff_white_uniform_group.jpg" alt="St. Anne Marie Staff Team">
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Our Dedicated Team</h1>
            <p class="hero-subtitle">
                Meeting the leaders and educators who inspire excellence and shape the future of St. Anne Marie Academy Schools.
            </p>
            <span class="hero-badge">Towards Excellence</span>
        </div>
    </header>

    <!-- Leadership Section -->
    <div class="leadership-container">
        <div class="section-title-wrapper" data-aos="fade-up">
            <span class="section-tag">Leadership</span>
            <h2 class="section-title">School Headmasters</h2>
        </div>

        <div class="leadership-grid">
            @php 
                $leadershipStaff = collect();
                foreach($campuses as $campus) {
                    $leadershipStaff = $leadershipStaff->concat($campus->activeStaff->where('category', 'leadership'));
                }
            @endphp

            @foreach($leadershipStaff as $index => $member)
                <div class="leadership-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <div class="leader-image-outer">
                        <img src="{{ asset($member->image_url) }}" alt="{{ $member->name }}" class="leader-image">
                    </div>
                    <h3 class="leader-name">{{ $member->name }}</h3>
                    <div class="leader-title">{{ $member->title }}</div>
                    @if($member->bio)
                        <p class="leader-bio">{{ $member->bio }}</p>
                    @endif
                    <div class="leader-campus">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        {{ $member->campus->name }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Campus Staff Sections -->
    @foreach($campuses as $campus)
        @php $otherStaff = $campus->activeStaff->where('category', '!=', 'leadership'); @endphp
        @if($otherStaff->count() > 0)
            <section class="campus-staff-section">
                <div class="staff-container">
                    <div class="campus-header">
                        <h2 class="campus-title">
                            {{ $campus->name }} Staff
                            <span class="campus-divider"></span>
                        </h2>
                        <p class="campus-subtitle">Educators and specialists dedicated to {{ $campus->level }}</p>
                    </div>

                    <div class="staff-grid">
                        @foreach($otherStaff as $member)
                            <div class="staff-member-card" data-aos="fade-up">
                                <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="staff-img-small">
                                <h4 class="staff-info-name">{{ $member->name }}</h4>
                                <p class="staff-info-title">{{ $member->title }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    @endforeach

    @php 
        $totalStaff = $campuses->sum(fn($c) => $c->activeStaff->count());
    @endphp

    @if($totalStaff == 0)
        <div class="empty-state">
            <div class="empty-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <h2 class="empty-title">Staff directory coming soon</h2>
            <p class="empty-text">We are currently updating our educator profiles for the current academic year.</p>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            offset: 100,
            once: true
        });
    });
</script>
@endsection
