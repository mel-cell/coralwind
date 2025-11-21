@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative bg-white py-24 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-8xl font-extrabold text-gray-900 mb-6">Find out the <span class="text-blue-600">Best stay</span>.</h1>
                <p class="text-xl text-gray-600 mb-8">Book your perfect hotel room with us and enjoy the best experience. Modular content design can be used across the entire site.</p>

                <!-- Buttons -->
                <div class="flex space-x-4 gap mb-8 ">
                    @guest
                        <a href="{{ route('login') }}" class="bg-white border border-gray-300 text-gray-700 px-6 py-3 rounded-full hover:bg-gray-50 transition">Log in</a>
                    @endguest
                    <a href="{{ route('rooms.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition">Get Started</a>
                </div>



            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Luxury Hotel Room" class="w-full h-96 object-cover rounded-lg shadow-xl">
            </div>
        </div>
    </div>
</section>

<!-- Featured Rooms Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Accommodation List</h2>
            <p class="text-xl text-gray-600">Discover our premium rooms and suites</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($rooms as $room)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    <img src="{{ $room->gambar ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}" alt="{{ $room->nama_kamar }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $room->nama_kamar }}</h3>
                            @if($room->availability_status === 'booked')
                                <span class="text-sm text-red-600 font-semibold bg-red-100 px-2 py-1 rounded-full">Booked</span>
                            @else
                                <span class="text-sm text-green-600 font-semibold bg-green-100 px-2 py-1 rounded-full">Available</span>
                            @endif
                        </div>
                             <div class="flex justify-start  items-start mb-2">
                                @for ($i = 1; $i <= 10; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $room->average_rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                                <span class="text-sm ml-2">{{ number_format($room->average_rating, 1) }}/10</span>
                            </div>
                        <p class="text-gray-600 mb-4">{{ $room->deskripsi ?? 'Comfortable room with modern amenities.' }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-bold text-blue-600">Rp{{ $room->harga }}/night</span>
                            <a href="{{ route('rooms.show', $room) }}" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition">Book Now</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">No rooms available at the moment. Check back later!</p>
                </div>
            @endforelse
        </div>


        <section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">our Reviews</h2>
        @if($highRatedReviews->count() > 0)
            <div class="space-y-6">
                @foreach($highRatedReviews as $review)
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="flex space-x-1">
                                @for ($i = 1; $i <= 10; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <span class="ml-2 text-gray-600">{{ $review->user->name }}</span>
                        </div>
                        <p class="text-gray-700">{{ $review->comment ?? 'No comment provided.' }}</p>
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


    </div>
</section>
@endsection
