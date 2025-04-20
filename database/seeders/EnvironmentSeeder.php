<?php

namespace Database\Seeders;

use App\Models\Environment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Environment::create([
            'application_id' => 1,
            'name' => "environment one",
        ]);

        Environment::create([
            'application_id' => 1,
            'name' => "environment two",
        ]);

    }
}
