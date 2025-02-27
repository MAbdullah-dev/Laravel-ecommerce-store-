<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'SuperAdmin',
            'role_id' => 1,
            'email' => 'SuperAdmin@gmail.com',
            'password' => Hash::make('12345678'), // Ensure you replace 'yourpassword' with the actual password
        ]);
    }
}
