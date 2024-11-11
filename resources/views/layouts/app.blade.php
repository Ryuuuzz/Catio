<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('Catio', 'Catio') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="website icon" href="/assets/cat image 2.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.9.1/dist/cdn.min.js"></script>
    
    @stack('styles') 
    
</head>
<body class="bg-white text-black min-h-screen flex flex-col">
    <!-- Header / Navbar -->
    <header class="bg-blue-900 pb-2 pt-1" x-data="{ open: false }">
        <div class="container mx-auto px-4">
            <nav class="flex justify-between items-center">
                <div class="text-2xl font-bold">
                    <a href="{{ url('/') }}" class="text-white hover:underline" style="font-family:'Rubik';">Catio</a>
                </div>
                <div class="hidden md:flex space-x-4 items-center mt-2" style="font-family:'Rubik';">
                    <nav>
                        <ul class="flex space-x-4">
                            <li><a href="{{ route('home') }}" class="text-white hover:underline">Beranda</a></li>
                            <li><a href="{{ route('articles.index') }}" class="text-white hover:underline">Artikel</a></li>
                            <li><a href="{{ route('gallery.index') }}" class="text-white hover:underline">Tipe-tipe</a></li>
                            <li><a href="{{ route('favorites.index') }}" class="text-white hover:underline">Favorit</a></li>

                            @auth

                            @else
                            <li><a href="{{ route('login') }}" class="text-white">Log in</a></li>
                            @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="text-white">Register</a></li>
                            @endif
                            @endauth

                            @auth
                            <x-dropdown align="right" width="w-30" class="ml-0">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-2 py-1 leading-4 capitalize rounded-md text-blue-900 bg-white hover:underline focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    @if (Auth::user()->usertype == 'admin')
                                    <x-dropdown-link :href="route('admin.dashboard')">
                                        {{ __('User dashboard') }}
                                    </x-dropdown-link>
                                    @endif
                                    @if (Auth::user()->usertype == 'admin')
                                    <x-dropdown-link :href="route('dashboard.index')">
                                        {{ __('artikel & gallery dashboard') }}
                                    </x-dropdown-link>
                            @endif
                                    <!-- Logout -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                            @endauth
                        </ul>
                    </nav>
                </div>

                <!-- Hamburger -->
                <div class="md:hidden">
                    <button @click="open = !open" class="text-white focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>
            </nav>
        </div>

        <div x-show="open" class="md:hidden bg-blue-900" style="font-family:'Rubik';">
            <nav>
                <ul class="flex flex-col space-y-2 p-4">
                    <li><a href="{{ route('home') }}" class="text-white hover:underline">Beranda</a></li>
                    <li><a href="{{ route('articles.index') }}" class="text-white hover:underline">Artikel</a></li>
                    <li><a href="{{ route('gallery.index') }}" class="text-white hover:underline">Tipe-tipe</a></li>
                    <li><a href="{{ route('favorites.index') }}" class="text-white hover:underline">Favorit</a></li>

                    @auth

                    @else
                    <li><a href="{{ route('login') }}" class="text-white hover:underline">Log in</a></li>
                    @if (Route::has('register'))
                    <li><a href="{{ route('register') }}" class="text-white hover:underline">Register</a></li>
                    @endif
                    @endauth

                    @auth
                    <li>
                        <x-dropdown align="right" width="45" class="ml-4">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent rounded-lg text-blue-900 bg-white hover:underline focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                @if (Auth::user()->usertype == 'admin')
                                            <x-dropdown-link 
                                            :href="route('admin.dashboard')">{{ __('User dashboard') }}
                                            </x-dropdown-link>
                                        @endif
                                        @if (Auth::user()->usertype == 'admin')
                                    <x-dropdown-link :href="route('dashboard.index')">
                                        {{ __('artikel & gallery dashboard') }}
                                    </x-dropdown-link>
                            @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <main class="flex-grow">
        <div class="container mx-auto px-4 py-8">
            @yield('content') 
        </div>
    </main>

    <footer class="bg-blue-900 text-sm">
        <div class="container mx-auto text-center text-white">
            <p>&copy; {{ date('Y') }} Catio</p>
        </div>
    </footer>

    @stack('scripts') 
</body>
</html>
