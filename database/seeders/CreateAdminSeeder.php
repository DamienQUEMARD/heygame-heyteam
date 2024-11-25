<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()
            ->create([
                'name' => 'Admin',
                'email' => 'admin@heygame.local',
                'password' => bcrypt('password')
            ]);
    }
}
