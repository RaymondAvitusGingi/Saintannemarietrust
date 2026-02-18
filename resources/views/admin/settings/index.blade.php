@extends('admin.layouts.app')

@section('page-title', 'Site Settings')

@section('content')
<div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
    <a href="{{ route('admin.settings.index', ['category' => 'contact']) }}" class="btn {{ $category == 'contact' ? 'btn-primary' : 'btn-secondary' }}">Contact Details</a>
    <a href="{{ route('admin.settings.index', ['category' => 'academics']) }}" class="btn {{ $category == 'academics' ? 'btn-primary' : 'btn-secondary' }}">Academic Page Content</a>
    <a href="{{ route('admin.settings.index', ['category' => 'general']) }}" class="btn {{ $category == 'general' ? 'btn-primary' : 'btn-secondary' }}">General Info</a>
    <a href="{{ route('admin.settings.index', ['category' => 'seo']) }}" class="btn {{ $category == 'seo' ? 'btn-primary' : 'btn-secondary' }}">SEO & Social Meta</a>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{ ucfirst($category) }} Settings</h2>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PATCH')

            @foreach($settings as $setting)
                <div class="form-group" style="max-width: 800px;">
                    <label class="form-label">{{ $setting->label }}</label>
                    <small style="color: #6b7280; display: block; margin-bottom: 0.5rem; font-size: 0.75rem;">Key: {{ $setting->key }}</small>
                    
                    @if($setting->type == 'textarea')
                        <textarea name="settings[{{ $setting->key }}]" class="form-textarea" rows="4">{{ $setting->value }}</textarea>
                    @elseif($setting->type == 'email')
                        <input type="email" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}" class="form-input">
                    @elseif($setting->type == 'tel')
                        <input type="tel" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}" class="form-input">
                    @else
                        <input type="text" name="settings[{{ $setting->key }}]" value="{{ $setting->value }}" class="form-input">
                    @endif
                </div>
            @endforeach

            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #f3f4f6;">
                <button type="submit" class="btn btn-primary">Update All {{ ucfirst($category) }} Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
