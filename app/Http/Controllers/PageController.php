<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\News;
use App\Models\GalleryImage;
use App\Models\Campus;
use App\Models\SiteSetting;
use App\Models\Staff;

class PageController extends Controller
{
    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:20',
            'message'    => 'required|string',
        ]);

        $recipient = 'stannemarieacademy@gmail.com';
        $subject = 'New Contact Message from ' . $validated['first_name'] . ' ' . $validated['last_name'];
        
        $body = "Name: " . $validated['first_name'] . " " . $validated['last_name'] . "\n";
        $body .= "Email: " . $validated['email'] . "\n";
        $body .= "Phone: " . ($validated['phone'] ?? 'N/A') . "\n\n";
        $body .= "Message:\n" . $validated['message'];

        // Send plain text email
        Mail::raw($body, function ($message) use ($recipient, $subject, $validated) {
            $message->to($recipient)
                    ->subject($subject)
                    ->replyTo($validated['email']);
        });

        return back()->with('success', 'Thank you for your message. We will get back to you shortly.');
    }

    public function home()
    {
        $campuses = Campus::orderBy('order')->get();
        $newsItems = News::published()->latest()->take(3)->get();
        
        return view('home', [
            'campuses' => $campuses,
            'newsItems' => $newsItems
        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function campuses()
    {
        $campuses = Campus::orderBy('order')->get();
        return view('campuses', ['campuses' => $campuses]);
    }

    public function campusDetail($slug)
    {
        $campus = Campus::where('slug', $slug)->firstOrFail();
        $images = GalleryImage::where('campus_id', $slug)->latest()->take(6)->get();
        
        return view('campuses.show', compact('campus', 'images'));
    }

    public function admissions()
    {
        $campuses = Campus::orderBy('order')->get();
        return view('admissions', ['campuses' => $campuses]);
    }

    public function contact()
    {
        $settings = SiteSetting::where('category', 'contact')->pluck('value', 'key');
        return view('contact', compact('settings'));
    }

    public function newsDetail($slug)
    {
        $news = News::published()->where('slug', $slug)->firstOrFail();

        return view('news.show', ['news' => $news]);
    }

    public function news()
    {
        $newsItems = News::published()->latest()->get();
        return view('news', ['newsItems' => $newsItems]);
    }

    public function academics()
    {
        $settings = SiteSetting::where('category', 'academics')->pluck('value', 'key');
        return view('academics', compact('settings'));
    }

    public function gallery()
    {
        $campuses = Campus::orderBy('order')->get();
        return view('gallery', ['campuses' => $campuses]);
    }

    public function galleryDetail($slug)
    {
        $campus = Campus::where('slug', $slug)->firstOrFail();

        // Fetch gallery images from database for this campus
        $images = GalleryImage::where('campus_id', $slug)->orderBy('order')->get();

        return view('gallery.show', compact('campus', 'images'));
    }

    public function administration()
    {
        $settings = SiteSetting::pluck('value', 'key');
        return view('administration', compact('settings'));
    }

    public function staff()
    {
        $campuses = Campus::with(['activeStaff' => function($query) {
            $query->orderBy('order');
        }])->orderBy('order')->get();
        
        return view('staff', compact('campuses'));
    }

    public function eventsJson()
    {
        $events = \App\Models\Event::where('is_public', true)
            ->get()
            ->map(function($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->start_date->format('Y-m-d'),
                    'end' => $event->end_date ? $event->end_date->addDay()->format('Y-m-d') : null,
                    'time' => $event->time,
                    'location' => $event->location,
                    'description' => $event->description,
                    'color' => '#1e5128', // Use brand primary color for events check
                ];
            });

        return response()->json($events);
    }
}
