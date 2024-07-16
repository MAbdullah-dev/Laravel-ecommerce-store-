<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['role_name' => 'SuperAdmin'],
            ['role_name' => 'StoreOwner'],
            ['role_name' => 'User'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
