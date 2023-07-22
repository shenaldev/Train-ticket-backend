<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainSchedule;
use App\Models\TrainSchedulePrice;
use App\Models\TrainScheduleSeat;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TrainScheduleContoller extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'train_id' => 'required',
            'from_id' => 'required',
            'to_id' => 'required',
            'routes_id' => 'required',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'prices' => 'required',
        ]);

        $prices = json_decode($request->prices);

        try {

            DB::transaction(function () use ($request, $prices) {

                $schedule = TrainSchedule::create([
                    'train_id' => $request->train_id,
                    'from' => $request->from_id,
                    'to' => $request->to_id,
                    'departure_time' => new DateTime($request->departure_time),
                    'arrival_time' => new DateTime($request->arrival_time),
                    'routes_id' => $request->routes_id,
                ]);

                foreach ($prices->class as $price) {
                    TrainSchedulePrice::create([
                        'schedule_id' => $schedule->id,
                        'class_id' => $price->id,
                        'price' => (float) $price->price,
                    ]);
                }

                for ($i = 1; $i <= 3; $i++) {
                    TrainScheduleSeat::create([
                        'schedule_id' => $schedule->id,
                        'class_id' => $i,
                        'available_count' => 20,
                    ]);
                }
            });
        } catch (Exception $e) {
            return response()->json(["error" => true, "success" => false]);
        }

        return response()->json(["error" => false, "success" => true]);

    }
}
