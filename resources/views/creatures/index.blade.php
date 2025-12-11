@extends('layouts.app')

@section('title', 'Mythical Creatures')

@section('content')
    <div class="mb-8 pl-4 pr-4">
        <h1 class="text-3xl font-bold mb-4">Mythical Creatures</h1>
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <p class="text-gray-600">Explore legendary beings and monsters from world folklore.</p>
            <form action="{{ route('creatures.search') }}" method="GET" class="w-full md:w-auto">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search creatures..."
                    class="px-4 py-2 border rounded-lg shadow-sm w-full md:w-64 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 pl-6 pr-6">
        @foreach ($creatures as $creature)
            <a href="{{ route('creatures.show', $creature) }}" class="block hover:shadow-lg transition-shadow"
                style="width: 95%">
                <div class="bg-white rounded-lg overflow-hidden shadow-md h-full">
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        @php
                            $filename = Str::slug($creature->name) . '/' . Str::slug($creature->name) . ' (1).jpeg';
                            $relativePath = 'storage/Creatures/' . $filename;
                            $fullPath = public_path($relativePath);
                        @endphp

                        @if (file_exists($fullPath))
                            <img src="{{ asset($relativePath) }}" alt="{{ $creature->name }}"
                                class="object-cover w-full h-full" style="object-fit: cover; object-position: top;">
                        @else
                            @php
                                $filename = Str::slug($creature->name) . '/' . Str::slug($creature->name) . ' (1).jpg';
                                $relativePath = 'storage/Creatures/' . $filename;
                                $fullPath = public_path($relativePath);
                            @endphp

                            @if (file_exists($fullPath))
                                <img src="{{ asset($relativePath) }}" alt="{{ $creature->name }}"
                                    class="object-cover w-full h-full" style="object-fit: cover; object-position: top;">
                            @else
                                <span class="text-gray-500 text-sm">Immagine non trovata per {{ $filename }}</span>
                            @endif
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-1">{{ $creature->name }}</h3>
                        <p class="text-gray-600 mb-2">{{ $creature->culture->name }}</p>
                        <p class="text-sm text-gray-500 line-clamp-2">{{ Str::limit($creature->description, 100) }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $creatures->links() }}
    </div>
@endsection
