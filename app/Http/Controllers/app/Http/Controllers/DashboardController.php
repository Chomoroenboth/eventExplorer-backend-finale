<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_events' => Event::count(),
            'pending_events' => Event::pending()->count(),
            'approved_events' => Event::approved()->count(),
            'total_proposals' => EventRequest::count(),
            'pending_proposals' => EventRequest::pending()->count(),
            'total_categories' => Category::count(),
            'total_users' => User::count(),
        ];

        $recent_events = Event::with('category')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $pending_proposals = EventRequest::with('category')
            ->pending()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('dashboard.index', compact('stats', 'recent_events', 'pending_proposals'));
    }
}