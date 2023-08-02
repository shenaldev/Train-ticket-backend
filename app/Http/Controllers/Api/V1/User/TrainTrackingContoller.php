<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Reservation;
use App\Models\TrainRoute;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrainTrackingContoller extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::now("GMT+5:30")->format('Y-m-d');
        $time_now = Carbon::now("GMT+5:30")->format('Y-m-d H:i:s');
        $userID = $request->user()->id;
        $trackingList = [];
        $todayReservations = $this->getTodayReservations($userID);

        foreach ($todayReservations as $reservation) {
            $route = TrainRoute::find($reservation->routes_id);
            $current_location = "Not Started";

            // IF TRAIN HAS ARRIVED
            if ($reservation->arrival_time < $time_now) {
                $current_location = "Arrived Destination";
            }

            // IF TRAIN IS RUNNING
            if ($reservation->departure_time < $time_now && $reservation->arrival_time > $time_now) {
                $routeList = json_decode($route->route_ids); //IDS OF ROUT LIST
                //TIME DIFFERENCE BETWEEN DEPARTURE AND ARRIVAL
                $time_defference = Carbon::parse($reservation->departure_time)->diffInSeconds($reservation->arrival_time);
                $time_to_pass_one_route = ceil($time_defference / sizeof($routeList));
                $time_passed = Carbon::parse($reservation->departure_time)->diffInSeconds($time_now);
                $route_passed = floor($time_passed / $time_to_pass_one_route);
                $current_location_id = $routeList[$route_passed];
                $location = Location::find($current_location_id)->name;
                $current_location = $location;
            }

            $trackingList[] = [
                "id" => $reservation->id,
                "schedule_id" => $reservation->schedule_id,
                "departure_time" => $reservation->departure_time,
                "arrival_time" => $reservation->arrival_time,
                "route" => $route->from_to,
                'current_location' => $current_location,
            ];
        }

        return response()->json($trackingList, 200);
    }

    /**
     * Get today reservations by user id
     * @param $userID
     * @return mixed
     */
    private function getTodayReservations($userID)
    {
        $today = Carbon::now("GMT+5:30")->format('Y-m-d');

        return Reservation::select([
            'reservations.id', 'schedule_id',
            'train_schedules.departure_time', "train_schedules.arrival_time", "train_schedules.routes_id",
        ])->
            where("user_id", $userID)
            ->join("train_schedules", "train_schedules.id", "=", "reservations.schedule_id")
            ->where("train_schedules.departure_time", "like", "%" . $today . "%")
            ->get();
    }
}
