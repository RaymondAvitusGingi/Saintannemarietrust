@extends('layouts.app')

@section('title', 'School Administration - St. Anne Marie Academy Schools')

@section('styles')
<style>
    .admin-page {
        background: #f9fafb;
        min-height: 100vh;
    }

    /* Hero Section */
    .admin-hero {
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
    .admin-container {
        max-width: 1536px;
        margin: -4rem auto 0;
        padding: 0 1rem 5rem;
        position: relative;
        z-index: 20;
    }

    /* Leadership Profiles */
    .leadership-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    @media (min-width: 1024px) {
        .leadership-grid {
            grid-template-columns: 2fr 1fr;
        }
    }

    .admin-card {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        padding: 3rem;
        border: 1px solid #f3f4f6;
    }

    .director-profile {
        display: flex;
        flex-direction: column;
        gap: 3rem;
    }

    @media (min-width: 768px) {
        .director-profile {
            flex-direction: row;
            align-items: flex-start;
        }
    }

    .director-image {
        width: 15rem;
        height: 15rem;
        border-radius: 1.5rem;
        overflow: hidden;
        flex-shrink: 0;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        background: #f3f4f6;
    }

    .director-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .director-content h2 {
        font-size: 2.25rem;
        font-family: Georgia, serif;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 0.5rem;
    }

    .director-title {
        color: var(--school-secondary, #c41e3a);
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
        display: block;
    }

    .director-quote {
        font-size: 1.125rem;
        color: #4b5563;
        line-height: 1.8;
        font-style: italic;
        margin-bottom: 2rem;
        position: relative;
    }

    .director-quote::before {
        content: '"';
        font-size: 4rem;
        color: #e5e7eb;
        position: absolute;
        top: -1rem;
        left: -1rem;
        z-index: -1;
        font-family: Georgia, serif;
    }

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .stat-item {
        background: #f9fafb;
        padding: 1.5rem;
        border-radius: 1rem;
        text-align: center;
    }

    .stat-value {
        display: block;
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--school-primary, #1e5128);
    }

    .stat-label {
        font-size: 0.75rem;
        color: #6b7280;
        text-transform: uppercase;
        font-weight: 700;
    }

    /* Policy Section */
    .policy-section {
        background: white;
        border-radius: 1.5rem;
        padding: 3rem;
        margin-top: 3rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    }

    .policy-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    @media (min-width: 768px) {
        .policy-list {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    .policy-item {
        display: flex;
        gap: 1.25rem;
    }

    .policy-icon {
        width: 3rem;
        height: 3rem;
        background: rgba(196, 30, 58, 0.1);
        color: var(--school-secondary, #c41e3a);
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .policy-content h4 {
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 0.5rem;
    }

    .policy-content p {
        font-size: 0.875rem;
        color: #6b7280;
        line-height: 1.6;
    }
</style>
@endsection

@section('content')
<div class="admin-page">
    <!-- Hero Section -->
    <div class="admin-hero">
        <div class="hero-background">
            <img src="/images/school/st_anne_staff_admin_group.jpg" alt="School Administration">
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>School Administration</h1>
            <p class="hero-subtitle">
                Visionary leadership dedicated to educational excellence and student welfare.
            </p>
            <span class="hero-badge">
                Towards Excellence
            </span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-container">
        <div class="leadership-grid">
            <!-- Director's Profile -->
            <div class="admin-card">
                <div class="director-profile">
                    <div class="director-image">
                        <img src="{{ asset($global_settings->get('director_image', '/images/school/logo_st_anne_official.jpg')) }}" alt="{{ $global_settings->get('director_name', 'Dr. Jasson Rweikiza') }}">
                    </div>
                    <div class="director-content">
                        <span class="director-title">{{ $global_settings->get('director_title', 'Founder & Director') }}</span>
                        <h2>{{ $global_settings->get('director_name', 'Dr. Jasson Rweikiza') }}</h2>
                        <div class="director-quote">
                            "{{ $global_settings->get('director_quote', 'Our investment in education is an investment in the future of Tanzania. We are committed to providing world-class facilities and a supportive environment where every child can excel, regardless of their background.') }}"
                        </div>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            {{ $global_settings->get('director_description', 'Under the visionary leadership of Dr. Jasson Rweikiza, St. Anne Marie Academy has grown into a prestigious group of schools. His dedication to educational standards and infrastructure has been recognized by the government as a significant contribution to the national education sector.') }}
                        </p>
                        <p class="text-gray-600 leading-relaxed">
                            A unique hallmark of his leadership is the school's social responsibility policy, ensuring that students who face family hardships remain supported in their educational journey.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Management Stats -->
            <div class="flex flex-col gap-6">
                <div class="admin-card">
                    <h3 class="font-bold text-school-primary mb-6 text-center uppercase tracking-widest text-sm">Institutional Reach</h3>
                    <div class="stat-grid">
                        <div class="stat-item">
                            <span class="stat-value">4</span>
                            <span class="stat-label">Campuses</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">75</span>
                            <span class="stat-label">Acres</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">20+</span>
                            <span class="stat-label">Years</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">Top</span>
                            <span class="stat-label">Ranking</span>
                        </div>
                    </div>
                </div>
                
                <div class="admin-card bg-school-secondary text-white">
                    <h3 class="font-bold mb-4">Board of Trustees</h3>
                    <p class="text-sm text-gray-100 leading-relaxed">
                        The St. Anne Marie Trust oversees all strategic decisions, ensuring the academy remains true to its mission of commitment, integrity, and professionalism.
                    </p>
                </div>
            </div>
        </div>

        <!-- Key Policies -->
        <div class="policy-section">
            <h2 class="text-2xl font-serif font-bold text-school-primary mb-12 text-center">Administrative focus & Policies</h2>
            <div class="policy-list">
                <div class="policy-item">
                    <div class="policy-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="policy-content">
                        <h4>Zero-Tolerance Discipline</h4>
                        <p>Strict adherence to school rules, including punctuality and prohibition of mobile phones, to ensure a focused learning environment.</p>
                    </div>
                </div>
                <div class="policy-item">
                    <div class="policy-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                    </div>
                    <div class="policy-content">
                        <h4>Student Welfare Policy</h4>
                        <p>Unique protocols to support students building professional habits and maintaining mental and physical health.</p>
                    </div>
                </div>
                <div class="policy-item">
                    <div class="policy-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <div class="policy-content">
                        <h4>Curriculum Standards</h4>
                        <p>Continuous monitoring of teaching quality to align with the Tanzania National Curriculum and global best practices.</p>
                    </div>
                </div>
                <div class="policy-item">
                    <div class="policy-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    </div>
                    <div class="policy-content">
                        <h4>Open Communication</h4>
                        <p>Maintaining strong ties with parents and guardians through regular updates and accessible administration offices.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
