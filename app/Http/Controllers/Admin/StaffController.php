<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Campus;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    /**
     * Display a listing of staff by campus
     */
    public function index(Request $request)
    {
        $campuses = Campus::orderBy('order')->pluck('name', 'id');
        $campusId = $request->get('campus', $campuses->keys()->first());
        
        $staff = Staff::where('campus_id', $campusId)->orderBy('order')->paginate(20);
        
        return view('admin.staff.index', compact('staff', 'campuses', 'campusId'));
    }

    /**
     * Show the form for creating a new staff member
     */
    public function create()
    {
        return view('admin.staff.create', [
            'campuses' => Campus::orderBy('order')->pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created staff member
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'campus_id' => 'required|exists:campuses,id',
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:leadership,staff',
            'bio' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order'] = Staff::where('campus_id', $validated['campus_id'])->max('order') + 1;

        if ($request->hasFile('image_file')) {
            $path = ImageService::uploadAndOptimize($request->file('image_file'), 'staff', 400); // Thumbnails for staff
            $validated['image'] = $path;
        }

        Staff::create($validated);

        return redirect()->route('admin.staff.index', ['campus' => $validated['campus_id']])
            ->with('success', 'Staff member added successfully!');
    }

    /**
     * Show the form for editing the specified staff member
     */
    public function edit(Staff $staff)
    {
        return view('admin.staff.edit', [
            'staff' => $staff,
            'campuses' => Campus::orderBy('order')->pluck('name', 'id'),
        ]);
    }

    /**
     * Update the specified staff member
     */
    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'campus_id' => 'required|exists:campuses,id',
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:leadership,staff',
            'bio' => 'nullable|string',
            'image_file' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image_file')) {
            if ($staff->image) {
                Storage::disk('public')->delete($staff->image);
            }
            $path = ImageService::uploadAndOptimize($request->file('image_file'), 'staff', 400);
            $validated['image'] = $path;
        }

        $staff->update($validated);

        return redirect()->route('admin.staff.index', ['campus' => $validated['campus_id']])
            ->with('success', 'Staff member updated successfully!');
    }

    /**
     * Remove the specified staff member
     */
    public function destroy(Staff $staff)
    {
        $campusId = $staff->campus_id;
        
        if ($staff->image) {
            Storage::disk('public')->delete($staff->image);
        }
        
        $staff->delete();

        return redirect()->route('admin.staff.index', ['campus' => $campusId])
            ->with('success', 'Staff member removed successfully!');
    }

    /**
     * Reorder staff members
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:staff,id',
        ]);

        foreach ($request->input('ids') as $index => $id) {
            Staff::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
