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
        return view('rooms.show', compact('room'));
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
