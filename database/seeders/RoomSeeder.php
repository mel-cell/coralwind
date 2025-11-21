<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::create([
            'nama_kamar' => 'Superior Room',
            'tipe_kamar' => 'Superior',
            'harga' => 1500000,
            'deskripsi' => 'A comfortable superior room with modern amenities.',
            'gambar' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
            'status' => 'tersedia',
            'rating' => 8.5,
        ]);

        Room::create([
            'nama_kamar' => 'Deluxe Room',
            'tipe_kamar' => 'Deluxe',
            'harga' => 2000000,
            'deskripsi' => 'A spacious deluxe room with premium features.',
            'gambar' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
            'status' => 'tersedia',
            'rating' => 9.2,
        ]);

        Room::create([
            'nama_kamar' => 'Suite Room',
            'tipe_kamar' => 'Suite',
            'harga' => 3000000,
            'deskripsi' => 'A luxurious suite with panoramic views.',
            'gambar' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
            'status' => 'tersedia',
            'rating' => 9.8,
        ]);
    }
}
