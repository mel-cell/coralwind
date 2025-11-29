<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $rooms = \App\Models\Room::take(6)->get(); // Fetch latest rooms
    
    $recommendedRooms = \App\Models\Room::orderByDesc('rating') 
        ->inRandomOrder() 
        ->take(3)
        ->get();

    $recommendedRooms = \App\Models\Room::withAvg('reviews', 'rating')
        ->orderByDesc('reviews_avg_rating')
        ->inRandomOrder() 
        ->take(3)
        ->get();

    $highRatedReviews = \App\Models\Review::with('user', 'room')->where('rating', '>=', 5)->latest()->take(4)->get(); 
    
    // Stats
    $totalRooms = \App\Models\Room::count();
    $totalReviews = \App\Models\Review::count();
    $totalBookings = \App\Models\Booking::count();
    $averageRating = \App\Models\Review::avg('rating');

    return view('home', compact('rooms', 'highRatedReviews', 'recommendedRooms', 'totalRooms', 'totalReviews', 'totalBookings', 'averageRating'));
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/rooms', [\App\Http\Controllers\RoomController::class, 'index'])->name('rooms.index');

Route::get('/rooms/{room}', [\App\Http\Controllers\RoomController::class, 'show'])->name('rooms.show');

Route::get('/transaksi/pemesanan', [\App\Http\Controllers\BookingController::class, 'create'])->name('transaksi.pemesanan')->middleware('auth');
Route::post('/transaksi/pemesanan', [\App\Http\Controllers\BookingController::class, 'store'])->name('transaksi.store')->middleware('auth');
Route::get('/transaksi/konfirmasi/{booking}', [\App\Http\Controllers\BookingController::class, 'show'])->name('transaksi.konfirmasi')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/bookings', [\App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
    Route::get('/riwayat', [\App\Http\Controllers\RiwayatController::class, 'index'])->name('riwayat.index');
    Route::post('/discounts/{id}/claim', [\App\Http\Controllers\DiscountController::class, 'claim'])->name('discounts.claim');
    Route::post('/discounts/redeem', [\App\Http\Controllers\DiscountController::class, 'redeem'])->name('discounts.redeem');
    
    // Invoice & Verification
    Route::get('/bookings/{booking}/invoice', [\App\Http\Controllers\BookingController::class, 'downloadInvoice'])->name('bookings.invoice');
    Route::get('/admin/verify/{booking}', [\App\Http\Controllers\BookingController::class, 'verify'])->name('admin.verify')->middleware('signed');
});

require __DIR__.'/auth.php';
