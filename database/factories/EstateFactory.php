<?php

namespace Database\Factories;

use App\Models\Estate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estate>
 */
class EstateFactory extends Factory
{
    /** @var class-string<TModelClass> */
    protected $model = Estate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(10000, 1000000),
            'surface' => $this->faker->numberBetween(50, 500),
            'rooms' => $this->faker->numberBetween(1, 10),
        ];
    }
}
