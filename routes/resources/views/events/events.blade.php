@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="space-y-6">
    <!-- Header with Create Button -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Events</h2>
            <p class="text-gray-600">Manage all events in the system</p>
        </div>
        <a href="{{ route('events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Create Event
        </a>
    </div>

    <!-- Events Grid -->
    @if($events->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($events as $event)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Event Header -->
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: {{ $event->category->color ?? '#3B82F6' }}20;">
                                    <i class="{{ $event->category->icon ?? 'fas fa-calendar' }} text-lg" style="color: {{ $event->category->color ?? '#3B82F6' }};"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 text-lg">{{ $event->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $event->category->name ?? 'Uncategorized' }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($event->approval_status === 'approved') bg-green-100 text-green-800
                                @elseif($event->approval_status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($event->approval_status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Event Details -->
                    <div class="p-4 space-y-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-calendar mr-2"></i>
                            {{ $event->start_datetime->format('M d, Y \a\t g:i A') }}
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $event->location }}, {{ $event->area }}
                        </div>

                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-tag mr-2"></i>
                            {{ ucfirst(str_replace('_', ' ', $event->event_type)) }}
                        </div>

                        @if($event->description)
                            <p class="text-sm text-gray-600 line-clamp-2">{{ $event->description }}</p>
                        @endif

                        <div class="flex items-center justify-between pt-2">
                            <span class="text-lg font-semibold {{ $event->is_free ? 'text-green-600' : 'text-blue-600' }}">
                                {{ $event->is_free ? 'FREE' : '$' . number_format($event->price, 2) }}
                            </span>
                            
                            <div class="flex space-x-2">
                                <a href="{{ route('events.show', $event) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('events.edit', $event) }}" class="text-yellow-600 hover:text-yellow-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this event?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $events->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-calendar-alt text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Events Found</h3>
            <p class="text-gray-600 mb-6">Get started by creating your first event.</p>
            <a href="{{ route('events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg inline-flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Create Event
            </a>
        </div>
    @endif
</div>
@endsection