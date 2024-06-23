<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'date_of_birth', 'gender', 'address', 'postal_code', 'place_of_birth'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
