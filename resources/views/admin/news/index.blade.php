@extends('admin.layouts.app')

@section('page-title', 'News & Events')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">All News Articles</h2>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
            Add New Article
        </a>
    </div>
    <div class="card-body" style="padding: 0;">
        @if($news->count() > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="hide-on-xs">Image</th>
                        <th>Title</th>
                        <th class="hide-on-mobile">Category</th>
                        <th class="hide-on-mobile">Status</th>
                        <th class="hide-on-mobile">Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $article)
                        <tr>
                            <td class="hide-on-xs">
                                @if($article->image)
                                    <img src="{{ $article->image }}" alt="" style="width: 4rem; height: 3rem; object-fit: cover; border-radius: 0.375rem;">
                                @else
                                    <div style="width: 4rem; height: 3rem; background: #f3f4f6; border-radius: 0.375rem; display: flex; align-items: center; justify-content: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.news.edit', $article) }}" style="color: #1e5128; font-weight: 600; text-decoration: none;">
                                    {{ Str::limit($article->title, 50) }}
                                </a>
                            </td>
                            <td class="hide-on-mobile">
                                <span style="background: #f3f4f6; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem;">
                                    {{ $article->category }}
                                </span>
                            </td>
                            <td class="hide-on-mobile">
                                @if($article->is_published)
                                    <span style="background: #d1fae5; color: #065f46; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 600;">Published</span>
                                @else
                                    <span style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 600;">Draft</span>
                                @endif
                            </td>
                            <td class="hide-on-mobile" style="color: #6b7280; font-size: 0.875rem;">
                                {{ $article->formatted_date }}
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.news.edit', $article) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    <form action="{{ route('admin.news.destroy', $article) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
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
                {{ $news->links() }}
            </div>
        @else
            <div style="padding: 4rem; text-align: center; color: #6b7280;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 1rem;"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6Z"/></svg>
                <p style="margin-bottom: 1rem;">No news articles yet. Create your first one!</p>
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary">Create First Article</a>
            </div>
        @endif
    </div>
</div>
@endsection
