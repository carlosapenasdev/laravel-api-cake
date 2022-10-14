<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cake>
 */
class CakeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name"      => $this->faker->firstName(),
            "weight"    => $this->faker->numberBetween(10, 9000),
            "price"     => $this->faker->randomFloat(2, 1, 100),
            "amount"    => $this->faker->numberBetween(0, 10),
        ];
    }
}
