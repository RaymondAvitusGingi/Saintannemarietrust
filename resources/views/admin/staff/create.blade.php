@extends('admin.layouts.app')

@section('page-title', 'Add Staff Member')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">New Staff Member</h2>
        <a href="{{ route('admin.staff.index', ['campus' => request('campus')]) }}" class="btn btn-secondary btn-sm">← Back to List</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <!-- Basic Info -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Assign to Campus *</label>
                        <select name="campus_id" class="form-select" required>
                            @foreach($campuses as $id => $name)
                                <option value="{{ $id }}" {{ request('campus') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Full Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-input" required placeholder="e.g., Dr. Jasson Rweikiza">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Position / Role *</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="form-input" required placeholder="e.g., Headmaster or Senior Teacher">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Staff Category *</label>
                        <select name="category" class="form-select" required>
                            <option value="staff" {{ old('category') == 'staff' ? 'selected' : '' }}>General Staff</option>
                            <option value="leadership" {{ old('category') == 'leadership' ? 'selected' : '' }}>Leadership / Headmaster</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width: 1.25rem; height: 1.25rem; accent-color: #1e5128;">
                            <span class="form-label" style="margin: 0;">Active Profile</span>
                        </label>
                    </div>
                </div>

                <!-- Media & Bio -->
                <div>
                    <div class="form-group">
                        <label class="form-label">Profile Photo</label>
                        <input type="file" name="image_file" class="form-input" accept="image/*">
                        <small style="color: #6b7280; display: block; margin-top: 0.25rem;">JPEG/PNG recommend. Optimized for 400x400 thumbnails.</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Brief Biography (Optional)</label>
                        <textarea name="bio" class="form-textarea" rows="5" placeholder="Short description of the staff member's background and achievements...">{{ old('bio') }}</textarea>
                    </div>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #f3f4f6;">
                <button type="submit" class="btn btn-primary">Save Staff Member</button>
                <a href="{{ route('admin.staff.index', ['campus' => request('campus')]) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
