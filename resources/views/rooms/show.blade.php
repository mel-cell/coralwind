@extends('layouts.public')

@section('content')
<!-- Room Detail Section -->
<section class="py-24 mt-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-start">
            <div>
                <img src="{{ $room->gambar ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}" alt="{{ $room->nama_kamar }}" class="w-full h-96 object-cover rounded-lg shadow-xl">
            </div>
            <div>
                <h1 class="text-4xl font-bold mb-4">{{ $room->nama_kamar }}</h1>
                <p class="text-xl mb-2">{{ $room->deskripsi ?? 'This luxurious room offers modern amenities and comfortable bedding for a perfect stay.' }}</p>
                <div class="flex justify-start  items-start mb-4">
                    @for ($i = 1; $i <= 10; $i++)
                        <svg class="w-6 h-6 {{ $i <= $room->average_rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    @endfor
                    <span class="text-lg ml-2">{{ number_format($room->average_rating, 1) }}/10</span>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg mb-6">
                    <h3 class="text-xl font-semibold mb-4">Room Details</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li><strong>Type:</strong> {{ $room->tipe_kamar ?? 'Standard' }}</li>
                        <li><strong>Status:</strong> {{ $room->status ?? 'Tersedia' }}</li>
                        <li><strong>Facilities:</strong> WiFi, AC, TV, Minibar</li>
                    </ul>
                </div>

                <div class="flex justify-between items-center mb-6">
                    <span class="text-3xl font-bold text-blue-600">Rp {{ number_format($room->harga ?? 1500000) }}/night</span>
                </div>

                <!-- Booking Form -->
                <form action="{{ route('bookings.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <div class="grid md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Check-in Date</label>
                            <input type="date" name="check_in" required class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Check-out Date</label>
                            <input type="date" name="check_out" required class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Number of Guests</label>
                        <input type="number" name="guests" min="1" max="4" required class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                        <select name="payment_method" required class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                            <option value="cash">Cash on Arrival</option>
                            <option value="debit_credit">Debit/Credit Card</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition">Book This Room</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-12">Guest Reviews</h2>
        @if($room->reviews->count() > 0)
            <div class="space-y-6">
                @foreach($room->reviews as $review)
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
@endsection
