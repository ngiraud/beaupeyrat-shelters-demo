<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Shelter;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Animal::factory()
            ->count(100)
            ->state(new Sequence(
                fn (Sequence $sequence) => ['shelter_id' => Shelter::all()->random()],
            ))
            ->create();
    }
}
