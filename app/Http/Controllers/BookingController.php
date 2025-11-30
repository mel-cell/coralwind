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
            'tgl_check_in' => 'required|date|after_or_equal:today',
            'tgl_check_out' => 'required|date|after:tgl_check_in',
            'jumlah_kamar' => 'required|integer|min:1',
            'payment_method' => 'required|in:pay_at_hotel,credit_card',
            'credit_card_number' => ['required_if:payment_method,credit_card', 'nullable', 'string', 'min:13', 'max:25', 'regex:/^[\d\s\-]+$/'],
            'discount_id' => 'nullable|exists:discounts,id',
            'nik' => ['required', 'string', 'size:16', 'regex:/^[0-9]+$/'],
            'no_hp' => ['required', 'string', 'min:10', 'max:15', 'regex:/^[\d\+\-\(\) ]+$/'],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Update user's phone number and NIK if they are different or empty
        $updateData = [];
        if ($user->no_hp !== $request->no_hp) {
            $updateData['no_hp'] = $request->no_hp;
        }
        if ($user->nik !== $request->nik) {
            $updateData['nik'] = $request->nik;
        }

        if (!empty($updateData)) {
            $user->update($updateData);
        }

        $room = Room::findOrFail($request->room_id);
        $checkIn = \Carbon\Carbon::parse($request->tgl_check_in);
        $checkOut = \Carbon\Carbon::parse($request->tgl_check_out);
        $days = $checkIn->diffInDays($checkOut);
        
        if ($days < 1) $days = 1;

        // Check for overlapping bookings
        $isBooked = Booking::where('room_id', $request->room_id)
            ->where(function ($query) {
                $query->where('status', 'bayar')
                      ->orWhere('status', 'pending');
            })
            ->where(function ($query) use ($request) {
                $query->whereBetween('tgl_check_in', [$request->tgl_check_in, $request->tgl_check_out])
                      ->orWhereBetween('tgl_check_out', [$request->tgl_check_in, $request->tgl_check_out])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('tgl_check_in', '<=', $request->tgl_check_in)
                            ->where('tgl_check_out', '>=', $request->tgl_check_out);
                      });
            })
            ->exists();

        if ($isBooked) {
            return back()->withErrors(['room_id' => 'Kamar ini sudah dipesan pada tanggal yang dipilih. Silakan pilih tanggal atau kamar lain.'])->withInput();
        }

        $totalPrice = $room->harga * $days;

        // Apply Discount
        if ($request->discount_id) {
            $discount = \App\Models\Discount::find($request->discount_id);

            // Validate discount availability
            $isUsed = $user->discounts()
                ->where('discount_id', $discount->id)
                ->wherePivot('is_used', true)
                ->exists();

            if (!$isUsed && ($discount->expires_at == null || $discount->expires_at >= now())) {
                $discountAmount = $totalPrice * ($discount->persentase / 100);
                $totalPrice -= $discountAmount;

                // Mark discount as used
                // Check if pivot exists, if not attach, if yes update
                $pivotExists = $user->discounts()->where('discount_id', $discount->id)->exists();
                if ($pivotExists) {
                    $user->discounts()->updateExistingPivot($discount->id, ['is_used' => true]);
                } else {
                    $user->discounts()->attach($discount->id, ['is_used' => true]);
                }
            }
        }

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'tgl_check_in' => $request->tgl_check_in,
            'tgl_check_out' => $request->tgl_check_out,
            'jumlah_kamar' => $request->jumlah_kamar,
            'total_harga' => $totalPrice,
            'payment_method' => $request->payment_method,
            'credit_card_number' => $request->credit_card_number,
            'nik' => $request->nik,
            'no_hp' => $request->no_hp,
            'status' => $request->payment_method === 'credit_card' ? 'bayar' : 'pending',
        ]);

        return redirect()->route('riwayat.index')->with('success', 'Booking created successfully!')->with('new_booking_id', $booking->id);
    }

    public function downloadInvoice(Booking $booking)
    {
        if (Auth::id() !== $booking->user_id && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $verificationUrl = \Illuminate\Support\Facades\URL::signedRoute('admin.verify', ['booking' => $booking->id]);
        
        $qrcode = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode($verificationUrl);

        // Return HTML view directly for browser printing
        return view('pdf.invoice', compact('booking', 'qrcode'));
    }   

    public function verify(Request $request, Booking $booking)
    {
        // Ensure user is admin
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action. Only admins can verify bookings.');
        }

        if ($booking->status === 'selesai') {
            return view('admin.scan-result', [
                'booking' => $booking,
                'status' => 'warning',
                'message' => 'Booking ini sudah diverifikasi sebelumnya.'
            ]);
        }

        $booking->update(['status' => 'selesai']);

        return view('admin.scan-result', [
            'booking' => $booking,
            'status' => 'success',
            'message' => 'Verifikasi Berhasil! Booking telah ditandai selesai.'
        ]);
    }
}
