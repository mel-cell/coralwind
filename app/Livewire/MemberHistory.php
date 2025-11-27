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

    public $isEditing = false;

    public function openReviewForm($bookingId)
    {
        $this->selectedBookingId = $bookingId;
        $booking = $this->bookings->find($bookingId);

        if ($booking && $booking->review) {
            $this->isEditing = true;
            $this->rating = $booking->review->rating;
            $this->comment = $booking->review->comment;
        } else {
            $this->isEditing = false;
            $this->rating = 5;
            $this->comment = '';
        }
    }

    public function closeReviewForm()
    {
        $this->selectedBookingId = null;
        $this->isEditing = false;
        $this->rating = 5;
        $this->comment = '';
    }

    public function submitReview()
    {
        $this->validate();

        $booking = $this->bookings->find($this->selectedBookingId);

        if (!$booking) {
            return;
        }

        if ($this->isEditing) {
            $booking->review->update([
                'rating' => $this->rating,
                'comment' => $this->comment,
            ]);
            $message = 'Testimoni berhasil diperbarui!';
        } else {
            if ($booking->review || $booking->status === 'pending') {
                return;
            }

            Review::create([
                'user_id' => Auth::id(),
                'booking_id' => $booking->id,
                'room_id' => $booking->room_id,
                'rating' => $this->rating,
                'comment' => $this->comment,
            ]);
            $message = 'Testimoni berhasil ditambahkan!';
        }

        // Update room rating
        // Note: The room model likely has an accessor or method to calculate average rating, 
        // but here we are just triggering an update to potentially refresh timestamps or similar.
        // Ideally, average rating is calculated on the fly or cached.
        $booking->room->touch(); 

        $this->closeReviewForm();
        $this->loadBookings();

        session()->flash('message', $message);
    }

    public function deleteReview($bookingId)
    {
        $booking = $this->bookings->find($bookingId);

        if ($booking && $booking->review) {
            $booking->review->delete();
            $booking->room->touch();
            $this->loadBookings();
            session()->flash('message', 'Testimoni berhasil dihapus.');
        }
    }

    public function cancelBooking($bookingId)
    {
        $booking = $this->bookings->find($bookingId);

        if ($booking && $booking->status === 'pending') {
            $booking->update(['status' => 'batal']);
            $this->loadBookings();
            session()->flash('message', 'Booking berhasil dibatalkan.');
        }
    }

    public function render()
    {
        return view('livewire.member-history');
    }
}
