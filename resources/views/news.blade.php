@extends('layouts.app')

@section('title', 'News & Events - St. Anne Marie Academy Schools')

@section('styles')
<!-- FullCalendar -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<style>
    .news-page {
        background: #f9fafb;
        min-height: 100vh;
        padding-bottom: 5rem;
    }

    .news-header {
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

    .news-header-content {
        max-width: 1536px;
        margin: 0 auto;
        padding: 0 1rem;
        text-align: center;
        position: relative;
        z-index: 10;
    }

    .news-header h1 {
        font-size: 3rem;
        font-family: 'Inter', sans-serif;
        font-weight: 800;
        margin-bottom: 1.5rem;
        letter-spacing: -0.025em;
    }

    .news-header p {
        font-size: 1.25rem;
        max-width: 42rem;
        margin: 0 auto 3.5rem; /* Matched spacing */
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

    .news-container {
        max-width: 1536px;
        margin: -4rem auto 0;
        padding: 0 1rem 5rem;
        position: relative;
        z-index: 20;
    }

    /* Featured Article */
    .featured-article {
        background: white;
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 3rem;
        display: flex;
        flex-direction: column;
    }

    .featured-article:hover .featured-image img {
        transform: scale(1.05);
    }

    .featured-image {
        width: 100%;
        height: 16rem;
        overflow: hidden;
        position: relative;
    }

    .featured-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: var(--school-secondary, #c41e3a);
        color: white;
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 700;
        border-radius: 0.25rem;
        text-transform: uppercase;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        z-index: 10;
    }

    .featured-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1);
        transition: transform 0.7s;
    }

    .featured-content {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .meta-item svg {
        width: 0.875rem;
        height: 0.875rem;
    }

    .meta-category {
        color: var(--school-primary, #1e5128);
        font-weight: 700;
    }

    .featured-content h2 {
        font-size: 1.875rem;
        font-family: Georgia, serif;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1rem;
        transition: color 0.3s;
    }

    .featured-article:hover .featured-content h2 {
        color: var(--school-primary, #1e5128);
    }

    .featured-content p {
        color: #4b5563;
        line-height: 1.75;
        margin-bottom: 1.5rem;
    }

    .article-location {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 1.5rem;
    }

    .article-location svg {
        width: 1rem;
        height: 1rem;
    }

    .read-more-link {
        color: var(--school-secondary, #c41e3a);
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: gap 0.3s;
        cursor: pointer;
        text-decoration: none;
    }

    .read-more-link:hover {
        gap: 0.75rem;
    }

    .read-more-link svg {
        width: 1.125rem;
        height: 1.125rem;
    }

    /* Recent Highlights Section */
    .recent-section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 1.5rem;
        padding-left: 1rem;
        border-left: 4px solid var(--school-secondary, #c41e3a);
    }

    .news-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    /* News Card */
    .news-card {
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: box-shadow 0.3s;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .news-card:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .news-card:hover .card-image img {
        transform: scale(1.1);
    }

    .card-image {
        height: 12rem;
        overflow: hidden;
        position: relative;
    }

    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1);
        transition: transform 0.5s;
    }

    .card-badge {
        position: absolute;
        top: 0;
        right: 0;
        background: rgba(30, 81, 40, 0.9);
        color: white;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 700;
        border-bottom-left-radius: 0.5rem;
    }

    .card-content {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .card-meta {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.75rem;
        color: #6b7280;
        margin-bottom: 0.75rem;
    }

    .card-meta svg {
        width: 0.75rem;
        height: 0.75rem;
    }

    .card-content h4 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.75rem;
        transition: color 0.3s;
    }

    .news-card:hover .card-content h4 {
        color: var(--school-secondary, #c41e3a);
    }

    .card-summary {
        color: #4b5563;
        font-size: 0.875rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .card-footer {
        padding-top: 1rem;
        border-top: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: auto;
    }

    .card-location {
        font-size: 0.75rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .card-location svg {
        width: 0.75rem;
        height: 0.75rem;
    }

    .card-link {
        color: var(--school-primary, #1e5128);
        font-size: 0.875rem;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
    }

    .card-link:hover {
        text-decoration: underline;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 5rem 0;
    }

    .empty-state p {
        color: #6b7280;
        font-size: 1.125rem;
    }

    /* Responsive Design */
    @media (min-width: 768px) {
        .news-header h1 {
            font-size: 3rem;
        }

        .featured-article {
            flex-direction: row;
        }

        .featured-image {
            width: 50%;
            height: auto;
        }

        .featured-content {
            width: 50%;
        }

        .news-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .news-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Calendar Styles */
    #calendar {
        background: white;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
    }

    .fc-toolbar-title {
        font-family: 'Inter', sans-serif !important;
        font-weight: 800 !important;
        color: var(--school-primary);
    }

    .fc-button-primary {
        background-color: var(--school-primary) !important;
        border-color: var(--school-primary) !important;
    }

    .fc-event {
        cursor: pointer;
        padding: 2px 4px;
        background-color: var(--school-secondary) !important;
        border-color: var(--school-secondary) !important;
    }

    .view-toggle {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 3rem;
    }

    .toggle-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 9999px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        border: 2px solid white;
        color: white;
        background: transparent;
    }

    .toggle-btn.active {
        background: white;
        color: var(--school-primary);
    }

    /* Event Modal */
    .event-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.5);
        backdrop-filter: blur(4px);
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .event-modal.show {
        display: flex;
        opacity: 1;
    }

    .event-modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        border: 1px solid #888;
        width: 90%;
        max-width: 500px;
        border-radius: 1rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        position: relative;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from { transform: translateY(20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .close-modal {
        color: #aaa;
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        font-size: 1.5rem;
        font-weight: bold;
        background: none;
        border: none;
        cursor: pointer;
        z-index: 10;
        transition: color 0.2s;
    }

    .close-modal:hover,
    .close-modal:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        padding: 1.5rem;
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    .modal-header h3 {
        margin: 0;
        color: var(--school-primary);
        font-size: 1.25rem;
        font-weight: 700;
        padding-right: 1.5rem;
    }

    .modal-date {
        display: block;
        margin-top: 0.25rem;
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 500;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-info-row {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
        color: #374151;
        font-size: 0.95rem;
    }

    .modal-info-row svg {
        width: 1.25rem;
        height: 1.25rem;
        color: var(--school-secondary);
    }

    .modal-description {
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid #f3f4f6;
        color: #4b5563;
        line-height: 1.6;
        font-size: 0.95rem;
        white-space: pre-line;
    }

    .modal-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid #e5e7eb;
        text-align: right;
    }

    .btn-close {
        background: #f3f4f6;
        color: #374151;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-close:hover {
        background: #e5e7eb;
    }
</style>
@endsection

@section('scripts')
<script>
    let calendar;

    function switchView(view) {
        const listView = document.getElementById('list-view');
        const calendarView = document.getElementById('calendar-view');
        const listToggle = document.getElementById('list-toggle');
        const calendarToggle = document.getElementById('calendar-toggle');

        if (view === 'list') {
            listView.style.display = 'block';
            calendarView.style.display = 'none';
            listToggle.classList.add('active');
            calendarToggle.classList.remove('active');
        } else {
            listView.style.display = 'none';
            calendarView.style.display = 'block';
            listToggle.classList.remove('active');
            calendarToggle.classList.add('active');
            
            if (!calendar) {
                initCalendar();
            } else {
                setTimeout(() => {
                    calendar.setOption('contentHeight', 'auto');
                    calendar.render();
                }, 10);
            }
        }
    }

    function initCalendar() {
        const calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listWeek'
            },
            events: '{{ route("events.json") }}',
            eventClick: function(info) {
                // If it has a URL (legacy news events), follow it
                if (info.event.url && info.event.extendedProps.is_news) {
                    window.location.href = info.event.url;
                    info.jsEvent.preventDefault();
                    return;
                }
                
                // Otherwise show the modal
                info.jsEvent.preventDefault();
                openEventModal(info.event);
            }
        });
        calendar.render();
    }

    function openEventModal(event) {
        const modal = document.getElementById('event-modal');
        
        // Title
        document.getElementById('modal-title').textContent = event.title;
        
        // Date Formatting
        let dateStr = event.start.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        if (event.end) {
            // Adjust end date because FullCalendar end date is exclusive
            let end = new Date(event.end);
            end.setDate(end.getDate() - 1);
            if (end.getTime() !== event.start.getTime()) {
                dateStr += ' - ' + end.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
            }
        }
        document.getElementById('modal-date').textContent = dateStr;
        
        // Time
        const timeRow = document.getElementById('modal-time-row');
        if (event.extendedProps.time) {
            document.getElementById('modal-time').textContent = event.extendedProps.time;
            timeRow.style.display = 'flex';
        } else {
            timeRow.style.display = 'none';
        }
        
        // Location
        const locRow = document.getElementById('modal-location-row');
        if (event.extendedProps.location) {
            document.getElementById('modal-location').textContent = event.extendedProps.location;
            locRow.style.display = 'flex';
        } else {
            locRow.style.display = 'none';
        }

        // Description
        const descEl = document.getElementById('modal-description');
        if (event.extendedProps.description) {
            descEl.textContent = event.extendedProps.description;
            descEl.style.display = 'block';
        } else {
            descEl.style.display = 'none';
        }

        modal.classList.add('show');
    }

    function closeEventModal() {
        document.getElementById('event-modal').classList.remove('show');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('event-modal');
        if (event.target == modal) {
            closeEventModal();
        }
    }
</script>
@endsection

@section('content')
<div class="news-page">
    <!-- Header -->
    <div class="news-header">
        <div class="hero-background">
            <img src="/images/school/trip_ruaha.jpg" alt="Ruaha Educational Trip">
        </div>
        <div class="hero-overlay"></div>
        <div class="news-header-content">
            <h1>News & Events</h1>
            <p>
                Stay updated with the latest happenings, academic achievements, excursions, and celebrations at St. Anne Marie Academy Schools.
            </p>
            
            <div class="view-toggle">
                <button onclick="switchView('list')" id="list-toggle" class="toggle-btn active">List View</button>
                <button onclick="switchView('calendar')" id="calendar-toggle" class="toggle-btn">Calendar View</button>
            </div>

            <span class="hero-badge">
                Towards Excellence
            </span>
        </div>
    </div>

    <div class="news-container">
        
        <div id="list-view">
        
        @if(count($newsItems) > 0)
            @php $featured = $newsItems[0]; @endphp
            
            <!-- Featured / Latest Event -->
            <article class="featured-article">
                <div class="featured-image">
                    <div class="featured-badge">Latest</div>
                    <img 
                        src="{{ $featured->image }}" 
                        alt="{{ $featured->title }}"
                    />
                </div>
                <div class="featured-content">
                    <div class="article-meta">
                        <span class="meta-item">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            {{ $featured->formatted_date }}
                        </span>
                        <span class="meta-item meta-category">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2H2v10l9.29 9.29c.94.94 2.48.94 3.42 0l6.58-6.58c.94-.94.94-2.48 0-3.42L12 2Z"/><path d="M7 7h.01"/></svg>
                            {{ $featured->category }}
                        </span>
                    </div>
                    <h2>{{ $featured->title }}</h2>
                    <p>{{ $featured->summary }}</p>
                    @if(!empty($featured['location']))
                        <div class="article-location">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.163-7.39 11.728a1.1 1.1 0 0 1-1.22 0C9.539 20.163 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                            {{ $featured->location }}
                        </div>
                    @endif
                    <a href="{{ route('news.show', $featured->slug) }}" class="read-more-link">
                        Read Full Story 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>
            </article>

            <!-- Recent Events Grid -->
            @if(count($newsItems) > 1)
                <div class="recent-section">
                    <h3 class="section-title">Recent Highlights</h3>
                    <div class="news-grid">
                        @foreach($newsItems->slice(1) as $item)
                            <article class="news-card">
                                <div class="card-image">
                                    <img 
                                        src="{{ $item->image }}" 
                                        alt="{{ $item->title }}"
                                    />
                                    <div class="card-badge">{{ $item->category }}</div>
                                </div>
                                <div class="card-content">
                                    <div class="card-meta">
                                        <span class="meta-item">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                            {{ $item->formatted_date }}
                                        </span>
                                    </div>
                                    <h4>{{ $item->title }}</h4>
                                    <p class="card-summary">{{ $item->summary }}</p>
                                    
                                    <div class="card-footer">
                                        @if(!empty($item['location']))
                                            <span class="card-location">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.163-7.39 11.728a1.1 1.1 0 0 1-1.22 0C9.539 20.163 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                                                {{ $item->location }}
                                            </span>
                                        @else
                                            <span></span>
                                        @endif
                                        <a href="{{ route('news.show', $item->slug) }}" class="card-link">Read More</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif
        @else
            <div class="empty-state">
                <p>No news items found.</p>
            </div>
        @endif

        </div><!-- End List View -->

        <div id="calendar-view" style="display: none;">
            <div id="calendar"></div>
        </div>
    </div><!-- End News Container -->

    <!-- Event Details Modal -->
    <div id="event-modal" class="event-modal">
        <div class="event-modal-content">
            <button class="close-modal" onclick="closeEventModal()">&times;</button>
            <div class="modal-header">
                <h3 id="modal-title">Event Title</h3>
                <span id="modal-date" class="modal-date">Date</span>
            </div>
            <div class="modal-body">
                <div class="modal-info-row" id="modal-time-row">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    <span id="modal-time"></span>
                </div>
                <div class="modal-info-row" id="modal-location-row">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.163-7.39 11.728a1.1 1.1 0 0 1-1.22 0C9.539 20.163 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                    <span id="modal-location"></span>
                </div>
                <div class="modal-description" id="modal-description"></div>
            </div>
            <div class="modal-footer">
                <button class="btn-close" onclick="closeEventModal()">Close</button>
            </div>
        </div>
    </div>
</div><!-- End News Page -->
@endsection