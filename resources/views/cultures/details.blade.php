<div class="culture-details bg-white rounded-xl shadow-lg overflow-hidden">
    <!-- Header with image -->
    <div class="relative">
        @php
            $filename = Str::slug($culture->name) . '/' . Str::slug($culture->name) . ' (1).png';
            $relativePath = 'storage/Cultures/' . $filename;
            $fullPath = public_path($relativePath);
        @endphp

        @if (file_exists($fullPath))
            <img src="{{ asset($relativePath) }}" alt="{{ $culture->name }}"
                class="w-full h-64 md:h-80 object-cover" style="object-position: top;">
        @else
            <div class="w-full h-64 md:h-80 bg-gradient-to-r from-blue-50 to-gray-100 flex items-center justify-center">
                <span class="text-gray-400 text-lg">{{ $culture->name }}</span>
            </div>
        @endif

        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $culture->name }}</h2>
            <p class="text-gray-200">{{ $culture->region }}</p>
        </div>
    </div>

    <!-- Culture Description (if available) -->
    @if ($culture->description)
        <div class="bg-blue-50 border-t border-blue-100 p-6">
            <h3 class="font-semibold text-lg text-blue-800 mb-3">Description of Culture</h3>
            <p class="text-gray-700 leading-relaxed">{{ $culture->description }}</p>
        </div>
    @endif

    <!-- All Content Sections - Always Visible -->
    <div class="p-6">
        <!-- Three Column Layout for Deities, Creatures, and Legends -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Deities Section -->
            <div class="bg-blue-50 rounded-lg p-5 border border-blue-100">
                <div class="flex items-center mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Deities</h3>
                        <p class="text-sm text-blue-600 font-medium">{{ $deities->count() }} entries</p>
                    </div>
                </div>

                <div class="space-y-3 max-h-80 overflow-y-auto pr-2">
                    @foreach ($deities as $deity)
                        <div class="bg-white p-3 rounded-lg hover:shadow-sm transition-shadow">
                            <h4 class="font-semibold text-gray-800">{{ $deity->name }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($deity->description, 100) }}</p>
                        </div>
                    @endforeach

                    @if ($deities->isEmpty())
                        <div class="text-center py-4 text-gray-500">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                </path>
                            </svg>
                            <p>No deities available</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Creatures Section -->
            <div class="bg-blue-50 rounded-lg p-5 border border-blue-100">
                <div class="flex items-center mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Creatures</h3>
                        <p class="text-sm text-blue-600 font-medium">{{ $creatures->count() }} entries</p>
                    </div>
                </div>

                <div class="space-y-3 max-h-80 overflow-y-auto pr-2">
                    @foreach ($creatures as $creature)
                        <div class="bg-white p-3 rounded-lg hover:shadow-sm transition-shadow">
                            <h4 class="font-semibold text-gray-800">{{ $creature->name }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($creature->description, 100) }}</p>
                        </div>
                    @endforeach

                    @if ($creatures->isEmpty())
                        <div class="text-center py-4 text-gray-500">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                </path>
                            </svg>
                            <p>No creatures available</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Legends Section -->
            <div class="bg-blue-50 rounded-lg p-5 border border-blue-100">
                <div class="flex items-center mb-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Legends</h3>
                        <p class="text-sm text-blue-600 font-medium">{{ $legends->count() }} entries</p>
                    </div>
                </div>

                <div class="space-y-3 max-h-80 overflow-y-auto pr-2">
                    @foreach ($legends as $legend)
                        <div class="bg-white p-3 rounded-lg hover:shadow-sm transition-shadow">
                            <h4 class="font-semibold text-gray-800">{{ $legend->title }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($legend->description, 100) }}</p>
                        </div>
                    @endforeach

                    @if ($legends->isEmpty())
                        <div class="text-center py-4 text-gray-500">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                                </path>
                            </svg>
                            <p>No legends available</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
