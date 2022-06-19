<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/choices.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        />

        {{-- Livewire --}}
        @livewireStyles
        {{-- blade ui Kit --}}
        @bukStyles(true)

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        {{-- Notifications --}}
        <x-notification />
        
        {{-- Livewire --}}
        @livewireScripts
        
        {{-- blade ui Kit --}}
        @bukScripts(true)

        <!-- Livewire modal -->
        @livewire('livewire-ui-modal')

        {{-- Apex Charts --}}
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        @stack('js')

    </body>
</html>
