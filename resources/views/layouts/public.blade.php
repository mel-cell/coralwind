<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <nav class="bg-white/80 backdrop-blur-md shadow-sm fixed top-0 w-full z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center">
                    <a href="/" class="group">
                        <img src="{{ asset('storage/app/public/logo.png') }}" alt="Coralwind Suites Hotel" class="h-12 w-auto transition-transform group-hover:scale-105">
                    </a>
                </div>
                <div class="flex items-center space-x-8">
                    <a href="/" class="{{ request()->is('/') ? 'text-primary font-bold' : 'text-gray-600 font-medium' }} hover:text-primary transition-colors duration-300 relative group">
                        Home
                        <span class="absolute -bottom-1 left-0 h-0.5 bg-primary transition-all duration-300 {{ request()->is('/') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    <a href="/rooms" class="{{ request()->is('rooms*') ? 'text-primary font-bold' : 'text-gray-600 font-medium' }} hover:text-primary transition-colors duration-300 relative group">
                        Rooms
                        <span class="absolute -bottom-1 left-0 h-0.5 bg-primary transition-all duration-300 {{ request()->is('rooms*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    <a href="/about" class="{{ request()->is('about') ? 'text-primary font-bold' : 'text-gray-600 font-medium' }} hover:text-primary transition-colors duration-300 relative group">
                        About
                        <span class="absolute -bottom-1 left-0 h-0.5 bg-primary transition-all duration-300 {{ request()->is('about') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>
                    @auth
                        <a href="{{ route('riwayat.index') }}" class="{{ request()->routeIs('riwayat.*') ? 'text-primary font-bold' : 'text-gray-600 font-medium' }} hover:text-primary transition-colors duration-300 relative group">
                            Transaction History
                            <span class="absolute -bottom-1 left-0 h-0.5 bg-primary transition-all duration-300 {{ request()->routeIs('riwayat.*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                        </a>
                        
                        <!-- Coupon Dropdown -->
                        @php
                            $myCoupons = auth()->user()->discounts()->wherePivot('is_used', false)->get();
                        @endphp
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="60">
                                <x-slot name="trigger">
                                    <button class="relative p-2 text-gray-400 hover:text-primary transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                        </svg>
                                        @if($myCoupons->count() > 0)
                                            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-red-500 rounded-full">{{ $myCoupons->count() }}</span>
                                        @endif
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="px-4 py-3 border-b border-gray-100">
                                        <p class="text-sm font-bold text-gray-100">My Coupons</p>
                                    </div>
                                    @forelse($myCoupons as $coupon)
                                        <div class="px-4 py-3 border-b border-gray-50 hover:bg-gray-50 transition-colors">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="font-bold text-primary">{{ $coupon->nama }}</p>
                                                    <p class="text-xs text-gray-500">{{ $coupon->persentase }}% OFF</p>
                                                </div>
                                                <span class="bg-gray-100 text-gray-600 text-xs font-mono px-2 py-1 rounded">{{ $coupon->kode }}</span>
                                            </div>
                                            <p class="text-xs text-gray-400 mt-1">Expires: {{ $coupon->expires_at ? $coupon->expires_at->format('d M Y') : 'No Expiry' }}</p>
                                        </div>
                                    @empty
                                        <div class="px-4 py-3 text-sm text-gray-500 text-center">
                                            No coupons available.
                                        </div>
                                    @endforelse
                                </x-slot>
                            </x-dropdown>
                        </div>

                        <!-- Settings Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ms-4">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-bold rounded-full text-white bg-primary hover:bg-[#5E8B94] focus:outline-none transition ease-in-out duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        <div>{{ Auth::user()->name }}</div>

                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('login') }}" class="text-gray-600 font-medium hover:text-primary border px-4 py-2.5 rounded-full transition-colors" style="border-color: #5E8B94;">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-2.5 rounded-full font-bold hover:bg-[#5E8B94] transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">Register</a>
                            @endif
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-8 mt-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2024 Hotel Melvin. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
