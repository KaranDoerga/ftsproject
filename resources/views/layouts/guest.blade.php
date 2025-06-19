<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-700 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-800">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white dark:bg-gray-700 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        <footer class="bg-gray-800 dark:bg-gray-900 border-t border-gray-700">
            <div class="container mx-auto px-6 py-8">
                <div class="flex flex-col items-center text-center">
                    {{-- Navigatie Links --}}
                    <div class="flex flex-wrap justify-center mt-6 -mx-4">
                        <a href="{{ route('home') }}" class="mx-4 text-sm text-gray-400 hover:text-white">Home</a>
                        <a href="{{ route('festivals.index') }}" class="mx-4 text-sm text-gray-400 hover:text-white">Festivals</a>
                        <a href="#" class="mx-4 text-sm text-gray-400 hover:text-white">Over Ons</a>
                        <a href="#" class="mx-4 text-sm text-gray-400 hover:text-white">Contact</a>
                        <a href="#" class="mx-4 text-sm text-gray-400 hover:text-white">Privacybeleid</a>
                    </div>
                </div>

                <hr class="my-6 border-gray-700" />

                <div class="text-center">
                    <p class="text-sm text-gray-400">© {{ date('Y') }} Karan Doerga. Alle rechten voorbehouden.</p>
                </div>
            </div>
        </footer>
    </body>
</html>
