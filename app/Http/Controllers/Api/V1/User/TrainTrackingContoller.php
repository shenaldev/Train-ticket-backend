<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\TrainRoute;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrainTrackingContoller extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now("GMT+5:30")->format('Y-m-d');
        $userID = $request->user()->id;

        $trackingList = [];

        $todayReservations = Reservation::select([
            'reservations.id', 'schedule_id',
            'train_schedules.departure_time', "train_schedules.arrival_time", "train_schedules.routes_id",
        ])->
            where("user_id", $userID)
            ->join("train_schedules", "train_schedules.id", "=", "reservations.schedule_id")
            ->where("train_schedules.departure_time", "like", "%" . $today . "%")
            ->get();

        foreach ($todayReservations as $reservation) {
            $route = TrainRoute::find($reservation->routes_id);
            $routeList = $route->route_ids;
            $trackingList[] = [
                "id" => $reservation->id,
                "schedule_id" => $reservation->schedule_id,
                "departure_time" => $reservation->departure_time,
                "arrival_time" => $reservation->arrival_time,
                "route" => $route->from_to,
            ];
        }

        return response()->json($trackingList, 200);
    }
}
