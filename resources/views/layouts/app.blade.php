<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Folklore World - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-900 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-bold">Folklore World</a>
            <div class="flex space-x-4">
                <a href="{{ route('cultures.index') }}" class="hover:text-blue-200">Cultures</a>
                <a href="{{ route('deities.index') }}" class="hover:text-blue-200">Deities</a>
                <a href="{{ route('creatures.index') }}" class="hover:text-blue-200">Creatures</a>
                <a href="{{ route('legends.index') }}" class="hover:text-blue-200">Legends</a>
                <a href="{{ route('map') }}" class="hover:text-blue-200">Map</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto py-8">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Folklore World. All rights reserved @Ale37lol.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>