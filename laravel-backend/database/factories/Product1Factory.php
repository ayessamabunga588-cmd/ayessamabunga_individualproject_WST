<?php

namespace Database\Factories;

use App\Models\Product1;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product1>
 */
class Product1Factory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => \App\Models\Category::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 5, 500),
        ];
    }
}