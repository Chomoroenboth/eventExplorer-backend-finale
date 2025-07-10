<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('events.index', compact('events'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $areas = ['Toul Kork', 'BKK', 'Sen Sok', 'Factory', 'Phnom Penh'];
        $eventTypes = ['concert', 'job_fair', 'late_night', 'festival', 'charity'];
        
        return view('events.create', compact('categories', 'areas', 'eventTypes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'nullable|date|after:start_datetime',
            'location' => 'required|string|max:255',
            'area' => 'required|string',
            'event_type' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_free' => 'boolean',
            'price' => 'nullable|numeric|min:0',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')
            ->with('success', 'Event created successfully.');
    }

    public function show(Event $event): View
    {
        $event->load('category', 'approvedBy');
        return view('events.show', compact('event'));
    }

    public function edit(Event $event): View
    {
        $categories = Category::orderBy('name')->get();
        $areas = ['Toul Kork', 'BKK', 'Sen Sok', 'Factory', 'Phnom Penh'];
        $eventTypes = ['concert', 'job_fair', 'late_night', 'festival', 'charity'];
        
        return view('events.edit', compact('event', 'categories', 'areas', 'eventTypes'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'nullable|date|after:start_datetime',
            'location' => 'required|string|max:255',
            'area' => 'required|string',
            'event_type' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_free' => 'boolean',
            'price' => 'nullable|numeric|min:0',
        ]);

        $event->update($validated);

        return redirect()->route('events.show', $event)
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Event deleted successfully.');
    }
}