<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\Campus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;

class GalleryController extends Controller
{
    /**
     * Display a listing of gallery images
     */
    public function index(Request $request)
    {
        $campuses = Campus::orderBy('order')->pluck('name', 'slug');
        $campusId = $request->get('campus', $campuses->keys()->first() ?? 'st-anne-marie');
        
        $images = GalleryImage::forCampus($campusId)->paginate(20);
        
        return view('admin.gallery.index', [
            'images' => $images,
            'campuses' => $campuses,
            'currentCampus' => $campusId,
        ]);
    }

    /**
     * Show the form for uploading images
     */
    public function create()
    {
        return view('admin.gallery.create', [
            'campuses' => Campus::orderBy('order')->pluck('name', 'slug'),
        ]);
    }

    /**
     * Store newly uploaded images
     */
    public function store(Request $request)
    {
        $campuses = Campus::pluck('slug')->toArray();
        
        $request->validate([
            'campus_id' => 'required|string|in:' . implode(',', $campuses),
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'captions' => 'nullable|array',
        ]);

        $campusId = $request->input('campus_id');
        $captions = $request->input('captions', []);
        $maxOrder = GalleryImage::where('campus_id', $campusId)->max('order') ?? 0;

        foreach ($request->file('images') as $index => $image) {
            $path = ImageService::uploadAndOptimize($image, 'gallery/' . $campusId);
            
            GalleryImage::create([
                'campus_id' => $campusId,
                'image_path' => $path,
                'caption' => $captions[$index] ?? null,
                'order' => ++$maxOrder,
            ]);
        }

        return redirect()->route('admin.gallery.index', ['campus' => $campusId])
            ->with('success', 'Images uploaded successfully!');
    }

    /**
     * Update image details
     */
    public function update(Request $request, GalleryImage $galleryImage)
    {
        $validated = $request->validate([
            'caption' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ]);

        $galleryImage->update($validated);

        return redirect()->back()->with('success', 'Image updated successfully!');
    }

    /**
     * Remove the specified image
     */
    public function destroy(GalleryImage $galleryImage)
    {
        $campusId = $galleryImage->campus_id;
        
        // Delete the file
        Storage::disk('public')->delete($galleryImage->image_path);
        
        // Delete the record
        $galleryImage->delete();

        return redirect()->route('admin.gallery.index', ['campus' => $campusId])
            ->with('success', 'Image deleted successfully!');
    }

    /**
     * Bulk delete images
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:gallery_images,id',
        ]);

        $images = GalleryImage::whereIn('id', $request->input('ids'))->get();
        $campusId = $images->first()?->campus_id ?? 'st-anne-marie';

        foreach ($images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        return redirect()->route('admin.gallery.index', ['campus' => $campusId])
            ->with('success', count($images) . ' images deleted successfully!');
    }

    /**
     * Reorder images
     */
    public function reorder(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:gallery_images,id',
        ]);

        foreach ($request->input('ids') as $index => $id) {
            GalleryImage::where('id', $id)->update(['order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
