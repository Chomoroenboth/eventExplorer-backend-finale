@extends('layouts.app')

@section('title', 'Event Proposals')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Event Proposals</h2>
            <p class="text-gray-600">Review and manage event proposals from users</p>
        </div>
    </div>

    <!-- Proposals Grid -->
    @if($eventRequests->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($eventRequests as $request)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    <!-- Request Header -->
                    <div class="p-4 border-b border-gray-200">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background-color: {{ $request->category->color ?? '#F59E0B' }}20;">
                                    <i class="{{ $request->category->icon ?? 'fas fa-clock' }} text-lg" style="color: {{ $request->category->color ?? '#F59E0B' }};"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 text-lg">{{ $request->title }}</h3>
                                    <p class="text-sm text-gray-500">{{ $request->category->name ?? 'Uncategorized' }}</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($request->approval_status === 'approved') bg-green-100 text-green-800
                                @elseif($request->approval_status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($request->approval_status) }}
                            </span>
                        </div>
                    </div>

                    <!-- Request Details -->
                    <div class="p-4 space-y-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-calendar mr-2"></i>
                            {{ $request->start_datetime->format('M d, Y \a\t g:i A') }}
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            {{ $request->location }}, {{ $request->area }}
                        </div>

                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-tag mr-2"></i>
                            {{ ucfirst(str_replace('_', ' ', $request->event_type)) }}
                        </div>

                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-user mr-2"></i>
                            {{ $request->requester_email }}
                        </div>

                        @if($request->description)
                            <p class="text-sm text-gray-600 line-clamp-2">{{ $request->description }}</p>
                        @endif

                        <div class="flex items-center justify-between pt-2">
                            <span class="text-lg font-semibold {{ $request->is_free ? 'text-green-600' : 'text-blue-600' }}">
                                {{ $request->is_free ? 'FREE' : '$' . number_format($request->price, 2) }}
                            </span>
                            
                            <div class="flex space-x-2">
                                <a href="{{ route('event-requests.show', $request) }}" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                @if($request->approval_status === 'pending')
                                    <form action="{{ route('event-requests.approve', $request) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:text-green-800" title="Approve">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('event-requests.reject', $request) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Reject">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $eventRequests->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-clock text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">No Event Proposals Found</h3>
            <p class="text-gray-600">There are currently no event proposals to review.</p>
        </div>
    @endif
</div>
@endsection