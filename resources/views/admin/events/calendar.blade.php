@extends('admin.layouts.app')

@section('page-title', 'Event Calendar')

@section('styles')
<!-- FullCalendar -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<style>
    #calendar {
        background: white;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        min-height: 700px;
    }

    .fc-toolbar-title {
        font-weight: 700 !important;
        color: #1e5128;
    }

    .fc-button-primary {
        background-color: #1e5128 !important;
        border-color: #1e5128 !important;
    }

    .fc-event {
        cursor: pointer;
        padding: 4px 8px;
        background-color: #1e5128 !important;
        border-color: #1e5128 !important;
        font-size: 0.85rem;
    }

    .calendar-legend {
        display: flex;
        gap: 2rem;
        margin-top: 1.5rem;
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 0.75rem;
        border: 1px solid #f3f4f6;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #6b7280;
    }

    .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }
</style>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Schedule Overview</h2>
        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm">
                + Create New Event
            </a>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary btn-sm">
                View List
            </a>
        </div>
    </div>
    <div class="card-body">
        <div id="calendar"></div>

        <div class="calendar-legend">
            <div class="legend-item">
                <div class="legend-dot" style="background: #1e5128;"></div>
                <span>Public Event</span>
            </div>
            <div class="legend-item">
                <div class="legend-dot" style="background: #6b7280;"></div>
                <span>Private Event</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendarEl = document.getElementById('calendar');
        
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listYear'
            },
            events: '{{ route("admin.events.json.admin") }}',
            height: 'auto',
            navLinks: true, // click on day numbers to navigate views
            eventClick: function(info) {
                if (info.event.url) {
                    window.location.href = info.event.url;
                    info.jsEvent.preventDefault();
                }
            }
        });
        
        calendar.render();
    });
</script>
@endsection
