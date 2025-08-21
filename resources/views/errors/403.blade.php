<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Forbidden</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            @include('components.base-style')
        @endif
    </head>
    <body class="bg-red-950 flex flex-col items-center justify-center min-h-screen"></body>
    <div class="flex flex-row items-center justify-evenly w-8xl h-screen leading-8 gap-6 text-center">
        <div class="flex flex-col w-full items-center text-left gap-6">
            <h1 class="text-5xl text-red-100 w-full">Whoops. Sorry to Interrupt.</h1>
            <p class="text-lg text-red-300 w-full">You do not have an access to this resource.</p>
        </div>

        <!-- Art by: @sh0neas -->
        <img src="{{ asset('images/403.svg') }}" alt="@sh0neas" style="width: 560px; height: 560px; object-fit: cover;">
    </div>
@include('components.footer')
