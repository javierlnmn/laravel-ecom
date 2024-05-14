<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Germania+One&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-zinc-100">
            <x-base.header />

            @if (isset($pageHeader))
                <div class="bg-white shadow">
                    <div class="max-w-7xl w-11/12 mx-auto flex items-center py-6">
                        {{ $pageHeader }}
                    </div>
                </div>
            @endif

            <main class="text-zinc-900">
                {{ $slot }}
            </main>

            <x-base.footer />
        </div>
    </body>
</html>
