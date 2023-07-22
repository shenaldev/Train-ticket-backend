<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;

class TrainSchedule extends Model
{
    use HasFactory;
    use PowerJoins;

    protected $fillable = [
        "train_id", "from", "to", "departure_time", "arrival_time", 'routes_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function train()
    {
        return $this->belongsTo(Train::class, "train_id");
    }

    public function location()
    {
        return $this->belongsTo(Location::class, "from");
    }

    public function locationTo()
    {
        return $this->belongsTo(Location::class, 'to');
    }

    public function schedule_price()
    {
        return $this->hasMany(TrainSchedulePrice::class, "schedule_id");
    }

    public function schedule_seats()
    {
        return $this->hasMany(TrainScheduleSeat::class, "schedule_id");
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
