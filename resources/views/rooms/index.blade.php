@extends('layouts.public')

@section('content')
<!-- Rooms List Section -->
<section class="py-24 mt-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">All Rooms</h1>
            <p class="text-xl text-gray-600">Explore our wide selection of rooms and suites</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mt-8">
            @forelse($rooms as $room)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    <img src="{{ $room->gambar ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}" alt="{{ $room->nama_kamar }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div>
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $room->nama_kamar }}</h3>
                            @if($room->availability_status === 'booked')
                                <span class="text-sm text-red-600 font-semibold bg-red-100 px-2 py-1 rounded-full">Booked</span>
                            @else
                                <span class="text-sm text-green-600 font-semibold bg-green-100 px-2 py-1 rounded-full">Available</span>
                            @endif
                        </div>
                        
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
                            <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($room->harga) }}/night</span>
                            <div class="flex flex-col items-end space-y-2">
                                <a href="{{ route('rooms.show', $room) }}" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500">No rooms available. Please check back later!</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-12">
            {{ $rooms->links() }}
        </div>
    </div>
</section>
@endsection
