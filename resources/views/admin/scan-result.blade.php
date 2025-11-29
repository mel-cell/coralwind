<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Result - Coralwind Suites</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-[2rem] shadow-xl p-8 max-w-md w-full text-center relative overflow-hidden">
        
        <!-- Status Icon -->
        <div class="mb-6 flex justify-center">
            @if($status === 'success')
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center animate-bounce">
                    <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            @else
                <div class="w-24 h-24 bg-yellow-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            @endif
        </div>

        <!-- Message -->
        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $status === 'success' ? 'Verified!' : 'Attention' }}</h1>
        <p class="text-gray-600 mb-8">{{ $message }}</p>

        <!-- Booking Details Card -->
        <div class="bg-gray-50 rounded-xl p-6 text-left border border-gray-100 mb-8">
            <div class="flex justify-between mb-3 border-b border-gray-200 pb-2">
                <span class="text-gray-500 text-sm">Booking ID</span>
                <span class="font-bold text-gray-900">#{{ $booking->id }}</span>
            </div>
            <div class="flex justify-between mb-3 border-b border-gray-200 pb-2">
                <span class="text-gray-500 text-sm">Guest</span>
                <span class="font-bold text-gray-900">{{ $booking->user->name }}</span>
            </div>
            <div class="flex justify-between mb-3 border-b border-gray-200 pb-2">
                <span class="text-gray-500 text-sm">Room</span>
                <span class="font-bold text-gray-900">{{ $booking->room->nama_kamar }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Check-in</span>
                <span class="font-bold text-gray-900">{{ $booking->tgl_check_in->format('d M Y') }}</span>
            </div>
        </div>

        <!-- Action -->
        <a href="{{ url('/admin') }}" class="block w-full bg-gray-900 text-white font-bold py-3 px-6 rounded-full hover:bg-gray-800 transition-colors">
            Back to Dashboard
        </a>

    </div>

</body>
</html>
