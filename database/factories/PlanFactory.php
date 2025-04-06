<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'plan_name' => fake()->word(),
            'price' => fake()->randomFloat(2, 10, 100),
            'features' => [
                'support' => true,
                'storage' => fake()->randomNumber(2) . ' GB',
                'analytics' => fake()->boolean(),
            ],
        ];
    }
}
