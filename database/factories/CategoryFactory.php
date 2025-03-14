<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
           $images = [
            'categories/1.png',
            'categories/2.png',
            'categories/3.png',
            'categories/4.png',
            'categories/5.png',
           ] ;
        return [
            'name' => $this->faker->name(),
            'category_image' => $images[rand(0, 4)],
            'status' => 'active'
        ];
    }
}
