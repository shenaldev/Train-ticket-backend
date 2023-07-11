<?php

namespace Database\Factories;

use App\Models\TrainSchedule;
use App\Models\TrainSchedulePrice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TrainSchedulePrice>
 */
class TrainSchedulePriceFactory extends Factory
{

    protected $model = TrainSchedulePrice::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $scheduleId = TrainSchedule::inRandomOrder()->first()->id;
        return [
            "schedule_id" => $scheduleId,
            "class_id" => $this->faker->numberBetween(1, 3),
            "price" => $this->faker->numberBetween(100, 2000),
        ];
    }
}
