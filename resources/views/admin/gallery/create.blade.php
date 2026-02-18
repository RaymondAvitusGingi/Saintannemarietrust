@extends('admin.layouts.app')

@section('page-title', 'Upload Gallery Images')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Upload Images</h2>
        <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">
            ← Back to Gallery
        </a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="campus_id" class="form-label">Campus *</label>
                <select id="campus_id" name="campus_id" class="form-select" required>
                    @foreach($campuses as $id => $name)
                        <option value="{{ $id }}" {{ request('campus') == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="images" class="form-label">Select Images *</label>
                <input type="file" id="images" name="images[]" class="form-input" accept="image/*" multiple required>
                <p style="color: #6b7280; font-size: 0.75rem; margin-top: 0.5rem;">
                    You can select multiple images. Max 5MB each. Supported formats: JPEG, PNG, GIF.
                </p>
                @error('images')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div id="preview-container" style="display: none; margin-bottom: 1.5rem;">
                <label class="form-label">Selected Images Preview</label>
                <div id="image-previews" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 1rem;"></div>
            </div>

            <div style="border-top: 1px solid #e5e7eb; padding-top: 1.5rem; margin-top: 1rem; display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary">Upload Images</button>
                <a href="{{ route('admin.gallery.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('images').addEventListener('change', function(e) {
        const previewContainer = document.getElementById('preview-container');
        const previews = document.getElementById('image-previews');
        previews.innerHTML = '';

        if (this.files.length > 0) {
            previewContainer.style.display = 'block';
            
            Array.from(this.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.style.cssText = 'background: white; border-radius: 0.5rem; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1);';
                    div.innerHTML = `
                        <img src="${e.target.result}" style="width: 100%; height: 80px; object-fit: cover;">
                        <div style="padding: 0.5rem; font-size: 0.75rem; color: #6b7280;">${file.name}</div>
                    `;
                    previews.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        } else {
            previewContainer.style.display = 'none';
        }
    });
</script>
@endsection
