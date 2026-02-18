@extends('admin.layouts.app')

@section('page-title', 'Create Event')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Event Details</h2>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary btn-sm">
            &larr; Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.events.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title" class="form-label">Event Title</label>
                <input type="text" name="title" id="title" class="form-input" value="{{ old('title') }}" required>
                @error('title') <span style="color: red; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-input" value="{{ old('start_date') }}" required>
                    @error('start_date') <span style="color: red; font-size: 0.875rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="end_date" class="form-label">End Date (Optional)</label>
                    <input type="date" name="end_date" id="end_date" class="form-input" value="{{ old('end_date') }}">
                    @error('end_date') <span style="color: red; font-size: 0.875rem;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label for="time" class="form-label">Time (e.g. 10:00 AM - 2:00 PM)</label>
                    <input type="text" name="time" id="time" class="form-input" value="{{ old('time') }}">
                    @error('time') <span style="color: red; font-size: 0.875rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" name="location" id="location" class="form-input" value="{{ old('location') }}">
                    @error('location') <span style="color: red; font-size: 0.875rem;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-textarea">{{ old('description') }}</textarea>
                @error('description') <span style="color: red; font-size: 0.875rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="checkbox" name="is_public" value="1" {{ old('is_public', true) ? 'checked' : '' }} style="width: 1rem; height: 1rem;">
                    Publicly Visible
                </label>
                <p style="font-size: 0.75rem; color: #6b7280;">Uncheck to hide this event from the public calendar (Admin only).</p>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Event</button>
            </div>
        </form>
    </div>
</div>
@endsection
