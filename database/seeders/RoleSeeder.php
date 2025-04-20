<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = [ 'admin', 'user'];

        for($i = 0; $i < count($roles); $i++){

            Role::create([
                'name' => $roles[$i],
                'guard_name' => 'web',
            ]);

        }

    }
}
