@extends('admin.layouts.app')

@section('page-title', 'Create News Article')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Create New Article</h2>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
            ← Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                <div>
                    <div class="form-group">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" id="title" name="title" class="form-input" value="{{ old('title') }}" required>
                        @error('title')
                            <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="summary" class="form-label">Summary *</label>
                        <textarea id="summary" name="summary" class="form-textarea" rows="3" required>{{ old('summary') }}</textarea>
                        <p style="color: #6b7280; font-size: 0.75rem; margin-top: 0.25rem;">Brief description shown in news listings.</p>
                        @error('summary')
                            <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content" class="form-label">Full Content *</label>
                        <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                        <trix-editor input="content" placeholder="Write your article content here..."></trix-editor>
                        @error('content')
                            <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="form-group">
                        <label for="image" class="form-label">Featured Image</label>
                        <input type="file" id="image" name="image" class="form-input" accept="image/*">
                        <p style="color: #6b7280; font-size: 0.75rem; margin-top: 0.25rem;">Max 5MB. JPEG, PNG, GIF.</p>
                        @error('image')
                            <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category" class="form-label">Category *</label>
                        <select id="category" name="category" class="form-select" required>
                            <option value="Academic" {{ old('category') == 'Academic' ? 'selected' : '' }}>Academic</option>
                            <option value="Recognition" {{ old('category') == 'Recognition' ? 'selected' : '' }}>Recognition</option>
                            <option value="Excursion" {{ old('category') == 'Excursion' ? 'selected' : '' }}>Excursion</option>
                            <option value="Leadership" {{ old('category') == 'Leadership' ? 'selected' : '' }}>Leadership</option>
                            <option value="Sports" {{ old('category') == 'Sports' ? 'selected' : '' }}>Sports</option>
                            <option value="General" {{ old('category') == 'General' ? 'selected' : '' }}>General</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" id="location" name="location" class="form-input" value="{{ old('location') }}" placeholder="e.g., Main Campus Grounds">
                    </div>

                    <div class="form-group">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} style="width: 1.25rem; height: 1.25rem; accent-color: #1e5128;">
                            <span class="form-label" style="margin: 0;">Publish immediately</span>
                        </label>
                    </div>
                </div>
            </div>

            <div style="border-top: 1px solid #e5e7eb; padding-top: 1.5rem; margin-top: 1rem; display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary">Create Article</button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
