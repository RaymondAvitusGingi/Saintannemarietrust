@extends('layouts.app')

@section('title', 'St. Anne Marie Academy Schools - Towards Excellence')

@section('styles')
<style>
    /* Hero Section */
    .home-hero {
        position: relative;
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .home-hero-bg {
        position: absolute;
        inset: 0;
        z-index: 0;
    }

    .home-hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 1.5s ease-in-out;
        z-index: 0;
    }

    .home-hero-bg img.active {
        opacity: 1;
        z-index: 1;
    }

    .home-hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(40, 40, 40, 0.75);
        z-index: 5;
    }

    .home-hero-content {
        position: relative;
        z-index: 10;
        max-width: 800px;
        margin: 0 auto;
        padding: 0 1.5rem;
        text-align: center;
        color: white;
    }

    .home-hero-title {
        font-family: 'Inter', sans-serif;
        font-size: 2.75rem;
        font-weight: 800;
        color: white;
        margin-bottom: 1.5rem;
        line-height: 1.2;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .home-hero-title .highlight {
        color: #d4a700;
        display: block;
        font-weight: 800;
        font-style: normal;
        letter-spacing: -0.01em;
    }
    .home-hero-description {
        font-size: 1rem;
        max-width: 36rem;
        margin: 0 auto 2rem;
        color: #d1d5db;
        line-height: 1.7;
    }

    .home-hero-buttons {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        justify-content: center;
        align-items: center;
    }

    .btn-admission {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.875rem 1.75rem;
        background: #c41e3a;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
        border-radius: 0.375rem;
        text-decoration: none;
        transition: all 0.3s;
        border: none;
    }

    .btn-admission:hover {
        background: #a31830;
        transform: translateY(-2px);
    }

    .btn-discover {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.875rem 1.75rem;
        background: white;
        color: #1e5128;
        font-weight: 700;
        font-size: 0.9rem;
        border: none;
        border-radius: 0.375rem;
        text-decoration: none;
        transition: all 0.3s;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .btn-discover:hover {
        background: #f9fafb;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px -2px rgba(0, 0, 0, 0.15);
    }

    /* Features Section */
    .home-features {
        position: relative;
        z-index: 15;
        margin-top: -5rem;
        padding: 0 1rem;
    }

    .home-features-container {
        max-width: 1536px;
        margin: 0 auto;
    }

    .features-card {
        background: white;
        border-radius: 1rem;
        padding: 2.5rem 1.5rem;
        box-shadow: 0 20px 50px -12px rgba(0, 0, 0, 0.15);
    }

    .features-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .feature-item {
        text-align: center;
        padding: 2rem 1.5rem;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .feature-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15);
    }

    .feature-item.bg-green {
        background: #e8f5e9;
    }

    .feature-item.bg-green:hover {
        background: #c8e6c9;
    }

    .feature-item.bg-pink {
        background: #fce4ec;
    }

    .feature-item.bg-pink:hover {
        background: #f8bbd9;
    }

    .feature-icon {
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        transition: transform 0.3s ease;
    }

    .feature-item:hover .feature-icon {
        transform: scale(1.1);
    }

    .feature-icon svg {
        width: 1.75rem;
        height: 1.75rem;
        color: white;
    }

    .feature-icon.green {
        background: #1e5128;
    }

    .feature-icon.red {
        background: #c41e3a;
    }

    .feature-item h3 {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1e5128;
        margin-bottom: 0.5rem;
    }

    .feature-item p {
        font-size: 0.875rem;
        color: #374151; /* Darker gray for better contrast */
        line-height: 1.6;
    }

    /* Who We Are Section */
    .home-about {
        padding: 5rem 1rem;
        background: white;
    }

    .home-about-container {
        max-width: 1536px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1fr;
        gap: 3rem;
        align-items: start;
    }

    .home-about-image {
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        aspect-ratio: 4/3;
    }

    .home-about-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .home-about-content .label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #c41e3a;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 0.75rem;
    }

    .home-about-content h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #1e5128;
        margin-bottom: 1.5rem;
        font-family: Georgia, 'Times New Roman', serif;
        line-height: 1.3;
    }

    .home-about-content p {
        color: #4b5563;
        line-height: 1.8;
        margin-bottom: 1rem;
        font-size: 0.95rem;
    }

    .read-more-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #1e5128;
        font-weight: 700;
        text-decoration: none;
        margin-top: 1rem;
        transition: gap 0.3s;
    }

    .read-more-link:hover {
        gap: 0.75rem;
        text-decoration: underline;
    }

    .read-more-link svg {
        width: 1.25rem;
        height: 1.25rem;
    }

    /* Campuses Section */
    .home-campuses {
        padding: 4rem 1rem;
        background: #1e5128;
    }

    .home-campuses-container {
        max-width: 1536px;
        margin: 0 auto;
    }

    .campuses-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .campuses-header h2 {
        font-size: 2rem;
        font-weight: 700;
        color: white;
        font-family: Georgia, 'Times New Roman', serif;
        margin-bottom: 0.5rem;
    }

    .campuses-header-line {
        width: 4rem;
        height: 4px;
        background: #d4a700;
        margin: 0 auto;
        border-radius: 2px;
    }

    .campuses-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .campus-card {
        background: white;
        border-radius: 0.75rem;
        overflow: hidden;
        text-decoration: none;
        transition: all 0.4s;
        display: flex;
        flex-direction: column;
    }

    .campus-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
    }

    .campus-card-image {
        height: 11rem;
        overflow: hidden;
        position: relative;
        background: #2d6a3e;
    }

    .campus-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s;
    }

    .campus-card:hover .campus-card-image img {
        transform: scale(1.1);
    }

    .campus-badge {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        padding: 0.25rem 0.75rem;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-radius: 0.25rem;
        z-index: 10;
    }

    .campus-badge.secondary {
        background: #7c3aed;
        color: white;
    }

    .campus-badge.primary {
        background: #1e5128;
        color: white;
    }

    .campus-badge.comprehensive {
        background: #c41e3a;
        color: white;
    }

    .campus-card-content {
        padding: 1.25rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .campus-card-content h3 {
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
        line-height: 1.3;
    }

    .campus-card-content p {
        font-size: 0.8rem;
        color: #6b7280;
        line-height: 1.5;
        margin-bottom: 1rem;
        flex-grow: 1;
    }

    .campus-view-link {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        color: #1e5128;
        font-weight: 700;
        font-size: 0.8rem;
        text-decoration: none;
        transition: gap 0.3s;
    }

    .campus-view-link:hover {
        gap: 0.5rem;
    }

    .campus-view-link svg {
        width: 1rem;
        height: 1rem;
    }

    /* News Section */
    .home-news {
        padding: 5rem 1rem;
        background: #f9fafb;
    }

    .home-news-container {
        max-width: 1536px;
        margin: 0 auto;
    }

    .news-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .news-header h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #1e5128;
        font-family: Georgia, 'Times New Roman', serif;
        margin-bottom: 0.5rem;
    }

    .news-header p {
        font-size: 1rem;
        color: #6b7280;
    }

    .news-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .news-card {
        background: white;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.3s;
        text-decoration: none;
    }

    .news-card:hover {
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.15);
        transform: translateY(-4px);
    }

    .news-card-image {
        height: 12rem;
        overflow: hidden;
    }

    .news-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .news-card:hover .news-card-image img {
        transform: scale(1.05);
    }

    .news-card-content {
        padding: 1.5rem;
    }

    .news-card-date {
        font-size: 0.75rem;
        color: #c41e3a;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .news-card-content h4 {
        font-size: 1.125rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    .news-card-content p {
        font-size: 0.875rem;
        color: #6b7280;
        line-height: 1.6;
    }

    .view-all-link-center {
        text-align: center;
        margin-top: 2.5rem;
    }

    /* CTA Section */
    .home-cta {
        padding: 4rem 1rem;
        background: linear-gradient(135deg, #1e5128 0%, #2d6a3e 100%);
        color: white;
        text-align: center;
    }

    .home-cta-container {
        max-width: 700px;
        margin: 0 auto;
    }

    .home-cta h2 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
        font-family: Georgia, 'Times New Roman', serif;
    }

    .home-cta p {
        font-size: 1rem;
        color: #d1fae5;
        margin-bottom: 2rem;
    }

    .home-cta .btn-admission {
        background: white;
        color: #1e5128;
    }

    .home-cta .btn-admission:hover {
        background: #f9fafb;
    }

    /* Responsive */
    @media (min-width: 640px) {
        .home-hero-buttons {
            flex-direction: row;
        }

        .home-hero-title {
            font-size: 3rem;
        }

        .features-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .campuses-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .news-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 768px) {
        .home-hero-title {
            font-size: 3.5rem;
        }

        .home-about-container {
            grid-template-columns: 1fr 1.2fr;
        }
    }

    @media (min-width: 1024px) {
        .home-hero-title {
            font-size: 3.75rem;
        }

        .campuses-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
</style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="home-hero">
        <div class="home-hero-bg" id="hero-slider">
            <img src="/images/school/graduation.jpg" alt="Graduation at St Marie Academy" class="active" fetchpriority="high">
            <img src="/images/school/red_carpet_graduation.jpg" alt="Graduates walking the Red Carpet">
            <img src="/images/school/student_celebration.jpg" alt="Students Celebrating Success">
            <img src="/images/school/graduation_suits.jpg" alt="Graduates in Professional Suits">
            <img src="/images/school/campus_main.jpg" alt="St Marie Trust - Main Campus">
            <img src="/images/school/st_anne_admin_front.jpg" alt="Administration Building">
            <img src="/images/school/st_anne_students_01.jpg" alt="Students at Saint Marie Academy">
            <img src="/images/school/outdoor_group.jpg" alt="Outdoor Student Gathering">
            <img src="/images/school/staff_white_uniform.jpg" alt="Our Professional Team 1">
            <img src="/images/school/staff_polo_uniform.jpg" alt="Our Professional Team 2">
            <img src="/images/school/st_anne_building_02.jpg" alt="Campus Building">
            <img src="/images/school/st_anne_buses_01.jpg" alt="Our Bus Fleet">
            <img src="/images/school/staff_spirit_01.jpg" alt="Our Dedicated Staff">
            <img src="/images/school/brilliant_entrance.jpg" alt="Brilliant Secondary School - St Marie Trust" class="w-full h-full object-cover">
            <img src="/images/school/sunshine_students_building.jpg" alt="Sunshine Secondary Campus - Saint Marie Academy">
            <img src="/images/rweikiza/rweikiza_students_01.jpg" alt="Rweikiza Nursery Scholars">
            <img src="/images/school/trip_ruaha.jpg" alt="Educational Tours">
            <img src="/images/school/class_auditorium.jpg" alt="Learning Facilities">
            <!-- Added Campus Images -->
            <img src="/images/school/rweikiza_profile.jpg" alt="Rweikiza Campus Profile">
            <img src="/images/school/brilliant_entrance.jpg" alt="Brilliant Campus Profile - St Marie Trust">
        </div>
        <div class="home-hero-overlay"></div>
        <div class="home-hero-content">
            <h1 class="home-hero-title">
                Learning Together,<br>
                <span class="highlight">Growing Together</span>
            </h1>
            <p class="home-hero-description">
                {{ $global_settings->get('home_hero_tagline', 'Empowering students with knowledge, character, and skills for a successful future across our four campuses.') }}
            </p>
            <div class="home-hero-buttons">
                <a href="{{ url('/admissions') }}" class="btn-admission">
                    Apply for Admission
                </a>
                <a href="{{ url('/about') }}" class="btn-discover">
                    Discover Our School
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="home-features">
        <div class="home-features-container">
            <div class="features-card">
                <div class="features-grid">
                    <div class="feature-item bg-green">
                        <div class="feature-icon green">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"/></svg>
                        </div>
                        <h2 style="font-size: 1.125rem; font-weight: 700; color: #1e5128; margin-bottom: 0.5rem;">Top Academic Results</h2>
                        <p>Consistently high scores in national and regional examinations.</p>
                    </div>
                    <div class="feature-item bg-pink">
                        <div class="feature-icon red">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </div>
                        <h2 style="font-size: 1.125rem; font-weight: 700; color: #1e5128; margin-bottom: 0.5rem;">Values & Discipline</h2>
                        <p>Focus on moral character, discipline, and holistic development.</p>
                    </div>
                    <div class="feature-item bg-green">
                        <div class="feature-icon green">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                        </div>
                        <h2 style="font-size: 1.125rem; font-weight: 700; color: #1e5128; margin-bottom: 0.5rem;">Comprehensive Curriculum</h2>
                        <p>Offering NECTA syllabus with a blend of modern learning techniques.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Who We Are Section -->
    <section class="home-about">
        <div class="home-about-container">
            <div class="home-about-image">
                <img src="/images/school/st_anne_admin_front.jpg" alt="St. Anne Marie Academy Campus" loading="lazy">
            </div>
            <div class="home-about-content">
                <div class="label">WHO WE ARE</div>
                <h2>Welcome to St. Anne Marie Academy Schools</h2>
                <p>
                    St. Anne Marie Academy Secondary School and its associated campuses are dedicated to providing quality education grounded in academic excellence. Our supportive learning environment helps students develop knowledge, character, and skills.
                </p>
                <p>
                    From Rweikiza Nursery & Primary School building foundations to Brilliant and Sunshine Secondary Schools preparing young adults, we are committed to shaping the leaders of tomorrow.
                </p>
                <a href="{{ url('/about') }}" class="read-more-link">
                    Read More About Us
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Campuses Section -->
    <section class="home-campuses">
        <div class="home-campuses-container">
            <div class="campuses-header">
                <h2>Our Campuses</h2>
                <div class="campuses-header-line"></div>
            </div>
            
            <div class="campuses-grid">
                @foreach($campuses as $campus)
                    @php
                        $level = $campus->level;
                        $isComprehensive = str_contains($level, 'Advanced') || (str_contains($level, 'Secondary') && (str_contains($level, 'Primary') || str_contains($level, 'Nursery')));
                        $isPrimary = str_contains($level, 'Primary') || str_contains($level, 'Nursery');
                        
                        if ($isComprehensive) {
                            $badgeClass = 'comprehensive';
                            $badgeText = 'Nursery to A-Level';
                        } elseif ($isPrimary) {
                            $badgeClass = 'primary';
                            $badgeText = 'Primary';
                        } else {
                            $badgeClass = 'secondary';
                            $badgeText = 'Secondary';
                        }
                    @endphp
                    <a href="{{ url('/campuses/' . $campus->slug) }}" class="campus-card">
                        <div class="campus-card-image">
                            <span class="campus-badge {{ $badgeClass }}">{{ $badgeText }}</span>
                            @if($campus->image)
                                <img src="{{ $campus->image }}" alt="{{ $campus->name }}" loading="lazy">
                            @else
                                <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 3rem; height: 3rem; color: rgba(255,255,255,0.4);" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M14 22v-4a2 2 0 1 0-4 0v4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M18 5v17"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg>
                                </div>
                            @endif
                        </div>
                        <div class="campus-card-content">
                            <h3>{{ $campus->name }}</h3>
                            <p>{{ Str::limit($campus->description, 90) }}</p>
                            <span class="campus-view-link">
                                View Details
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="home-news">
        <div class="home-news-container">
            <div class="news-header">
                <h2>Latest News & Events</h2>
                <p>Stay updated with the latest happenings at St. Anne Marie Academy.</p>
            </div>
            
            <div class="news-grid">
                @foreach($newsItems as $news)
                    <a href="{{ route('news.show', $news->slug) }}" class="news-card">
                        <div class="news-card-image">
                            <img src="{{ $news->image }}" alt="{{ $news->title }}" loading="lazy">
                        </div>
                        <div class="news-card-content">
                            <div class="news-card-date">{{ $news->formatted_date }}</div>
                            <h4>{{ $news->title }}</h4>
                            <p>{{ Str::limit($news->summary, 100) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <div class="view-all-link-center">
                <a href="{{ url('/news') }}" class="read-more-link">
                    View All News & Events
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="home-cta">
        <div class="home-cta-container">
            <h2>Ready to Join Our Family?</h2>
            <p>Applications are now open for the 2026 Academic Year. Take the first step towards excellence.</p>
            <a href="{{ url('/admissions') }}" class="btn-admission">
                Apply for Admission
            </a>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('#hero-slider img');
            let currentIndex = 0;
            const intervalTime = 5000; // 5 seconds

            function nextImage() {
                images[currentIndex].classList.remove('active');
                currentIndex = (currentIndex + 1) % images.length;
                images[currentIndex].classList.add('active');
            }

            if (images.length > 1) {
                setInterval(nextImage, intervalTime);
            }
        });
    </script>
@endsection
