<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create main admin user
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
            ]
        );

        // // Create demo users
        // User::factory(10)->create();

        // // Create one more admin
        // User::updateOrCreate(
        //     ['email' => 'manager@gmail.com'],
        //     [
        //         'name' => 'Manager',
        //         'password' => Hash::make('password'),
        //         'is_admin' => true,
        //         'status' => 'active',
        //     ]
        // );
    }
}
