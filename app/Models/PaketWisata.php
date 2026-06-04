<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketWisata extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_paket',
        'deskripsi',
        'itinerary',
        'harga_per_orang',
        'destinasi',
        'durasi_hari',
        'min_peserta',
        'max_peserta',
        'foto',
        'is_active',
    ];

    protected $casts = [
        'harga_per_orang' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }
        return asset('images/default-destination.jpg');
    }

    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_per_orang, 0, ',', '.');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByDestinasi($query, $destinasi)
    {
        return $query->where('destinasi', 'like', "%{$destinasi}%");
    }

    public function scopeByHarga($query, $min, $max)
    {
        if ($min) $query->where('harga_per_orang', '>=', $min);
        if ($max) $query->where('harga_per_orang', '<=', $max);
        return $query;
    }
}