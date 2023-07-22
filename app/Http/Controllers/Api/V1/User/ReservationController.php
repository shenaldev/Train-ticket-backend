<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $userID = $request->user()->id;

        $reservations = Reservation::where("user_id", "=", $userID)
            ->select([
                "reservations.*",
                'train_schedules.id as schedule',
                "trains.name as train",
            ])
            ->join("train_schedules", "train_schedules.id", "=", "reservations.schedule_id")
            ->join("trains", "train_schedules.train_id", "=", "trains.id")
            ->with("train_schedule.location:id,name",
                "train_schedule.locationTo:id,name",
                "reservation_seats:id,reservation_id,seat_no")
            ->get();

        return response()->json($reservations);

    }
}
