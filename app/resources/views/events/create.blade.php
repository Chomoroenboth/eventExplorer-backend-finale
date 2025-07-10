@extends('layouts.app')

@section('title', 'Create Event')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-md">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Create New Event</h2>
        </div>

        <!-- Form -->
        <form action="{{ route('events.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Event Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category_id" id="category_id" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Event Type -->
                <div>
                    <label for="event_type" class="block text-sm font-medium text-gray-700 mb-2">Event Type</label>
                    <select name="event_type" id="event_type" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            required>
                        <option value="">Select Type</option>
                        @foreach($eventTypes as $type)
                            <option value="{{ $type }}" {{ old('event_type') == $type ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $type)) }}
                            </option>
                        @endforeach
                    </select>
                    @error('event_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Start Date & Time -->
                <div>
                    <label for="start_datetime" class="block text-sm font-medium text-gray-700 mb-2">Start Date & Time</label>
                    <input type="datetime-local" name="start_datetime" id="start_datetime" value="{{ old('start_datetime') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required>
                    @error('start_datetime')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- End Date & Time -->
                <div>
                    <label for="end_datetime" class="block text-sm font-medium text-gray-700 mb-2">End Date & Time (Optional)</label>
                    <input type="datetime-local" name="end_datetime" id="end_datetime" value="{{ old('end_datetime') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('end_datetime')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location') }}" 
                           placeholder="Enter venue or address"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                           required>
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Area -->
                <div>
                    <label for="area" class="block text-sm font-medium text-gray-700 mb-2">Area</label>
                    <select name="area" id="area" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            required>
                        <option value="">Select Area</option>
                        @foreach($areas as $area)
                            <option value="{{ $area }}" {{ old('area') == $area ? 'selected' : '' }}>
                                {{ $area }}
                            </option>
                        @endforeach
                    </select>
                    @error('area')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                              placeholder="Describe your event...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pricing -->
                <div class="md:col-span-2">
                    <div class="space-y-4">
                        <label class="block text-sm font-medium text-gray-700">Pricing</label>
                        
                        <div class="flex items-center space-x-4">
                            <label class="flex items-center">
                                <input type="radio" name="is_free" value="1" {{ old('is_free', '1') == '1' ? 'checked' : '' }} 
                                       class="mr-2" onchange="togglePriceInput()">
                                Free Event
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="is_free" value="0" {{ old('is_free') == '0' ? 'checked' : '' }} 
                                       class="mr-2" onchange="togglePriceInput()">
                                Paid Event
                            </label>
                        </div>

                        <div id="price-input" class="hidden">
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ($)</label>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" 
                                   step="0.01" min="0"
                                   class="w-full md:w-1/3 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('events.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Create Event
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function togglePriceInput() {
    const isFree = document.querySelector('input[name="is_free"]:checked').value === '1';
    const priceInput = document.getElementById('price-input');
    
    if (isFree) {
        priceInput.classList.add('hidden');
        document.getElementById('price').removeAttribute('required');
    } else {
        priceInput.classList.remove('hidden');
        document.getElementById('price').setAttribute('required', 'required');
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    togglePriceInput();
});
</script>
@endsection