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
        return [
            "name"        => fake()->name(),
            "description" => fake()->paragraph(6),
            "summary"     => fake()->text(),
            "weight"      => fake()->randomNumber(1, 80),
            "dimensions"  => fake()->randomNumber(1, 80),
            "price"       => fake()->randomFloat(2, 20, 90),
        ];
    }
}
