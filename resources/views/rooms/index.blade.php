@extends('layouts.public')

@section('content')
<!-- Rooms List Section -->
<section class="py-24 mt-16 bg-white min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-gray-500 text-lg uppercase tracking-wider">Find Your Best</span>
            <h1 class="text-6xl font-bold text-primary mt-2 mb-10">Acomodation</h1>
            
            <!-- Search Bar & Filter -->
            <form action="{{ route('rooms.index') }}" method="GET" class="max-w-4xl mx-auto flex items-center gap-4">
                <div class="flex-1 relative flex items-center gap-2  rounded-full border-2 border-primary/30">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search for rooms..." class="w-full px-8 py-4 bg-transparent border-transparent">
                    <button type="submit" class="p-4 rounded-full bg-white text-primary hover:bg-primary hover:text-white transition-all duration-300 shadow-sm flex-shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
                

                <div class="relative min-w-auto">
                    <select name="status" class="w-full px-4 py-4 rounded-full border-2 border-primary/30 focus:border-primary focus:ring-0 text-lg shadow-sm outline-none transition-all appearance-none bg-white text-gray-600 cursor-pointer" onchange="this.form.submit()">
                        <option value="">All Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="booked" {{ request('status') == 'booked' ? 'selected' : '' }}>Booked</option>
                    </select>
                </div>

            </form>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
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
                        <div class="mb-1">
                            @if($room->availability_status === 'booked')
                                <span class="bg-red-500/90 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm">Booked</span>
                            @else
                                <span class="bg-[#74A6AF]/90 backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm">Available</span>
                            @endif
                        </div>

                        <h3 class="text-3xl font-bold leading-tight drop-shadow-md">{{ $room->nama_kamar }}</h3>
                        <p class="font-bold text-gray-100 bg-[#74A6AF]/50 backdrop-blur-md px-2 py-1 text-xs rounded-full">{{ $room->tipe_kamar }}</p>
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
                    <p class="text-gray-500 text-xl">No rooms found matching your search.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-16">
            {{ $rooms->links() }}
        </div>
    </div>
</section>
@endsection
