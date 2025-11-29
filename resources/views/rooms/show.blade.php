@extends('layouts.public')

@section('content')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
<style>
    .flatpickr-day.disabled, .flatpickr-day.disabled:hover, .flatpickr-disabled, .flatpickr-disabled:hover {
        background: #fee2e2 !important;
        color: #ef4444 !important;
        text-decoration: line-through;
        opacity: 0.5;
        cursor: not-allowed;
        border-color: transparent !important;
    }
    .flatpickr-day.selected {
        background: #74A6AF !important;
        border-color: #74A6AF !important;
    }
    .flatpickr-day.startRange, .flatpickr-day.endRange {
        background: #74A6AF !important;
        border-color: #74A6AF !important;
    }
    .flatpickr-day.inRange {
        box-shadow: -5px 0 0 #E0F2F1, 5px 0 0 #E0F2F1 !important;
        background: #E0F2F1 !important;
        border-color: #E0F2F1 !important;
        color: #2d3748 !important;
    }
</style>

<div class="pt-32 pb-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex mb-8 text-sm text-gray-500">
            <a href="/" class="hover:text-primary">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('rooms.index') }}" class="hover:text-primary">Rooms</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900 font-medium">{{ $room->nama_kamar }}</span>
        </nav>

        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Left Column: Main Content -->
            <div class="lg:col-span-2 space-y-12">
                
                <!-- Gallery / Hero Image -->
                <div class="rounded-[2.5rem] overflow-hidden shadow-2xl relative group">
                    <img src="{{ $room->gambar ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}" alt="{{ $room->nama_kamar }}" class="w-full h-[500px] object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute top-6 right-6 bg-white/90 backdrop-blur-md px-6 py-2 rounded-full text-primary font-bold shadow-lg">
                        {{ $room->tipe_kamar }}
                    </div>
                </div>

                <!-- Header Info -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $room->nama_kamar }}</h1>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <span>Coralwind Suites, Bali</span>
                        </div>
                    </div>
                    <div class="text-right mr-4">
                        <div class="text-3xl font-bold text-primary">Rp {{ number_format($room->harga) }}</div>
                        <span class="text-gray-400 text-sm">/ night</span>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 py-8 border-y border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase">Type</p>
                            <p class="font-bold text-gray-900">{{ $room->tipe_kamar }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase">Capacity</p>
                            <p class="font-bold text-gray-900">2 Adults</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase">Size</p>
                            <p class="font-bold text-gray-900">450 sqft</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 uppercase">Rating</p>
                            <p class="font-bold text-gray-900">{{ number_format($room->average_rating, 1) }} ({{ $room->reviews->count() }})</p>
                        </div>
                    </div>
                </div>

                <!-- Overview -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Overview</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ $room->deskripsi ?? 'Experience luxury and comfort in our spacious rooms. Designed with modern aesthetics and equipped with premium amenities to ensure a relaxing stay. Enjoy the stunning views and world-class service at Coralwind Suites.' }}
                    </p>
                </div>

                <!-- Amenities -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Room Amenities</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-white border border-gray-100 shadow-sm">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <span class="text-gray-700 font-medium">Flat-Screen TV</span>
                        </div>
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-white border border-gray-100 shadow-sm">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                            <span class="text-gray-700 font-medium">High-Speed Wi-Fi</span>
                        </div>
                        <div class="flex items-center gap-3 p-4 rounded-xl bg-white border border-gray-100 shadow-sm">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            <span class="text-gray-700 font-medium">Air Conditioning</span>
                        </div>
                        <!-- Add more amenities as needed -->
                    </div>
                </div>

                

                <!-- Location Map Placeholder -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Location</h3>
                    <div class="rounded-3xl overflow-hidden shadow-lg h-[300px] relative">
                        <img src="https://images.unsplash.com/photo-1524661135-423995f22d0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1748&q=80" alt="Map" class="w-full h-full object-cover">
                        <div class="absolute inset-0 flex items-center justify-center bg-black/10">
                            <div class="bg-white px-6 py-3 rounded-full shadow-xl flex items-center gap-3 animate-bounce">
                                <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                <span class="font-bold text-gray-900">Coralwind Suites</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guest Reviews -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Guest Reviews</h3>
                    @if($room->reviews->count() > 0)
                        <div class="space-y-6">
                            @foreach($room->reviews as $review)
                                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xl">
                                            {{ substr($review->user->name, 0, 1) }}
                                        </div>
                                    </div>
                                    <div class="flex-grow">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h4 class="font-bold text-gray-900">{{ $review->user->name }}</h4>
                                                <div class="flex items-center gap-1 text-yellow-400 text-sm">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-200' }}" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                            <span class="text-sm text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-gray-600 leading-relaxed">{{ $review->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-white rounded-2xl border border-gray-100 border-dashed">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            <p class="text-gray-500">No reviews yet. Be the first to share your experience!</p>
                        </div>
                    @endif
                </div>
            </div>
            

            <!-- Right Column: Booking Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 bg-white rounded-[2rem] shadow-2xl p-8 border border-gray-100">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Book Room</h3>
                    
                    <form action="{{ route('bookings.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        <input type="hidden" name="total_harga" id="total_harga_input">
                        <input type="hidden" name="jumlah_kamar" value="1">

                        <!-- User Info -->
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Your Name</label>
                            <input type="text" value="{{ Auth::user()->name ?? '' }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-primary focus:bg-white focus:ring-0 transition-all" readonly>
                        </div>

                        <!-- NIK -->
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">NIK (National ID)</label>
                            <input type="text" name="nik" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-primary focus:bg-white focus:ring-0 transition-all" placeholder="Enter your NIK" required>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Phone Number</label>
                            <input type="text" name="no_hp" value="{{ Auth::user()->no_hp ?? '' }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-primary focus:bg-white focus:ring-0 transition-all" placeholder="Enter your phone number" required>
                        </div>
                        
                        <!-- Date Range Picker -->
                        <div class="mb-6">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Select Dates (Check-in - Check-out)</label>
                            <div class="relative">
                                <input type="text" id="date_range" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-primary focus:bg-white focus:ring-0 transition-all pl-10" placeholder="Select Check-in & Check-out Date" required>
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <!-- Hidden inputs for backend -->
                            <input type="hidden" name="tgl_check_in" id="tgl_check_in">
                            <input type="hidden" name="tgl_check_out" id="tgl_check_out">
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-4">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Payment Method</label>
                            <select name="payment_method" id="payment_method_select" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-primary focus:bg-white focus:ring-0 transition-all" required>
                                <option value="pay_at_hotel">Pay at Hotel</option>
                                <option value="credit_card">Credit Card</option>
                            </select>
                        </div>

                        <!-- Credit Card Input (Hidden by default) -->
                        <div class="mb-4 hidden" id="credit_card_field">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Credit Card Number</label>
                            <input type="text" name="credit_card_number" id="credit_card_input" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-primary focus:bg-white focus:ring-0 transition-all" placeholder="XXXX-XXXX-XXXX-XXXX">
                        </div>

                        <!-- Discount Selection -->
                        @auth
                            @if(count($availableDiscounts) > 0)
                                <div class="mb-6">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Available Discounts</label>
                                    <select name="discount_id" id="discount_select" class="w-full px-4 py-3 rounded-xl bg-gray-50 border-transparent focus:border-primary focus:bg-white focus:ring-0 transition-all">
                                        <option value="" data-percent="0">Select a discount</option>
                                        @foreach($availableDiscounts as $discount)
                                            <option value="{{ $discount->id }}" data-percent="{{ $discount->persentase }}">
                                                {{ $discount->nama }} ({{ $discount->persentase }}% OFF)
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                        @endauth

                        <!-- Total Price Display -->
                        <div class="bg-[#E0F2F1] rounded-xl p-4 mb-6">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-bold text-gray-900" id="subtotal_display">Rp 0</span>
                            </div>
                            <div class="flex justify-between items-center mb-2 text-green-600 hidden" id="discount_row">
                                <span>Discount</span>
                                <span class="font-bold" id="discount_display">-Rp 0</span>
                            </div>
                            <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                                <span class="text-primary font-bold text-lg">Total Price</span>
                                <span class="text-2xl font-bold text-primary" id="total_price_display">Rp 0</span>
                            </div>
                        </div>

                        @auth
                            <button type="submit" class="w-full bg-primary text-white font-bold py-4 rounded-xl hover:bg-[#5E8B94] transition-all shadow-lg hover:shadow-primary/30 transform hover:-translate-y-1">
                                Book Now
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="block w-full text-center bg-gray-800 text-white font-bold py-4 rounded-xl hover:bg-gray-700 transition-all">
                                Login to Book
                            </a>
                        @endauth
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Flatpickr Script -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookedDates = @json($bookedDates);
        const pricePerNight = {{ $room->harga }};
        const dateRangeInput = document.getElementById('date_range');
        const tglCheckInInput = document.getElementById('tgl_check_in');
        const tglCheckOutInput = document.getElementById('tgl_check_out');
        const totalPriceDisplay = document.getElementById('total_price_display');
        const totalPriceInput = document.getElementById('total_harga_input');

        // Disable booked dates logic
        const disableDates = bookedDates.map(date => {
            return {
                from: date.start,
                to: date.end
            };
        });

        const fp = flatpickr(dateRangeInput, {
            mode: "range",
            minDate: "today",
            disable: disableDates,
            dateFormat: "Y-m-d",
            showMonths: 1,
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    const checkIn = instance.formatDate(selectedDates[0], "Y-m-d");
                    const checkOut = instance.formatDate(selectedDates[1], "Y-m-d");
                    
                    tglCheckInInput.value = checkIn;
                    tglCheckOutInput.value = checkOut;
                    
                    calculateTotal(selectedDates[0], selectedDates[1]);
                } else {
                    tglCheckInInput.value = '';
                    tglCheckOutInput.value = '';
                    resetTotal();
                }
            }
        });

        const paymentMethodSelect = document.getElementById('payment_method_select');
        const creditCardField = document.getElementById('credit_card_field');
        const creditCardInput = document.getElementById('credit_card_input');

        if(paymentMethodSelect) {
            paymentMethodSelect.addEventListener('change', function() {
                if(this.value === 'credit_card') {
                    creditCardField.classList.remove('hidden');
                    creditCardInput.required = true;
                } else {
                    creditCardField.classList.add('hidden');
                    creditCardInput.required = false;
                    creditCardInput.value = '';
                }
            });
        }

        const discountSelect = document.getElementById('discount_select');
        const subtotalDisplay = document.getElementById('subtotal_display');
        const discountDisplay = document.getElementById('discount_display');
        const discountRow = document.getElementById('discount_row');

        if(discountSelect) {
            discountSelect.addEventListener('change', function() {
                if (fp.selectedDates.length === 2) {
                    calculateTotal(fp.selectedDates[0], fp.selectedDates[1]);
                }
            });
        }

        function calculateTotal(checkInDate, checkOutDate) {
            if (checkInDate && checkOutDate) {
                const diffTime = Math.abs(checkOutDate - checkInDate);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
                
                if(diffDays > 0) {
                    const subtotal = diffDays * pricePerNight;
                    let total = subtotal;
                    let discountAmount = 0;

                    // Calculate Discount
                    if (discountSelect && discountSelect.value) {
                        const selectedOption = discountSelect.options[discountSelect.selectedIndex];
                        const percent = parseFloat(selectedOption.getAttribute('data-percent')) || 0;
                        discountAmount = subtotal * (percent / 100);
                        total = subtotal - discountAmount;

                        discountRow.classList.remove('hidden');
                        discountDisplay.innerText = '-Rp ' + new Intl.NumberFormat('id-ID').format(discountAmount);
                    } else {
                        if(discountRow) discountRow.classList.add('hidden');
                    }

                    subtotalDisplay.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
                    totalPriceDisplay.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
                    totalPriceInput.value = total;
                } else {
                    resetTotal();
                }
            }
        }

        function resetTotal() {
            subtotalDisplay.innerText = 'Rp 0';
            totalPriceDisplay.innerText = 'Rp 0';
            totalPriceInput.value = 0;
            if(discountRow) discountRow.classList.add('hidden');
        }
    });
</script>
@endsection
