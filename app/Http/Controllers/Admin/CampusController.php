<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class CampusController extends Controller
{
    public function index()
    {
        $campuses = Campus::orderBy('order')->get();
        return view('admin.campuses.index', compact('campuses'));
    }

    public function edit(Campus $campus)
    {
        return view('admin.campuses.edit', compact('campus'));
    }

    public function update(Request $request, Campus $campus)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'motto' => 'nullable|string|max:255',
            'level' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'ranking' => 'nullable|string|max:255',
            'acreage' => 'nullable|string|max:255',
            'registration' => 'nullable|string|max:255',
            'mission' => 'nullable|string',
            'vision' => 'nullable|string',
            'headmaster' => 'nullable|string|max:255',
            'combinations' => 'nullable|string',
            'history' => 'nullable|string',
            'environment' => 'nullable|string',
            'image_file' => 'nullable|image|max:5120',
            'logo_file' => 'nullable|image|max:2048',
            'rules' => 'nullable|array',
            'rules.*' => 'nullable|string|max:500',
            'routine_time' => 'nullable|array',
            'routine_activity' => 'nullable|array',
        ]);

        // Process Rules (filter empty)
        if (isset($validated['rules'])) {
            $validated['rules'] = array_values(array_filter($validated['rules']));
        }

        // Process Routine
        if (isset($request->routine_time) && isset($request->routine_activity)) {
            $routine = [];
            foreach ($request->routine_time as $index => $time) {
                if (!empty($time) || !empty($request->routine_activity[$index])) {
                    $routine[] = [
                        'time' => $time,
                        'activity' => $request->routine_activity[$index] ?? ''
                    ];
                }
            }
            $validated['routine'] = $routine;
        }

        // Clean up helper arrays
        unset($validated['routine_time'], $validated['routine_activity']);

        // Handle image upload
        if ($request->hasFile('image_file')) {
            // Delete old image if it exists in storage
            if ($campus->image && str_starts_with($campus->image, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $campus->image);
                Storage::disk('public')->delete($oldPath);
            }
            
            $path = ImageService::uploadAndOptimize($request->file('image_file'), 'campuses');
            $validated['image'] = '/storage/' . $path;
        }

        // Handle logo upload
        if ($request->hasFile('logo_file')) {
            // Delete old logo if it exists in storage
            if ($campus->logo && str_starts_with($campus->logo, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $campus->logo);
                Storage::disk('public')->delete($oldPath);
            }

            $path = ImageService::uploadAndOptimize($request->file('logo_file'), 'campuses/logos', 400); // Smaller size for logos
            $validated['logo'] = '/storage/' . $path;
        }

        $campus->update($validated);

        return redirect()->route('admin.campuses.index')->with('success', 'Campus updated successfully!');
    }

    /**
     * Reorder campuses
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:campuses,id',
        ]);

        foreach ($request->input('ids') as $index => $id) {
            Campus::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
