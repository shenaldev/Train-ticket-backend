<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Train;
use Illuminate\Http\Request;

class TrainContoller extends Controller
{
    public function index(Request $request)
    {
        $trains = Train::all(["id", "name", "slug"]);

        return response()->json($trains);
    }
}
