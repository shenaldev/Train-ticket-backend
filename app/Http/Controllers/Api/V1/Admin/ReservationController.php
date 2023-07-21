<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainSchedule;
use DateTime;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $from = new DateTime($request->from);
        $to = new DateTime($request->to);

        $reservations = TrainSchedule::select([
            'train_schedules.id',
            'reservations.id',
            'users.name as user_name',
            'trains.name as train_name',
            'train_schedules.departure_time as date',
        ])->
            whereBetween('departure_time', [$from, $to])
            ->join("reservations", "train_schedules.id", "=", "reservations.schedule_id")
            ->join('users', "users.id", "=", "reservations.user_id")
            ->join("trains", "trains.id", "=", "train_schedules.train_id")
            ->paginate(30);

        return response()->json($reservations);
    }
}
