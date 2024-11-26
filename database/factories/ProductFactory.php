<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $priceWithoutVat = $this->faker->randomFloat(2, 1, 100);

        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->randomElement(['rpg', 'sports', 'fps', 'rts']),
            'quantity' => $this->faker->numberBetween(1, 100),
            'barcode' => $this->faker->ean13(),
            'price_without_vat' => $priceWithoutVat,
            'price_with_vat' => $priceWithoutVat * 1.20
        ];
    }
}
