@extends('layouts.app')

@section('title', 'World Cultures')

@section('content')
    <div class="mb-8 pl-4">
        <h1 class="text-3xl font-bold mb-4">World Cultures</h1>
        <p class="text-gray-600">Explore the rich folklore traditions from cultures around the world.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-1 pl-6 pr-6">
        @foreach ($cultures as $culture)
            <a href="{{ route('cultures.show', $culture) }}" class="block hover:shadow-lg transition-shadow" style="width: 95%">
                <div class="bg-white rounded-lg overflow-hidden shadow-md h-full">
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        @php
                            $filename = Str::slug($culture->name) .'/'. Str::slug($culture->name) .' (1).png';
                            $relativePath = 'storage/Cultures/' . $filename;
                            $fullPath = public_path($relativePath);
                        @endphp

                        @if (file_exists($fullPath))
                            <img src="{{ asset($relativePath) }}" alt="{{ $culture->name }}"
                                class="object-cover w-full h-full">
                        @else
                            <span class="text-gray-500 text-sm">Immagine non trovata per {{ $filename }}</span>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg mb-1">{{ $culture->name }}</h3>
                        <p class="text-gray-600 mb-2">{{ $culture->region }}</p>
                        <p class="text-sm text-gray-500 line-clamp-2">{{ Str::limit($culture->description, 100) }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $cultures->links() }}
    </div>
@endsection
