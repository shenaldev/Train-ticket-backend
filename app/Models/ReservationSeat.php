<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationSeat extends Model
{
    use HasFactory;

    protected $fillable = [
        "reservation_id", "seat_no",
    ];
}
