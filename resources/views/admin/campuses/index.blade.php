@extends('admin.layouts.app')

@section('page-title', 'Campus Management')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">School Campuses</h2>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 40px;" class="hide-on-mobile"></th>
                        <th class="hide-on-xs">Logo</th>
                        <th>Campus Name</th>
                        <th class="hide-on-mobile">Level</th>
                        <th class="hide-on-mobile">Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campuses as $campus)
                        <tr class="campus-row" data-id="{{ $campus->id }}" style="cursor: grab;">
                            <td class="drag-handle hide-on-mobile" style="color: #9ca3af; text-align: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="5" r="1"/><circle cx="9" cy="12" r="1"/><circle cx="9" cy="19" r="1"/><circle cx="15" cy="5" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="19" r="1"/></svg>
                            </td>
                            <td class="hide-on-xs">
                                @if($campus->logo)
                                    <img src="{{ $campus->logo }}" alt="" style="width: 3rem; height: 3rem; object-fit: contain;">
                                @else
                                    <div style="width: 3rem; height: 3rem; background: #f3f4f6; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; color: #9ca3af;">No Logo</div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $campus->name }}</strong>
                                <div class="hide-on-mobile" style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">{{ $campus->location }}</div>
                            </td>
                            <td class="hide-on-mobile">{{ $campus->level }}</td>
                            <td class="hide-on-mobile">{{ $campus->location }}</td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.campuses.edit', $campus) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    <a href="{{ url('/campuses/' . $campus->slug) }}" target="_blank" class="btn btn-secondary btn-sm hide-on-xs">View</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tbody = document.querySelector('tbody');
        if (tbody) {
            new Sortable(tbody, {
                animation: 150,
                ghostClass: 'sortable-ghost',
                handle: '.drag-handle',
                onEnd: function() {
                    const ids = Array.from(tbody.querySelectorAll('.campus-row')).map(el => el.dataset.id);
                    
                    fetch('{{ route("admin.campuses.reorder") }}', {
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
<style>
    .sortable-ghost {
        background-color: #f9fafb !important;
        opacity: 0.5;
    }
    .campus-row:active {
        cursor: grabbing !important;
    }
</style>
@endsection
