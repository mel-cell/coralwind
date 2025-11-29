@extends('layouts.public')
@section('content')
<div class="min-h-screen bg-gray-50 py-20 pt-32">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <span class="text-gray-500 text-lg uppercase tracking-wider">Account Settings</span>
            <h1 class="text-4xl font-bold text-gray-900 mt-2">Your Profile</h1>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left Column: Navigation / Summary -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Profile Card -->
                <div class="bg-white rounded-[2rem] p-8 shadow-lg border border-gray-100 text-center relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-full h-24 bg-[#74A6AF]/10"></div>
                    <div class="relative">
                        <div class="w-24 h-24 mx-auto bg-[#E0F2F1] rounded-full flex items-center justify-center text-[#74A6AF] text-3xl font-bold mb-4 shadow-inner">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">{{ Auth::user()->name }}</h2>
                        <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
                        
                        <div class="mt-6 pt-6 border-t border-gray-100 flex justify-center gap-4">
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-primary">{{ Auth::user()->bookings->count() }}</span>
                                <span class="text-xs text-gray-400 uppercase tracking-wide">Bookings</span>
                            </div>
                            <div class="w-px bg-gray-200"></div>
                            <div class="text-center">
                                <span class="block text-2xl font-bold text-primary">{{ Auth::user()->reviews->count() ?? 0 }}</span>
                                <span class="text-xs text-gray-400 uppercase tracking-wide">Reviews</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Links (Optional) -->
                <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100">
                    <nav class="space-y-2">
                        <a href="{{ route('riwayat.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="font-medium">Booking History</span>
                        </a>
                        <!-- Add more links if needed -->
                    </nav>
                </div>
            </div>

            <!-- Right Column: Forms -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Update Profile Info -->
                <div class="bg-white rounded-[2rem] p-8 shadow-lg border border-gray-100">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Profile Information</h3>
                        <p class="text-gray-500 text-sm">Update your account's profile information and email address.</p>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Update Password -->
                <div class="bg-white rounded-[2rem] p-8 shadow-lg border border-gray-100">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Update Password</h3>
                        <p class="text-gray-500 text-sm">Ensure your account is using a long, random password to stay secure.</p>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Delete Account -->
                <div class="bg-white rounded-[2rem] p-8 shadow-lg border border-red-100">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-red-600">Delete Account</h3>
                        <p class="text-gray-500 text-sm">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection