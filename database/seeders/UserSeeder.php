<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrInsert(
            [
                'email' => 'superadmin@gmail.com',
            ],
            [
                'name' => 'super admin',
                'password' => Hash::make('Juaraumum1'),
            ]
        );
        $superAdmin = User::where('email', 'superadmin@gmail.com')->first();
        $superAdmin->assignRole('superadmin');

        User::updateOrInsert(
            [
                'email' => 'admin1@gmail.com',
            ],
            [
                'name' => 'admin 1',
                'password' => Hash::make('password'),
            ]
        );
        $admin1 = User::where('email', 'admin1@gmail.com')->first();
        $admin1->assignRole('admin');

        User::updateOrInsert(
            [
                'email' => 'admin2@gmail.com',
            ],
            [
                'name' => 'admin 2',
                'password' => Hash::make('password'),
            ]
        );
        $admin2 = User::where('email', 'admin2@gmail.com')->first();
        $admin2->assignRole('admin');

        User::updateOrInsert(
            [
                'email' => 'user1@gmail.com',
            ],
            [
                'name' => 'user 1',
                'password' => Hash::make('password'),
            ]
        );
        $user1 = User::where('email', 'user1@gmail.com')->first();
        $user1->assignRole('manajer');

        User::updateOrInsert(
            [
                'email' => 'user2@gmail.com',
            ],
            [
                'name' => 'user 2',
                'password' => Hash::make('password'),
            ]
        );
        $user2 = User::where('email', 'user2@gmail.com')->first();
        $user2->assignRole('manajer');
    }
}
