<?php

namespace App\Http\Resources;

use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Animal
 */
class AnimalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'shelter' => ShelterResource::make($this->whenLoaded('shelter')),
            'species' => SpeciesResource::make($this->whenLoaded('species')),
        ];
    }
}
