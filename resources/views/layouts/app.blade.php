<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    <!-- Main wrapper -->
    <div class="min-h-screen flex flex-col">

        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Header -->
        @isset($header)
            <header class="bg-white/80 dark:bg-gray-800/80 backdrop-blur shadow-sm sticky top-0 z-40">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex items-center justify-between">
                    <div class="text-xl font-semibold">{{ $header }}</div>

                    <!-- Optional Right Buttons -->
                    <div class="flex items-center space-x-3">
                        <button class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm shadow">
                            Action
                        </button>
                    </div>
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-1">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
      

         <!-- Alert -->
        @if (session('success'))
    <div class="mb-4 p-4 text-green-800 bg-green-100 rounded">
         {{ session('success') }}
    </div>
@endif

@if (session('warning'))
    <div class="mb-4 p-4 text-yellow-800 bg-yellow-100 rounded">
         {{ session('warning') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 p-4 text-red-800 bg-red-100 rounded">
         {{ session('error') }}
    </div>
@endif

  </main>

        <!-- Footer -->
        <footer class="bg-white dark:bg-gray-800 py-6 border-t dark:border-gray-700 mt-10">
            <div class="max-w-7xl mx-auto text-center text-sm text-gray-600 dark:text-gray-300">
                © {{ date('Y') }} {{ config('app.name') }} — All Rights Reserved
            </div>
        </footer>
    </div>
</body>
</html>
