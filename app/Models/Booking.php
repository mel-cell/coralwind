<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'tgl_check_in',
        'tgl_check_out',
        'jumlah_kamar',
        'total_harga',
        'status',
    ];

    protected $casts = [
        'tgl_check_in' => 'date',
        'tgl_check_out' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
