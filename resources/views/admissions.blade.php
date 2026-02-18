@extends('layouts.app')

@section('title', 'Admissions - St. Anne Marie Academy Schools')

@section('styles')
<style>
    .admissions-page {
        background: #f9fafb;
        min-height: 100vh;
    }

    /* Hero Section */
    .admissions-hero {
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
        margin: 0 auto 3.5rem; /* Matched spacing from Campuses page */
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
    .admissions-container {
        max-width: 1536px;
        margin: -4rem auto 0;
        padding: 0 1rem 5rem;
        position: relative;
        z-index: 20;
    }

    /* Custom Rounding Fixes */
    .rounded-card-lg {
        border-radius: 2.5rem !important;
    }

    .rounded-card-md {
        border-radius: 2rem !important;
    }

    .rounded-btn-custom {
        border-radius: 1.25rem !important;
    }

    .overflow-hidden {
        overflow: hidden !important;
    }
</style>
@endsection

@section('content')
<div class="admissions-page">
    <!-- Hero Section -->
    <div class="admissions-hero">
        <div class="hero-background">
            <img src="/images/school/st_anne_students_01.jpg" alt="St. Anne Marie Students">
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Admissions</h1>
            <p class="hero-subtitle">
                Join the St. Anne Marie Academy Family. Guidelines for 2026 Academic Year.
            </p>
            <span class="hero-badge">
                Towards Excellence
            </span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admissions-container">
        <!-- Main Form Info Card -->
        <div class="bg-white rounded-card-lg shadow-xl p-8 lg:p-12 mb-12 border border-gray-100 overflow-hidden">
            <div class="max-width-3xl mx-auto text-center mb-12">
                <h2 class="text-4xl font-serif font-bold text-school-primary mb-4">Request Admission Form</h2>
                <p class="text-gray-600 text-lg leading-relaxed max-w-2xl mx-auto">
                    Each campus has its own specific admission process. Please select the school you wish to apply to below to contact the respective Head of School.
                </p>
            </div>

            <!-- Campus Cards Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                @foreach($campuses as $campus)
                    @php
                        $isPrimary = str_contains($campus->level, 'Primary') || str_contains($campus->level, 'Nursery');
                        
                        // Use school-specific phone if available, otherwise default by level
                        $rawPhone = $campus->phone ?? ($isPrimary ? "255744489933" : "255654995711");
                        $phoneNumber = str_replace(['+', ' '], '', $rawPhone);
                        $displayNum = $campus->phone ?? ($isPrimary ? "+255 744 489 933" : "+255 65 499 5711");
                        
                        $headTitle = $campus->headmaster ?? ($isPrimary ? "HEAD MASTER (PRIMARY)" : "HEAD MASTER (SECONDARY)");
                    @endphp
                    <div class="bg-white rounded-card-md shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col group border border-gray-100">
                        <div class="h-48 relative overflow-hidden">
                            <img src="{{ $campus->image ?? '/images/school/logo_st_anne_official.jpg' }}" alt="{{ $campus->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-school-primary/20"></div>
                            <div class="absolute top-4 left-4">
                                <span class="bg-school-secondary text-white text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-lg shadow-lg">
                                    {{ $campus->level }}
                                </span>
                            </div>
                        </div>

                        <div class="p-6 flex-grow flex flex-col">
                            <h3 class="text-lg font-bold text-school-primary font-serif mb-4 leading-tight">{{ $campus->name }}</h3>
                            
                            <div class="mt-auto pt-4 border-t border-gray-100">
                                @php
                                    // Handle multiple phone numbers (split by /, &, or ,)
                                    $phones = preg_split('/[\/&,]/', $rawPhone);
                                @endphp

                                @foreach($phones as $p)
                                    @php
                                        $cleanP = str_replace(['+', ' ', '(', ')', '-'], '', trim($p));
                                        if (str_starts_with($cleanP, '0')) {
                                            $cleanP = '255' . substr($cleanP, 1);
                                        }
                                        
                                        $personTitle = $campus->headmaster ?? ($isPrimary ? "HEAD MASTER (PRIMARY)" : "HEAD MASTER (SECONDARY)");
                                        if ($campus->slug == 'st-anne-marie') {
                                            $personTitle = ($loop->iteration == 1) ? 'HEADTEACHER PRIMARY' : 'HEADMASTER SECONDARY';
                                        }
                                    @endphp
                                    <div class="{{ $loop->iteration > 1 ? 'mt-4 pt-4 border-t border-gray-100' : '' }}">
                                        <div class="mb-4">
                                            <p class="text-[10px] text-gray-400 font-black uppercase tracking-[0.15em] mb-1.5">{{ $personTitle }}</p>
                                            <p class="text-lg font-bold text-gray-800 mb-4">{{ trim($p) }}</p>
                                        </div>
                                        <div class="grid grid-cols-2 gap-2">
                                            <a href="tel:{{ $cleanP }}" class="flex items-center justify-center bg-school-primary text-white py-3 rounded-btn-custom hover:bg-school-secondary transition duration-300 group/btn" title="Call {{ trim($p) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                            </a>
                                            <a href="https://wa.me/{{ $cleanP }}" target="_blank" class="flex items-center justify-center bg-green-600 text-white py-3 rounded-btn-custom hover:bg-green-700 transition duration-300" title="WhatsApp {{ trim($p) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Support Card -->
        <div class="bg-school-primary rounded-card-lg p-8 lg:p-12 text-white shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 p-8 opacity-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-64 h-64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14.5 2 14.5 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
            </div>
            
            <div class="relative z-10 flex flex-col lg:flex-row items-center justify-between gap-12">
                <div class="max-w-2xl text-center lg:text-left">
                    <h3 class="text-3xl font-serif font-bold mb-4">General Inquiries</h3>
                    <p class="text-gray-300 text-lg mb-8 leading-relaxed">
                        For general questions about the academy, fee structures, or if you're unsure which campus to choose, our administration team is here to help.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="tel:+255754309879" class="flex items-center justify-center gap-3 bg-white text-school-primary px-8 py-4 rounded-btn-custom font-bold hover:bg-school-accent transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            Call Administration
                        </a>
                        <a href="https://wa.me/255754309879" class="flex items-center justify-center gap-3 bg-green-500 text-white px-8 py-4 rounded-xl font-bold hover:bg-green-600 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            WhatsApp
                        </a>
                    </div>
                </div>
                <div class="text-center bg-white/10 p-8 rounded-card-md backdrop-blur-md border border-white/20">
                    <p class="text-xs font-black uppercase tracking-[0.2em] mb-2">School Admin</p>
                    <p class="text-3xl font-bold tracking-tight">+255 754 309 879</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection