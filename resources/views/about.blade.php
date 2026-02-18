@extends('layouts.app')

@section('title', 'St. Anne Marie Academy Schools - About Us')

@section('styles')
<style>
    .about-page {
        background: #f9fafb;
        min-height: 100vh;
    }

    /* Hero Section */
    .about-hero {
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
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 1rem;
        position: relative;
        z-index: 10;
        text-align: center;
    }

    .hero-content h1 {
        font-size: 2.5rem;
        font-family: Georgia, serif;
        font-weight: 700;
        margin-bottom: 1.5rem;
        letter-spacing: -0.025em;
    }

    .hero-subtitle {
        font-size: 1.25rem;
        max-width: 42rem;
        margin: 0 auto 2rem;
        color: #e5e7eb;
        font-weight: 500;
    }

    .hero-badge {
        display: inline-block;
        padding: 0.5rem 1.5rem;
        background: var(--school-accent, #00FF88);
        color: var(--school-primary, #1e5128);
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        border-radius: 9999px;
        font-size: 0.875rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }

    /* Main Container */
    .about-container {
        max-width: 1536px;
        margin: -4rem auto 0;
        padding: 0 1rem 5rem;
        position: relative;
        z-index: 20;
    }

    /* Legacy Section */
    .legacy-section {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        padding: 2rem;
        margin-bottom: 3rem;
    }

    .legacy-grid {
        display: grid;
        gap: 3rem;
        align-items: center;
    }

    .legacy-content h2 {
        font-size: 1.875rem;
        font-family: Georgia, serif;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 1.5rem;
    }

    .legacy-text {
        color: #4b5563;
        line-height: 1.75;
        font-weight: 500;
    }

    .legacy-text p {
        margin-bottom: 1rem;
    }

    .legacy-highlight {
        color: var(--school-secondary, #c41e3a);
        font-weight: 700;
        font-size: 1.125rem;
    }

    .legacy-images {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .legacy-images img {
        border-radius: 1rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%;
        height: 16rem;
        object-fit: cover;
    }

    .legacy-images img:nth-child(2) {
        margin-top: 2rem;
    }

    /* Vision/Mission Cards */
    .values-grid {
        display: grid;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .value-card {
        background: white;
        padding: 3rem 2rem;
        border-radius: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
        min-height: 16rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .value-card:hover {
        transform: translateY(-0.25rem);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    }

    .value-icon {
        width: 4rem;
        height: 4rem;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        transition: transform 0.3s;
    }

    .value-card:hover .value-icon {
        transform: scale(1.05);
    }

    .value-icon-vision {
        background: #fef3c7;
        color: var(--school-primary, #1e5128);
    }

    .value-icon-mission {
        background: #d1fae5;
        color: var(--school-primary, #1e5128);
    }

    .value-icon-excellence {
        background: #fee2e2;
        color: var(--school-secondary, #c41e3a);
    }

    .value-icon svg {
        width: 2rem;
        height: 2rem;
    }

    .value-card h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 1rem;
    }

    .value-card p {
        color: #6b7280;
        font-weight: 400;
        line-height: 1.6;
        font-size: 0.9375rem;
    }

    /* Redesigned Facilities Section */
    .facilities-section {
        background: linear-gradient(135deg, #1e5128 0%, #14361b 100%);
        border-radius: 1.5rem;
        padding: 4rem 2rem;
        color: white;
        margin-bottom: 3rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        position: relative;
        overflow: hidden;
    }

    .facilities-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.03) 0%, transparent 70%);
        pointer-events: none;
    }

    .facilities-section h2 {
        font-size: 2.25rem;
        font-family: 'Merriweather', Georgia, serif;
        font-weight: 700;
        margin-bottom: 3.5rem;
        text-align: center;
        color: white;
        letter-spacing: -0.01em;
    }

    .facilities-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 2.5rem;
        position: relative;
        z-index: 5;
    }

    .facility-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 1.5rem;
        border-radius: 1rem;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .facility-item:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-8px);
        border-color: var(--school-accent, #00FF88);
    }

    .facility-icon-wrapper {
        width: 4rem;
        height: 4rem;
        background: rgba(0, 255, 136, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
        color: var(--school-accent, #00FF88);
        transition: transform 0.3s;
    }

    .facility-item:hover .facility-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
        background: var(--school-accent, #00FF88);
        color: #1e5128;
    }

    .facility-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.25rem;
    }

    .facility-label {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.7);
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.15em;
    }

    /* Leadership Section */
    .leadership-section {
        background: white;
        border-radius: 1.5rem;
        padding: 2rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 3rem;
        border: 1px solid #f3f4f6;
    }

    .leadership-image {
        width: 12rem;
        height: 12rem;
        border-radius: 9999px;
        overflow: hidden;
        flex-shrink: 0;
        border: 8px solid #f9fafb;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        background: white;
    }

    .leadership-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 1rem;
    }

    .leadership-content h3 {
        font-size: 1.875rem;
        font-family: Georgia, serif;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 0.5rem;
    }

    .leadership-tagline {
        color: var(--school-secondary, #c41e3a);
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }

    .leadership-quote-container {
        position: relative;
    }

    .quote-icon {
        position: absolute;
        top: -1rem;
        left: -1.5rem;
        color: #f3f4f6;
        width: 3rem;
        height: 3rem;
        z-index: -10;
    }

    .leadership-quote {
        color: #4b5563;
        font-style: italic;
        font-size: 1.25rem;
        line-height: 1.75;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (min-width: 768px) {
        .hero-content h1 {
            font-size: 3.75rem;
        }

        .legacy-section {
            padding: 3rem;
        }

        .legacy-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .values-grid {
            grid-template-columns: repeat(3, 1fr);
        }

        .facilities-grid {
            grid-template-columns: repeat(4, 1fr);
        }

        .leadership-section {
            flex-direction: row;
            padding: 3rem;
        }
    }
    /* Campus Grid Section */
    .campus-grid-section {
        padding: 4rem 0;
        margin-bottom: 3rem;
    }

    .campus-grid-header {
        text-align: center;
        margin-bottom: 3.5rem;
    }

    .campus-grid-header h2 {
        font-size: 2.25rem;
        font-family: Georgia, serif;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 1rem;
    }

    .campus-grid-header p {
        color: #6b7280;
        font-size: 1.125rem;
        max-width: 36rem;
        margin: 0 auto;
    }

    .campus-simple-grid {
        display: grid;
        gap: 2rem;
    }

    .campus-card-simple {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        border: 1px solid #f3f4f6;
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        flex-direction: column;
    }

    .campus-card-simple:hover {
        transform: translateY(-0.5rem);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .campus-card-img {
        height: 14rem;
        width: 100%;
        object-fit: cover;
    }

    .campus-card-body {
        padding: 2rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .campus-card-body h3 {
        font-size: 1.5rem;
        font-family: Georgia, serif;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 0.5rem;
    }

    .campus-card-motto {
        color: var(--school-secondary, #c41e3a);
        font-weight: 700;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
    }

    .campus-card-text {
        color: #4b5563;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        font-size: 0.9375rem;
    }

    .campus-card-footer {
        margin-top: auto;
        padding-top: 1.5rem;
        border-top: 1px solid #f3f4f6;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.8125rem;
        color: #6b7280;
        font-weight: 600;
    }

    .footer-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .footer-item svg {
        width: 1rem;
        height: 1rem;
        color: var(--school-primary, #1e5128);
    }

    @media (min-width: 768px) {
        .campus-simple-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>
@endsection

@section('content')
<div class="about-page">
    <!-- Hero Section -->
    <div class="about-hero">
        <div class="hero-background">
            <img src="/images/school/graduation_suits.jpg" alt="St. Anne Marie Graduates" fetchpriority="high">
            <div class="hero-overlay"></div>
        </div>
        
        <div class="hero-content">
            <h1>About Us</h1>
            <p class="hero-subtitle">
                Molding the future with Commitment, Integrity, and Professionalism.
            </p>
            <span class="hero-badge">Towards Excellence</span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="about-container">
        <!-- Legacy Section -->
        <div class="legacy-section">
            <div class="legacy-grid">
                <div class="legacy-content">
                    <h2>Our Legacy & Mission</h2>
                    <div class="legacy-text">
                        <p>
                            St. Anne Marie Academy is not just a school; it is the <strong>Mother School</strong> of a family of leading educational institutions, including <strong>Brilliant Secondary School</strong> (Mbezi Kimara - Kwa Msuguri), <strong>Sunshine Secondary School</strong> (Kibaha - Picha ya Ndege), and <strong>Rweikiza Nursery & Primary School</strong> (Kyetema - Bukoba). Located in Mbezi Kimara – kwa Msuguri, Ubungo District, Dar es Salaam, we have grown from a single boarding and day school into a network of specialized campuses, each dedicated to molding the future with excellence. To know more about each school, navigate to the <strong>Campuses</strong> section below.
                        </p>
                        <p>
                            Owned by the St. Anne Marie Trust, our schools occupy 75 acres of land in our main campus alone, providing a serene environment conducive to academic success. Across our campuses, we provide a broad curriculum covering key academic streams — Arts, Science, and Business — with additional specializations like Information Computer Studies (ICS).
                        </p>
                        <p class="legacy-highlight">
                            As the mother school, St. Anne Marie Academy sets the standard for our family of schools, where qualified teachers and modern facilities ensure our students consistently achieve top-tier NECTA results at all levels.
                        </p>
                    </div>
                </div>
                <div class="legacy-images">
                    <img src="/images/school/campus_main.jpg" alt="Campus" loading="lazy">
                    <img src="/images/school/library.jpg" alt="Library" loading="lazy">
                </div>
            </div>
        </div>

        <!-- Our Campuses Section -->
        <div class="campus-grid-section">
            <div class="campus-grid-header">
                <h2>Our Growing Family of Schools</h2>
                <p>Beside the mother school, St. Anne Marie Academy extends its excellence through three specialized campuses.</p>
            </div>
            
            <div class="campus-simple-grid">
                <div class="campus-card-simple">
                    <img src="/images/school/brilliant_maroon_skirts.jpg" alt="Brilliant Secondary School" class="campus-card-img" loading="lazy">
                    <div class="campus-card-body">
                        <h3>Brilliant Secondary School</h3>
                        <p class="campus-card-motto">"Arise and Shine"</p>
                        <p class="campus-card-text">
                            A premier secondary school for boys and girls emphasizing science and commerce streams. Located in Mbezi Kimara - kwa Msuguri, it provides modern laboratories and a focused academic environment.
                        </p>
                        <div class="campus-card-footer">
                            <div class="footer-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span>Mbezi Kimara (Msuguri), DSM</span>
                            </div>
                            <div class="footer-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                                <span>Form 1 - 4</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="campus-card-simple">
                    <img src="/images/school/sunshine_student_group_large.jpg" alt="Sunshine Secondary School" class="campus-card-img" loading="lazy">
                    <div class="campus-card-body">
                        <h3>Sunshine Secondary School</h3>
                        <p class="campus-card-motto">"Let Your Light Shine"</p>
                        <p class="campus-card-text">
                            Situated in the quiet area of Kibaha - Picha ya Ndege, Sunshine Secondary offers a serene environment perfect for focused study. It is recognized as a center of excellence in the Coast Region.
                        </p>
                        <div class="campus-card-footer">
                            <div class="footer-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span>Kibaha (Picha ya Ndege), Pwani</span>
                            </div>
                            <div class="footer-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                                <span>Form 1 - 4</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rweikiza -->
                <div class="campus-card-simple">
                    <img src="/images/school/rweikiza_profile.jpg" alt="Rweikiza Nursery & Primary" class="campus-card-img" loading="lazy">
                    <div class="campus-card-body">
                        <h3>Rweikiza Nursery & Primary</h3>
                        <p class="campus-card-motto">"Foundation for Success"</p>
                        <p class="campus-card-text">
                            Dedicated to building a strong foundation for young learners in Kyetema, Bukoba. Our primary school consistently produces top-tier graduates with a focus on discipline and early academic mastery.
                        </p>
                        <div class="campus-card-footer">
                            <div class="footer-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span>Kyetema, Bukoba</span>
                            </div>
                            <div class="footer-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                                <span>Nursery - Std 7</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vision/Mission Cards -->
        <div class="values-grid">
            <!-- Vision -->
            <div class="value-card">
                <div class="value-icon value-icon-vision">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <h3>Our Vision</h3>
                <p>{{ $global_settings->get('school_vision', 'Superb Education') }}</p>
            </div>

            <!-- Mission -->
            <div class="value-card">
                <div class="value-icon value-icon-mission">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                </div>
                <h3>Our Mission</h3>
                <p>{{ $global_settings->get('school_mission', 'To be a model school providing high quality education service founded on commitment, integrity and professionalism.') }}</p>
            </div>

            <!-- Excellence -->
            <div class="value-card">
                <div class="value-icon value-icon-excellence">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"/><circle cx="12" cy="8" r="6"/></svg>
                </div>
                <h3>Academic Excellence</h3>
                <p>Consistently achieving top-tier NECTA results and recognized as a leading institution in Tanzania.</p>
            </div>
        </div>

        <!-- Facilities -->
        <div class="facilities-section">
            <h2>Modern Facilities & Resources</h2>
            <div class="facilities-grid">
                <div class="facility-item">
                    <div class="facility-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <p class="facility-value">75 Acres</p>
                    <p class="facility-label">Campus Size</p>
                </div>
                <div class="facility-item">
                    <div class="facility-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 14 4-4"/><path d="m3.34 18.24 10.14-10.14"/><path d="m15.5 15.5-2-2"/><path d="m2 2 20 20"/><path d="m21.9 6.06-4.24 4.24"/><path d="M18 10l-4 4"/><path d="m8.5 8.5-2-2"/></svg>
                    </div>
                    <p class="facility-value">Dispensary</p>
                    <p class="facility-label">Medical Care</p>
                </div>
                <div class="facility-item">
                    <div class="facility-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h.01"/><path d="M12 16h.01"/><path d="M12 12h.01"/><path d="M12 8h.01"/><path d="m3 16 2-2 3 2 3-5 4 6 2-2 4 4"/><path d="M3 20h18"/><path d="M3 4h18"/><path d="M3 8h18"/><path d="M3 12h18"/></svg>
                    </div>
                    <p class="facility-value">Bakery</p>
                    <p class="facility-label">Fresh Food</p>
                </div>
                <div class="facility-item">
                    <div class="facility-icon-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 11v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><path d="m4 11 8-4 8 4"/><path d="m15 5-3-3-3 3"/><path d="M12 2v19"/></svg>
                    </div>
                    <p class="facility-value">Transport</p>
                    <p class="facility-label">Reliable Fleet</p>
                </div>
            </div>
        </div>

        <!-- Leadership Note -->
        <div class="leadership-section">
            <div class="leadership-image">
                <img src="/images/school/logo_st_anne.jpg" alt="St. Anne Marie Academy Logo" loading="lazy">
            </div>
            <div class="leadership-content">
                <h3>Message from Leadership</h3>
                <p class="leadership-tagline">Towards Excellence</p>
                <div class="leadership-quote-container">
                    <svg class="quote-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.851h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.851h3.983v10h-9.983z" /></svg>
                    <blockquote class="leadership-quote">
                        "At St. Anne Marie Academy, we believe in a supportive and friendly learning environment. Beyond academic achievement, we prioritize student well-being. This includes a unique policy ensuring that any student who loses a parent remains under our care, so their educational journey continues uninterrupted."
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection