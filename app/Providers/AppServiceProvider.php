<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \Filament\Http\Responses\Auth\Contracts\LogoutResponse::class,
            \App\Http\Responses\LogoutResponse::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Auto-cancel pending bookings that have passed check-in date
        if (!app()->runningInConsole()) {
            \App\Models\Booking::where('status', 'pending')
                ->where('tgl_check_in', '<', now()->startOfDay())
                ->update(['status' => 'batal']);
        }
    }
}
