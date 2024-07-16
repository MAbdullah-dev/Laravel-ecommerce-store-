<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'SuperAdmin',
            'role_id'=>1,
            'email'=>'SuperAdmin@gmail.com',
            'password'=>'$2y$10$aArqyV5xMP9wIXMnFqiKNODbqj2p556emAY4sntgWNRyC6KszYzqW'
        ]);
    }
}
