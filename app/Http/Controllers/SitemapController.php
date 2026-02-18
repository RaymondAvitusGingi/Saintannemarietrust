<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Response;
use App\Models\News;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $campuses = Campus::all();
        $news = News::published()->latest()->get();

        return response()->view('sitemap', [
            'campuses' => $campuses,
            'news' => $news,
        ])->header('Content-Type', 'text/xml');
    }
}
