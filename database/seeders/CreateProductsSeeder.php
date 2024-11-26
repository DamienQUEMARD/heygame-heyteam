<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // import data from JSON file
        $products = json_decode(file_get_contents((__DIR__.'/../../storage/app/private/products.json')), true);

        // insert data into the database with a random quantity
        foreach ($products as $product) {
            Product::create([...$product, 'quantity' => rand(1, 100)]);
        }
    }
}
