<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationsTableSeeder extends Seeder
{
    private $stations = [
        "Ahangama",
        "Aluthgama",
        "Ambalangoda",
        "Ambewela",
        "Anuradhapura",
        "Anuradhapura Town",
        "Avissawella",
        "Badulla",
        "Bandarawela",
        "Batticaloa",
        "Beliatta",
        "Bentota",
        "Beruwala",
        "China bay",
        "Chunnakam",
        "Colombo Fort",
        "Demodara-Ella",
        "Diyathalawa",
        "Ella",
        "Eraur",
        "Galgamuwa",
        "Galle",
        "Galoya",
        "Gampaha",
        "Gampola",
        "Habaraduwa",
        "Habarana",
        "Hali Ela",
        "Haputhale",
        "Hatton",
        "Hikkaduwa",
        "Hingurakgoda",
        "Jaffna",
        "Kakirawa",
        "Kalutara South",
        "Kamburugamuwa",
        "Kandy",
        "Kankesanthurai",
        "Kanthale",
        "Kilinochchi",
        "Kodikamam",
        "Koggala",
        "Kurunegala",
        "Madhupara",
        "Mahawa",
        "Makumbura",
        "Mannar",
        "Maradhana",
        "Matale",
        "Matara",
        "Medawachchiya",
        "Mirigama",
        "Mirissa",
        "Moratuwa",
        "Mount Lavinia",
        "NAGOLLAGAMA",
        "Nanu Oya",
        "Nawalapitiya",
        "Nuwaraeliya",
        "Nugegoda",
        "Omantha",
        "Pallai",
        "Panadura",
        "Peradeniya",
        "Polgahawela",
        "Polonnaruwa",
        "Puwakpitiya",
        "Ragama",
        "Rambukkana",
        "Rathmalana",
        "Talaimannar Pier",
        "Thambalagamuwa",
        "Thambuththegama",
        "Thandikulam",
        "Trincomalee",
        "Unawatuna",
        "Valachchena",
        "Vauniya",
        "Veyangoda",
        "Waduwwa",
        "Weligama",
        "Welikanda",
        "Wellawa",
        "Wellawatte",
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        foreach ($this->stations as $station) {
            Location::create([
                'name' => $station,
                'slug' => Str::slug($station),
            ]);
        }

    }
}
