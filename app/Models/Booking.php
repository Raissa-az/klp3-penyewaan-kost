<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'kamar_id',
    'kost_id',
    'status',
    'tanggal_mulai',
    'tanggal_selesai',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

public function kamar()
{
    return $this->belongsTo(Kamar::class)->with('kost');
}
   
    public function kost()
{
    return $this->belongsTo(Kost::class);
}

    // Update agar sesuai enum di migration
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}
