@extends('admin.layouts.app')

@section('page-title', 'Edit Staff Member')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Update Profile: {{ $staff->name }}</h2>
        <a href="{{ route('admin.staff.index', ['campus' => $staff->campus_id]) }}" class="btn btn-secondary btn-sm">← Back to List</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.staff.update', $staff) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <!-- Basic Info -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Assign to Campus *</label>
                        <select name="campus_id" class="form-select" required>
                            @foreach($campuses as $id => $name)
                                <option value="{{ $id }}" {{ old('campus_id', $staff->campus_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name', $staff->name) }}" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Position / Role *</label>
                        <input type="text" name="title" value="{{ old('title', $staff->title) }}" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Staff Category *</label>
                        <select name="category" class="form-select" required>
                            <option value="staff" {{ old('category', $staff->category) == 'staff' ? 'selected' : '' }}>General Staff</option>
                            <option value="leadership" {{ old('category', $staff->category) == 'leadership' ? 'selected' : '' }}>Leadership / Headmaster</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $staff->is_active) ? 'checked' : '' }} style="width: 1.25rem; height: 1.25rem; accent-color: #1e5128;">
                            <span class="form-label" style="margin: 0;">Active Profile</span>
                        </label>
                    </div>
                </div>

                <!-- Media & Bio -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Profile Photo</label>
                        @if($staff->image)
                            <img src="{{ $staff->image_url }}" alt="" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; margin-bottom: 1rem; border: 2px solid #e5e7eb;">
                        @endif
                        <input type="file" name="image_file" class="form-input" accept="image/*">
                        <small style="color: #6b7280; display: block; margin-top: 0.25rem;">Replace photo by selecting a new file.</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Brief Biography</label>
                        <textarea name="bio" class="form-textarea" rows="5">{{ old('bio', $staff->bio) }}</textarea>
                    </div>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #f3f4f6;">
                <button type="submit" class="btn btn-primary">Update Profile</button>
                <a href="{{ route('admin.staff.index', ['campus' => $staff->campus_id]) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
