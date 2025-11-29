<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::where('role', 'user')->get();
        $rooms = \App\Models\Room::all();

        if ($users->isEmpty() || $rooms->isEmpty()) {
            return;
        }

        foreach ($users as $user) {
            // Create 3-5 completed bookings (past)
            for ($i = 0; $i < rand(3, 5); $i++) {
                \App\Models\Booking::create([
                    'user_id' => $user->id,
                    'room_id' => $rooms->random()->id,
                    'tgl_check_in' => now()->subDays(rand(30, 100)),
                    'tgl_check_out' => now()->subDays(rand(10, 29)),
                    'jumlah_kamar' => 1,
                    'total_harga' => rand(1500000, 5000000),
                    'status' => 'selesai',
                    'payment_method' => 'credit_card',
                    'credit_card_number' => '4242424242424242',
                    'nik' => '1234567890123456',
                    'no_hp' => '081234567890',
                ]);
            }

            // Create 1-3 pending bookings (future)
            for ($i = 0; $i < rand(1, 3); $i++) {
                \App\Models\Booking::create([
                    'user_id' => $user->id,
                    'room_id' => $rooms->random()->id,
                    'tgl_check_in' => now()->addDays(rand(1, 30)),
                    'tgl_check_out' => now()->addDays(rand(31, 40)),
                    'jumlah_kamar' => 1,
                    'total_harga' => rand(1500000, 5000000),
                    'status' => 'pending',
                    'payment_method' => 'pay_at_hotel',
                    'nik' => '1234567890123456',
                    'no_hp' => '081234567890',
                ]);
            }

            // Create 1 cancelled booking
            \App\Models\Booking::create([
                'user_id' => $user->id,
                'room_id' => $rooms->random()->id,
                'tgl_check_in' => now()->addDays(rand(50, 60)),
                'tgl_check_out' => now()->addDays(rand(61, 65)),
                'jumlah_kamar' => 1,
                'total_harga' => rand(1500000, 5000000),
                'status' => 'batal',
                'payment_method' => 'credit_card',
                'credit_card_number' => '4242424242424242',
                'nik' => '1234567890123456',
                'no_hp' => '081234567890',
            ]);
        }
    }
}
