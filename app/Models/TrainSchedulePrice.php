<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;

class TrainSchedulePrice extends Model
{
    use HasFactory;
    use PowerJoins;

    protected $fillable = [
        "schedule_id", "class_id", "price",
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function train_schedule()
    {
        return $this->belongsTo(TrainSchedule::class, "schedule_id");
    }
}
