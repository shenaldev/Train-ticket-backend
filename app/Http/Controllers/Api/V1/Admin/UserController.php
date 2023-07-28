<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(30);

        return response()->json($users);
    }

    public function update(Request $request)
    {
        $request->validate([
            'user_id' => 'string|required',
            "name" => "string|nullable",
            "phone_no" => "string|nullable",
            'nic' => 'string|nullable',
            "address" => "string|nullable",
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(["message" => "User not found"], 404);
        }

        if ($request->filled("name")) {
            $user->name = $request->name;
        }

        if ($request->filled("phone_no")) {
            $user->phone_no = $request->phone_no;
        }

        if ($request->filled("nic")) {
            $user->nic = $request->nic;
        }

        if ($request->filled("address")) {
            $user->address = $request->address;
        }

        $user->save();

        return response()->json($user);
    }

    public function destroy($userId)
    {
        User::destroy($userId);

        return response()->json(["message" => "User deleted successfully"], 200);
    }
}
