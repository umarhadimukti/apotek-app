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
            'name' => $this->faker->sentence(3),
            'slug' => $this->faker->slug(3, false),
            'price' => $this->faker->randomNumber(5, true),
            'about' => $this->faker->paragraph(2, false),
            'category_id' => rand(1, 5),
        ];
    }
}
