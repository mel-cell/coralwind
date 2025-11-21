<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $rooms = \App\Models\Room::take(6)->get(); // Fetch latest rooms
    $highRatedReviews = \App\Models\Review::with('user', 'room')->where('rating', '>=', 5)->latest()->take(4)->get(); 
    return view('home', compact('rooms', 'highRatedReviews'));
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/rooms', [\App\Http\Controllers\RoomController::class, 'index'])->name('rooms.index');

Route::get('/rooms/{room}', [\App\Http\Controllers\RoomController::class, 'show'])->name('rooms.show');

Route::get('/transaksi/pemesanan', [\App\Http\Controllers\BookingController::class, 'create'])->name('transaksi.pemesanan')->middleware('auth');
Route::post('/transaksi/pemesanan', [\App\Http\Controllers\BookingController::class, 'store'])->name('transaksi.store')->middleware('auth');
Route::get('/transaksi/konfirmasi/{booking}', [\App\Http\Controllers\BookingController::class, 'show'])->name('transaksi.konfirmasi')->middleware('auth');
Route::post('/bookings', [\App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/riwayat', function () {
        return view('riwayat.index');
    })->name('riwayat.index');
});

require __DIR__.'/auth.php';
