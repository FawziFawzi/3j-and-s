<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->text(),
            'category' => fake()->randomElement(['تقني', 'زراعي', 'تجاري', 'زراعي', 'صحي']),
            'image' => 'project.jpg',
            'money' => fake()->numberBetween(100000,10000000),
            'user_id' => fake()->numberBetween(1,3),

        ];
    }
}
