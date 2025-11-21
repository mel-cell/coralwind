<div>
    <!-- Filter Dropdown -->
    <div class="flex justify-end mb-8">
        <select wire:model="tipe_kamar" class="w-48 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 @error('tipe_kamar') @enderror">
            <option value="">Filter Tipe Kamar</option>
            <option value="Superior">Superior</option>
            <option value="Deluxe">Deluxe</option>
            <option value="Suite">Suite</option>
        </select>
        @error('tipe_kamar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
    </div>

    @if($showResults && count($rooms) > 0)
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-4">Kamar Tersedia</h3>
            <div class="grid md:grid-cols-3 gap-4">
                @foreach($rooms as $room)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                        <img src="{{ $room->gambar ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}" alt="{{ $room->nama_kamar }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $room->nama_kamar }}</h3>
                            <p class="text-gray-600 mb-4">{{ $room->deskripsi ?? 'Kamar nyaman dengan fasilitas modern.' }}</p>
                            <div class="flex items-center mb-2">
                                @for ($i = 1; $i <= 10; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $room->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                                <span class="ml-2 text-sm text-gray-600">{{ $room->rating }}/10</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($room->harga) }}/malam</span>
                                <a href="{{ route('rooms.show', $room) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    @elseif($showResults)
        <div class="mt-8 text-center text-gray-500">
            Tidak ada kamar yang tersedia untuk kriteria pencarian.
        </div>
    @endif
</div>
