<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function claim(Request $request, $id)
    {
        $discount = \App\Models\Discount::findOrFail($id);
        /** @var \Illuminate\Contracts\Auth\Guard $auth */
        $auth = auth();
        /** @var \App\Models\User $user */
        $user = $auth->user();

        // Check if already claimed
        if (!$user->discounts()->where('discount_id', $discount->id)->exists()) {
            $user->discounts()->attach($discount->id, ['is_used' => false]);
            return back()->with('success', 'Discount claimed successfully!');
        }

        return back()->with('info', 'You have already claimed this discount.');
    }

    public function redeem(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:discounts,kode',
        ]);

        $discount = \App\Models\Discount::where('kode', $request->code)->first();
        
        // Check expiration
        if ($discount->expires_at && $discount->expires_at->isPast()) {
            return back()->with('error', 'This discount code has expired.');
        }

        /** @var \Illuminate\Contracts\Auth\Guard $auth */
        $auth = auth();
        /** @var \App\Models\User $user */
        $user = $auth->user();

        // Check if already claimed
        if ($user->discounts()->where('discount_id', $discount->id)->exists()) {
            return back()->with('info', 'You have already claimed this discount.');
        }

        $user->discounts()->attach($discount->id, ['is_used' => false]);

        return back()->with('success', 'Discount redeemed successfully!');
    }
}
