@extends('layouts.app')

@section('title', 'Explore World Folklore')

@section('content')
    <div class="mb-12">
        <h1 class="text-4xl font-bold pl-4 mb-6">Explore World Folklore</h1>
        <p class="text-lg pl-4 mb-8">Discover myths, legends, deities, and creatures from cultures around the world.</p>

        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-2xl font-semibold mb-4">Featured Cultures</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($cultures as $culture)
                    <a href="{{ route('cultures.show', $culture) }}" class="block hover:shadow-lg transition-shadow">
                        <div class="bg-white rounded-lg overflow-hidden shadow-md">
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                @php
                                    $filename =
                                        Str::slug($culture->name) . '/' . Str::slug($culture->name) . ' (1).png';
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
                                <h3 class="font-bold text-lg">{{ $culture->name }}</h3>
                                <p class="text-gray-600">{{ $culture->region }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Featured Deities</h2>
                <div class="space-y-4">
                    @foreach ($featuredDeities as $deity)
                        <a href="{{ route('deities.show', $deity) }}"
                            class="flex items-center space-x-4 hover:bg-gray-100 p-2 rounded">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                                @php
                                    $filename = Str::slug($deity->name) . '/' . Str::slug($deity->name) . ' (1).jpeg';
                                    $relativePath = 'storage/Deities/' . $filename;
                                    $fullPath = public_path($relativePath);
                                @endphp

                                @if (file_exists($fullPath))
                                    <img src="{{ asset($relativePath) }}" alt="{{ $deity->name }}"
                                        class="object-cover w-full h-full" style="border-radius: 50%;">
                                @else
                                    @php
                                        $filename =
                                            Str::slug($deity->name) . '/' . Str::slug($deity->name) . ' (1).jpg';
                                        $relativePath = 'storage/Deities/' . $filename;
                                        $fullPath = public_path($relativePath);
                                    @endphp

                                    @if (file_exists($fullPath))
                                        <img src="{{ asset($relativePath) }}" alt="{{ $deity->name }}"
                                            class="object-cover w-full h-full" style="border-radius: 50%;">
                                    @else
                                        <span class="text-gray-500 text-sm">Immagine non trovata per
                                            {{ $filename }}</span>
                                    @endif
                                @endif
                            </div>
                            <div>
                                <h3 class="font-semibold">{{ $deity->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $deity->culture->name }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">Featured Creatures</h2>
                <div class="space-y-4">
                    @foreach ($featuredCreatures as $creature)
                        <a href="{{ route('creatures.show', $creature) }}"
                            class="flex items-center space-x-4 hover:bg-gray-100 p-2 rounded">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                                @php
                                    $filename =
                                        Str::slug($creature->name) . '/' . Str::slug($creature->name) . ' (1).jpeg';
                                    $relativePath = 'storage/Creatures/' . $filename;
                                    $fullPath = public_path($relativePath);
                                @endphp

                                @if (file_exists($fullPath))
                                    <img src="{{ asset($relativePath) }}" alt="{{ $creature->name }}"
                                        class="object-cover w-full h-full" style="border-radius: 50%;">
                                @else
                                    @php
                                        $filename =
                                            Str::slug($creature->name) . '/' . Str::slug($creature->name) . ' (1).jpg';
                                        $relativePath = 'storage/Creatures/' . $filename;
                                        $fullPath = public_path($relativePath);
                                    @endphp

                                    @if (file_exists($fullPath))
                                        <img src="{{ asset($relativePath) }}" alt="{{ $creature->name }}"
                                            class="object-cover w-full h-full" style="border-radius: 50%;">
                                    @else
                                        <span class="text-gray-500 text-sm">Immagine non trovata per
                                            {{ $filename }}</span>
                                    @endif
                                @endif
                            </div>
                            <div>
                                <h3 class="font-semibold">{{ $creature->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $creature->culture->name }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
