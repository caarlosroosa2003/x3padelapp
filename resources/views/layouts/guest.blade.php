<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased" style="font-family: 'Poppins', sans-serif;">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50">
            <div class="text-center mb-6">
                <a href="/">
                    <img src="{{ asset('images/logo.svg') }}" alt="X3 Pádel" class="w-24 h-24 mx-auto mb-4">
                    <h1 class="text-3xl font-bold text-gray-900">
                        <span class="text-[#C3E617]">X3</span> Pádel
                    </h1>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border-2 border-gray-100">
                {{ $slot }}
            </div>
            
            <div class="mt-6 text-center">
                <a href="{{ url('/') }}" class="text-gray-800 hover:text-[#C3E617] font-medium transition duration-300">
                    ← Volver al inicio
                </a>
            </div>
        </div>
    </body>
</html>
