<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Booking;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query();

        // Search by name
        if ($request->has('search') && $request->search) {
            $query->where('nama_kamar', 'like', '%' . $request->search . '%');
        }

        // Filter by status
        if ($request->has('status') && $request->status) {
            if ($request->status === 'available') {
                $query->whereDoesntHave('bookings', function ($q) {
                    $q->whereIn('status', ['confirmed', 'pending'])
                      ->where('tgl_check_out', '>=', Carbon::today());
                });
            } elseif ($request->status === 'booked') {
                $query->whereHas('bookings', function ($q) {
                    $q->whereIn('status', ['confirmed', 'pending'])
                      ->where('tgl_check_out', '>=', Carbon::today());
                });
            }
        }

        // Filter by room type if provided
        if ($request->has('tipe_kamar') && $request->tipe_kamar) {
            $query->where('tipe_kamar', $request->tipe_kamar);
        }

        $rooms = $query->paginate(9);

        // Check availability for each room and add status
        foreach ($rooms as $room) {
            $room->availability_status = $this->checkRoomAvailability($room);
        }

        return view('rooms.index', compact('rooms'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        $checkIn = $request->check_in;
        $checkOut = $request->check_out;
        $guests = $request->guests;

        $query = Room::whereDoesntHave('bookings', function ($q) use ($checkIn, $checkOut) {
            $q->where('status', '!=', 'batal')
              ->where('tgl_check_in', '<', $checkOut)
              ->where('tgl_check_out', '>', $checkIn);
        });

        // Note: No capacity field, so no filtering by guests; all available rooms shown
        $rooms = $query->paginate(9);

        return view('rooms.index', compact('rooms'))
            ->with('searchParams', $request->only(['check_in', 'check_out', 'guests']));
    }

    public function show(Room $room)
    {
        $room->availability_status = $this->checkRoomAvailability($room);
        $room->load('reviews.user');

        // Fetch booked dates
        $bookedDates = \App\Models\Booking::where('room_id', $room->id)
            ->where(function ($query) {
                $query->whereIn('status', ['confirmed', 'pending', 'bayar']) // Include 'bayar' if used
                      ->whereNotIn('status', ['batal', 'cancelled']);
            })
            ->where('tgl_check_out', '>=', Carbon::today())
            ->get(['tgl_check_in', 'tgl_check_out'])
            ->map(function ($booking) {
                return [
                    'start' => $booking->tgl_check_in->format('Y-m-d'),
                    'end' => $booking->tgl_check_out->subDay()->format('Y-m-d'),
                ];
            });

        // Fetch available discounts for authenticated user
        $availableDiscounts = [];
        if (auth()->check()) {
            $user = auth()->user();
            $availableDiscounts = \App\Models\Discount::where(function ($query) {
                    $query->whereNull('expires_at')
                          ->orWhere('expires_at', '>=', Carbon::today());
                })
                ->whereHas('users', function ($query) use ($user) {
                    $query->where('user_id', $user->id)
                          ->where('is_used', false);
                })
                ->get();
        }

        return view('rooms.show', compact('room', 'bookedDates', 'availableDiscounts'));
    }

    private function checkRoomAvailability(Room $room)
    {
        // Check if room has any active bookings (confirmed or pending) in the future
        $activeBookings = \App\Models\Booking::where('room_id', $room->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->where('tgl_check_out', '>=', Carbon::today())
            ->count();

        return $activeBookings > 0 ? 'booked' : 'available';
    }
}
