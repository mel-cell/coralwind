@extends('layouts.public')

@section('content')
<!-- About Section -->
<section class="py-24 mt-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">About Hotel Melvin</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Welcome to Hotel Melvin, where luxury meets comfort. We provide exceptional hospitality and world-class amenities for an unforgettable stay.</p>
        </div>
        
        <div class="grid lg:grid-cols-2 gap-12 items-center mb-16">
            <div>
                <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Hotel Exterior" class="w-full rounded-lg shadow-xl">
            </div>
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Story</h2>
                <p class="text-gray-600 mb-6">Established in 2024, Hotel Melvin is dedicated to providing the finest accommodations and services. Our team strives to make every guest feel at home while enjoying the luxuries of modern travel.</p>
                <ul class="space-y-4 text-gray-600">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        24/7 Concierge Service
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Free Wi-Fi Throughout
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        On-site Restaurant & Bar
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
