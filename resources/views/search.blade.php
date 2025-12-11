@extends('layouts.app')

@section('title', 'Search Results')

@section('content')
@push('scripts')
<script src="{{ mix('js/search.js') }}"></script>
@endpush

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-6">Search Results for "{{ $query }}"</h1>
        
        @if($deities->count() > 0)
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Deities</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($deities as $deity)
                        @include('partials.deity-card', ['deity' => $deity])
                    @endforeach
                </div>
                @if($deities->count() == 5)
                    <div class="mt-4 text-right">
                        <a href="{{ route('deities.search') }}?q={{ $query }}" class="text-blue-600 hover:underline">View all deity results</a>
                    </div>
                @endif
            </div>
        @endif
        
        @if($creatures->count() > 0)
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Creatures</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($creatures as $creature)
                        @include('partials.creature-card', ['creature' => $creature])
                    @endforeach
                </div>
                @if($creatures->count() == 5)
                    <div class="mt-4 text-right">
                        <a href="{{ route('creatures.search') }}?q={{ $query }}" class="text-blue-600 hover:underline">View all creature results</a>
                    </div>
                @endif
            </div>
        @endif
        
        @if($legends->count() > 0)
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">Legends</h2>
                <div class="space-y-4">
                    @foreach($legends as $legend)
                        @include('partials.legend-card', ['legend' => $legend])
                    @endforeach
                </div>
                @if($legends->count() == 5)
                    <div class="mt-4 text-right">
                        <a href="{{ route('legends.search') }}?q={{ $query }}" class="text-blue-600 hover:underline">View all legend results</a>
                    </div>
                @endif
            </div>
        @endif
        
        @if($deities->count() == 0 && $creatures->count() == 0 && $legends->count() == 0)
            <div class="bg-white rounded-lg shadow-md p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No results found</h3>
                <p class="mt-1 text-gray-500">Try different search terms.</p>
            </div>
        @endif
    </div>
@endsection