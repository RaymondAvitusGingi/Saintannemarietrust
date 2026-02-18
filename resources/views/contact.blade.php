@extends('layouts.app')

@section('title', 'Contact Us - St. Anne Marie Academy Schools')

@section('styles')
<style>
    .contact-page {
        background: #f9fafb;
        min-height: 100vh;
    }

    /* Hero Section */
    .contact-hero {
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

    .contact-container {
        max-width: 1536px;
        margin: -4rem auto 0;
        padding: 0 1rem 5rem;
        position: relative;
        z-index: 20;
    }


    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
    }

    .content-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 1.75rem;
        padding: 3rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-size: 1.75rem;
        font-weight: 900;
        color: #1f2937;
        margin-bottom: 2rem;
        letter-spacing: -0.03em;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        color: #374151;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        background: #f9fafb;
        border: 1px solid #d1d5db;
        border-radius: 0.75rem;
        color: #1f2937;
        font-size: 0.95rem;
        transition: 0.3s;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #1e5128;
        background: #ffffff;
    }

    .form-input::placeholder,
    .form-textarea::placeholder {
        color: #9ca3af;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }

    .submit-btn {
        width: 100%;
        padding: 1rem;
        background: #00FF88;
        color: #0d1b14;
        font-weight: 900;
        font-size: 0.95rem;
        border: none;
        border-radius: 0.75rem;
        cursor: pointer;
        transition: 0.3s;
    }

    .submit-btn:hover {
        opacity: 0.85;
        transform: translateY(-2px);
    }

    .info-section {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .school-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-left: 4px solid #1e5128;
        border-radius: 1.5rem;
        padding: 2rem;
        transition: 0.3s;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .school-card:hover {
        background: #f9fafb;
        transform: translateX(4px);
    }

    .school-card.brilliant {
        border-left-color: #ff4444;
    }

    .school-card.sunshine {
        border-left-color: #ffcc00;
    }

    .school-card.rweikiza {
        border-left-color: #4488ff;
    }

    .school-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .school-logo {
        width: 64px;
        height: 64px;
        object-fit: contain;
        flex-shrink: 0;
        background: rgba(255,255,255,0.9);
        border-radius: 0.75rem;
        padding: 0.5rem;
    }

    .school-icon {
        width: 64px;
        height: 64px;
        flex-shrink: 0;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .school-icon.sunshine {
        background: rgba(255,204,0,0.1);
        color: #ffcc00;
    }

    .school-icon.rweikiza {
        background: rgba(68,136,255,0.1);
        color: #4488ff;
    }

    .school-title {
        font-size: 1.5rem;
        font-weight: 900;
        color: #1f2937;
        line-height: 1.2;
    }

    .contact-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .contact-item {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }

    .contact-item svg {
        color: #1e5128;
        flex-shrink: 0;
        margin-top: 0.2rem;
    }

    .school-card.brilliant .contact-item svg {
        color: #ff4444;
    }

    .school-card.sunshine .contact-item svg {
        color: #ffcc00;
    }

    .school-card.rweikiza .contact-item svg {
        color: #4488ff;
    }

    .contact-label {
        display: block;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.25rem;
        font-size: 0.9rem;
    }

    .contact-text {
        color: #4b5563;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .map-placeholder {
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        border-radius: 1.5rem;
        height: 256px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        gap: 0.5rem;
    }

    @media (max-width: 900px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .hero h1 {
            font-size: 2rem;
        }
    }
</style>
@endsection

@section('content')
<div class="contact-page">
    <!-- Hero Section -->
    <div class="contact-hero">
        <div class="hero-background">
            <img src="/images/school/st_anne_students_group.jpg" alt="St. Anne Marie Students">
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Contact Us</h1>
            <p class="hero-subtitle">
                We'd love to hear from you. Reach out to any of our campuses.
            </p>
            <span class="hero-badge">
                Towards Excellence
            </span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="contact-container">

    <div class="contact-grid">
        <!-- Contact Form -->
        <div class="content-card">
            <h2 class="section-title">Send us a Message</h2>
            
            @if(session('success'))
                <div style="background-color: #d1fae5; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; text-align: center;">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-input" placeholder="John">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" class="form-input" placeholder="Doe">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-input" placeholder="john@example.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-input" placeholder="+255 xxx xxx xxx">
                </div>
                <div class="form-group">
                    <label class="form-label">Message</label>
                    <textarea name="message" class="form-textarea" placeholder="How can we help you?"></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>

        <!-- Info Side -->
        <div class="info-section">
            @php $campuses = \App\Models\Campus::orderBy('order')->get(); @endphp
            @foreach($campuses as $campus)
                <div class="school-card {{ $campus->slug }}">
                    <div class="school-header">
                        @if($campus->logo)
                            <img src="{{ $campus->logo }}" alt="{{ $campus->name }} Logo" class="school-logo">
                        @else
                            <div class="school-icon {{ $campus->slug }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9 12 2l9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            </div>
                        @endif
                        <h3 class="school-title">{{ $campus->name }}</h3>
                    </div>
                    <div class="contact-list">
                        @if($campus->address)
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 10c0 4.993-5.539 10.163-7.39 11.728a1.1 1.1 0 0 1-1.22 0C9.539 20.163 4 14.993 4 10a8 8 0 0 1 16 0"/>
                                <circle cx="12" cy="10" r="3"/>
                            </svg>
                            <div>
                                <span class="contact-label">Address</span>
                                <p class="contact-text">{!! nl2br(e($campus->address)) !!}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($campus->phone)
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                            </svg>
                            <div>
                                <span class="contact-label">Phone</span>
                                
                                @php
                                    $rawPhones = preg_split('/[\/&,]/', $campus->phone);
                                @endphp

                                <div class="flex flex-col gap-4">
                                    @foreach($rawPhones as $p)
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
                                        <div class="{{ $loop->iteration > 1 ? 'pt-4 border-t border-gray-100' : '' }}">
                                            <p class="text-[9px] text-gray-400 font-bold uppercase tracking-wider mb-1">{{ $personTitle }}</p>
                                            <p class="text-xs font-bold text-gray-800 mb-2">{{ trim($p) }}</p>
                                            <div class="flex items-center gap-2 mt-2">
                                                <a href="tel:{{ $cleanP }}" class="inline-flex items-center justify-center p-2 rounded-lg bg-school-primary/10 text-school-primary hover:bg-school-primary hover:text-white transition-all duration-300" title="Call {{ trim($p) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                                </a>
                                                <a href="https://wa.me/{{ $cleanP }}" target="_blank" class="inline-flex items-center justify-center p-2 rounded-lg bg-green-100 text-green-600 hover:bg-green-600 hover:text-white transition-all duration-300" title="WhatsApp {{ trim($p) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        @php $campusEmail = $campus->email ?? ($campus->slug == 'st-anne-marie' ? ($settings['contact_email'] ?? null) : null); @endphp
                        @if($campusEmail)
                        <div class="contact-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="16" x="2" y="4" rx="2"/>
                                <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                            <div>
                                <span class="contact-label">Email</span>
                                <p class="contact-text">{{ $campusEmail }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach

            <!-- Map Integration -->
            <div class="map-container" style="border-radius: 1.5rem; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15847.08564887373!2d39.0792556!3d-6.79796!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c4f1c7bd2cecd%3A0xe98670b14bcf84!2sSt.Anne%20Marie%20Primary%20School!5e0!3m2!1sen!2stz!4v1709280000000!5m2!1sen!2stz" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>

</div>
@endsection