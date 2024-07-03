<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Task Management</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
<div class="relative sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

    <main class="w-full p-6 lg:p-8">

        @if(session()->has('success'))
            <div class="border border-green-400 rounded p-3 bg-white mb-4 text-green-700 flex justify-between" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="btn-close" >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @if(session()->has('error'))
            <div class="border border-red-400 rounded p-3 bg-white mb-4 text-red-700 flex justify-between" role="alert">
                {{ session()->get('error') }}
                <button type="button" class="btn-close" >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        {{ $slot }}


        <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
            <div class="text-center text-sm sm:text-left">
                &nbsp;
            </div>

            <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>
    </main>

    <script type="text/javascript" src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/libs/jquery-ui.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/libs/jquery-ui-punch.min.js') }}"></script>
    {!! $script ?? "" !!}
</div>
</body>
</html>
