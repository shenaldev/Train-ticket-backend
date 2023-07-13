<?php

namespace App\Http\Controllers\Api\V1\Public;

use App\Http\Controllers\Controller;
use App\Models\TrainSchedule;
use DateTime;
use Illuminate\Http\Request;

class TrainScheduleContoller extends Controller
{
    //
    public function search(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'date' => 'required',
        ]);

        $from = $request->from;
        $to = $request->to;
        $date = $request->date;

        //GET USER SELECTED LOCATION DATA
        $trains = TrainSchedule::select(["train_schedules.*",
            "from.name as from",
            "to.name as to",
            "trains.name as train_name",
        ])
            ->where("from", "=", $from)
            ->where("to", "=", $to)
            ->where("departure_time", ">=", new DateTime($date))
            ->join("trains", "train_schedules.train_id", "=", "trains.id")
            ->join("locations as from", "train_schedules.from", "=", "from.id")
            ->join("locations as to", "train_schedules.to", "=", "to.id")
            ->with("schedule_price", "schedule_seats")
            ->get();

        return response()->json($trains);
    }
}
