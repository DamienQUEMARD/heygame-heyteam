<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use Database\Factories\OrderLineFactory;
use Illuminate\Database\Seeder;

class CreateOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()
            ->count(1)
            ->has(OrderLineFactory::new()->count(1))
            ->create();
    }
}
