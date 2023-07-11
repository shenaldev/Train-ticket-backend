<?php

namespace Database\Seeders;

use App\Models\Train;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TrainsTableSeeder extends Seeder
{
    private $trainNames = array("Rajadhani Express", "Podi Menike", "Udarata Menike", "Yal Devi", "Expo Rail", "Viceroy II", "Sagarika", "Galu Kumari", "Dunhinda", "Denuwara Menike", "Badulla Night Mail", "Uththara Devi", "Muththettugala Menike", "Maho Jaya Sri Maha Bodhiya", "Samudradevi", "Vavuniya Night Mail", "Senkadagala Menike", "Rajarata Rejini", "Kumari", "Ratnapura Raja Rata");

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->trainNames as $trainName) {
            Train::create([
                'name' => $trainName,
                'slug' => Str::slug($trainName),
            ]);
        }
    }
}
