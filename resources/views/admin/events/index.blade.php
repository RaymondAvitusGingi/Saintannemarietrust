@extends('admin.layouts.app')

@section('page-title', 'Event Calendar Management')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">All Events</h2>
        <div style="display: flex; gap: 1rem;">
            <a href="{{ route('admin.events.calendar') }}" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                View Calendar
            </a>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                Create New Event
            </a>
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        @if($events->count() > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Date & Time</th>
                        <th class="hide-on-mobile">Location</th>
                        <th class="hide-on-mobile">Visibility</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr>
                            <td>
                                <span style="font-weight: 600; color: #1f2937;">{{ $event->title }}</span>
                            </td>
                            <td>
                                <div style="display: flex; flex-direction: column; font-size: 0.875rem;">
                                    <span style="font-weight: 500;">
                                        {{ $event->start_date->format('M d, Y') }}
                                        @if($event->end_date && $event->end_date != $event->start_date)
                                            - {{ $event->end_date->format('M d, Y') }}
                                        @endif
                                    </span>
                                    <span style="color: #6b7280; font-size: 0.75rem;">
                                        {{ $event->time ?? 'All Day' }}
                                    </span>
                                </div>
                            </td>
                            <td class="hide-on-mobile" style="color: #6b7280;">
                                {{ $event->location ?? '-' }}
                            </td>
                            <td class="hide-on-mobile">
                                @if($event->is_public)
                                    <span style="background: #d1fae5; color: #065f46; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 600;">Public</span>
                                @else
                                    <span style="background: #f3f4f6; color: #374151; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 600;">Private</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

            <div style="padding: 1rem 1.5rem; border-top: 1px solid #f3f4f6;">
                {{ $events->links() }}
            </div>
        @else
            <div style="padding: 4rem; text-align: center; color: #6b7280;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 1rem;"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <p style="margin-bottom: 1rem;">No events found. Create your first event!</p>
                <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Create First Event</a>
            </div>
        @endif
    </div>
</div>
@endsection
