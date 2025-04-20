<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // RoleSeeder::class,
            // AdminSeeder::class,
            // OrderSeeder::class,
            // MechanicSeeder::class,
            // CarSeeder::class,
            // OwnerSeeder::class,
            ApplicationSeeder::class,
            EnvironmentSeeder::class,
            DeploymentSeeder::class,
        ]);
    }
}
