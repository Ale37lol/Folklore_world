@extends('layouts.app')

@section('title', $culture->name)

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex flex-col md:flex-row gap-8 mb-8">
            <div class="md:w-1/3">
                <div class="w-full bg-gray-200 rounded-lg overflow-hidden">
                    @php
                        $filename = Str::slug($culture->name) . '/' . Str::slug($culture->name) . ' (1).png';
                        $relativePath = 'storage/Cultures/' . $filename;
                        $fullPath = public_path($relativePath);
                    @endphp

                    @if (file_exists($fullPath))
                        <img src="{{ asset($relativePath) }}" alt="{{ $culture->name }}" class="w-full rounded-lg object-cover"
                            style="object-position: top;">
                    @else
                        <div class="flex items-center justify-center h-48 text-gray-500 text-sm">
                            Immagine non trovata per {{ $filename }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Dettagli e descrizione -->
            <div class="md:w-2/3 flex flex-col">
                <h1 class="text-3xl font-bold mb-4">{{ $culture->name }}</h1>
                <p class="text-gray-700 mb-4">{!! nl2br(e($cultureText)) !!}</p>
            </div>
        </div>

        <!-- Galleria immagini -->
        @php
            $galleryDir = public_path('storage/Cultures/' . $slugName);
            $galleryRelativeDir = 'storage/Cultures/' . $slugName;
            $galleryImages = [];

            if (File::exists($galleryDir)) {
                $galleryImages = collect(File::files($galleryDir))
                    ->filter(function ($file) {
                        return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp']);
                    })
                    ->map(function ($file) use ($galleryRelativeDir) {
                        return asset($galleryRelativeDir . '/' . $file->getFilename());
                    });
            }
        @endphp

        @if ($galleryImages->count() > 1)
            <div class="mt-8">
                <h2 class="text-2xl font-semibold mb-4">Gallery</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($galleryImages as $img)
                        <a href="{{ $img }}" data-lightbox="gallery" data-title="{{ $culture->name }}">
                            <img src="{{ $img }}" alt="{{ $culture->name }}"
                                class="w-full h-45 object-cover rounded-lg shadow hover:shadow-lg transition-shadow">
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <div class="mt-8">
                <h2 class="text-2xl font-semibold mb-4">Gallery</h2>
                <p class="text-gray-500">No images available for this culture.</p>
            </div>
        @endif

        <div class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Deities of {{ $culture->name }}</h2>
            @if ($culture->deities->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                    @foreach ($culture->deities as $deity)
                        <a href="{{ route('deities.show', $deity) }}" class="block hover:shadow-lg transition-shadow">
                            <div class="bg-white rounded-lg overflow-hidden shadow-md h-full flex flex-col">
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                                    @php
                                        $filename =
                                            Str::slug($deity->name) . '/' . Str::slug($deity->name) . ' (1).jpeg';
                                        $relativePath = 'storage/Deities/' . $filename;
                                        $fullPath = public_path($relativePath);
                                    @endphp

                                    @if (file_exists($fullPath))
                                        <img src="{{ asset($relativePath) }}" alt="{{ $deity->name }}"
                                            class="object-cover w-full h-full"
                                            style="object-fit: cover; object-position: top;">
                                    @else
                                        @php
                                            $filename =
                                                Str::slug($deity->name) . '/' . Str::slug($deity->name) . ' (1).jpg';
                                            $relativePath = 'storage/Deities/' . $filename;
                                            $fullPath = public_path($relativePath);
                                        @endphp

                                        @if (file_exists($fullPath))
                                            <img src="{{ asset($relativePath) }}" alt="{{ $deity->name }}"
                                                class="object-cover w-full h-full"
                                                style="object-fit: cover; object-position: top;">
                                        @else
                                            <span class="text-gray-500 text-sm">Immagine non trovata per
                                                {{ $filename }}</span>
                                        @endif
                                    @endif
                                </div>

                                <div class="p-4 flex-grow flex flex-col">
                                    <h3 class="font-bold text-lg mb-1">{{ $deity->name }}</h3>
                                    <p class="text-gray-600 mb-2">{{ $deity->domain ?? 'Divine domain' }}</p>
                                    <p class="text-sm text-gray-500 line-clamp-2 mt-auto">
                                        {{ Str::limit($deity->description ?? 'No description available', 100) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No deities recorded for this culture yet.</p>
            @endif
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Creatures of {{ $culture->name }}</h2>
            @if ($culture->creatures->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                    @foreach ($culture->creatures as $creature)
                        <a href="{{ route('creatures.show', $creature) }}" class="block hover:shadow-lg transition-shadow">
                            <div class="bg-white rounded-lg overflow-hidden shadow-md h-full flex flex-col">
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
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

                                <div class="p-4 flex-grow flex flex-col">
                                    <h3 class="font-bold text-lg mb-1">{{ $creature->name }}</h3>
                                    <p class="text-gray-600 mb-2">{{ $creature->domain ?? 'Divine domain' }}</p>
                                    <p class="text-sm text-gray-500 line-clamp-2 mt-auto">
                                        {{ Str::limit($creature->description ?? 'No description available', 100) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No creatures recorded for this culture yet.</p>
            @endif
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Legends of {{ $culture->name }}</h2>
            @if ($culture->legends->count() > 0)
                <div class="space-y-6">
                    @foreach ($culture->legends as $legend)
                        <a href="{{ route('legends.show', $legend) }}"
                            class="block hover:bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h3 class="font-bold text-lg mb-1">{{ $legend->title }}</h3>
                            <p class="text-sm text-gray-500 line-clamp-2">{{ Str::limit($legend->content, 200) }}</p>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No legends recorded for this culture yet.</p>
            @endif
        </div>
    </div>
@endsection
