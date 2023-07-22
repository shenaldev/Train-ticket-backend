<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $classesID = [1, 2, 3];

    public function run(): void
    {
        foreach ($this->classesID as $class) {
            Reservation::create([
                'user_id' => 1,
                'schedule_id' => 1,
                'class_id' => $class,
            ]);
        }
    }
}
