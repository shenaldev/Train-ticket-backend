<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;

class ReservationSeat extends Model
{
    use HasFactory;
    use PowerJoins;

    protected $fillable = [
        "reservation_id", "seat_no",
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
