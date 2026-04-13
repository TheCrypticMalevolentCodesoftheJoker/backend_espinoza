<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TblBrandFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company(),
            'status' => $this->faker->boolean(90),
        ];
    }
}
