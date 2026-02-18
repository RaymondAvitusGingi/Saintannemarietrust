<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\ImageService;

class NewsController extends Controller
{
    /**
     * Display a listing of the news
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new news article
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created news article
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'is_published' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['author'] = auth()->user()->name;
        $validated['is_published'] = $request->boolean('is_published');
        
        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = ImageService::uploadAndOptimize($request->file('image'), 'news');
            $validated['image'] = '/storage/' . $path;
        }

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'News article created successfully!');
    }

    /**
     * Show the form for editing the specified news article
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified news article
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');
        
        if ($validated['is_published'] && !$news->published_at) {
            $validated['published_at'] = now();
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists in storage
            if ($news->image && str_starts_with($news->image, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $news->image);
                Storage::disk('public')->delete($oldPath);
            }
            
            $path = ImageService::uploadAndOptimize($request->file('image'), 'news');
            $validated['image'] = '/storage/' . $path;
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'News article updated successfully!');
    }

    /**
     * Remove the specified news article
     */
    public function destroy(News $news)
    {
        // Delete image if exists
        if ($news->image && str_starts_with($news->image, '/storage/')) {
            $path = str_replace('/storage/', '', $news->image);
            Storage::disk('public')->delete($path);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'News article deleted successfully!');
    }
    // Calendar and EventsJson methods removed as they are now handled by EventController
}
