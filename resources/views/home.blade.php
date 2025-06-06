<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TALL Stack Todo</title>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @fluxAppearance
    </head>
    <body class="bg-gray-300 dark:bg-zinc-900">
        <div class="flex mx-auto w-full max-w-2xl mt-12 bg-white dark:bg-zinc-700 sm:rounded-lg shadow">
            <div class="w-full block">
                <div class="p-4 border-b border-b-gray-200 dark:border-b-zinc-800">
                    <flux:heading size="xl">{{ __("My Tasks") }}</flux:heading>
                </div>

                <livewire:todo />
            </div>
        </div>


        @fluxScripts
    </body>
</html>
