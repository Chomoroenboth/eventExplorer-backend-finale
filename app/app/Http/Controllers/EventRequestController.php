<?php

namespace App\Http\Controllers;

use App\Models\EventRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EventRequestController extends Controller
{
    public function index(): View
    {
        $eventRequests = EventRequest::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('event-requests.index', compact('eventRequests'));
    }

    public function show(EventRequest $eventRequest): View
    {
        $eventRequest->load('category', 'requestedBy', 'approvedBy');
        return view('event-requests.show', compact('eventRequest'));
    }

    public function approve(EventRequest $eventRequest): RedirectResponse
    {
        $eventRequest->update([
            'approval_status' => 'approved',
            'approved_by' => auth()->id(),
        ]);

        return redirect()->back()
            ->with('success', 'Event request approved successfully.');
    }

    public function reject(EventRequest $eventRequest): RedirectResponse
    {
        $eventRequest->update([
            'approval_status' => 'rejected',
            'approved_by' => auth()->id(),
        ]);

        return redirect()->back()
            ->with('success', 'Event request rejected.');
    }
}