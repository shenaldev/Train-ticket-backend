<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\ReservationSeat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * GET USER RESERVATIONS FOR SELECTED TIME PERIOD
     * @param Requset $request {from, to}:date
     */
    public function index(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
        ]);

        $userID = $request->user()->id;

        $reservations = Reservation::where("user_id", "=", $userID)
            ->whereDate("train_schedules.departure_time", ">=", date($request->from))
            ->whereDate("train_schedules.departure_time", "<=", date($request->to))
            ->select([
                "reservations.*",
                'train_schedules.id as schedule', "train_schedules.departure_time", "train_schedules.train_id",
                "trains.name as train",
            ])
            ->join("train_schedules", "train_schedules.id", "=", "reservations.schedule_id")
            ->join("trains", "train_schedules.train_id", "=", "trains.id")
            ->with(
                "reservation_seats:id,reservation_id,seat_no",
                "train_schedule.location:id,name",
                "train_schedule.locationTo:id,name",
            )
            ->orderBy("train_schedules.departure_time")
            ->get()
            ->groupBy("departure_time");

        return response()->json($reservations);

    }

    /**
     * MAKE RESERVATION
     */
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required',
            'class_id' => 'required',
            'selected_seats' => 'required',
            'discount' => 'required',
            'total' => 'required',
        ]);

        $userID = $request->user()->id;

        $seats = json_decode($request->selected_seats);

        $reservation = Reservation::create([
            'user_id' => $userID,
            'schedule_id' => $request->schedule_id,
            'class_id' => $request->class_id,
        ]);

        foreach ($seats as $seat) {
            ReservationSeat::create([
                'reservation_id' => $reservation->id,
                'seat_no' => $seat,
            ]);
        }

        Payment::create([
            'user_id' => $userID,
            'reservation_id' => $reservation->id,
            'discount' => (int) $request->discount,
            'amount' => (float) $request->total,
        ]);

        if ($reservation) {
            return response()->json(["error" => false, "success" => true]);
        }

        return response()->json(["error" => true, "success" => false]);
    }

    public function count(Request $request)
    {
        $userID = $request->user()->id;
        $reservationCount = DB::table('reservations')
            ->where("user_id", "=", $userID)
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        return response()->json($reservationCount);

    }
}
