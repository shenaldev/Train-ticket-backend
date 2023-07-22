<?php

namespace Database\Seeders;

use App\Models\ReservationSeat;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ReservationSeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $classesID = [1, 2, 3];

    public function run(): void
    {
        $faker = Faker::create();

        foreach ($this->classesID as $class) {
            for ($i = 1; $i <= 2; $i++) {
                ReservationSeat::create([
                    'reservation_id' => $class,
                    'seat_no' => $faker->numberBetween(1, 20),
                ]);
            }
        }
    }
}
