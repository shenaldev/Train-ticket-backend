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
            'route_ids' => json_encode([37, 64, 25, 58, 30, 59, 29, 19, 8]),
        ]);

        TrainRoute::create([
            'from_to' => 'badulla-kandy',
            'route_ids' => json_encode([8, 19, 29, 59, 30, 58, 25, 64, 37]),
        ]);

        TrainRoute::create([
            'from_to' => 'kandy-colombo',
            'route_ids' => json_encode([37, 64, 69, 65, 52, 24, 68, 16]),
        ]);

        TrainRoute::create([
            'from_to' => 'colombo-kandy',
            'route_ids' => json_encode([16, 68, 24, 52, 65, 69, 64, 37]),
        ]);

        TrainRoute::create([
            'from_to' => 'colombo-galle',
            'route_ids' => json_encode([16, 54, 63, 35, 12, 31, 22]),
        ]);

        TrainRoute::create([
            'from_to' => 'galle-colombo',
            'route_ids' => json_encode([22, 31, 12, 35, 63, 54, 16]),
        ]);

        TrainRoute::create([
            'from_to' => 'kurunagala-anuradhapura',
            'route_ids' => json_encode([43, 21, 73, 5]),
        ]);

        TrainRoute::create([
            'from_to' => 'anuradhapura-kurunagala',
            'route_ids' => json_encode([5, 73, 21, 43]),
        ]);

    }
}
