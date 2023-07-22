<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainScheduleSeat extends Model
{
    use HasFactory;

    protected $fillable = [
        "schedule_id", "class_id", "available_count",
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
