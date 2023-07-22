<?php

namespace Database\Seeders;

use App\Models\TrainRoute;
use Illuminate\Database\Seeder;

class TrainRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TrainRoute::create([
            'from_to' => 'kandy-badulla',
            'route_ids' => json_encode([37, 8, 58, 30, 59, 19, 25]),
        ]);

        TrainRoute::create([
            'from_to' => 'badulla-kandy',
            'route_ids' => json_encode([25, 19, 59, 30, 58, 8, 37]),
        ]);

        TrainRoute::create([
            'from_to' => 'kandy-colombo',
            'route_ids' => json_encode([37, 69, 65, 52, 24, 68, 16]),
        ]);

        TrainRoute::create([
            'from_to' => 'colombo-kandy',
            'route_ids' => json_encode([16, 68, 24, 52, 65, 69, 37]),
        ]);

        TrainRoute::create([
            'from_to' => 'colombo-galle',
            'route_ids' => json_encode([16, 35, 3, 31, 22]),
        ]);

    }
}
