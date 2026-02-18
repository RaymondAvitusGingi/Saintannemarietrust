@extends('layouts.app')

@section('title', 'Academics - St. Anne Marie Academy Schools')

@section('styles')
<style>
    .academics-page {
        background: #f9fafb;
        min-height: 100vh;
    }

    /* Hero Section */
    .academics-hero {
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
    .academics-container {
        max-width: 1536px;
        margin: -4rem auto 0;
        padding: 0 1rem 5rem;
        position: relative;
        z-index: 20;
    }

    /* Sections */
    .academics-section {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        padding: 3rem;
        margin-bottom: 3rem;
        border: 1px solid #f3f4f6;
    }

    .section-header {
        margin-bottom: 2rem;
        border-left: 4px solid var(--school-secondary, #c41e3a);
        padding-left: 1.5rem;
    }

    .section-header h2 {
        font-size: 2rem;
        font-family: Georgia, serif;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
    }

    .academic-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    @media (min-width: 768px) {
        .academic-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .academic-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    .level-card {
        padding: 2rem;
        border-radius: 1rem;
        background: #f9fafb;
        border: 1px solid #f3f4f6;
        transition: all 0.3s ease;
    }

    .level-card:hover {
        transform: translateY(-5px);
        border-color: var(--school-primary, #1e5128);
        background: white;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    .level-card h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 1rem;
    }

    .level-card p {
        color: #4b5563;
        font-size: 0.9375rem;
        line-height: 1.6;
    }

    /* Combinations List */
    .combinations-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 1rem;
        margin-top: 2rem;
    }

    .combo-badge {
        background: white;
        color: var(--school-primary, #1e5128);
        border: 2px solid #e5e7eb;
        padding: 0.75rem;
        border-radius: 0.75rem;
        text-align: center;
        font-weight: 700;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .combo-badge:hover {
        border-color: var(--school-secondary, #c41e3a);
        color: var(--school-secondary, #c41e3a);
        transform: scale(1.05);
    }

    /* Features */
    .academic-features {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 2rem;
        margin-bottom: 3rem;
    }

    @media (min-width: 768px) {
        .academic-features {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    .a-feature {
        text-align: center;
        padding: 1.5rem;
    }

    .a-feature-icon {
        width: 3.5rem;
        height: 3.5rem;
        background: var(--school-primary, #1e5128);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .a-feature h4 {
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 0.5rem;
    }

    .a-feature p {
        font-size: 0.8125rem;
        color: #6b7280;
    }
</style>
@endsection

@section('content')
<div class="academics-page">
    <!-- Hero Section -->
    <div class="academics-hero">
        <div class="hero-background">
            <img src="/images/school/class_auditorium.jpg" alt="Academic Excellence">
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Academics</h1>
            <p class="hero-subtitle">
                A tradition of excellence, a future of success. Our comprehensive curriculum prepares students for global challenges.
            </p>
            <span class="hero-badge">
                Towards Excellence
            </span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="academics-container">
        <!-- Academic Levels -->
        <div class="academics-section">
            <div class="section-header">
                <h2>Our Academic Journey</h2>
            </div>
            <div class="academic-grid">
                <div class="level-card">
                    <h3>Nursery School</h3>
                    <p>{{ $settings['nursery_level_description'] ?? 'Building strong foundations with play-based learning and early literacy at Rweikiza and St. Anne Marie campuses.' }}</p>
                </div>
                <div class="level-card">
                    <h3>Primary Education</h3>
                    <p>{{ $settings['primary_level_description'] ?? 'Our Standard 1-7 curriculum focuses on core competencies, achieving Grade \'A\' school averages in national PSLE exams.' }}</p>
                </div>
                <div class="level-card">
                    <h3>Secondary (O-Level)</h3>
                    <p>{{ $settings['secondary_level_description'] ?? 'Form 1-4 education emphasizing science, arts, and business subjects with exceptional NECTA performance.' }}</p>
                </div>
                <div class="level-card">
                    <h3>High School (A-Level)</h3>
                    <p>{{ $settings['advanced_level_description'] ?? 'Form 5-6 advanced studies across multiple combinations, preparing students for university and professional success.' }}</p>
                </div>
                <div class="level-card">
                    <h3>ICT & Innovation</h3>
                    <p>Integration of Information Computer Studies (ICS) across all levels to ensure digital literacy in the modern world.</p>
                </div>
                <div class="level-card">
                    <h3>Character Building</h3>
                    <p>Beyond books, we focus on discipline, integrity, and leadership values as part of our holistic education.</p>
                </div>
            </div>
        </div>

        <!-- A-Level Combinations -->
        <div class="academics-section">
            <div class="section-header">
                <h2>Advanced Level Combinations</h2>
                <p class="text-gray-600 mt-2">We offer a wide range of Arts, Science, and Business combinations for Form 5 and 6 students.</p>
            </div>
            <div class="combinations-grid">
                <div class="combo-badge">PCM</div>
                <div class="combo-badge">PCB</div>
                <div class="combo-badge">PGM</div>
                <div class="combo-badge">CBN</div>
                <div class="combo-badge">CBG</div>
                <div class="combo-badge">HGK</div>
                <div class="combo-badge">HGL</div>
                <div class="combo-badge">HKL</div>
                <div class="combo-badge">HGF</div>
                <div class="combo-badge">HGE</div>
                <div class="combo-badge">EGM</div>
                <div class="combo-badge">KLF</div>
                <div class="combo-badge">HLF</div>
                <div class="combo-badge">BuLF</div>
                <div class="combo-badge">FLE</div>
                <div class="combo-badge">EBuAc</div>
                <div class="combo-badge">MEBu</div>
                <div class="combo-badge">BuEL</div>
            </div>
        </div>

        <!-- Academic Features -->
        <div class="academic-features">
            <div class="a-feature">
                <div class="a-feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                </div>
                <h4>Rich Library</h4>
                <p>Extensive collections of reference materials.</p>
            </div>
            <div class="a-feature">
                <div class="a-feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-5c1.62-2.2 5-3 5-3"/><path d="M12 15v5s3.03-.55 5-2c2.2-1.62 3-5 3-5"/></svg>
                </div>
                <h4>Modern Labs</h4>
                <p>Fully equipped for practical science learning.</p>
            </div>
            <div class="a-feature">
                <div class="a-feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h4>Expert Staff</h4>
                <p>Dedicated and highly qualified educators.</p>
            </div>
            <div class="a-feature">
                <div class="a-feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h4>Discipline</h4>
                <p>Cultivating respect and professional habits.</p>
            </div>
        </div>
    </div>
</div>
@endsection
