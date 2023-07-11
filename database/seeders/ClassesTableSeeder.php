<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ClassesTableSeeder extends Seeder
{
    protected $classes = [
        "First Class",
        "Second Class",
        "Third Class",
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        foreach ($this->classes as $class) {
            Classes::create([
                "name" => $class,
                "slug" => Str::slug($class),
            ]);
        }
    }
}
