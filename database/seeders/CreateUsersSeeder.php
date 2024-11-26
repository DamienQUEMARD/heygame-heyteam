<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an user
        User::query()
            ->create([
                'name' => 'user',
                'email' => 'user@heygame.local',
                'password' => bcrypt('password'),
                'role' => 'user'
            ]);

        // Create an admin
        User::query()
        ->create([
            'name' => 'admin',
            'email' => 'admin@heygame.local',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

    }
}
