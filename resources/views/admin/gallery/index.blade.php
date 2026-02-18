@extends('admin.layouts.app')

@section('page-title', 'Gallery Management')

@section('styles')
<style>
    .campus-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .campus-tab {
        padding: 0.5rem 1rem;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #6b7280;
        text-decoration: none;
        transition: all 0.2s;
    }

    .campus-tab:hover {
        border-color: #1e5128;
        color: #1e5128;
    }

    .campus-tab.active {
        background: #1e5128;
        border-color: #1e5128;
        color: white;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 1.5rem;
    }

    .gallery-item {
        position: relative;
        background: white;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        cursor: grab;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .gallery-item:active {
        cursor: grabbing;
    }

    .gallery-item.sortable-ghost {
        opacity: 0.4;
        transform: scale(0.95);
    }

    .gallery-item img {
        width: 100%;
        height: 160px;
        object-fit: cover;
        pointer-events: none;
    }

    .gallery-item-handle {
        position: absolute;
        top: 0.5rem;
        left: 0.5rem;
        width: 2rem;
        height: 2rem;
        border-radius: 0.375rem;
        background: rgba(0,0,0,0.5);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s;
        z-index: 10;
    }

    .gallery-item:hover .gallery-item-handle {
        opacity: 1;
    }

    .gallery-item {
        position: relative;
        background: white;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .gallery-item img {
        width: 100%;
        height: 140px;
        object-fit: cover;
    }

    .gallery-item-actions {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        display: flex;
        gap: 0.25rem;
        opacity: 0;
        transition: opacity 0.2s;
    }

    .gallery-item:hover .gallery-item-actions {
        opacity: 1;
    }

    .gallery-item-actions button {
        width: 2.5rem; /* Larger for touch */
        height: 2.5rem;
        border-radius: 0.375rem;
        border: none;
        background: rgba(0,0,0,0.7);
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gallery-item-actions button:hover {
        background: #dc2626;
    }

    /* Mobile refinements for gallery */
    @media (max-width: 768px) {
        .gallery-item-actions {
            opacity: 1; /* Always visible on mobile */
        }
        .gallery-item-handle {
            opacity: 1; /* Always visible on mobile */
            background: rgba(255,255,255,0.9);
            color: #1f2937;
        }
        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
            gap: 1rem;
        }
        .gallery-item img {
            height: 120px;
        }
    }

    .gallery-item-caption {
        padding: 0.75rem;
        font-size: 0.75rem;
        color: #6b7280;
    }
</style>
@endsection

@section('content')
<!-- Campus Tabs -->
<div class="campus-tabs">
    @foreach($campuses as $id => $name)
        <a href="{{ route('admin.gallery.index', ['campus' => $id]) }}" class="campus-tab {{ $currentCampus == $id ? 'active' : '' }}">
            {{ $name }}
        </a>
    @endforeach
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{ $campuses[$currentCampus] }} Gallery</h2>
        <a href="{{ route('admin.gallery.create') }}?campus={{ $currentCampus }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
            Upload Images
        </a>
    </div>
    <div class="card-body">
        @if($images->count() > 0)
            <div class="gallery-grid">
                @foreach($images as $image)
                    <div class="gallery-item" data-id="{{ $image->id }}">
                        <div class="gallery-item-handle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="5" r="1"/><circle cx="9" cy="12" r="1"/><circle cx="9" cy="19" r="1"/><circle cx="15" cy="5" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="19" r="1"/></svg>
                        </div>
                        <img src="{{ $image->image_url }}" alt="{{ $image->caption }}">
                        <div class="gallery-item-actions">
                            <form action="{{ route('admin.gallery.destroy', $image) }}" method="POST" onsubmit="return confirm('Delete this image?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                </button>
                            </form>
                        </div>
                        @if($image->caption)
                            <div class="gallery-item-caption">{{ $image->caption }}</div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div style="margin-top: 1.5rem;">
                {{ $images->appends(['campus' => $currentCampus])->links() }}
            </div>
        @else
            <div style="padding: 4rem; text-align: center; color: #6b7280;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#d1d5db" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 1rem;"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                <p style="margin-bottom: 1rem;">No images in this gallery yet.</p>
                <a href="{{ route('admin.gallery.create') }}?campus={{ $currentCampus }}" class="btn btn-primary">Upload First Images</a>
            </div>
        @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const grid = document.querySelector('.gallery-grid');
        if (grid) {
            new Sortable(grid, {
                animation: 150,
                ghostClass: 'sortable-ghost',
                handle: '.gallery-item-handle',
                onEnd: function() {
                    const ids = Array.from(grid.querySelectorAll('.gallery-item')).map(el => el.dataset.id);
                    
                    fetch('{{ route("admin.gallery.reorder") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ ids: ids })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Order updated');
                        }
                    });
                }
            });
        }
    });
</script>
@endsection
