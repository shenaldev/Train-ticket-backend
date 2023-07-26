<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(30);

        return response()->json($users);
    }

    public function destroy($userId)
    {
        User::destroy($userId);

        return response()->json(["message" => "User deleted successfully"], 200);
    }
}
