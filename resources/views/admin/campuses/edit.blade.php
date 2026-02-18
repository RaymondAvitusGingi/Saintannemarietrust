@extends('admin.layouts.app')

@section('page-title', 'Edit Campus: ' . $campus->name)

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Campus Details</h2>
        <a href="{{ route('admin.campuses.index') }}" class="btn btn-secondary btn-sm">← Back to List</a>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.campuses.update', $campus) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                
                <!-- Basic Info -->
                <div>
                    <h3 style="font-size: 1.125rem; margin-bottom: 1.5rem; color: var(--primary); border-bottom: 2px solid #f3f4f6; padding-bottom: 0.5rem;">Basic Information</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Campus Name</label>
                        <input type="text" name="name" value="{{ old('name', $campus->name) }}" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">School Motto</label>
                        <input type="text" name="motto" value="{{ old('motto', $campus->motto) }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Academic Levels (e.g., Nursery to A-Level)</label>
                        <input type="text" name="level" value="{{ old('level', $campus->level) }}" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Main Image</label>
                        @if($campus->image)
                            <img src="{{ $campus->image }}" style="width: 100%; height: 150px; object-fit: cover; border-radius: 0.5rem; margin-bottom: 0.5rem;">
                        @endif
                        <input type="file" name="image_file" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Campus Logo</label>
                        @if($campus->logo)
                            <img src="{{ $campus->logo }}" style="width: 80px; height: 80px; object-fit: contain; margin-bottom: 0.5rem;">
                        @endif
                        <input type="file" name="logo_file" class="form-input">
                    </div>
                </div>

                <!-- Contact & Logistics -->
                <div>
                    <h3 style="font-size: 1.125rem; margin-bottom: 1.5rem; color: var(--primary); border-bottom: 2px solid #f3f4f6; padding-bottom: 0.5rem;">Contact & Logistics</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Location Description</label>
                        <input type="text" name="location" value="{{ old('location', $campus->location) }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Physical Address / Box</label>
                        <input type="text" name="address" value="{{ old('address', $campus->address) }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Direct Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $campus->phone) }}" class="form-input">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Official Email</label>
                        <input type="email" name="email" value="{{ old('email', $campus->email) }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">NECTA Ranking Highlights</label>
                        <input type="text" name="ranking" value="{{ old('ranking', $campus->ranking) }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Campus Acreage</label>
                        <input type="text" name="acreage" value="{{ old('acreage', $campus->acreage) }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Registration Body</label>
                        <input type="text" name="registration" value="{{ old('registration', $campus->registration) }}" class="form-input">
                    </div>
                </div>

                <!-- Detailed Content -->
                <div style="grid-column: 1 / -1;">
                    <h3 style="font-size: 1.125rem; margin-bottom: 1.5rem; color: var(--primary); border-bottom: 2px solid #f3f4f6; padding-bottom: 0.5rem;">Detailed Content</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Mission Statement</label>
                        <textarea name="mission" class="form-textarea">{{ old('mission', $campus->mission) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Vision Statement</label>
                        <textarea name="vision" class="form-textarea">{{ old('vision', $campus->vision) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Headmaster's Name/Title</label>
                        <input type="text" name="headmaster" value="{{ old('headmaster', $campus->headmaster) }}" class="form-input">
                    </div>

                    <div class="form-group">
                        <label class="form-label">A-Level Combinations (Comma separated)</label>
                        <textarea name="combinations" class="form-textarea" rows="2">{{ old('combinations', $campus->combinations) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">History & Facilities</label>
                        <textarea name="history" class="form-textarea">{{ old('history', $campus->history) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">School Environment Description</label>
                        <textarea name="environment" class="form-textarea">{{ old('environment', $campus->environment) }}</textarea>
                    </div>

                    <!-- Campus Rules Editor -->
                    <div class="rules-editor-wrapper" style="background: #f9fafb; padding: 1.5rem; border-radius: 0.75rem; margin-top: 2rem; border: 1px solid #e5e7eb;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <h4 style="margin: 0; color: #374151; font-weight: 700;">School Rules</h4>
                            <button type="button" id="add-rule-btn" class="btn btn-secondary btn-sm" style="background: white; border: 1px solid #d1d5db;">+ Add Rule</button>
                        </div>
                        <div id="rules-container" style="display: flex; flex-direction: column; gap: 0.5rem;">
                            @php $rules = old('rules', $campus->rules ?? []); @endphp
                            @forelse($rules as $rule)
                                <div class="rule-row" style="display: flex; gap: 0.5rem;">
                                    <input type="text" name="rules[]" value="{{ $rule }}" class="form-input" placeholder="e.g. Mobile phones are prohibited">
                                    <button type="button" class="remove-row" style="background: #fee2e2; color: #dc2626; border: none; padding: 0 0.75rem; border-radius: 0.375rem; cursor: pointer;">&times;</button>
                                </div>
                            @empty
                                <div class="rule-row" style="display: flex; gap: 0.5rem;">
                                    <input type="text" name="rules[]" value="" class="form-input" placeholder="e.g. Punctuality is mandatory">
                                    <button type="button" class="remove-row" style="background: #fee2e2; color: #dc2626; border: none; padding: 0 0.75rem; border-radius: 0.375rem; cursor: pointer;">&times;</button>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Daily Routine Editor -->
                    <div class="routine-editor-wrapper" style="background: #f9fafb; padding: 1.5rem; border-radius: 0.75rem; margin-top: 2rem; border: 1px solid #e5e7eb;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <h4 style="margin: 0; color: #374151; font-weight: 700;">Daily Routine</h4>
                            <button type="button" id="add-routine-btn" class="btn btn-secondary btn-sm" style="background: white; border: 1px solid #d1d5db;">+ Add Item</button>
                        </div>
                        <div id="routine-container" style="display: flex; flex-direction: column; gap: 0.5rem;">
                            @php $routine = old('routine', $campus->routine ?? []); @endphp
                            @forelse($routine as $item)
                                <div class="routine-row" style="display: flex; gap: 0.5rem;">
                                    <input type="text" name="routine_time[]" value="{{ $item['time'] ?? '' }}" class="form-input" placeholder="Time (e.g. 7:30 AM)" style="width: 150px;">
                                    <input type="text" name="routine_activity[]" value="{{ $item['activity'] ?? '' }}" class="form-input" placeholder="Activity (e.g. Assembly)">
                                    <button type="button" class="remove-row" style="background: #fee2e2; color: #dc2626; border: none; padding: 0 0.75rem; border-radius: 0.375rem; cursor: pointer;">&times;</button>
                                </div>
                            @empty
                                <div class="routine-row" style="display: flex; gap: 0.5rem;">
                                    <input type="text" name="routine_time[]" value="" class="form-input" placeholder="Time" style="width: 150px;">
                                    <input type="text" name="routine_activity[]" value="" class="form-input" placeholder="Activity">
                                    <button type="button" class="remove-row" style="background: #fee2e2; color: #dc2626; border: none; padding: 0 0.75rem; border-radius: 0.375rem; cursor: pointer;">&times;</button>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #f3f4f6;">
                <button type="submit" class="btn btn-primary">Save Campus Changes</button>
            </div>
        </form>
    </div>
</div>
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Generic row removal
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-row')) {
                const container = e.target.closest('#rules-container, #routine-container');
                if (container.children.length > 1) {
                    e.target.parentElement.remove();
                } else {
                    const inputs = e.target.parentElement.querySelectorAll('input');
                    inputs.forEach(input => input.value = '');
                }
            }
        });

        // Add Rule row
        document.getElementById('add-rule-btn').addEventListener('click', function() {
            const container = document.getElementById('rules-container');
            const newRow = document.createElement('div');
            newRow.className = 'rule-row';
            newRow.style.cssText = 'display: flex; gap: 0.5rem; margin-top: 0.5rem;';
            newRow.innerHTML = `
                <input type="text" name="rules[]" value="" class="form-input" placeholder="e.g. Mobile phones are prohibited">
                <button type="button" class="remove-row" style="background: #fee2e2; color: #dc2626; border: none; padding: 0 0.75rem; border-radius: 0.375rem; cursor: pointer;">&times;</button>
            `;
            container.appendChild(newRow);
        });

        // Add Routine row
        document.getElementById('add-routine-btn').addEventListener('click', function() {
            const container = document.getElementById('routine-container');
            const newRow = document.createElement('div');
            newRow.className = 'routine-row';
            newRow.style.cssText = 'display: flex; gap: 0.5rem; margin-top: 0.5rem;';
            newRow.innerHTML = `
                <input type="text" name="routine_time[]" value="" class="form-input" placeholder="Time" style="width: 150px;">
                <input type="text" name="routine_activity[]" value="" class="form-input" placeholder="Activity">
                <button type="button" class="remove-row" style="background: #fee2e2; color: #dc2626; border: none; padding: 0 0.75rem; border-radius: 0.375rem; cursor: pointer;">&times;</button>
            `;
            container.appendChild(newRow);
        });
    });
</script>
@endsection
