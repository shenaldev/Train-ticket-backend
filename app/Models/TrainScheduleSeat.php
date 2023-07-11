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
}
