<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_booking',
        'user_id',
        'paket_wisata_id',
        'tanggal_berangkat',
        'jumlah_peserta',
        'total_harga',
        'catatan',
        'status',
        'alasan_tolak',
        'pembayaran_diterima',
        'pembayaran_diterima_at',
    ];

    protected $casts = [
        'tanggal_berangkat' => 'date',
        'total_harga' => 'decimal:2',
        'pembayaran_diterima' => 'boolean',
        'pembayaran_diterima_at' => 'datetime',
    ];

    // Auto-generate kode_booking
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($booking) {
            $booking->kode_booking = 'TRV-' . strtoupper(Str::random(8));
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paketWisata()
    {
        return $this->belongsTo(PaketWisata::class);
    }

    public function getTotalHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'Pending'      => 'badge-warning',
            'Dikonfirmasi' => 'badge-info',
            'Berlangsung'  => 'badge-primary',
            'Selesai'      => 'badge-success',
            'Ditolak'      => 'badge-danger',
            default        => 'badge-secondary',
        };
    }

    public function canBeCancelled(): bool
    {
        return $this->status === 'Pending';
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}