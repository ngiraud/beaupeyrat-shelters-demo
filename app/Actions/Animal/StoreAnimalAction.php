<?php

namespace App\Actions\Animal;

use App\Models\Animal;

class StoreAnimalAction
{
    protected ?Animal $animal = null;

    /**
     * @param  array<string, mixed>  $data
     */
    public function execute(array $data): Animal
    {
        $animal = $this->animal ?? new Animal();

        $animal->fill($data)->save();

        return $animal;
    }

    public function on(Animal $animal): static
    {
        $this->animal = $animal;

        return $this;
    }
}
