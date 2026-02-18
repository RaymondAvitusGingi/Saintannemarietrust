@extends('admin.layouts.app')

@section('page-title', 'Edit News Article')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Edit Article</h2>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
            ← Back to List
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                <div>
                    <div class="form-group">
                        <label for="title" class="form-label">Title *</label>
                        <input type="text" id="title" name="title" class="form-input" value="{{ old('title', $news->title) }}" required>
                        @error('title')
                            <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="summary" class="form-label">Summary *</label>
                        <textarea id="summary" name="summary" class="form-textarea" rows="3" required>{{ old('summary', $news->summary) }}</textarea>
                        @error('summary')
                            <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content" class="form-label">Full Content *</label>
                        <input id="content" type="hidden" name="content" value="{{ old('content', $news->content) }}">
                        <trix-editor input="content" placeholder="Update your article content here..."></trix-editor>
                        @error('content')
                            <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <div class="form-group">
                        <label class="form-label">Current Image</label>
                        @if($news->image)
                            <img src="{{ $news->image }}" alt="" style="width: 100%; max-height: 150px; object-fit: cover; border-radius: 0.5rem; margin-bottom: 1rem;">
                        @else
                            <div style="width: 100%; height: 100px; background: #f3f4f6; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                                <span style="color: #9ca3af; font-size: 0.875rem;">No image</span>
                            </div>
                        @endif
                        
                        <label for="image" class="form-label">Replace Image</label>
                        <input type="file" id="image" name="image" class="form-input" accept="image/*">
                        @error('image')
                            <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category" class="form-label">Category *</label>
                        <select id="category" name="category" class="form-select" required>
                            @foreach(['Academic', 'Recognition', 'Excursion', 'Leadership', 'Sports', 'General'] as $cat)
                                <option value="{{ $cat }}" {{ old('category', $news->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" id="location" name="location" class="form-input" value="{{ old('location', $news->location) }}">
                    </div>

                    <div class="form-group">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published', $news->is_published) ? 'checked' : '' }} style="width: 1.25rem; height: 1.25rem; accent-color: #1e5128;">
                            <span class="form-label" style="margin: 0;">Published</span>
                        </label>
                    </div>
                </div>
            </div>

            <div style="border-top: 1px solid #e5e7eb; padding-top: 1.5rem; margin-top: 1rem; display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary">Update Article</button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
