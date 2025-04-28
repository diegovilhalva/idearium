<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Idearium') }}</title>
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|source+serif+pro:400" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-neutral-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Cabeçalho Condicional -->
            @if (!request()->is('verify-email'))
                <div class="w-full sm:max-w-4xl mb-8 px-4">
                    <nav class="flex flex-wrap justify-between items-center py-4">
                        <!-- Logo -->
                        <a href="/"  class="flex items-center space-x-2 w-full md:w-auto mb-4 md:mb-0">
                            <x-application-logo class="w-12 h-12" />
                            <span class="text-xl md:text-2xl font-serif font-bold text-secondary">Idearium</span>
                        </a >

                        <!-- Menu Desktop -->
                        <div class="flex items-center gap-2 md:gap-4 w-full md:w-auto justify-end">
                            <a href="{{ route('login') }}" class="
                                text-sm md:text-base
                                bg-transparent md:bg-transparent
                                text-secondary hover:text-primary 
                                px-3 py-1.5 md:px-0 md:py-0
                                rounded-full md:rounded-none
                                transition
                            ">
                                <span class="hidden md:inline">Fazer Login</span>
                                <span class="md:hidden">Login</span>
                            </a>
                            
                            <a href="{{ route('register') }}" class="
                                text-sm md:text-base
                                bg-primary text-white 
                                px-4 py-2 
                                rounded-full 
                                hover:bg-[#156612] 
                                transition
                            ">
                                Registrar
                            </a>
                        </div>
                    </nav>
                </div>
            @endif

            <!-- Conteúdo -->
            <div class="w-full sm:max-w-md px-4 py-6">
                <div class="bg-white shadow-lg rounded-lg p-6 sm:p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
