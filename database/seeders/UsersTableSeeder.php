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
            'email' => 'admin@trains.com',
            "phone_no" => "075-456-6651",
            'nic' => '895001506v',
            'password' => Hash::make('password'),
        ]);

        UserRole::create([
            'user_id' => $admin->id,
            'role_id' => 1,
        ]);

        $user1 = User::create([
            'name' => 'Boyce Cole',
            'email' => 'boyce@mail.com',
            "phone_no" => "075-456-6653",
            'nic' => '992501502v',
            'password' => Hash::make('password'),
        ]);

        UserRole::create([
            'user_id' => $user1->id,
            'role_id' => 2,
        ]);

        $user2 = User::create([
            'name' => 'Kasun Lakmal',
            'email' => 'kasun@mail.com',
            "phone_no" => "077-356-4253",
            'nic' => '972106302v',
            'password' => Hash::make('password'),
        ]);

        UserRole::create([
            'user_id' => $user2->id,
            'role_id' => 2,
        ]);

        $user3 = User::create([
            'name' => 'Ishan Fernando',
            'email' => 'ishan@mail.com',
            "phone_no" => "071-456-1273",
            'nic' => '19995631226',
            'password' => Hash::make('password'),
        ]);

        UserRole::create([
            'user_id' => $user3->id,
            'role_id' => 2,
        ]);

        $user4 = User::create([
            'name' => 'Danushi Malesha',
            'email' => 'danushi@mail.com',
            "phone_no" => "078-254-9853",
            'nic' => '19974563566',
            'password' => Hash::make('password'),
        ]);

        UserRole::create([
            'user_id' => $user4->id,
            'role_id' => 2,
        ]);

    }
}
