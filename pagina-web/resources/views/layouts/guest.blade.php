<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fuentes y CSS -->
        <link href="https://fonts.googleapis.com/css2?family=Syne+Mono&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="cyberpunk-body">
        <div class="cyberpunk-container">
            <div class="scanline"></div>
            
            <!-- Logo -->
            <div class="cyberpunk-logo">
                <a href="/">
                    <x-application-logo class="neon-logo" />
                </a>
            </div>

            <!-- Contenido -->
            <div class="cyberpunk-content">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>