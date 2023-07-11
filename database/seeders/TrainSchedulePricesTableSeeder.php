<?php

namespace Database\Seeders;

use App\Models\TrainSchedulePrice;
use Illuminate\Database\Seeder;

class TrainSchedulePricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TrainSchedulePrice::factory()->count(50)->create();
    }
}
