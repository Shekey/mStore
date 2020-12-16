<?php

namespace Database\Factories;

use App\Models\Articles;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticlesFactory extends Factory
{
    protected $model = Articles::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'brand' => $this->faker->unique()->lastName,
            'price' => 11.33,
            'isActive' => 1,
            'isOnSale' => rand(0, 1),
            'profitMake' => rand(0, 1),
            'category_id' => rand(1, 3),
            'market_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
