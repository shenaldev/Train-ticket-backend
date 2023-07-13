<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;

class Location extends Model
{
    use HasFactory;
    use PowerJoins;

    protected $fillable = [
        'name', 'slug',
    ];

    public function train_schedule()
    {
        return $this->hasMany(TrainSchedule::class, "from");
    }
}
