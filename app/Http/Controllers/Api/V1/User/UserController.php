<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return response()->json($user);
    }

    public function update(Request $request)
    {
        $request->validate([
            "name" => "string|nullable",
            "phone_no" => "string|nullable",
            'nic' => 'string|nullable',
            "address" => "string|nullable",
        ]);

        $user = User::find($request->user()->id);

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
}
