<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@auth.com',
            "phone_no" => "075-456-6651",
            'password' => Hash::make('pass'),
        ]);

        UserRole::create([
            'user_id' => $admin->id,
            'role_id' => 1,
        ]);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@auth.com',
            "phone_no" => "075-456-6653",
            'password' => Hash::make('pass'),
        ]);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => 2,
        ]);

    }
}
