@extends('layouts.app')

@section('title', 'Folklore Map')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Header and search -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
            <h1 class="text-3xl font-bold text-gray-800">World Folklore Map</h1>

            <div class="w-full md:w-auto">
                <select id="culture-selector"
                    class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select a culture...</option>
                    @foreach ($cultures as $culture)
                        <option value="{{ $culture->id }}">{{ $culture->name }} ({{ $culture->region }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Map and index container -->
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Sidebar index -->
            <div class="lg:w-1/4 bg-white rounded-lg shadow-md overflow-hidden h-full">
    <div class="p-4 border-b border-gray-200">
        <h3 class="font-semibold text-lg text-gray-800">Index Cultures</h3>
    </div>
    <div id="culture-index" class="overflow-y-auto" style="max-height: 600px;">
        <ul class="divide-y divide-gray-200">
            @php
                // Sort the collection alphabetically by name (case-insensitive)
                $sortedCultures = $cultures->sortBy(function($culture) {
                    return strtolower($culture->name);
                });
            @endphp
            
            @foreach ($sortedCultures as $culture)
                <li class="p-3 hover:bg-gray-50 cursor-pointer transition-colors"
                    data-culture-id="{{ $culture->id }}" onclick="focusCulture({{ $culture->id }})">
                    <div class="flex items-center">
                        <div
                            class="w-3 h-3 rounded-full mr-2 
                            {{ in_array($culture->name, [
                                'Ancient Egypt',
                                'Greece',
                                'Rome / Roman Empire',
                                'Scandinavia / Vikings',
                                'India',
                            ])
                                ? 'bg-red-500'
                                : 'bg-blue-500' }}">
                        </div>
                        <div>
                            <h4 class="font-medium">{{ $culture->name }}</h4>
                            <p class="text-sm text-gray-600">{{ $culture->region }}</p>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

            <!-- Map container -->
            <div class="lg:w-3/4 bg-white rounded-lg shadow-md overflow-hidden relative">
                <div id="map-container" class="relative">
                    <!-- Legend overlay -->
                    <div id="map-overlay" style="position: absolute; top: 1; left: 10; z-index: 1000;"
                        class="absolute top-4 right-4 bg-white bg-opacity-90 p-3 rounded-lg shadow-md z-10 border border-gray-200">
                        <h3 class="font-semibold text-lg mb-2 text-gray-800">Map legend</h3>
                        <div class="flex items-center mb-1">
                            <div class="w-4 h-4 rounded-full bg-red-500 mr-2"></div>
                            <span class="text-sm">Main Culture</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-4 h-4 rounded-full bg-blue-500 mr-2"></div>
                            <span class="text-sm">Other Culture</span>
                        </div>
                    </div>

                    <div id="map" style="height: 600px; width: 100%;"></div>
                </div>
            </div>
        </div>

        <!-- Culture details section -->
        <div id="culture-details" class="hidden bg-white rounded-lg shadow-md p-6 my-8 animate-fadeIn"></div>
    </div>
@endsection

@section('scripts')
    @parent
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />

    <script>
        fetch('/api/cultures')
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/api/cultures')
                .then(response => response.json())
                .then(data => {
                    console.log('Dati dalle API:', data);
                    data.forEach(culture => {
                        if (culture.latitude && culture.longitude) {
                            L.marker([culture.latitude, culture.longitude])
                                .addTo(folkloreMap)
                                .bindPopup(`<b>${culture.name}</b><br>${culture.region}`);
                        }
                    });
                })
                .catch(error => console.error('Errore API:', error));
        });

        // Mappa globale
        let folkloreMap = null;
        let markerCluster = null;
        let isMapInitialized = false;
        let culturesData = {!! $cultures->map(function ($culture) {
                return [
                    'id' => $culture->id,
                    'name' => $culture->name,
                    'coords' => $culture->getCoordinatesArray(),
                    'region' => $culture->region,
                    'isMajor' => in_array($culture->name, [
                        'Ancient Egypt',
                        'Greece',
                        'Rome / Roman Empire',
                        'Scandinavia / Vikings',
                        'India',
                    ]),
                ];
            })->toJson() !!};

        // mappa con controllo
        function initializeMap() {
            if (isMapInitialized) return folkloreMap;

            folkloreMap = L.map('map', {
                center: [20, 0],
                zoom: 2,
                worldCopyJump: false,
                maxBounds: [
                    [-90, -180],
                    [90, 180]
                ], // Limiti del mondo
                maxBoundsViscosity: 1.0 // Forza i limiti
            });

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                noWrap: true
            }).addTo(folkloreMap);

            markerCluster = L.markerClusterGroup({
                maxClusterRadius: 60, // Riduci il raggio del cluster
                spiderfyOnMaxZoom: false,
                showCoverageOnHover: false
            });
            folkloreMap.addLayer(markerCluster);

            // Adatta la mappa ai marker con padding ottimale
            setTimeout(() => {
                folkloreMap.invalidateSize();
                fitMapToMarkers();
            }, 100);

            isMapInitialized = true;
            return folkloreMap;
        }

        function fitMapToMarkers() {
            const validCoords = culturesData
                .filter(c => c.coords && c.coords[0] !== 0)
                .map(c => c.coords);

            if (validCoords.length > 0) {
                const bounds = L.latLngBounds(validCoords);
                folkloreMap.fitBounds(bounds, {
                    padding: [20, 20],
                    maxZoom: 8 // Zoom massimo
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            initializeMap();
            addCultureMarkers(culturesData);

            document.getElementById('culture-selector').addEventListener('change', function() {
                const cultureId = this.value;
                if (!cultureId) return;

                focusCulture(cultureId);
            });
        });

        // Focus su una cultura specifica
        function focusCulture(cultureId) {
            const culture = culturesData.find(c => c.id == cultureId);
            if (!culture) return;

            document.getElementById('culture-selector').value = cultureId;

            // Centra la mappa
            if (culture.coords && culture.coords[0] !== 0) {
                folkloreMap.setView(culture.coords, 6, {
                    animate: true,
                    duration: 1
                });
            }

            // Evidenzia nell'indice
            document.querySelectorAll('#culture-index li').forEach(li => {
                li.classList.remove('bg-blue-100');
                if (li.dataset.cultureId == cultureId) {
                    li.classList.add('bg-blue-100');
                    li.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest'
                    });
                }
            });

            loadCultureDetails(cultureId);
        }

        // Aggiungi marker alla mappa
        function addCultureMarkers(culturesData) {
            if (markerCluster) {
                markerCluster.clearLayers();
            }

            culturesData.forEach(culture => {
                if (!culture.coords || culture.coords[0] === 0) return;

                const marker = L.circleMarker(culture.coords, {
                    radius: culture.isMajor ? 10 : 7,
                    fillColor: culture.isMajor ? '#ef4444' : '#3b82f6',
                    color: '#fff',
                    weight: 1,
                    fillOpacity: 0.8
                });

                marker.bindPopup(`
                    <div class="p-2">
                        <h3 class="font-bold">${culture.name}</h3>
                        <p class="text-sm text-gray-600">${culture.region}</p>
                        <button onclick="focusCulture(${culture.id})" 
                            class="mt-2 w-full bg-blue-500 hover:bg-blue-600 text-white py-1 px-3 rounded text-sm transition-colors">
                            Vedi Dettagli
                        </button>
                    </div>
                `, {
                    maxWidth: 300
                });

                marker.on('click', function() {
                    focusCulture(culture.id);
                });

                markerCluster.addLayer(marker);
            });
        }

        // Carica i dettagli della cultura
        function loadCultureDetails(cultureId) {
            const detailsContainer = document.getElementById('culture-details');
            detailsContainer.innerHTML = `
                <div class="py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
                </div>
            `;
            detailsContainer.classList.remove('hidden');

            fetch(`/cultures/${cultureId}/details`)
                .then(response => {
                    if (!response.ok) throw new Error('Errore nel caricamento');
                    return response.text();
                })
                .then(html => {
                    detailsContainer.innerHTML = html;
                    detailsContainer.scrollIntoView({
                        behavior: 'smooth'
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    detailsContainer.innerHTML = `
                        <div class="text-center py-8 text-red-500">
                            <p>Errore nel caricamento dei dettagli.</p>
                            <button onclick="window.location.reload()" class="mt-2 text-blue-500 hover:underline">
                                Ricarica la pagina
                            </button>
                        </div>
                    `;
                });
        }
    </script>
@endsection
@section('styles')
    @parent
    <style>
        #map-overlay {
            position: fixed;
            display: none;
            z-index: 2;
        }

        #map {
            min-height: 600px;
            height: 600px;
            width: 100%;
            z-index: 1;
        }

        .leaflet-container {
            background: #fff;
            outline: 1px solid #e5e7eb;
        }

        #culture-index {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e0 #f1f5f9;
        }

        #culture-index::-webkit-scrollbar {
            width: 6px;
        }

        #culture-index::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        #culture-index::-webkit-scrollbar-thumb {
            background-color: #cbd5e0;
            border-radius: 3px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        /* Stile per i cluster più compatti */
        .marker-cluster-small,
        .marker-cluster-medium,
        .marker-cluster-large {
            background-color: rgba(59, 130, 246, 0.6) !important;
        }

        .marker-cluster-small div,
        .marker-cluster-medium div,
        .marker-cluster-large div {
            background-color: rgba(59, 130, 246, 0.8) !important;
        }
    </style>
@endsection
