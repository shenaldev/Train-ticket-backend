<?php

namespace App\Http\Controllers\Api\V1\Public;

use App\Http\Controllers\Controller;
use App\Models\Location;

class LocationContoller extends Controller
{
    /**
     * Fetch and return all the station locations
     */
    public function locations()
    {
        $locations = Location::all(["name", "slug"]);

        return response()->json($locations, 200);
    }
}
