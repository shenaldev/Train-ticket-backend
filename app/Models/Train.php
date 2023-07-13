<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "slug",
    ];

    public function train_schedules()
    {
        return $this->belongsToMany(TrainSchedule::class, "train_id");
    }
}
