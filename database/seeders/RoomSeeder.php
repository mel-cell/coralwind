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

        Room::create([
            'nama_kamar' => 'Family Suite',
            'tipe_kamar' => 'Suite',
            'harga' => 3500000,
            'deskripsi' => 'Perfect for families, featuring two bedrooms and a living area.',
            'gambar' => 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
            'status' => 'tersedia',
            'rating' => 9.5,
        ]);

        Room::create([
            'nama_kamar' => 'Ocean View Deluxe',
            'tipe_kamar' => 'Deluxe',
            'harga' => 2500000,
            'deskripsi' => 'Wake up to the sound of waves with a stunning ocean view.',
            'gambar' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80',
            'status' => 'tersedia',
            'rating' => 9.4,
        ]);

        Room::create([
            'nama_kamar' => 'Garden Villa',
            'tipe_kamar' => 'Villa',
            'harga' => 4500000,
            'deskripsi' => 'Private villa surrounded by lush tropical gardens.',
            'gambar' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
            'status' => 'tersedia',
            'rating' => 9.9,
        ]);

        Room::create([
            'nama_kamar' => 'Standard Room',
            'tipe_kamar' => 'Standard',
            'harga' => 900000,
            'deskripsi' => 'Cozy and affordable room for solo travelers or couples.',
            'gambar' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
            'status' => 'tersedia',
            'rating' => 8.0,
        ]);

        Room::create([
            'nama_kamar' => 'Executive Suite',
            'tipe_kamar' => 'Suite',
            'harga' => 3200000,
            'deskripsi' => 'Designed for business travelers with a dedicated workspace.',
            'gambar' => 'https://images.unsplash.com/photo-1591088398332-8a7791972843?ixlib=rb-4.0.3&auto=format&fit=crop&w=1074&q=80',
            'status' => 'tersedia',
            'rating' => 9.3,
        ]);

        Room::create([
            'nama_kamar' => 'Pool Access Room',
            'tipe_kamar' => 'Deluxe',
            'harga' => 2800000,
            'deskripsi' => 'Direct access to the lagoon pool from your terrace.',
            'gambar' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1049&q=80',
            'status' => 'tersedia',
            'rating' => 9.6,
        ]);

        Room::create([
            'nama_kamar' => 'Presidential Suite',
            'tipe_kamar' => 'Suite',
            'harga' => 8000000,
            'deskripsi' => 'The ultimate luxury experience with private butler service.',
            'gambar' => 'https://images.unsplash.com/photo-1618773928121-c32242e63f39?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
            'status' => 'tersedia',
            'rating' => 9.9,
        ]);
    }
}
