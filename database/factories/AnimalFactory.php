<?php

namespace Database\Factories;

use App\Enums\AnimalGender;
use App\Models\Shelter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shelter_id' => Shelter::factory(),
            'name' => fake()->firstName(),
            'description' => fake()->paragraph(),
            'birthdate' => fake()->dateTimeThisDecade(),
            'gender' => fake()->randomElement(AnimalGender::class),
        ];
    }
}
