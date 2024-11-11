<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="website icon" href="/assets/cat image 2.jpg">


    <title>{{ config('Catio', 'Login') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gradient-to-br from-indigo-100 via-white to-indigo-50">
    <div class="min-h-screen flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <!-- Logo Section -->
        <div class="mb-8">
            <a href="/">

            </a>
        </div>

        <!-- Card Container -->
        <div class="w-full sm:max-w-lg bg- shadow-lg rounded-xl p-8 ">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
