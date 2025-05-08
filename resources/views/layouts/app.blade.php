<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Idearium') }}</title>

    <!-- Fonts -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta name="description" content="Idearium - Sua plataforma de artigos e ideias.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|source+serif+pro:400,700" rel="stylesheet" />

    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.0/dist/trix.css">


    <script src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-neutral-50">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-sm">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/" class="flex items-center space-x-2">
                            <x-application-logo class="w-12 h-12 text-primary" />
                            <span class="hidden md:block text-xl font-serif font-bold text-secondary">Idearium</span>
                        </a>

                    </div>



                    <!-- Navigation Links -->
                    <div class="hidden sm:flex sm:items-center space-x-6 gap-2">
                        <a href="{{ route('post.create') }}"
                            class=" bg-primary text-white p-3 rounded-full shadow-lg hover:bg-primary/90 transition-all duration-300 z-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </a>

                        @guest
                            <a href="{{ route('login') }}"
                                class="
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
                            <a href="{{ route('register') }}"
                                class="
                                text-sm md:text-base
                                bg-primary text-white 
                                px-4 py-2 
                                rounded-full 
                                hover:bg-[#156612] 
                                transition
                            ">
                                Registrar
                            </a>
                        @endguest   




                        @auth


                            <!-- Settings Dropdown -->
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-gray-500 hover:text-primary transition">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link href="{{ route('profile.edit') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link href="{{ route('post.mine') }}">
                                        Meus posts
                                    </x-dropdown-link>
                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        @endauth
                    </div>

                    <!-- Hamburger Menu (Mobile) -->
                    <div class="-mr-2 flex items-center sm:hidden gap-4">
                        <div class="flex lg:hidden md:hidden justify-center items-center space-x-5">
                            <a href="{{ route('post.create') }}"
                                class=" bg-primary text-white p-3 rounded-full shadow-lg hover:bg-primary/90 transition-all duration-300 z-50 sm:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                            </a>
                            @guest
                            <a href="{{ route('login') }}"
                                class="
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

                            <a href="{{ route('register') }}"
                                class="
                                text-sm md:text-base
                                bg-primary text-white 
                                px-4 py-2 
                                rounded-full 
                                hover:bg-[#156612] 
                                transition
                            ">
                                Registrar
                            </a>
                            @endguest
                        </div>

                        @auth
                            <button @click="open = !open"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            @auth
                <div class="sm:hidden" x-show="open" @click.away="open = false">


                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link href="{{ route('profile.edit') }}">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>
                            <x-responsive-nav-link href="{{ route('post.mine') }}">
                                Meus posts
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-responsive-nav-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
            @guest

            @endguest
        </nav>

        <!-- Page Content -->
        <main class="flex-1">
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h1 class="text-2xl font-serif font-bold text-gray-900">
                            {{ $header }}
                        </h1>
                    </div>
                </header>
            @endisset

            <!-- Main Content Container -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                {{ $slot }}
            </div>
        </main>
    </div>

</body>

</html>
