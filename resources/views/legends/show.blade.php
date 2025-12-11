@extends('layouts.app')

@section('title', $legend->title)

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold mb-2">{{ $legend->title }}</h1>
            <div class="flex items-center text-gray-600">
                <span>From {{ $legend->culture->name ?? 'Unknown Culture' }}</span>
                @if ($legend->is_verified)
                    <span
                        class="ml-2 px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Verified</span>
                @endif
            </div>
        </div>

        {{-- Legend Text --}}
        @if ($legendText)
            <div class="prose max-w-none">
                {!! nl2br(e($legendText)) !!}
            </div>
        @else
            <div class="text-red-500 font-semibold">
                Testo della leggenda "{{ $legend->title }}" non disponibile.
                @if (auth()->check() && auth()->user()->isAdmin())
                    <div class="mt-2 text-sm text-gray-600">
                        Controlla che il titolo nel database ("{{ $legend->title }}") corrisponda esattamente a quello nel
                        file leggende.txt
                    </div>
                @endif
            </div>
        @endif

        {{-- Related Deities --}}
        @if ($legend->deities->count() > 0)
            <div class="mt-8">
                <h2 class="text-2xl font-semibold mb-4">Related Deities</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($legend->deities as $deity)
                        <a href="{{ route('deities.show', $deity) }}"
                            class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <div
                                class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                                @php
                                    $filename = Str::slug($deity->name) . '/' . Str::slug($deity->name) . ' (1).jpeg';
                                    $relativePath = 'storage/Deities/' . $filename;
                                    $fullPath = public_path($relativePath);
                                @endphp

                                @if (file_exists($fullPath))
                                    <img src="{{ asset($relativePath) }}" alt="{{ $deity->name }}"
                                        class="object-cover w-full h-full" style="object-fit: cover; object-position: top;">
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
                            <div>
                                <h3 class="font-medium">{{ $deity->name }}</h3>
                                <p class="text-sm text-gray-600">
                                    {{ $deity->pivot->role_in_legend ?? 'Associated deity' }}
                                    @if ($deity->role)
                                        <span class="block text-xs text-gray-400">{{ $deity->role }}</span>
                                    @endif
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Related Creatures --}}
        @if ($legend->creatures->count() > 0)
            <div class="mt-8">
                <h2 class="text-2xl font-semibold mb-4">Related Creatures</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($legend->creatures as $creature)
                        <a href="{{ route('creatures.show', $creature) }}"
                            class="flex items-center space-x-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">
                            <div
                                class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
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
                                <h3 class="font-medium">{{ $creature->name }}</h3>
                                <p class="text-sm text-gray-600">
                                    {{ $creature->pivot->role_in_legend ?? 'Associated creature' }}
                                    <span class="block text-xs text-gray-400 capitalize">{{ $creature->type }}</span>
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
