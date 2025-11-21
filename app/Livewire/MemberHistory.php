<?php

namespace App\Livewire;

use App\Models\Review;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MemberHistory extends Component
{
    public $bookings;
    public $selectedBookingId = null;
    public $rating = 5;
    public $comment = '';

    protected $rules = [
        'rating' => 'required|integer|min:1|max:10',
        'comment' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        $this->loadBookings();
    }

    public function loadBookings()
    {
        /** @var User $user */
        $user = Auth::user();
        $this->bookings = $user->bookings()->with('room', 'review')->latest()->get();
    }

    public function getBookingsProperty()
    {
        /** @var User $user */
        $user = Auth::user();
        return $user->bookings()->with('room', 'review')->latest()->get();
    }

    public function openReviewForm($bookingId)
    {
        $this->selectedBookingId = $bookingId;
        $this->rating = 5;
        $this->comment = '';
    }

    public function closeReviewForm()
    {
        $this->selectedBookingId = null;
        $this->rating = 5;
        $this->comment = '';
    }

    public function submitReview()
    {
        $this->validate();

        $booking = $this->bookings->find($this->selectedBookingId);

        if (!$booking || $booking->review || $booking->status === 'pending') {
            return;
        }

        Review::create([
            'user_id' => Auth::id(),
            'booking_id' => $booking->id,
            'room_id' => $booking->room_id,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        // Update room rating
        $booking->room->update(['rating' => $booking->room->average_rating ?? 0.0]);

        $this->closeReviewForm();
        $this->loadBookings();

        session()->flash('message', 'Testimoni berhasil ditambahkan!');
    }

    public function render()
    {
        return view('livewire.member-history');
    }
}
