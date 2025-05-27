<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::factory(),
            'total_stocks' =>fake()->numberBetween(30,100),
            'remaining_stocks' =>fake()->numberBetween(1,35),
            'stock_price' =>fake()->numberBetween(19000,50000),
            ];
    }
}
