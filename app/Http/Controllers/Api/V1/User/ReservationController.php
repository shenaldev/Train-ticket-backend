<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\TrainSchedule;
use App\Models\User;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $userID = $request->user()->id;

        $reservations = TrainSchedule::select([
            'train_schedules.id',
            'reservations.id as reservation_id',
            'trains.name as train_name',
            'classes.name as class',
            'train_schedules.departure_time',
            'train_schedules.arrival_time',
        ])->
            where('reservations.user_id', "=", $userID)
            ->join("reservations", "train_schedules.id", "=", "reservations.schedule_id")
            ->join("trains", "trains.id", "=", "train_schedules.train_id")
            ->join("classes", 'classes.id', "=", 'reservations.class_id')
            ->get();

        return response()->json($reservations);

    }
}
