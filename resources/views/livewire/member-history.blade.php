<div class="min-h-screen bg-gray-50 py-12">
    @if (session()->has('message'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
            <div class="bg-[#E0F2F1] border border-[#74A6AF] text-[#74A6AF] px-6 py-4 rounded-2xl flex items-center shadow-sm">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        </div>
    @endif

    <div class="max-w-7xl mx-auto mt-20 px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <span class="text-gray-500 text-lg uppercase tracking-wider">Your Journey</span>
            <h1 class="text-5xl font-bold text-primary mt-2 mb-4">Booking History</h1>
            <p class="text-gray-500 text-lg">Track your past stays and manage your reviews</p>
        </div>

        @if($bookings->count() > 0)
            <div class="space-y-6">
                @foreach($bookings as $booking)
                    <div class="bg-white rounded-[1.5rem] p-4 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 flex flex-col md:flex-row gap-5 items-center group">
                        <!-- Room Image (More Compact) -->
                        <div class="w-full md:w-32 h-24 flex-shrink-0 relative overflow-hidden rounded-xl">
                            <img src="{{ $booking->room->gambar ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}" alt="{{ $booking->room->nama_kamar }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        </div>

                        <!-- Main Content -->
                        <div class="flex-1 w-full grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                            
                            <!-- Room Details (Cols 4) -->
                            <div class="md:col-span-4">
                                <h3 class="text-lg font-bold text-gray-900 mb-0.5 line-clamp-1">{{ $booking->room->nama_kamar }}</h3>
                                <div class="flex items-center text-gray-500 text-xs">
                                    <span class="bg-gray-100 px-2 py-0.5 rounded text-gray-600 font-medium mr-2">{{ $booking->room->tipe_kamar }}</span>
                                    {{ $booking->tgl_check_in->format('d M') }} - {{ $booking->tgl_check_out->format('d M Y') }}
                                </div>
                            </div>

                            <!-- Status (Cols 2) -->
                            <div class="md:col-span-2">
                                @if($booking->status === 'bayar')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-green-50 text-green-700 border border-green-100">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span> Paid
                                    </span>
                                @elseif($booking->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-yellow-50 text-yellow-700 border border-yellow-100">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span> Pending
                                    </span>
                                @elseif($booking->status === 'batal')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-red-50 text-red-700 border border-red-100">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span> Cancelled
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-gray-50 text-gray-700 border border-gray-100">
                                        <span class="w-1.5 h-1.5 bg-gray-500 rounded-full mr-1.5"></span> {{ ucfirst($booking->status) }}
                                    </span>
                                @endif
                            </div>

                            <!-- Price (Cols 2) -->
                            <div class="md:col-span-2">
                                <span class="text-lg font-bold text-primary">Rp {{ number_format($booking->total_harga) }}</span>
                            </div>

                            <!-- Action / Review Display (Cols 4) -->
                            <div class="md:col-span-4 flex flex-col items-end justify-center gap-2">
                                @if($booking->status !== 'batal')
                                    <a href="{{ route('bookings.invoice', $booking->id) }}" target="_blank" class="w-full md:w-auto bg-gray-800 text-white px-4 py-1.5 rounded-full font-bold text-xs hover:bg-gray-900 transition-all shadow-sm hover:shadow flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        Download Invoice
                                    </a>
                                @endif
                                @if(!$booking->review && $booking->status === 'selesai')
                                    <button wire:click="openReviewForm({{ $booking->id }})" class="w-full md:w-auto bg-white border border-primary text-primary px-4 py-1.5 rounded-full font-bold text-xs hover:bg-primary hover:text-white transition-all shadow-sm hover:shadow flex items-center justify-center">
                                        Write Review
                                    </button>
                                @elseif($booking->status === 'pending')
                                    <button wire:click="cancelBooking({{ $booking->id }})" wire:confirm="Are you sure you want to cancel this booking?" class="w-full md:w-auto bg-white border border-red-500 text-red-500 px-4 py-1.5 rounded-full font-bold text-xs hover:bg-red-500 hover:text-white transition-all shadow-sm hover:shadow flex items-center justify-center">
                                        Cancel Booking
                                    </button>
                                @elseif($booking->review)
                                    <div class="flex flex-col items-end w-full">
                                        <div class="flex items-center justify-end gap-2 w-full mb-1">
                                            <div class="flex items-center gap-0.5">
                                                @for($i = 1; $i <= 10; $i++)
                                                    <svg class="w-4 h-4 {{ $i <= $booking->review->rating ? 'text-yellow-400 fill-current' : 'text-gray-200 fill-current' }}" viewBox="0 0 20 20">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                    </svg>
                                                @endfor
                                            </div>
                                            <!-- Edit/Delete Actions -->
                                            <div class="flex items-center gap-2 ml-2">
                                                <button wire:click="openReviewForm({{ $booking->id }})" class="text-gray-400 hover:text-primary transition-colors" title="Edit Review">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </button>
                                                <button wire:click="deleteReview({{ $booking->id }})" wire:confirm="Are you sure you want to delete this review?" class="text-gray-400 hover:text-red-500 transition-colors" title="Delete Review">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                        @if($booking->review->comment)
                                            <p class="text-sm text-gray-600 italic line-clamp-2 max-w-xs text-right">"{{ $booking->review->comment }}"</p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-[3rem] shadow-sm border border-gray-100">
                <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No Bookings Yet</h3>
                <p class="text-gray-500 mb-8">You haven't made any reservations with us yet.</p>
                <a href="{{ route('rooms.index') }}" class="bg-primary text-white px-8 py-3 rounded-full font-bold hover:bg-[#5E8B94] transition-all shadow-lg hover:shadow-primary/30">
                    Find a Room
                </a>
            </div>
        @endif

    <!-- Review Modal -->
    @if($selectedBookingId)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm" aria-hidden="true" wire:click="closeReviewForm"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-[2rem] text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full p-8">
                    <div class="text-center mb-8">
                        <h3 class="text-3xl font-bold text-gray-900" id="modal-title">{{ $isEditing ? 'Edit Your Review' : 'Share Your Experience' }}</h3>
                        <p class="text-gray-500 mt-2">How was your stay at Coralwind Suites?</p>
                    </div>

                    <form wire:submit="submitReview">
                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-700 mb-4 uppercase tracking-wider text-center">Your Rating</label>
                            <div class="flex justify-center gap-2">
                                @for($i = 1; $i <= 10; $i++)
                                    <label class="cursor-pointer group">
                                        <input type="radio" wire:model="rating" value="{{ $i }}" class="hidden peer">
                                        <svg class="w-8 h-8 text-gray-300 peer-checked:text-yellow-400 group-hover:text-yellow-300 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </label>
                                @endfor
                            </div>
                            @error('rating') <span class="text-red-500 text-sm block text-center mt-2">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wider">Your Review</label>
                            <textarea wire:model="comment" rows="4" class="w-full p-4 border-2 border-gray-200 rounded-2xl focus:border-primary focus:ring-0 outline-none transition-all resize-none text-gray-600" placeholder="Tell us what you loved..."></textarea>
                            @error('comment') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex gap-4">
                            <button type="button" wire:click="closeReviewForm" class="flex-1 px-6 py-3 bg-gray-100 text-gray-600 rounded-full font-bold hover:bg-gray-200 transition-colors">Cancel</button>
                            <button type="submit" class="flex-1 px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-[#5E8B94] transition-colors shadow-lg hover:shadow-primary/30">{{ $isEditing ? 'Update Review' : 'Submit Review' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
