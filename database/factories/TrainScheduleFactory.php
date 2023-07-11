<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Train;
use App\Models\TrainSchedule;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainSchedule>
 */
class TrainScheduleFactory extends Factory
{
    protected $model = TrainSchedule::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get random train_id from the Train model
        $trainId = Train::inRandomOrder()->first()->id;
        // Get random 'from' and 'to'
        $fromId = Location::inRandomOrder()->first()->id;
        $toId = Location::inRandomOrder()->first()->id;
        // Generate random departure and arrival times
        $departureTime = $this->faker->dateTimeBetween('now', '+2 hours');
        $arrivalTime = Carbon::instance($departureTime)->addHours(rand(2, 10));

        return [
            "train_id" => $trainId,
            "from" => $fromId,
            "to" => $toId,
            "departure_time" => $departureTime,
            "arrival_time" => $arrivalTime,
        ];
    }
}
