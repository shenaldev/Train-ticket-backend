<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;

class Train extends Model
{
    use HasFactory;
    use PowerJoins;

    protected $fillable = [
        "name", "slug",
    ];

    public function train_schedules()
    {
        return $this->belongsToMany(TrainSchedule::class, "id");
    }

}
