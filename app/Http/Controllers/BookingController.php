<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        $room = Room::findOrFail($request->room_id);

        // Check if room is available for the dates
        $existingBooking = Booking::where('room_id', $room->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('tgl_check_in', [$request->check_in, $request->check_out])
                      ->orWhereBetween('tgl_check_out', [$request->check_in, $request->check_out])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('tgl_check_in', '<=', $request->check_in)
                            ->where('tgl_check_out', '>=', $request->check_out);
                      });
            })
            ->exists();

        if ($existingBooking) {
            return back()->withErrors(['dates' => 'Room is not available for the selected dates.']);
        }

        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'tgl_check_in' => $request->check_in,
            'tgl_check_out' => $request->check_out,
            'jumlah_kamar' => $request->guests,
            'total_harga' => $room->harga * (strtotime($request->check_out) - strtotime($request->check_in)) / (60 * 60 * 24),
            'status' => 'pending',
        ]);

        return redirect()->route('rooms.index')->with('success', 'Booking created successfully!');
    }
}
