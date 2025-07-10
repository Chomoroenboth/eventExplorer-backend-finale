@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Events</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_events'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Approved Events</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['approved_events'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pending Events</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending_events'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-paper-plane text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Proposals</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_proposals'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Events -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Events</h3>
                    <a href="{{ route('events.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                </div>
            </div>
            <div class="p-6">
                @if($recent_events->count() > 0)
                    <div class="space-y-4">
                        @foreach($recent_events as $event)
                            <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: {{ $event->category->color ?? '#3B82F6' }}20;">
                                        <i class="{{ $event->category->icon ?? 'fas fa-calendar' }} text-sm" style="color: {{ $event->category->color ?? '#3B82F6' }};"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $event->title }}</p>
                                    <p class="text-sm text-gray-500">{{ $event->category->name ?? 'Uncategorized' }}</p>
                                    <p class="text-xs text-gray-400">{{ $event->start_datetime->format('M d, Y') }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        @if($event->approval_status === 'approved') bg-green-100 text-green-800
                                        @elseif($event->approval_status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($event->approval_status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">No events found</p>
                @endif
            </div>
        </div>

        <!-- Pending Proposals -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Pending Proposals</h3>
                    <a href="{{ route('event-requests.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                </div>
            </div>
            <div class="p-6">
                @if($pending_proposals->count() > 0)
                    <div class="space-y-4">
                        @foreach($pending_proposals as $proposal)
                            <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg transition-colors">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: {{ $proposal->category->color ?? '#F59E0B' }}20;">
                                        <i class="{{ $proposal->category->icon ?? 'fas fa-clock' }} text-sm" style="color: {{ $proposal->category->color ?? '#F59E0B' }};"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $proposal->title }}</p>
                                    <p class="text-sm text-gray-500">{{ $proposal->category->name ?? 'Uncategorized' }}</p>
                                    <p class="text-xs text-gray-400">{{ $proposal->start_datetime->format('M d, Y') }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <a href="{{ route('event-requests.show', $proposal) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Review
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">No pending proposals</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('events.create') }}" class="flex items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-plus text-white"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">Create Event</p>
                    <p class="text-sm text-gray-500">Add a new event</p>
                </div>
            </a>

            <a href="{{ route('event-requests.index') }}" class="flex items-center p-4 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition-colors">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-yellow-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-white"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">Review Proposals</p>
                    <p class="text-sm text-gray-500">{{ $stats['pending_proposals'] }} pending</p>
                </div>
            </a>

            <a href="{{ route('events.index') }}" class="flex items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-list text-white"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">View All Events</p>
                    <p class="text-sm text-gray-500">Browse events</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection 