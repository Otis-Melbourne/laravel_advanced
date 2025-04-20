<?php

namespace Database\Seeders;

use App\Models\Deployment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeploymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Deployment::create([
            'environment_id' => 1,
            'commit_hash' => "83aef0f9b5c30d39516eb9d60eab248bcc94b27e",
        ]);

        Deployment::create([
            'environment_id' => 1,
            'commit_hash' => "83aef0f9b5cfdsaofeefd16eb9d60eab24efadsa",
        ]);
        

        Deployment::create([
            'environment_id' => 2,
            'commit_hash' => "83aef0f9b5c30d39516eb9d60eab248bcc94b27e",
        ]);

        Deployment::create([
            'environment_id' => 2,
            'commit_hash' => "83aef0f9b5cfdsaofeefd16eb9d60eab24efadsa",
        ]);
    }
}
