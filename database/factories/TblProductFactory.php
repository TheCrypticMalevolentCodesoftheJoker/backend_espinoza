<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Modules\Catalog\Brand\Infrastructure\Persistence\Eloquent\Models\TblBrand;
use App\Modules\Catalog\Category\Infrastructure\Persistence\Eloquent\Models\TblCategory;

class TblProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->bothify('PROD-####'),
            'category_id' => TblCategory::inRandomOrder()->value('id'),
            'brand_id'     => TblBrand::inRandomOrder()->value('id'),

            'name' => $this->faker->words(3, true),
            'description' => $this->faker->optional()->sentence(12),
            'unit_measure' => $this->faker->randomElement(['m2', 'pieza', 'caja']),
            'status' => $this->faker->boolean(90),
        ];
    }
}
