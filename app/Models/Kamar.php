<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $table = 'kamars';

 protected $fillable = [
    'kost_id',
    'nomor',        // dari form
    'tipe_kamar',   // dari form
    'harga',
    'status',
    'deskripsi',
];


    public function kost()
    {
        return $this->belongsTo(Kost::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
