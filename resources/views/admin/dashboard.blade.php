@extends('admin.layouts.app')

@section('page-title', 'Dashboard')

@section('content')
<div class="dashboard-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
    <!-- Stats Cards -->
    <div class="stat-card" style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="width: 3rem; height: 3rem; background: #d1fae5; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#065f46" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6Z"/></svg>
            </div>
            <div>
                <div style="font-size: 2rem; font-weight: 800; color: #1f2937;">{{ $stats['total_news'] }}</div>
                <div style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">Total News</div>
            </div>
        </div>
    </div>

    <div class="stat-card" style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="width: 3rem; height: 3rem; background: #dbeafe; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1d4ed8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
            </div>
            <div>
                <div style="font-size: 2rem; font-weight: 800; color: #1f2937;">{{ $stats['published_news'] }}</div>
                <div style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">Published</div>
            </div>
        </div>
    </div>

    <div class="stat-card" style="background: white; border-radius: 1rem; padding: 1.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <div style="display: flex; align-items: center; gap: 1rem;">
            <div style="width: 3rem; height: 3rem; background: #fef3c7; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
            </div>
            <div>
                <div style="font-size: 2rem; font-weight: 800; color: #1f2937;">{{ $stats['total_images'] }}</div>
                <div style="font-size: 0.75rem; color: #6b7280; text-transform: uppercase; font-weight: 600;">Gallery Images</div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card" style="margin-bottom: 2rem;">
    <div class="card-header">
        <h2 class="card-title">Quick Actions</h2>
    </div>
    <div class="card-body" style="display: flex; gap: 1rem; flex-wrap: wrap;">
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Add News Article
        </a>
        <a href="{{ route('admin.gallery.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
            Upload Gallery Images
        </a>
        <a href="{{ url('/') }}" class="btn btn-secondary" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" x2="21" y1="14" y2="3"/></svg>
            View Website
        </a>
    </div>
</div>

<!-- Recent News -->
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Recent News</h2>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary btn-sm">View All</a>
    </div>
    <div class="card-body" style="padding: 0;">
        @if($recentNews->count() > 0)
            <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th class="hide-on-mobile">Category</th>
                        <th class="hide-on-xs">Status</th>
                        <th class="hide-on-mobile">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentNews as $news)
                        <tr>
                            <td>
                                <a href="{{ route('admin.news.edit', $news) }}" style="color: #1e5128; font-weight: 600; text-decoration: none;">
                                    {{ Str::limit($news->title, 40) }}
                                </a>
                            </td>
                            <td class="hide-on-mobile">
                                <span style="background: #f3f4f6; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem;">
                                    {{ $news->category }}
                                </span>
                            </td>
                            <td class="hide-on-xs">
                                @if($news->is_published)
                                    <span style="background: #d1fae5; color: #065f46; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 600;">Published</span>
                                @else
                                    <span style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 600;">Draft</span>
                                @endif
                            </td>
                            <td class="hide-on-mobile" style="color: #6b7280; font-size: 0.875rem;">
                                {{ $news->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
            <div style="padding: 3rem; text-align: center; color: #6b7280;">
                <p>No news articles yet.</p>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary" style="margin-top: 1rem;">Create First Article</a>
            </div>
        @endif
    </div>
</div>
@endsection
