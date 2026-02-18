<style>
    .site-footer {
        background: #1e5128; /* Darker green (emerald-900 like) */
        color: white;
        padding: 5rem 1rem 2rem;
        border-top: 5px solid #c41e3a; /* Red border */
    }

    .footer-container {
        max-width: 1536px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 3rem;
        margin-bottom: 4rem;
    }

    .footer-section h3 {
        font-size: 1.5rem;
        font-family: Georgia, serif;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #d4a700; /* Amber-400 (Gold) */
        letter-spacing: 0.025em;
    }

    .footer-about-text {
        color: #f3f4f6;
        margin-bottom: 1.5rem;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    .footer-social-links {
        display: flex;
        gap: 0.75rem;
    }

    .social-link {
        width: 2.5rem;
        height: 2.5rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 0.375rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
        cursor: pointer;
        color: white;
    }

    .social-link:hover {
        background: #d4a700; /* Gold hover */
        color: #1e5128;
        transform: translateY(-3px);
    }

    .social-link svg {
        width: 1.125rem;
        height: 1.125rem;
    }

    .footer-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-list li {
        margin-bottom: 0.75rem;
        color: #f3f4f6;
        font-size: 0.95rem;
        transition: padding-left 0.3s;
    }

    .footer-list li:hover {
        padding-left: 0.25rem;
    }

    .footer-list a {
        color: #f3f4f6;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-list a:hover {
        color: #fbbf24; /* Gold hover */
    }

    .footer-contact-item {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
        margin-bottom: 1.25rem;
        color: #f3f4f6;
        font-size: 0.95rem;
    }

    .footer-contact-icon {
        color: #fbbf24; /* Gold icon */
        flex-shrink: 0;
        width: 1.25rem;
        height: 1.25rem;
        margin-top: 0.125rem;
    }

    .footer-bottom {
        margin-top: 3.5rem;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.15);
        text-align: center;
        color: #d1d5db;
        font-size: 0.875rem;
    }

    @media (min-width: 768px) {
        .footer-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .footer-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
</style>

<!-- Footer -->
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-grid">
            <!-- About Us -->
            <div class="footer-section">
                <h3>About Us</h3>
                <p class="footer-about-text">
                    {{ $global_settings->get('school_footer_about', 'St. Anne Marie Academy Secondary School (also known as St Marie Trust or Saint Marie Academy) is dedicated to providing quality education grounded in academic excellence, discipline, and moral values.') }}
                </p>
                <div class="footer-social-links">
                    @if($global_settings->has('facebook_link'))
                    <a href="{{ $global_settings->get('facebook_link') }}" class="social-link" target="_blank" aria-label="Follow us on Facebook">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </a>
                    @endif
                    @if($global_settings->has('instagram_link'))
                    <a href="{{ $global_settings->get('instagram_link') }}" class="social-link" target="_blank" aria-label="Follow us on Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                    </a>
                    @endif
                    @if($global_settings->has('youtube_link'))
                    <a href="{{ $global_settings->get('youtube_link') }}" class="social-link" target="_blank" aria-label="Visit our YouTube Channel">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17"/><path d="m10 15 5-3-5-3z"/></svg>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Our Campuses -->
            <div class="footer-section">
                <h3>Our Campuses</h3>
                <ul class="footer-list">
                    @foreach($global_campuses as $campus)
                        <li><a href="{{ url('/campuses/' . $campus->slug) }}">{{ $campus->name }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-list">
                    <li><a href="{{ url('/admissions') }}">Admissions</a></li>
                    <li><a href="{{ url('/academics') }}">Academic Calendar</a></li>
                    <li><a href="{{ url('/news') }}">News & Events</a></li>
                    <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="footer-section">
                <h3>Contact Info</h3>
                <div class="footer-contact-item">
                    <svg class="footer-contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.163-7.39 11.728a1.1 1.1 0 0 1-1.22 0C9.539 20.163 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                    <span>{!! nl2br(e($global_settings->get('contact_address', 'Mbezi kwa Musuguri Area, Dar es Salaam'))) !!}</span>
                </div>
                <div class="footer-contact-item">
                    <svg class="footer-contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    <span>{{ $global_settings->get('contact_phone', '+255 754 309 879') }}</span>
                </div>
                <div class="footer-contact-item">
                    <svg class="footer-contact-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                    <span>{{ $global_settings->get('contact_email', 'stannemarieacademy@gmail.com') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Bottom bar -->
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} St. Anne Marie Trust. All Rights Reserved. <a href="{{ route('admin.login') }}" style="color: inherit; text-decoration: none; opacity: 0.8; font-size: 0.75rem;">Admin</a></p>
        </div>
    </div>
</footer>