@extends('layouts.app')

@section('title', $creature->name)

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex flex-col md:flex-row gap-8 mb-8">
            <!-- Immagine principale -->
            <div class="md:w-1/3">
                <div class="w-full bg-gray-200 rounded-lg overflow-hidden">
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
            </div>

            <!-- Dettagli e descrizione -->
            <div class="md:w-2/3 flex flex-col">
                <h1 class="text-3xl font-bold mb-4">{{ $creature->name }}</h1>
                <p class="text-gray-700 mb-4">{!! nl2br(e($creatureText)) !!}</p>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold mb-2">Details</h3>
                    <p><span class="font-medium">Culture:</span> {{ $creature->culture->name ?? 'Unknown' }}</p>
                    <p><span class="font-medium">Type:</span> {{ $creature->type ?? 'Unknown' }}</p>
                </div>
            </div>
        </div>

        <!-- Galleria immagini -->
        @php
            use Illuminate\Support\Facades\File;

            $directory = public_path('storage/Creatures/' . Str::slug($creature->name));
            $relativeDir = 'storage/Creatures/' . Str::slug($creature->name);
            $galleryImages = [];

            if (File::exists($directory)) {
                $galleryImages = collect(File::files($directory))
                    ->filter(function ($file) {
                        return in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp']);
                    })
                    ->map(function ($file) use ($relativeDir) {
                        return asset($relativeDir . '/' . $file->getFilename());
                    });
            }
        @endphp

        @if ($galleryImages->count() > 1)
            <div class="mt-8">
                <h2 class="text-2xl font-semibold mb-4">Gallery</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($galleryImages as $img)
                        <a href="{{ $img }}" data-lightbox="gallery" data-title="{{ $creature->name }}">
                            <img src="{{ $img }}" alt="{{ $creature->name }}"
                                class="w-full h-45 object-cover rounded-lg shadow hover:shadow-lg transition-shadow">
                        </a>
                    @endforeach
                </div>
            </div>
        @endif




        <!-- Leggende correlate -->
        @if ($creature->legends->count() > 0)
            <div class="mt-8">
                <h2 class="text-2xl font-semibold mb-4">Related Legends</h2>
                <div class="space-y-4">
                    @foreach ($creature->legends as $legend)
                        <a href="{{ route('legends.show', $legend) }}"
                            class="block border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                            <h3 class="font-bold text-lg">{{ $legend->title }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($legend->content, 150) }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "Image %1 of %2"
        });
    </script>
@endsection