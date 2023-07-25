<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    protected $mostUsedTrainSchedule = [
        [
            'month' => '2023-03',
            'schedule' => 'kandy-colombo',
        ],
        [
            'month' => '2023-04',
            'schedule' => 'kandy-colombo',
        ],
        [
            'month' => '2023-05',
            'schedule' => 'kandy-badulla',
        ],
        [
            'month' => '2023-06',
            'schedule' => 'kandy-badulla',
        ],
        [
            'month' => '2023-07',
            'schedule' => 'colombo-kandy',
        ],
    ];

    public function index()
    {
        $totalBookings = DB::table('reservations')
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        $totalIncomes = DB::table("payments")
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(amount) as total')
            ->groupBy('month')
            ->get();

        $mostUsedClass = $this->getMostUsedClass();

        return response()->json([
            'monthly_bookings' => $totalBookings,
            'monthly_income' => $totalIncomes,
            'most_used_schedule' => $this->mostUsedTrainSchedule,
            'most_used_class' => $mostUsedClass,
        ]);
    }

    public function getMostUsedClass()
    {
        $mostUsedClass = DB::table('reservations')
            ->select('class_id', DB::raw('COUNT(*) as count'), DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'))
            ->groupBy('class_id', 'month')
            ->orderBy('month')
            ->orderByDesc('count')
            ->get();

        $monthlyMostUsedClass = [];

        foreach ($mostUsedClass as $data) {
            $month = $data->month;
            $classId = $data->class_id;
            $count = $data->count;

            if (!isset($monthlyMostUsedClass[$month]) || $count > $monthlyMostUsedClass[$month]['no_of_bookings']) {
                $monthlyMostUsedClass[$month] = [
                    'class_id' => $classId,
                    'no_of_bookings' => $count,
                ];
            }
        }
        return $monthlyMostUsedClass;
    }
}
