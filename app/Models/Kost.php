<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'harga',
        'tipe',
        'jumlah_kamar',
        'fasilitas',
        'jenis', // Tambahkan ini jika kolom database adalah 'jenis'
    ];

    // Relasi ke Kamar
    public function kamars()
    {
        return $this->hasMany(Kamar::class);
    }

    // Attribute untuk mendapatkan jenis (cewe/cowo/campur)
    public function getJenisAttribute()
    {
        return $this->tipe ?? $this->attributes['jenis'] ?? null;
    }

    // Attribute untuk fasilitas yang diparsing dari JSON
    public function getFasilitasArrayAttribute()
    {
        $fasilitas = $this->fasilitas;
        
        if (is_string($fasilitas)) {
            return json_decode($fasilitas, true) ?? [];
        }
        
        return $fasilitas ?? [];
    }

    // Cek apakah ada fasilitas tertentu
    public function hasFasilitas($key)
    {
        $fasilitasArray = $this->fasilitas_array;
        return isset($fasilitasArray[$key]) && $fasilitasArray[$key];
    }
}