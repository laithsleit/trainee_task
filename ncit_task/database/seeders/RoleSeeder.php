<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {





                // Retrieve roles
                $adminRole = Role::where('name', 'Admin')->first();
                $userRole = Role::where('name', 'user')->first();

                // Assign 'user' role to all users except ID 1
                User::where('id', '<>', 1)->each(function ($user) use ($userRole) {
                    $user->assignRole($userRole);
                });

                // Assign 'admin' role to user with ID 1
                User::find(1)->assignRole($adminRole);

        }


}
