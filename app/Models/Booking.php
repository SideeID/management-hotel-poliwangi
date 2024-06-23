<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservations_id',
        'booking_date',
        'total_harga',
        'total_tamu',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservations_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'bookings_id');
    }
}
