<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nave</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps.key') }}"></script>
</head>
<body class="bg-background text-foreground">
    <div class="border-b border-border px-8 sticky top-0 bg-background z-50 min-h-12 flex items-center">
        <nav class="uk-navbar" uk-navbar>
            <div class="uk-navbar-left gap-x-4 lg:gap-x-6">
                <div class="text-lg font-bold text-foreground">Nave</div>
            </div>
        </nav>
    </div>

    <div class="flex-1 p-8 pt-6">
        @yield('content')
    </div>

    @yield('scripts')
</body>
</html>
