<?php

namespace Database\Seeders;

use App\Models\TrainSchedule;
use Illuminate\Database\Seeder;

class TrainSchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TrainSchedule::factory()->count(50)->create();
    }
}
