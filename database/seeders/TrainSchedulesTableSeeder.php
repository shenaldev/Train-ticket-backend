<?php

namespace Database\Seeders;

use App\Models\TrainSchedule;
use App\Models\TrainSchedulePrice;
use App\Models\TrainScheduleSeat;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TrainSchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $classesID = [1, 2, 3];
    public function run(): void
    {
        $faker = Faker::create();
        $fakeDate = $faker->dateTimeBetween("now", "+1 months");

        //KANDY TO BADULLA
        $schedule1 = TrainSchedule::create([
            'train_id' => 2,
            'from' => 37,
            'to' => 8,
            'routes_id' => 1,
            'departure_time' => $fakeDate,
            'arrival_time' => $faker->dateTimeBetween($fakeDate, $fakeDate->format('Y-m-d H:i:s') . ' +6 hours'),
        ]);

        $this->seedRelations($schedule1->id, $faker);

        //BADULLA TO KANDY
        $schedule1 = TrainSchedule::create([
            'train_id' => 11,
            'from' => 8,
            'to' => 37,
            'routes_id' => 2,
            'departure_time' => $fakeDate,
            'arrival_time' => $faker->dateTimeBetween($fakeDate, $fakeDate->format('Y-m-d H:i:s') . ' +6 hours'),
        ]);

        $this->seedRelations($schedule1->id, $faker);

        //KANDY TO COLOMBO
        $schedule2 = TrainSchedule::create([
            'train_id' => 3,
            'from' => 37,
            'to' => 16,
            'routes_id' => 3,
            'departure_time' => $fakeDate,
            'arrival_time' => $faker->dateTimeBetween($fakeDate, $fakeDate->format('Y-m-d H:i:s') . ' +6 hours'),
        ]);

        $this->seedRelations($schedule2->id, $faker);

        //COLOMBO TO KANDY
        $schedule3 = TrainSchedule::create([
            'train_id' => 17,
            'from' => 37,
            'to' => 8,
            'routes_id' => 4,
            'departure_time' => $fakeDate,
            'arrival_time' => $faker->dateTimeBetween($fakeDate, $fakeDate->format('Y-m-d H:i:s') . ' +6 hours'),
        ]);

        $this->seedRelations($schedule3->id, $faker);

        //COLOMBO TO GALLA
        $schedule1 = TrainSchedule::create([
            'train_id' => 8,
            'from' => 16,
            'to' => 22,
            'routes_id' => 5,
            'departure_time' => $fakeDate,
            'arrival_time' => $faker->dateTimeBetween($fakeDate, $fakeDate->format('Y-m-d H:i:s') . ' +6 hours'),
        ]);

        $this->seedRelations($schedule1->id, $faker);

    }

    protected function seedRelations($scheduleID, $faker)
    {
        foreach ($this->classesID as $class) {
            $price = $faker->numberBetween(100, 500);
            if ($class == 1) {
                $price = $faker->numberBetween(1000, 2000);
            } elseif ($class == 2) {
                $price = $faker->numberBetween(500, 1000);
            }
            TrainSchedulePrice::create([
                'schedule_id' => $scheduleID,
                'class_id' => $class,
                'price' => $price,
            ]);

            TrainScheduleSeat::create([
                'schedule_id' => $scheduleID,
                'class_id' => $class,
                'available_count' => 20,
            ]);
        }

    }
}
