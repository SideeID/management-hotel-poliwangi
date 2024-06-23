<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_id',
        'check_in',
        'check_out',
        'rate_plan_id',
        'booking_date',
        'total_harga_room',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reservation) {
            $ratePlan = RatePlan::find($reservation->rate_plan_id);
            $reservation->total_harga_room = $ratePlan->price;
        });
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class, 'guest_id');
    }

    public function rate_plan()
    {
        return $this->belongsTo(RatePlan::class, 'rate_plan_id');
    }
}
