@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative mt-26 pt-32 pb-20 bg-[#F8FAFC] overflow-hidden">
    <!-- Background Decoration -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-[#74A6AF]/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-72 h-72 bg-blue-100/50 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="space-y-8">
                <div>
                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                    <span class="inline-block py-1 px-3 rounded-full bg-[#E0F2F1] text-[#74A6AF] text-sm font-bold tracking-wider">
                        CORALWIND SUITES
                    </span>
                        <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Coralwind Suites, Bali</span>
                    </div>
                    <h1 class="text-6xl md:text-7xl font-bold text-gray-900 leading-tight">
                        Find Out The <br>
                        <span class="text-primary relative">
                            Best Stay
                            <svg class="absolute w-full h-3 -bottom-1 left-0 text-[#74A6AF]/30" viewBox="0 0 100 10" preserveAspectRatio="none">
                                <path d="M0 5 Q 50 10 100 5" stroke="currentColor" stroke-width="8" fill="none" />
                            </svg>
                        </span>
                    </h1>
                    <p class="text-lg text-gray-600 mt-6 max-w-lg leading-relaxed">
                        Experience the ultimate relaxation with our premium rooms designed for your comfort. Wake up to the sound of the ocean and enjoy world-class amenities.
                    </p>
                </div>
            </div>

            <!-- Right Image -->
            <div class="relative hidden lg:block">
                <div class="relative rounded-[3rem] overflow-hidden shadow-2xl border-8 border-white">
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80" alt="Luxury Hotel" class="w-full h-[600px] object-cover">
                    
                    <!-- Floating Badge -->
                    <div class="absolute bottom-8 left-8 bg-white/90 backdrop-blur-md p-4 rounded-2xl shadow-lg flex items-center gap-4 max-w-xs">
                        <div class="bg-yellow-100 p-3 rounded-full text-yellow-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-900">4.9 Rating</p>
                            <p class="text-xs text-gray-500">Based on 2k+ reviews</p>
                        </div>
                    </div>
                </div>
                <!-- Decorative Elements -->
                <div class="absolute -z-10 top-10 -right-10 w-full h-full border-2 border-[#74A6AF]/20 rounded-[3rem]"></div>
            </div>
        </div>
    </div>
</section>

<!-- Best Options Highlight Section -->
<section class="py-20 bg-white relative group/section">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        
        <!-- Navigation Buttons -->
        <button onclick="document.getElementById('recommendation-scroll').scrollBy({left: -400, behavior: 'smooth'})" class="absolute left-0 top-1/2 -translate-y-1/2 -ml-4 z-10 w-12 h-12 rounded-full bg-white shadow-lg border border-gray-100 flex items-center justify-center text-gray-600 hover:text-primary hover:scale-110 transition-all opacity-0 group-hover/section:opacity-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </button>
        <button onclick="document.getElementById('recommendation-scroll').scrollBy({left: 400, behavior: 'smooth'})" class="absolute right-0 top-1/2 -translate-y-1/2 -mr-4 z-10 w-12 h-12 rounded-full bg-white shadow-lg border border-gray-100 flex items-center justify-center text-gray-600 hover:text-primary hover:scale-110 transition-all opacity-0 group-hover/section:opacity-100">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </button>

        <!-- Scrollable Container -->
        <div id="recommendation-scroll" class="flex gap-8 overflow-x-auto pb-8 snap-x snap-mandatory scrollbar-hide" style="scrollbar-width: none; -ms-overflow-style: none;">
            
            <!-- 1. Recommended Room 1 -->
            @if($recommendedRooms->count() > 0)
                <a href="{{ route('rooms.show', $recommendedRooms[0]) }}" class="min-w-[350px] md:min-w-[300px] snap-center group cursor-pointer block">
                    <div class="relative h-[400px] rounded-[2rem] overflow-hidden mb-6 shadow-lg">
                        <img src="{{ $recommendedRooms[0]->gambar ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}" alt="{{ $recommendedRooms[0]->nama_kamar }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-white p-2 rounded-full shadow-md">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                        </div>
                        <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm px-4 py-1 rounded-full text-xs font-bold text-primary">
                            Recommended
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $recommendedRooms[0]->nama_kamar }}</h3>
                        <p class="text-gray-500 text-sm mt-1">{{ $recommendedRooms[0]->tipe_kamar }} &bull; Rp {{ number_format($recommendedRooms[0]->harga) }}</p>
                    </div>
                </a>
            @endif

            <!-- 2. Recommended Room 2 -->
            @if($recommendedRooms->count() > 1)
                <a href="{{ route('rooms.show', $recommendedRooms[1]) }}" class="min-w-[350px] md:min-w-[300px] snap-center group cursor-pointer block">
                    <div class="relative h-[400px] rounded-[2rem] overflow-hidden mb-6 shadow-lg">
                        <img src="{{ $recommendedRooms[1]->gambar ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}" alt="{{ $recommendedRooms[1]->nama_kamar }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-white p-2 rounded-full shadow-md">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $recommendedRooms[1]->nama_kamar }}</h3>
                        <p class="text-gray-500 text-sm mt-1">{{ $recommendedRooms[1]->tipe_kamar }} &bull; Rp {{ number_format($recommendedRooms[1]->harga) }}</p>
                    </div>
                </a>
            @endif

            <!-- 3. Text Card (Fixed Position) -->
            <div class="min-w-[300px] md:min-w-[300px] snap-center h-[400px] flex flex-col justify-center p-8 border-2 border-dashed border-gray-200 rounded-[2rem]">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">CORALWIND SELECTION</span>
                <h2 class="text-3xl font-bold text-gray-900 mb-6 leading-tight">Best option to stay here for your summer vacations</h2>
                <a href="{{ route('rooms.index') }}" class="inline-flex items-center text-lg font-bold text-primary hover:text-[#5E8B94] transition-colors group">
                    Explore More 
                    <svg class="w-5 h-5 ml-2 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <!-- 4. Recommended Room 3 -->
            @if($recommendedRooms->count() > 2)
                <a href="{{ route('rooms.show', $recommendedRooms[2]) }}" class="min-w-[350px] md:min-w-[300px] snap-center group cursor-pointer block">
                    <div class="relative h-[400px] rounded-[2rem] overflow-hidden mb-6 shadow-lg">
                        <img src="{{ $recommendedRooms[2]->gambar ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}" alt="{{ $recommendedRooms[2]->nama_kamar }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-white p-2 rounded-full shadow-md">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $recommendedRooms[2]->nama_kamar }}</h3>
                        <p class="text-gray-500 text-sm mt-1">{{ $recommendedRooms[2]->tipe_kamar }} &bull; Rp {{ number_format($recommendedRooms[2]->harga) }}</p>
                    </div>
                </a>
            @endif

        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-12 bg-primary text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-center md:grid-cols-4 gap-8 text-center divide-x divide-white/20">
            <div class="p-4">
                <div class="text-4xl font-bold mb-2">{{ number_format($totalRooms) }}+</div>
                <div class="text-sm uppercase tracking-wider opacity-80">Luxury Rooms</div>
            </div>
            <div class="p-4">
                <div class="text-4xl font-bold mb-2">{{ number_format($totalBookings) }}+</div>
                <div class="text-sm uppercase tracking-wider opacity-80">Bookings Completed</div>
            </div>
            <div class="p-4">
                <div class="text-4xl font-bold mb-2">{{ number_format($totalReviews) }}+</div>
                <div class="text-sm uppercase tracking-wider opacity-80">Happy Guests</div>
            </div>
            <div class="p-4">
                <div class="text-4xl font-bold mb-2">{{ number_format($averageRating, 1) }}</div>
                <div class="text-sm uppercase tracking-wider opacity-80">Average Rating</div>
            </div>
        </div>
    </div>
</section>

@php
    $activeDiscount = \App\Models\Discount::where(function($query) {
            $query->whereNull('expires_at')
                  ->orWhere('expires_at', '>=', now());
        })->first();
@endphp

@if($activeDiscount)
<!-- Discount CTA Section -->
<section class="relative py-6 bg-[#0F4C75] overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-row items-center justify-between gap-4">
        <div class="text-white flex items-center gap-3">
            <span class="text-2xl hidden sm:inline">🎉</span>
            <p class="text-sm md:text-lg font-medium">Special Offer! Get <span class="font-bold text-yellow-400">{{ $activeDiscount->persentase }}% OFF</span> with code <span class="font-mono bg-white/20 px-2 py-1 rounded">{{ $activeDiscount->kode }}</span></p>
        </div>
        
        @auth
            @if(auth()->user()->discounts()->where('discount_id', $activeDiscount->id)->exists())
                <a href="{{ route('rooms.index') }}" class="inline-block bg-white text-[#0F4C75] font-bold px-6 py-2.5 rounded-full text-sm hover:bg-gray-100 transition-all shadow-md whitespace-nowrap">
                    Book Now
                </a>
            @else
                <form action="{{ route('discounts.claim', $activeDiscount->id) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="bg-yellow-400 text-[#0F4C75] font-bold px-6 py-2.5 rounded-full text-sm hover:bg-yellow-300 transition-all shadow-md whitespace-nowrap">
                        Claim Now
                    </button>
                </form>
            @endif
        @else
            <a href="{{ route('login') }}" class="inline-block bg-white text-[#0F4C75] font-bold px-6 py-2.5 rounded-full text-sm hover:bg-gray-100 transition-all shadow-md whitespace-nowrap">
                Login to Claim
            </a>
        @endauth
    </div>
</section>
@endif

<!-- Featured Rooms Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-gray-500 text-lg uppercase tracking-wider">Accommodation</span>
            <h2 class="text-4xl font-bold text-gray-900 mt-2">Our Rooms</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($rooms as $room)
                <a href="{{ route('rooms.show', $room) }}" class="group relative h-[500px] rounded-[2.5rem] overflow-hidden shadow-2xl cursor-pointer block">
                    <!-- Background Image -->
                    <img src="{{ $room->gambar ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}" alt="{{ $room->nama_kamar }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent opacity-90"></div>

                    <!-- Top Right Book Button (Visual Only) -->
                    <div class="absolute top-0 right-0 bg-[#74A6AF] text-white px-8 py-4 rounded-bl-[3rem] font-bold text-base hover:bg-[#5E8B94] transition-colors shadow-lg z-10 tracking-wide">
                        View
                    </div>

                    <!-- Content Overlay -->
                    <div class="absolute bottom-0 left-0 w-full p-8 text-white">
                        <!-- Status Badge -->
                        <div class="mb-3">
                            @if($room->availability_status === 'booked')
                                <span class="bg-red-500/90 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm">Booked</span>
                            @else
                                <span class="bg-[#74A6AF]/90 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm">Available</span>
                            @endif
                        </div>

                        <h3 class="text-3xl font-bold mb-2 leading-tight drop-shadow-md">{{ $room->nama_kamar }}</h3>
                        <div class="text-2xl font-medium mb-2 drop-shadow-sm">
                            Rp {{ number_format($room->harga) }} <span class="text-base font-normal opacity-90">/ Night</span>
                        </div>
                        
                        <div class="flex items-center text-white/90 text-sm font-medium drop-shadow-sm">
                            <div class="flex gap-0.5">
                                @for ($i = 1; $i <= 10; $i++)
                                    <svg class="w-3 h-3 {{ $i <= $room->average_rating ? 'text-yellow-400 fill-current' : 'text-white/40 fill-current' }}" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">No rooms available at the moment.</p>
                </div>
            @endforelse
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('rooms.index') }}" class="inline-block px-8 py-4 rounded-full border-2 border-primary text-primary font-bold hover:bg-primary hover:text-white transition-all duration-300">
                View All Rooms
            </a>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="py-20 bg-[#F8FAFC] relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Guest Experiences</h2>
            <p class="text-xl text-gray-500">What our guests say about their stay</p>
        </div>

        @if($highRatedReviews->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($highRatedReviews as $review)
                    <div class="bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 rounded-full bg-[#E0F2F1] flex items-center justify-center text-[#74A6AF] font-bold text-xl mr-4 flex-shrink-0">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900">{{ $review->user->name }}</h4>
                                <div class="flex text-yellow-400 text-sm">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <svg class="w-3 h-3 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-600 italic leading-relaxed flex-grow">"{{ $review->comment ?? 'No comment provided.' }}"</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center text-gray-500">
                <p>No reviews yet. Be the first to leave a review after booking!</p>
            </div>
        @endif
    </div>
</section>

<!-- Location Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold text-gray-900 mb-4">Check Our Location</h2>
        <p class="text-gray-500 mb-12 max-w-2xl mx-auto">Conveniently located near the city center and the beach, offering you the best of both worlds.</p>
        
        <div class="relative rounded-[3rem] overflow-hidden shadow-xl border-4 border-white h-[400px] group">
            <!-- Map Image Placeholder -->
            <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1748&q=80" alt="Map Location" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
            
            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
            
            <!-- Pin Icon -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="relative">
                    <div class="w-4 h-4 bg-primary rounded-full animate-ping absolute top-0 left-0"></div>
                    <svg class="w-12 h-12 text-red-500 drop-shadow-lg relative z-10" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                </div>
            </div>
            
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 bg-white/90 backdrop-blur-md px-8 py-4 rounded-full shadow-lg">
                <p class="font-bold text-gray-900">Coralwind Suites Hotel</p>
                <p class="text-xs text-gray-500">Jl. Pantai Indah No. 88, Bali</p>
            </div>
        </div>
    </div>
</section>
@endsection
