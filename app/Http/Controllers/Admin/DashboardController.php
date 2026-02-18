<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\GalleryImage;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function index()
    {
        $stats = [
            'total_news' => News::count(),
            'published_news' => News::published()->count(),
            'total_images' => GalleryImage::count(),
        ];

        $recentNews = News::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentNews'));
    }
}
