@extends('admin.layouts.app')

@section('page-title', 'Staff Management')

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

    .staff-row {
        cursor: grab;
    }

    .staff-row:active {
        cursor: grabbing;
    }

    .sortable-ghost {
        background: #f9fafb;
        opacity: 0.5;
    }

    /* Delete Modal Styles */
    .delete-modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .delete-modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .delete-modal {
        background: white;
        border-radius: 1rem;
        padding: 2rem;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        transform: scale(0.9) translateY(20px);
        transition: all 0.3s ease;
    }

    .delete-modal-overlay.active .delete-modal {
        transform: scale(1) translateY(0);
    }

    .delete-modal-icon {
        width: 4rem;
        height: 4rem;
        background: #fef2f2;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
    }

    .delete-modal-icon svg {
        width: 2rem;
        height: 2rem;
        color: #dc2626;
    }

    .delete-modal-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        text-align: center;
        margin-bottom: 0.5rem;
    }

    .delete-modal-message {
        color: #6b7280;
        text-align: center;
        margin-bottom: 1.5rem;
        line-height: 1.5;
    }

    .delete-modal-name {
        font-weight: 600;
        color: #111827;
    }

    .delete-modal-actions {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
    }

    .delete-modal-btn {
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s;
        border: none;
    }

    .delete-modal-btn-cancel {
        background: #f3f4f6;
        color: #374151;
    }

    .delete-modal-btn-cancel:hover {
        background: #e5e7eb;
    }

    .delete-modal-btn-delete {
        background: #dc2626;
        color: white;
    }

    .delete-modal-btn-delete:hover {
        background: #b91c1c;
    }
</style>
@endsection

@section('content')
<!-- Campus Tabs -->
<div class="campus-tabs">
    @foreach($campuses as $id => $name)
        <a href="{{ route('admin.staff.index', ['campus' => $id]) }}" class="campus-tab {{ $campusId == $id ? 'active' : '' }}">
            {{ $name }}
        </a>
    @endforeach
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">{{ $campuses[$campusId] }} - Staff Directory</h2>
        <a href="{{ route('admin.staff.create') }}?campus={{ $campusId }}" class="btn btn-primary">
            + Add Staff Member
        </a>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 40px;" class="hide-on-mobile"></th>
                        <th class="hide-on-xs">Photo</th>
                        <th>Name</th>
                        <th class="hide-on-mobile">Category</th>
                        <th class="hide-on-mobile">Title / Role</th>
                        <th class="hide-on-xs">Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="staff-tbody">
                    @forelse($staff as $member)
                        <tr class="staff-row" data-id="{{ $member->id }}">
                            <td class="drag-handle hide-on-mobile" style="color: #9ca3af; text-align: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="5" r="1"/><circle cx="9" cy="12" r="1"/><circle cx="9" cy="19" r="1"/><circle cx="15" cy="5" r="1"/><circle cx="15" cy="12" r="1"/><circle cx="15" cy="19" r="1"/></svg>
                            </td>
                            <td class="hide-on-xs">
                                <img src="{{ $member->image_url }}" alt="{{ $member->name }}" style="width: 3rem; height: 3rem; border-radius: 50%; object-fit: cover; background: #f3f4f6;">
                            </td>
                            <td>
                                <strong>{{ $member->name }}</strong>
                                <div class="hide-on-mobile" style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">{{ $member->title }}</div>
                            </td>
                            <td class="hide-on-mobile">
                                <span style="text-transform: capitalize; font-size: 0.875rem;">{{ $member->category }}</span>
                            </td>
                            <td class="hide-on-mobile">{{ $member->title }}</td>
                            <td class="hide-on-xs">
                                @if($member->is_active)
                                    <span style="color: #059669; background: #ecfdf5; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">Active</span>
                                @else
                                    <span style="color: #6b7280; background: #f3f4f6; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.staff.edit', $member) }}" class="btn btn-secondary btn-sm">Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm delete-trigger" 
                                        style="background: transparent; border: none; color: #dc2626;"
                                        data-name="{{ $member->name }}"
                                        data-action="{{ route('admin.staff.destroy', $member) }}">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 3rem; text-align: center; color: #6b7280;">
                                No staff members found for this campus.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($staff->count() > 0)
    <div style="margin-top: 1.5rem;">
        {{ $staff->appends(['campus' => $campusId])->links() }}
    </div>
@endif

<!-- Delete Confirmation Modal -->
<div class="delete-modal-overlay" id="deleteModal">
    <div class="delete-modal">
        <div class="delete-modal-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
            </svg>
        </div>
        <h3 class="delete-modal-title">Remove Staff Member</h3>
        <p class="delete-modal-message">
            Are you sure you want to remove <span class="delete-modal-name" id="deleteModalName"></span>? This action cannot be undone.
        </p>
        <div class="delete-modal-actions">
            <button type="button" class="delete-modal-btn delete-modal-btn-cancel" id="deleteModalCancel">Cancel</button>
            <form id="deleteModalForm" method="POST" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-modal-btn delete-modal-btn-delete">Yes, Remove</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sortable functionality
        const tbody = document.getElementById('staff-tbody');
        if (tbody) {
            new Sortable(tbody, {
                animation: 150,
                ghostClass: 'sortable-ghost',
                handle: '.drag-handle',
                onEnd: function() {
                    const ids = Array.from(tbody.querySelectorAll('.staff-row')).map(el => el.dataset.id);
                    
                    fetch('{{ route("admin.staff.reorder") }}', {
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

        // Delete Modal functionality
        const deleteModal = document.getElementById('deleteModal');
        const deleteModalName = document.getElementById('deleteModalName');
        const deleteModalForm = document.getElementById('deleteModalForm');
        const deleteModalCancel = document.getElementById('deleteModalCancel');
        const deleteButtons = document.querySelectorAll('.delete-trigger');

        // Open modal when delete button is clicked
        deleteButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const name = this.dataset.name;
                const action = this.dataset.action;
                
                deleteModalName.textContent = name;
                deleteModalForm.action = action;
                deleteModal.classList.add('active');
            });
        });

        // Close modal on cancel
        deleteModalCancel.addEventListener('click', function() {
            deleteModal.classList.remove('active');
        });

        // Close modal when clicking outside
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                deleteModal.classList.remove('active');
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && deleteModal.classList.contains('active')) {
                deleteModal.classList.remove('active');
            }
        });
    });
</script>
@endsection
