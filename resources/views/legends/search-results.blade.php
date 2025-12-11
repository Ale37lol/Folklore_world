@extends('layouts.app')

@section('title', 'Search Results for Legends')

@section('content')
    <div class="mb-8 pl-4 pr-4">
        <h1 class="text-3xl font-bold mb-4">Search results: "{{ $query }}"</h1>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <p class="text-gray-600">Explore legends and myths from different cultures and traditions.</p>
            <form action="{{ route('legends.search') }}" method="GET" class="w-full md:w-auto">
                <input type="text" name="q" value="{{ $query }}" placeholder="Search legends..."
                    class="px-4 py-2 border rounded-lg shadow-sm w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </form>
        </div>
    </div>
    @if ($legends->count() > 0)
        <div class="space-y-6">
            @foreach ($legends as $legend)
                <a href="{{ route('legends.show', $legend) }}"
                    class="block bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row gap-6 pl-6 pr-6">
                            <div class="w-full">
                                <h2 class="text-xl font-bold mb-2">{{ $legend->title }}</h2>
                                <p class="text-gray-600 mb-3">{{ $legend->culture->name }}</p>
                                <p class="text-gray-700">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($legend->content), 200) }}</p>
                                @if ($legend->is_verified)
                                    <span
                                        class="inline-block mt-3 px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Verified</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $legends->appends(['search' => $searchQuery])->links() }}
        </div>
    @else
        <p class="text-gray-600">No legends found matching your search.</p>
    @endif
    </div>
@endsection
