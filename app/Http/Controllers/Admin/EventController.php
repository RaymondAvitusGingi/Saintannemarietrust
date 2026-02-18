<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of events.
     */
    public function index()
    {
        $events = \App\Models\Event::latest('start_date')->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created event.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'time' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
        ]);

        $validated['is_public'] = $request->boolean('is_public');

        \App\Models\Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Show the form for editing the event.
     */
    public function edit(\App\Models\Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event.
     */
    public function update(Request $request, \App\Models\Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'time' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
        ]);

        $validated['is_public'] = $request->boolean('is_public');

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified event.
     */
    public function destroy(\App\Models\Event $event)
    {
        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully!');
    }

    /**
     * Show the admin calendar view.
     */
    public function calendar()
    {
        return view('admin.events.calendar');
    }

    /**
     * Get JSON events for FullCalendar.
     */
    public function eventsJson()
    {
        $events = \App\Models\Event::get()
            ->map(function($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'start' => $event->start_date->format('Y-m-d'),
                    'end' => $event->end_date ? $event->end_date->addDay()->format('Y-m-d') : null, // FullCalendar end date is exclusive
                    'url' => route('admin.events.edit', $event->id),
                    'color' => $event->is_public ? '#1e5128' : '#6b7280', // Green for public, Gray for private
                    'allDay' => true,
                ];
            });

        return response()->json($events);
    }
}
