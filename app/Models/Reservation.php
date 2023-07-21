<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;

class Reservation extends Model
{
    use HasFactory;
    use PowerJoins;

    protected $fillable = [
        "user_id", "schedule_id", "class_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservation_seats()
    {
        return $this->hasMany(ReservationSeat::class);
    }

    public function train()
    {
        return $this->belongsTo(Train::class);
    }

    public function train_schedule()
    {
        return $this->belongsTo(TrainSchedule::class);
    }
}
