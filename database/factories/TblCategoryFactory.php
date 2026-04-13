<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TblCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->unique()->word()),
            'status' => $this->faker->boolean(90),
        ];
    }
}
