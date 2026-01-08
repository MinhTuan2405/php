<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $grades = ['10', '11', '12'];

        return [
            'name' => fake()->sentence(3),
            'category_id' => Category::inRandomOrder()->first()->id,
            'grade' => fake()->randomElement($grades),
            'price' => fake()->numberBetween(100000, 1000000),
        ];
    }
}
