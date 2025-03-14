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
        $images = [
            'products/1.png',
            'products/2.png',
            'products/3.png',
            'products/4.png',
            'products/5.png',
            'products/6.png',
            'products/7.png',
            'products/8.png',
            'products/9.png',
            'products/10.png',
           ] ;

        return [
          'name' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'description' => $this->faker->paragraph(),
            'image' => $images[rand(0, 9)],
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'featured' => $this->faker->boolean(),
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
