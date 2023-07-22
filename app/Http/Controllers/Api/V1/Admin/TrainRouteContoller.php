<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\TrainRoute;

class TrainRouteContoller extends Controller
{
    public function index()
    {
        $routes = TrainRoute::all(["id", "from_to", "route_ids"]);

        $routesWithLocations = [];

        foreach ($routes as $route) {
            $locations = json_decode($route->route_ids);
            $temp = [
                'id' => $route->id,
                'from_to' => $route->from_to,
                'locations' => [],
            ];
            foreach ($locations as $location) {
                $locationdb = Location::where("id", "=", $location)->first();
                array_push($temp['locations'], $locationdb->name);
            }
            array_push($routesWithLocations, $temp);
        }

        return response()->json($routesWithLocations);
    }
}
